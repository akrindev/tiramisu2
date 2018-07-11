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
      if( ! request()->ajax() || ! session('qkey'))
      {
        die('Miaww senpai chann *-*)/');
      }

      $id = ($id > 10) ? 1 : $id;

      return view('quiz.ajax',[
      	'data'	=> session('q-'.$id),
        'id' => $id
      ]);
    }

  	public function ajaxTerjawab()
    {
      if( ! request()->ajax() || ! session('qkey'))
      {
        die('Miaww senpai chann *-*)/');
      }

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
        session()->forget(['jawaban-'.$i,'q-'.$i]);
       // session()->forget('q-'.$i);
      }

      // selesai mengoreksi hapus kunci soal
      session()->forget(['qkey']);

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
      }

      $benarku = auth()->user()->quizScore->benar ?? 0;
      $salahku = auth()->user()->quizScore->salah ?? 0;
      $pointku = auth()->user()->quizScore->point ?? 0;

      $score = QuizScore::updateOrCreate(
      [
        'user_id' => auth()->id()
      ],
      [
        'benar' 	=> $benarku + $benar,
        'salah'		=> $salahku + $salah,
        'point'		=> $pointku + $point
      ]);

      return view('quiz.result',[
      	'benar' => $benar,
        'salah' => $salah,
        'point' => $point,
        'score'	=> Auth::user()->quizScore
      ]);
    }

  	public function myProfile()
    {
      $quizzes = Auth::user()->quiz()->latest()->paginate(10);

      return view('auth.quiz',[
      	'quizzes' => $quizzes
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

  	public function edit($id)
    {
      $quiz = Quiz::findOrFail($id);

      if(auth()->id() != $quiz->user_id)
      {
        return redirect('/')->with('gagal','Akses ditolak');
      }

      return view('quiz.edit',[
      	"data" => $quiz
      ]);
    }

  	public function editSubmit($id)
    {
      $quiz = Quiz::findOrFail($id);

      if(auth()->id() != $quiz->user_id)
      {
        if(auth()->user()->role == 'member')
        {
        	return redirect('/')->with('gagal','Akses ditolak');
        }
      }

      request()->validate([
		'pertanyaan' => 'required',
        'jawaban_a' => 'required',
        'jawaban_b' => 'required',
        'jawaban_c' => 'required',
        'jawaban_d' => 'required',
        'benar'	=> 'required'
      ],[
      	'required' => 'Kolom ini nggak boleh di kosongin'
      ]);

      $updated = $quiz->update([
        'question'	=> request()->pertanyaan,
        'answer_a'	=> request()->jawaban_a,
        'answer_b'	=> request()->jawaban_b,
        'answer_c'	=> request()->jawaban_c,
        'answer_d'	=> request()->jawaban_d,
        'correct'	=> request()->benar
      ]);

      if($updated)
      {
        return back()->with('sukses','Data berhasil di ubah yey *-*)/');
      }
    }


  	/**
    * Only admin can do this action
    */
  	public function destroy()
    {
      $quiz = Quiz::findOrFail(request()->id);

      if(auth()->user()->role == 'member')
      {
      	return redirect('/')->with('gagal','Akses ditolak');       }

      $quiz->approved = request()->status;

      if($quiz->save())
      {
        return response()->json(['success'=>true]);
      }
    }

  	public function admin()
    {
      if(auth()->user()->role != 'admin')
      {
        return redirect('/')->with('gagal', 'Akses Ditolak');
      }

      $quizzes = Quiz::latest()->paginate(20);
      $scores = QuizScore::get();

      return view('quiz.admin', [
        'quiz'		=> Quiz::get(),
      	'quizzes'	=> $quizzes,
        'scores'	=> $scores
      ]);
    }
}