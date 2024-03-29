<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\QuizCode;
use App\QuizScore;
use App\QuizScoreCode;
use App\User;
use Auth;

class QuizController extends Controller
{
    /**
     * show
     *
     * @return void
     */
    public function show()
    {
        return view('quiz.show');
    }

    /**
     * mulaiQuiz
     *
     * @return void
     */
    public function mulaiQuiz()
    {
        $quizzes = Quiz::whereApproved(1)->inRandomOrder()->take(10)->distinct()->get();

        $i = 1;

        foreach ($quizzes as $k) {
            // taruh quiz di session
            session()->put('q-'.$i, [
                'quiz_id' => $k->id,
                'by' => $k->user->name,
                'question' => $k->question,
                'jawaban_a' => $k->answer_a,
                'jawaban_b' => $k->answer_b,
                'jawaban_c' => $k->answer_c,
                'jawaban_d' => $k->answer_d,
            ]);

            // nomer quiz
            $i++;
        }

        session()->put('qkey', sha1(now()));

        return view('quiz.kerjakan');
    }

    /**
     * kerjakan
     *
     * @return void
     */
    public function kerjakan()
    {
        if (! session('qkey')) {
            return redirect('/quiz');
        }

        return view('quiz.begin');
    }

    /**
     * ajax
     *
     * @param  mixed  $id
     * @return void
     */
    public function ajax($id)
    {
        if (! request()->ajax() || ! session('qkey')) {
            exit('Miaww senpai chann *-*)/');
        }

        session(request()->except('_token'));

        $id = ($id > 10) ? 1 : $id;

        return view('quiz.ajax', [
            'data' => session('q-'.$id),
            'id' => $id,
        ]);
    }

    /**
     * ajaxTerjawab
     *
     * @return void
     */
    public function ajaxTerjawab()
    {
        if (! request()->ajax() || ! session('qkey')) {
            exit('Miaww senpai chann *-*)/');
        }

        $terjawab = 0;

        for ($i = 1; $i <= 10; $i++) {
            $terjawab += session('jawaban-'.$i) ? 1 : 0;
        }

        return view('quiz.terjawab', compact('terjawab'));
    }

    /**
     * saveAnswer to session
     *
     * @return void
     */
    public function saveAnswer()
    {
        session(request()->except('_token'));

        return response()->json(['success' => true]);
    }

    /**
     * koreksi
     *
     * @return void
     */
    public function koreksi()
    {
        // jika kunci quiz tidak ada
        if (! session('qkey')) {
            return redirect('/quiz');
        }

        // asign
        $benar = 0;
        $salah = 0;
        $point = 0;

        // koreksi 10 soal
        for ($i = 1; $i <= 10; $i++) {
            $jawaban = session('jawaban-'.$i);
            $true = session('q-'.$i);

            $true_answer = Quiz::where('id', $true['quiz_id'])->first();

            // jika jawaban benar
            if ($true_answer->correct == $jawaban) {
                $true_answer->increment('benar');
                $benar++;
            } else {
                $true_answer->increment('salah');
                $salah++;
            }

            // hapys sesi
            session()->forget(['jawaban-'.$i, 'q-'.$i]);
            // session()->forget('q-'.$i);
        }

        // selesai mengoreksi hapus kunci soal
        session()->forget(['qkey']);

        switch ($benar) {
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
                'user_id' => auth()->id(),
            ],
            [
                'benar' => $benarku + $benar,
                'salah' => $salahku + $salah,
                'point' => $pointku + $point,
            ]
        );

