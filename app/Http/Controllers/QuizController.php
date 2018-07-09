<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function tambah()
    {
      return view('quiz.tambah');
    }

  	public function tambahSubmit()
    {

      $response = [
        'messages' => [],
        'csrfHash' => csrf_token()
      ];
      $val = \Validator::make(request()->all(),[
		'question' => 'required',
        'jawaban_a' => 'required',
        'jawaban_b' => 'required',
        'jawaban_c' => 'required',
        'jawaban_d' => 'required',
      ]);

      $response['success'] = true;

      foreach($val->getMessageBag()->toArray() as $e)
      {
        dd($e);
      }

      return;

      if($val->fails())
      {
        $response = [
          'success' => false,
          'messages' => $val->errors()->all()
        ];

      }


      return response()->json($response)
        ->header('Content-Type','application/json');
    }
}