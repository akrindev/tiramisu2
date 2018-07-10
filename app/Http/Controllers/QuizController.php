<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;
use App\QuizScore;
use App\User;
use Auth;

class QuizController extends Controller
{
  	public function show()
    {
      return view('quiz.show');
    }

  	public function mulaiQuiz()
    {
      $quizzes = Quiz::whereApproved(1)->inRandomOrder()->take(10)->distinct()->get();

      $i = 1;

      foreach($quizzes as $k):
      	// taruh quiz di session
      	session()->put('q-'.$i,[
        	'quiz_id'	=> $k->id,
          	'by'		=> $k->user->name,
         	'question'	=> $k->question,
          	'jawaban_a'	=> $k->answer_a,
          	'jawaban_b'	=> $k->answer_b,
          	'jawaban_c'	=> $k->answer_c,
          	'jawaban_d'	=> $k->answer_d,
        ]);

      	// nomer quiz
      	$i++;
      endforeach;

      session()->put('qkey',sha1(now()));

      return view('quiz.kerjakan');
    }

  	public function kerjakan()
    {
      if(!session('qkey'))
      {
        return redirect('/quiz');
      }

      return view('quiz.begin');
    }

  	public function ajax($id)
    {
      $id = ($id > 10) ? 1 : $id;

      return view('quiz.ajax',[
      	'data'	=> session('q-'.$id),
        'id' => $id
      ]);
    }

  	public function ajaxTerjawab()
    {
      $terjawab = 0;

      for ($i = 1; $i <= 10;$i++)
      {
        $terjawab += session('jawaban-'.$i) ? 1 : 0;
      }

      return view('quiz.terjawab',compact('terjawab'));
    }

  	public function saveAnswer()
    {
      session(request()->except('_token'));

      return response()->json(['success'=> true]);
    }

  	public function koreksi()
    {
      // jika kunci quiz tidak ada
      if( ! session('qkey'))
      {
        return redirect('/quiz');
      }

      // asign
      $benar = 0;
      $salah = 0;
      $point = 0;

      // koreksi 10 soal
      for ($i = 1; $i <= 10; $i++)
      {
        $jawaban = session('jawaban-'.$i);
        $true = session('q-'.$i);

        $true_answer = Quiz::where('id',$true['quiz_id'])->first();

        // jika jawaban benar
        if ($true_answer->correct == $jawaban)
        {
          $true_answer->increment('benar');
          $benar++;
        }
        else
        {
          $true_answer->increment('salah');
          $salah++;
        }

        // hapys sesi
        session()->forget('jawaban-'.$i);
        session()->forget('q-'.$i);
      }

      // selesai mengoreksi hapus kunci soal
      session()->forget('qkey');

      switch($benar)
      {
        case 1:
        case 2:
          $point = 2;
          break;
        case 3:
        case 4:
        case 5:
          $point = 5;
          break;
        case 6:
        case 7:
        case 8:
          $point = 8;
          break;
        case 9:
        case 10:
          $point = 10;
          break;
        default:
          $point = 2;
          break;
      }

      $score = Auth::user()->quizScore;

      $total_benar = 0;
      $total_salah = 0;
      $total_point = 0;

      if( ! $score)
      {
        QuizScore::create([
          'user_id' => auth()->id(),
          'benar' => 0,
          'salah'	=> 0,
          'point'	=> 0
        ]);
      }
      else
      {
        $total_benar = $score->benar;
        $total_salah = $score->salah;
        $total_point = $score->point;
      }

      $result = QuizScore::where('user_id',auth()->id())
        ->update([
      	'benar' => $total_benar + $benar,
        'salah' => $total_salah + $salah,
        'point' => $total_point + $point
      ]);

      return view('quiz.result',[
      	'benar' => $benar,
        'salah' => $salah,
        'point' => $point
      ]);
    }

    public function tambah()
    {
      return view('quiz.tambah');
    }

  	public function tambahSubmit()
    {

      $val = \Validator::make(request()->all(),[
		'pertanyaan' => 'required',
        'jawaban_a' => 'required',
        'jawaban_b' => 'required',
        'jawaban_c' => 'required',
        'jawaban_d' => 'required',
        'benar'	=> 'required'
      ],[
      	'required' => 'Kolom ini nggak boleh di kosongin'
      ]);


      $response = [
        'success' => true,
        'messages' => [],
        'csrfHash' => csrf_token()
      ];

      if($val->fails() === true)
      {
        $response = [
          'success' => false,
          'messages' => $val->getMessageBag()->toArray()
        ];

      }

      $quiz = Quiz::create([
      	'user_id'	=> auth()->id(),
        'question'	=> request()->pertanyaan,
        'answer_a'	=> request()->jawaban_a,
        'answer_b'	=> request()->jawaban_b,
        'answer_c'	=> request()->jawaban_c,
        'answer_d'	=> request()->jawaban_d,
        'correct'		=> request()->benar
      ]);

      if($quiz)
      {

    	  return response()->json($response)
      		  ->header('Content-Type','application/json');
      }
    }
}