        return view('quiz.result', [
            'benar' => $benar,
            'salah' => $salah,
            'point' => $point,
            'score' => Auth::user()->quizScore,
        ]);
    }

    /**
     * myProfile
     *
     * @return void
     */
    public function myProfile()
    {
        $quizzes = Auth::user()->quiz()->latest()->paginate(10);

        return view('auth.quiz', [
            'quizzes' => $quizzes,
        ]);
    }

    /**
     * tambah
     *
     * @return void
     */
    public function tambah()
    {
        return view('quiz.tambah');
    }

    /**
     * tambahSubmit
     *
     * @return void
     */
    public function tambahSubmit()
    {
        $val = \Validator::make(request()->all(), [
            'pertanyaan' => 'required',
            'jawaban_a' => 'required',
            'jawaban_b' => 'required',
            'jawaban_c' => 'required',
            'jawaban_d' => 'required',
            'benar' => 'required',
        ], [
            'required' => 'Kolom ini nggak boleh di kosongin',
        ]);

        $response = [
            'success' => true,
            'messages' => [],
            'csrfHash' => csrf_token(),
        ];

        if ($val->fails() === true) {
            $response = [
                'success' => false,
                'messages' => $val->getMessageBag()->toArray(),
            ];
        }

        $quiz = Quiz::create([
            'user_id' => auth()->id(),
            'question' => request()->pertanyaan,
            'answer_a' => request()->jawaban_a,
            'answer_b' => request()->jawaban_b,
            'answer_c' => request()->jawaban_c,
            'answer_d' => request()->jawaban_d,
            'correct' => request()->benar,
            'approved' => 0,
        ]);

        if ($quiz) {
            return response()->json($response)
                ->header('Content-Type', 'application/json');
        }
    }

    /**
     * edit
     *
     * @param  mixed  $id
     * @return void
     */
    public function edit($id)
    {
        $quiz = Quiz::findOrFail($id);

        return view('quiz.edit', [
            'data' => $quiz,
        ]);
    }

    public function editSubmit($id)
    {
        $quiz = Quiz::findOrFail($id);

        request()->validate([
            'pertanyaan' => 'required',
            'jawaban_a' => 'required',
            'jawaban_b' => 'required',
            'jawaban_c' => 'required',
            'jawaban_d' => 'required',
            'benar' => 'required',
        ], [
            'required' => 'Kolom ini nggak boleh di kosongin',
        ]);

        $updated = $quiz->update([
            'question' => request()->pertanyaan,
            'answer_a' => request()->jawaban_a,
            'answer_b' => request()->jawaban_b,
            'answer_c' => request()->jawaban_c,
            'answer_d' => request()->jawaban_d,
            'correct' => request()->benar,
        ]);

        return redirect('/quiz/admin')->with('sukses', 'Data berhasil di ubah yey *-*)/');
    }

    /**
     * allScores
     *
     * @return void
     */
    public function allScores()
    {
        $scores = QuizScore::with('user')->orderBy('point', 'desc')->orderBy('benar', 'desc')->paginate(50);

        return view('quiz.all_score', [
            'scores' => $scores,
        ]);
    }

    /**
     * Quiz ini khusus dibuat untuk mengerjakan sekali
     * quiz, tidak bisa di ulang setelah ngerjain
     * quiz di ambil dari user tersebut tidak di acak atau
     * tercampur quiz dari user lain
     */
    public function lihatKode($code)
    {
        $quiz = QuizCode::whereCode($code)->firstOrFail();
        $scores = $quiz->quizScore()->orderBy('benar', 'desc')
            ->orderBy('updated_at', 'asc')
            ->paginate(50);

        return view('quiz.quiz_code', [
            'data' => $quiz->soal,
            'scores' => $scores,
        ]);
    }

    public function ambilQuiz($code)
    {
        $quiz = QuizCode::whereCode($code)->firstOrFail();

        $bisa = QuizScoreCode::where('quiz_code_id', $quiz->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($bisa) {
            return redirect('/quiz/kode/'.$code)->with('gagal', 'kamu sudah mengerjakan kuis ini');
        }

        $quizzes = collect(explode(',', $quiz->soal->soal))->take(10);

        $randQuizzes = $quizzes->shuffle();

        $randQuizzes->all();

        $i = 1;

        foreach ($randQuizzes as $ki) {
            $k = Quiz::find($ki);
            // taruh quiz di session
            session()->put('q-'.$i, [
                'quiz_id' => $k->id,
                'by' => $k->user->name,
                'question' => $k->question,
                'jawaban_a' => $k->answer_a,
                'jawaban_b' => $k->answer_b,
                'jawaban_c' => $k->answer_c,
                'jawaban_d' => $k->answer_d,
            ]);

            // nomer quiz
            $i++;
        }

        session()->put('qkey', sha1(now()));
        session()->put('the-code', $code);

        return view('quiz.kerjakan_code');
    }

    /**
     * kerjakanByCode
     *
     * @return void
     */
    public function kerjakanByCode()
    {
        if (! session('qkey')) {
            return redirect('/quiz');
        }

        return view('quiz.begin_code');
    }

    /**
     * koreksiByCode
     *
     * @return void
     */
    public function koreksiByCode()
    {
        // jika kunci quiz tidak ada
        if (! session('qkey')) {
            return redirect('/quiz');
        }

        // asign
        $benar = 0;
        $salah = 0;

        // koreksi 10 soal
        for ($i = 1; $i <= 10; $i++) {
            $jawaban = session('jawaban-'.$i);
            $true = session('q-'.$i);

            $true_answer = Quiz::where('id', $true['quiz_id'])->first();

            // jika jawaban benar
            if ($true_answer->correct == $jawaban) {
                $true_answer->increment('benar');
                $benar++;
            } else {
                $true_answer->increment('salah');
                $salah++;
            }

            // hapys sesi
            session()->forget(['jawaban-'.$i, 'q-'.$i]);
            // session()->forget('q-'.$i);
        }

        // selesai mengoreksi hapus kunci soal
        session()->forget(['qkey']);

        $kuis = QuizCode::whereCode(session('the-code'))->first();

        $skor = new QuizScoreCode;
        $skor->user_id = auth()->id();
        $skor->quiz_code_id = $kuis->id;
        $skor->benar = $benar;
        $skor->salah = $salah;
        $skor->save();

        return view('quiz.result_code', [
            'benar' => $benar,
            'salah' => $salah,
        ]);
    }

    /**
     * buatKode
     *
     * @return void
     */
    public function buatKode()
    {
        $kuis = Quiz::latest()->where('user_id', auth()->id())->get();

        return view('quiz.buatkode', compact('kuis'));
    }

    /**
     * buatKodePost
     *
     * @return void
     */
    public function buatKodePost()
    {
        request()->validate([
            'body' => 'required|min:25',
            'terpilih' => 'required|min:10',
        ], [
            'required' => 'Data ini di butuhkan',
            'min' => 'minimal terdapat :min',
        ]);

        $terpilih = request()->terpilih;

        foreach ($terpilih as $pilih) {
            $the = Quiz::findOrFail($pilih);

            if ($the->user_id != auth()->id()) {
                return back()->with('gagal', 'Akses di tolak');
            }
        }

        $rand = rand(000000, 999999);

        $ada = true;

        while ($ada) {
            $ko = QuizCode::whereCode($rand)->first();
            if (! $ko) {
                $ada = false;
            }
        }

        $code = new QuizCode;
        $code->user_id = auth()->id();
        $code->code = $rand;
        $code->save();

        $code->soal()->create([
            'body' => request()->body,
            'soal' => implode(',', $terpilih),
        ]);

        return back()->with('sukses', 'Kode quiz telah di buat <b>'.$rand.'</b>');
    }

    /**
     * cekKode
     *
     * @return void
     */
    public function cekKode()
    {
        $kode = request()->kode;

        $quiz = QuizCode::whereCode($kode)->first();

        if (! $quiz) {
            return response()->json([
                'success' => false,
                'reason' => 'kode tidak di temukan!',
            ]);
        }

        $wu = $quiz->soal();

        if ($wu->count() < 1) {
            return response()->json([
                'success' => false,
                'reason' => 'kesalahan',
            ]);
        }

        return response()->json([
            'success' => true,
            'reason' => "kode telah di temukan <a href='/quiz/kode/$quiz->code'>lanjutkan...</a>",
        ]);
    }

    // -- end quiz codes --//

    /**
     * Only admin can do this action
     */
    public function destroy()
    {
        $quiz = Quiz::findOrFail(request()->id);
        $quiz->approved = request()->status;
        $quiz->save();

        return response()->json(['success' => true]);
    }

    public function admin()
    {
        $quizzes = Quiz::latest()->paginate(20);
        $scores = QuizScore::get();

        return view('quiz.admin', [
            'quiz' => Quiz::get(),
            'quizzes' => $quizzes,
            'scores' => $scores,
        ]);
    }
}
