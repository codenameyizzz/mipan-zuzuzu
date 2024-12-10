<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\Question;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Option;
use App\Models\SubQuestion;

class QuestionnaireController extends Controller
{
    public function viewQuesionnaire()
    {
        $response = Response::where('user_id', auth()->id())->first();
        if ($response) {
            return redirect()->route('home')->with('error', 'Anda sudah mengisi kuisioner');
        }

        return view('questionnaire.identity');
    }

    public function storeStatus(Request $request)
    {
        // Ambil status yang dipilih
        $status = $request->status;
        $response = Response::where('user_id', auth()->id())->first();
        if ($response) {
            return redirect()->route('home')->with('error', 'Anda sudah mengisi kuisioner');
        }

        if ($status == 'Bekerja') {
            return redirect()->route('questionnaire.form-bekerja');  // Halaman jika memilih Bekerja
        }

        // Tambahkan logika untuk status lainnya
        if ($status == 'Belum memungkinkan bekerja') {
            return redirect()->route('questionnaire.form-belum-bekerja');  // Halaman untuk status ini
        }

        if ($status == 'Wiraswasta') {
            return redirect()->route('questionnaire.form-wiraswasta');  // Halaman untuk wiraswasta
        }

        if ($status == 'Melanjutkan Pendidikan') {
            return redirect()->route('questionnaire.form-melanjutkan-pendidikan');  // Halaman untuk pendidikan
        }

        if ($status == 'Tidak kerja tetapi sedang mencari kerja') {
            return redirect()->route('questionnaire.form-mencari-kerja');  // Halaman untuk status ini
        }
    }

    public function viewBekerja()
    {
        return view('questionnaire.form-bekerja');
    }

    public function viewBelumBekerja()
    {
        return view('questionnaire.form-belum-bekerja');
    }

    public function viewWiraswasta()
    {
        return view('questionnaire.form-wiraswasta');
    }

    public function viewMelanjutkanPendidikan()
    {
        return view('questionnaire.form-melanjutkan-pendidikan');
    }

    public function viewMencariKerja()
    {
        return view('questionnaire.form-mencari-kerja');
    }

