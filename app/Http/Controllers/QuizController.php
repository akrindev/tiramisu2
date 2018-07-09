<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;

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

  	public function saveAnswer()
    {
      session(request()->except('_token'));

      return response()->json(['success'=> true]);
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