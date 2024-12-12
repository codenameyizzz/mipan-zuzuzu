<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Survey;
use App\Models\Question;
use App\Models\Response;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Answer;

class adminNavController extends Controller
{
    public function showDashboard()
    {
        return view("admin.app.dashboard");
    }

    public function showQuestionnaire()
    {
        return view("admin.app.questionnaire");
    }

    public function addQuestionnaire()
    {
        $type = Survey::pluck('type');
        $questionnaire_type = [
            'bekerja',
            'belum bekerja',
            'wiraswasta',
            'melanjutkan pendidikan',
            'mencari kerja',
        ];

        foreach ($type as $t) {
            $key = array_search($t, $questionnaire_type);
            unset($questionnaire_type[$key]);
        }

        return view("admin.app.add-questionnaire", compact('questionnaire_type'));
    }

    public function editQuestionnaire($id)
    {
        $data = Survey::with(['Questions', 'Questions.SubQuestions', 'Questions.Options', 'Questions.SubQuestions.Options'])->find($id);
        $type = Survey::where('id', '!=', $id)->pluck('type');
        $questionnaire_type = [
            'bekerja',
            'belum bekerja',
            'wiraswasta',
            'melanjutkan pendidikan',
            'mencari kerja',
        ];
        foreach ($type as $t) {
            $key = array_search($t, $questionnaire_type);
            unset($questionnaire_type[$key]);
        }
        return view("admin.app.edit-questionnaire", compact('data', 'questionnaire_type'));
    }

    public function dataQuestionnaire()
    {
        $keyword = request('search');
        $datas = Survey::with(['Questions', 'Questions.SubQuestions', 'Questions.Options', 'Questions.SubQuestions.Options']);

        if ($keyword) {
            $datas = $datas->where('title', 'LIKE', "%{$keyword}%");
        }

        $datas = $datas->paginate(10);
        return view("admin.app.data-questionnaire", compact('datas'));
    }

    public function postAddQuestionnaire(Request $request)
    {
        DB::beginTransaction();
        try {
            $survey = Survey::create([
                'title' => $request->title,
                'type' => $request->type,
                'description' => $request->description,
            ]);

            foreach ($request->questions as $req) {
                $req = (object) $req;

                $question = Question::create([
                    'question' => $req->text,
                    'type' => $req->type,
                    'is_required' => $req->is_required,
                    'survey_id' => $survey->id,
                ]);
                if ($req->type == 'radio' || $req->type == 'checkbox' || $req->type == 'dropdown') {
                    foreach ($req->options as $option) {
                        Option::create([
                            'value' => $option,
                            'text' => $option,
                            'question_id' => $question->id,
                        ]);
                    }
                } elseif ($req->type == 'scaled') {
                    for ($i = $req->scale_min; $i <= $req->scale_max; $i++) {
                        Option::create([
                            'value' => $i,
                            'text' => $i,
                            'question_id' => $question->id,
                        ]);
                    }
                }
            }
            DB::commit();
            return redirect()->route('data.questionnaire')->with('success', 'Berhasil menambahkan kuisioner');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Gagal menambahkan kuisioner');
        }
    }

    public function postEditQuestionnaire(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $survey = Survey::find($id);

            Answer::where('survey_id', $survey->id)->delete();
            Option::whereHas('Question', function ($query) use ($survey) {
                $query->where('survey_id', $survey->id);
            })->delete();
            Question::where('survey_id', $survey->id)->delete();

            $survey->update([
                'title' => $request->title,
                'type' => $request->type,
                'description' => $request->description,
            ]);

            foreach ($request->questions as $req) {
                $req = (object) $req;

                $question = Question::create([
                    'question' => $req->text,
                    'type' => $req->type,
                    'is_required' => $req->is_required,
                    'survey_id' => $survey->id,
                ]);
                if ($req->type == 'radio' || $req->type == 'checkbox' || $req->type == 'dropdown') {
                    foreach ($req->options as $option) {
                        Option::create([
                            'value' => $option,
                            'text' => $option,
                            'question_id' => $question->id,
                        ]);
                    }
                } elseif ($req->type == 'scaled') {
                    for ($i = $req->scale_min; $i <= $req->scale_max; $i++) {
                        Option::create([
                            'value' => $i,
                            'text' => $i,
                            'question_id' => $question->id,
                        ]);
                    }
                }
            }
            DB::commit();
            return redirect()->route('data.questionnaire')->with('success', 'Berhasil menambahkan kuisioner');
        } catch (\Throwable $th) {
            dD($th);
            DB::rollBack();
            return back()->with('error', 'Gagal menambahkan kuisioner');
        }
    }

    public function deleteQuestionnaire($id)
    {
        DB::beginTransaction();
        try {
            $survey = Survey::find($id);
            Option::whereHas('Question', function ($query) use ($survey) {
                $query->where('survey_id', $survey->id);
            })->delete();
            Question::where('survey_id', $survey->id)->delete();
            $survey->delete();
            DB::commit();
            return redirect()->route('data.questionnaire')->with('success', 'Berhasil menghapus kuisioner');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus kuisioner');
        }
    }

    public function showRespondens()
    {
        return view("admin.app.responden");
    }

    public function dataResponden()
    {
        $keyword = request('search');
        $datas = Mahasiswa::with(['User', 'Fakultas', 'Prodi']);

        if ($keyword) {
            $datas = $datas->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('nim', 'LIKE', "%{$keyword}%")
                ->orWhere('angkatan', 'LIKE', "%{$keyword}%")
                ->orWhere('status', 'LIKE', "%{$keyword}%");
        }

        $datas = $datas->paginate(10);
        return view("admin.app.data-responden", compact('datas'));
    }

    public function showStatistik()
    {
        return view("admin.app.statistik");
    }

    public function showUnggah()
    {
        return view("admin.app.unggah_data");
    }

    public function showUnduh()
    {
        $questionnaires = Survey::all();
        return view("admin.app.unduh_data", compact('questionnaires'));
    }

    public function unduhCSV()
    {
        $filename = "responden.csv";
        $datas = Answer::where('survey_id', request('survey_id'))->get();

        $questions = $datas->map(function ($data) {
            return $data->Question->question;
        })->unique();

        $header = array_merge(['Nama', 'NIM', 'Fakultas', 'Prodi'], $questions->toArray());

        $handle = fopen($filename, 'w+');
        fputcsv($handle, $header);

        $groupedData = $datas->groupBy('User.Mahasiswa.nim');
        foreach ($groupedData as $nim => $responses) {
            $firstResponse = $responses->first();

            $row = [
                $firstResponse->User->Mahasiswa->name,
                $firstResponse->User->Mahasiswa->nim,
                $firstResponse->User->Mahasiswa->Fakultas->name,
                $firstResponse->User->Mahasiswa->Prodi->name,
            ];

            foreach ($questions as $question) {
                $answer = $responses->firstWhere('Question.question', $question)?->answer ?? '';
                $row[] = $answer;
            }

            fputcsv($handle, $row);
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return response()->download($filename, 'response.csv', $headers);
    }

    public function showPanduan()
    {
        return view("admin.app.panduan_form");
    }

    public function showFAQ()
    {
        return view("admin.app.faq");
    }

    public function showContact()
    {
        return view("admin.app.contact");
    }

    public function showSurvey()
    {
        return view("admin.app.user_survey");
    }
}