    public function submit(Request $request)
    {
        $status = $request->status;
        DB::beginTransaction();
        try {
            if ($status == 'Bekerja') {
                foreach ($request->question as $question_number => $value) {
                    // Cari survey dengan title tertentu
                    $survey = Survey::where('title', 'Form Kuisioner - Bekerja')->first();
                    if (!$survey) {
                        $survey = Survey::create([
                            'title' => 'Form Kuisioner - Bekerja',
                            'description' => 'Form kuisioner untuk alumni yang sudah bekerja',
                        ]);
                    }

                    if (is_array($value)) {
                        foreach ($value as $question_text => $answer) {
                            $stringQuestion = str_replace("'", '', $question_text);
                            if (is_array($answer)) {
                                if ($question_number != '3') {
                                    $stringAnswer = '';
                                    foreach ($answer as $subQuestion => $subAnswer) {
                                        $stringAnswer .= $subQuestion . ': ' . $subAnswer . ', ';
                                    }
                                } else {
                                    $stringAnswer = implode(', ', $answer);
                                }
                            } else {
                                $stringAnswer = $answer;
                            }

                            $question = Question::where('question', $stringQuestion)->first();
                            if (!$question) {
                                $question = Question::create([
                                    'id' => $question_number,
                                    'question' => $stringQuestion,
                                    'type' => 'text',
                                    'is_required' => true,
                                    'survey_id' => $survey->id,
                                ]);
                            }
                            Response::create([
                                'user_id' => auth()->id(),
                                'survey_id' => $survey->id,
                                'question_id' => $question->id,
                                'question_text' => $question->question,
                                'answer' => $stringAnswer,
                            ]);
                        }
                    }
                }
            } else if ($status == 'Belum memungkinkan bekerja') {
                foreach ($request->question as $question_number => $value) {
                    // Cari survey dengan title tertentu
                    $survey = Survey::where('title', 'Form Kuisioner - Belum memungkinkan bekerja')->first();
                    if (!$survey) {
                        $survey = Survey::create([
                            'title' => 'Form Kuisioner - Belum memungkinkan bekerja',
                            'description' => 'Form kuisioner untuk alumni yang belum memungkinkan bekerja',
                        ]);
                    }

                    if (is_array($value)) {
                        foreach ($value as $question_text => $answer) {
                            $stringQuestion = str_replace("'", '', $question_text);
                            if (is_array($answer)) {
                                $stringAnswer = '';
                                foreach ($answer as $subQuestion => $subAnswer) {
                                    $stringAnswer .= $subQuestion . ': ' . $subAnswer . ', ';
                                }
                            } else {
                                $stringAnswer = $answer;
                            }

                            $question = Question::where('question', $stringQuestion)->first();
                            if (!$question) {
                                $question = Question::create([
                                    'id' => $question_number,
                                    'question' => $stringQuestion,
                                    'type' => 'text',
                                    'is_required' => true,
                                    'survey_id' => $survey->id,
                                ]);
                            }
                            Response::create([
                                'user_id' => auth()->id(),
                                'survey_id' => $survey->id,
                                'question_id' => $question->id,
                                'question_text' => $question->question,
                                'answer' => $stringAnswer,
                            ]);
                        }
                    }
                }
            } else if ($status == 'Wiraswasta') {
                foreach ($request->question as $question_number => $value) {
                    // Cari survey dengan title tertentu
                    $survey = Survey::where('title', 'Form Kuisioner - Wiraswasta')->first();
                    if (!$survey) {
                        $survey = Survey::create([
                            'title' => 'Form Kuisioner - Wiraswasta',
                            'description' => 'Form kuisioner untuk alumni yang belum memungkinkan bekerja',
                        ]);
                    }

                    if (is_array($value)) {
                        foreach ($value as $question_text => $answer) {
                            $stringQuestion = str_replace("'", '', $question_text);
                            if (is_array($answer)) {
                                $stringAnswer = '';
                                foreach ($answer as $subQuestion => $subAnswer) {
                                    $stringAnswer .= $subQuestion . ': ' . $subAnswer . ', ';
                                }
                            } else {
                                $stringAnswer = $answer;
                            }

                            $question = Question::where('question', $stringQuestion)->first();
                            if (!$question) {
                                $question = Question::create([
                                    'id' => $question_number,
                                    'question' => $stringQuestion,
                                    'type' => 'text',
                                    'is_required' => true,
                                    'survey_id' => $survey->id,
                                ]);
                            }
                            Response::create([
                                'user_id' => auth()->id(),
                                'survey_id' => $survey->id,
                                'question_id' => $question->id,
                                'question_text' => $question->question,
                                'answer' => $stringAnswer,
                            ]);
                        }
                    }
                }
            } else if ($status == 'Melanjutkan Pendidikan') {
                foreach ($request->question as $question_number => $value) {
                    // Cari survey dengan title tertentu
                    $survey = Survey::where('title', 'Form Kuisioner - Mencari Pekerjaan')->first();
                    if (!$survey) {
                        $survey = Survey::create([
                            'title' => 'Form Kuisioner - Mencari Pekerjaan',
                            'description' => 'Form kuisioner untuk alumni yang mencari pekerjaan',
                        ]);
                    }

                    if (is_array($value)) {
                        foreach ($value as $question_text => $answer) {
                            $stringQuestion = str_replace("'", '', $question_text);
                            if (is_array($answer)) {
                                $stringAnswer = '';
                                foreach ($answer as $subQuestion => $subAnswer) {
                                    $stringAnswer .= $subQuestion . ': ' . $subAnswer . ', ';
                                }
                            } else {
                                $stringAnswer = $answer;
                            }

                            $question = Question::where('question', $stringQuestion)->first();
                            if (!$question) {
                                $question = Question::create([
                                    'id' => $question_number,
                                    'question' => $stringQuestion,
                                    'type' => 'text',
                                    'is_required' => true,
                                    'survey_id' => $survey->id,
                                ]);
                            }
                            Response::create([
                                'user_id' => auth()->id(),
                                'survey_id' => $survey->id,
                                'question_id' => $question->id,
                                'question_text' => $question->question,
                                'answer' => $stringAnswer,
                            ]);
                        }
                    }
                }
            } else if ($status == 'Mencari Pekerjaan') {
                foreach ($request->question as $question_number => $value) {
                    // Cari survey dengan title tertentu
                    $survey = Survey::where('title', 'Form Kuisioner - Melanjutkan Pendidikan')->first();
                    if (!$survey) {
                        $survey = Survey::create([
                            'title' => 'Form Kuisioner - Melanjutkan Pendidikan',
                            'description' => 'Form kuisioner untuk alumni yang melanjutkan pendidikan',
                        ]);
                    }

                    if (is_array($value)) {
                        foreach ($value as $question_text => $answer) {
                            $stringQuestion = str_replace("'", '', $question_text);
                            if (is_array($answer)) {
                                $stringAnswer = '';
                                foreach ($answer as $subQuestion => $subAnswer) {
                                    $stringAnswer .= $subQuestion . ': ' . $subAnswer . ', ';
                                }
                            } else {
                                $stringAnswer = $answer;
                            }

                            $question = Question::where('question', $stringQuestion)->first();
                            if (!$question) {
                                $question = Question::create([
                                    'id' => $question_number,
                                    'question' => $stringQuestion,
                                    'type' => 'text',
                                    'is_required' => true,
                                    'survey_id' => $survey->id,
                                ]);
                            }
                            Response::create([
                                'user_id' => auth()->id(),
                                'survey_id' => $survey->id,
                                'question_id' => $question->id,
                                'question_text' => $question->question,
                                'answer' => $stringAnswer,
                            ]);
                        }
                    }
                }
            }
            DB::commit();
            return redirect()->route('home')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Gagal menyimpan data');
        }
    }
}
