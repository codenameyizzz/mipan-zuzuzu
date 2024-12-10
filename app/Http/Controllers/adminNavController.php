<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Response;
use Illuminate\Http\Request;

class adminNavController extends Controller
{
    public function showDashboard()
    {
        return view("admin.app.dashboard");
    }

    public function showRespondens()
    {
        $datas = Mahasiswa::paginate(10);
        return view("admin.app.responden", compact('datas'));
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
        return view("admin.app.unduh_data");
    }

    public function unduhCSV()
    {
        $filename = "responden.csv";
        $datas = Response::all();
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Kuisioner', 'Pertanyaan', 'NIM', 'Nama', 'Fakultas', 'Prodi', 'Angkatan', 'Jawaban'));

        foreach ($datas as $data) {
            fputcsv($handle, array($data->Survey->title, $data->Question->question, $data->User->Mahasiswa->nim, $data->User->Mahasiswa->name, $data->User->Mahasiswa->Fakultas->name, $data->User->Mahasiswa->Prodi->name, $data->User->Mahasiswa->angkatan, $data->answer));
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
