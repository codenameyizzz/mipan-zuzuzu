<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Prodi;
use App\Models\Survey;
use App\Models\Fakultas;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Answer;

class ReportController extends Controller
{
    public function view()
    {
        $fakultas = Fakultas::get();
        return view('report', compact('fakultas'));
    }

    public function getProdi(Request $request)
    {
        $fakultas_id = $request->fakultas_id;
        $prodi = Fakultas::find($fakultas_id)->Prodis;
        return response()->json($prodi);
    }

    public function getAngkatan(Request $request)
    {
        $prodi_id = $request->prodi_id;
        if (!$prodi_id) {
            return response()->json([]);
        }

        $prodi = Prodi::find($prodi_id);
        $mahasiswas = $prodi->mahasiswas;

        if ($mahasiswas->count() > 0) {
            $angkatan = $mahasiswas->pluck('angkatan')->unique();
        } else {
            $angkatan = [];
        }
        return response()->json($angkatan);
    }

    // public function getReport(Request $request)
    // {
    //     $prodi_id = $request->prodi_id;
    //     $angkatan = $request->angkatan;

    //     $answer = Answer::query();

    //     if ($prodi_id) {
    //         $answer->whereHas('User', function ($query) use ($prodi_id) {
    //             $query->whereHas('mahasiswa', function ($query) use ($prodi_id) {
    //                 $query->where('prodi_id', $prodi_id);
    //             });
    //         });
    //     }

    //     if ($angkatan) {
    //         $answer->whereHas('User', function ($query) use ($angkatan) {
    //             $query->whereHas('mahasiswa', function ($query) use ($angkatan) {
    //                 $query->where('angkatan', $angkatan);
    //             });
    //         });
    //     }

    //     $jumlah_mahasiswa_tiap_kategori = $answer->select('type', DB::raw('count(*) as total'))
    //         ->join('surveys', 'answers.survey_id', '=', 'surveys.id') // Bergabung dengan tabel surveys
    //         ->groupBy('type')
    //         ->pluck('total', 'type'); // Menggunakan pluck untuk mendapatkan data dalam format key-value

    //     $data['jumlah_mahasiswa_tiap_kategori'] = [
    //         'labels' => $jumlah_mahasiswa_tiap_kategori->keys(), // Ambil kunci (kategori)
    //         'data' => $jumlah_mahasiswa_tiap_kategori->values(), // Ambil nilai (jumlah)
    //     ];

    //     $total_responses = $jumlah_mahasiswa_tiap_kategori->sum(); // Total semua kategori

    //     $data['proporsi_mahasiswa_tiap_kategori'] = [
    //         'labels' => $jumlah_mahasiswa_tiap_kategori->keys(),
    //         'data' => $jumlah_mahasiswa_tiap_kategori->map(function ($value) use ($total_responses) {
    //             return round(($value / $total_responses) * 100, 2);
    //         })->values(),
    //     ];

    //     $grouped_data = $answer->select('surveys.type', 'mahasiswas.angkatan', DB::raw('count(*) as total'))
    //         ->join('surveys', 'answers.survey_id', '=', 'surveys.id')
    //         ->join('mahasiswas', 'answers.user_id', '=', 'mahasiswas.user_id')
    //         ->groupBy('surveys.type', 'mahasiswas.angkatan')
    //         ->get()
    //         ->groupBy('angkatan');

    //     $data['berdasarkan_angkatan'] = [
    //         'labels' => $grouped_data->keys(),
    //         'data' => $grouped_data->map(function ($angkatanGroup) {
    //             return $angkatanGroup->pluck('total', 'type');
    //         }),
    //     ];
    //     dd($data);
    //     $messages = [
    //         'status' => 'success',
    //         'html' => view('report-data', $data)->render(),
    //     ];

    //     return $messages;
    // }

    public function getReport(Request $request)
    {
        $prodi_id = $request->prodi_id;
        $angkatan = $request->angkatan;

        // Query awal untuk jumlah mahasiswa tiap kategori
        $jumlah_mahasiswa_tiap_kategori_query = Answer::select('type', DB::raw('count(*) as total'))
            ->join('surveys', 'answers.survey_id', '=', 'surveys.id');

        // Tambahkan filter jika prodi_id atau angkatan diberikan
        if ($prodi_id || $angkatan) {
            $jumlah_mahasiswa_tiap_kategori_query = $jumlah_mahasiswa_tiap_kategori_query
                ->join('mahasiswas', 'answers.user_id', '=', 'mahasiswas.user_id');

            if ($prodi_id) {
                $jumlah_mahasiswa_tiap_kategori_query = $jumlah_mahasiswa_tiap_kategori_query->where('mahasiswas.prodi_id', $prodi_id);
            }

            if ($angkatan) {
                $jumlah_mahasiswa_tiap_kategori_query = $jumlah_mahasiswa_tiap_kategori_query->where('mahasiswas.angkatan', $angkatan);
            }
        }

        // Group by and fetch the results
        $jumlah_mahasiswa_tiap_kategori = $jumlah_mahasiswa_tiap_kategori_query
            ->groupBy('type')
            ->pluck('total', 'type');

        // Data untuk Pie Chart
        $data['jumlah_mahasiswa_tiap_kategori'] = [
            'labels' => $jumlah_mahasiswa_tiap_kategori->keys(),
            'data' => $jumlah_mahasiswa_tiap_kategori->values(),
        ];

        $total_responses = $jumlah_mahasiswa_tiap_kategori->sum();

        // Data proporsi untuk Pie Chart dalam persentase
        $data['proporsi_mahasiswa_tiap_kategori'] = [
            'labels' => $jumlah_mahasiswa_tiap_kategori->keys(),
            'data' => $jumlah_mahasiswa_tiap_kategori->map(function ($value) use ($total_responses) {
                return round(($value / $total_responses) * 100, 2);
            })->values(),
        ];

        // Query awal untuk data berdasarkan angkatan
        $grouped_data_query = Answer::select('surveys.type', 'mahasiswas.angkatan', DB::raw('count(*) as total'))
            ->join('surveys', 'answers.survey_id', '=', 'surveys.id')
            ->join('mahasiswas', 'answers.user_id', '=', 'mahasiswas.user_id');

        // Tambahkan filter jika prodi_id atau angkatan diberikan
        if ($prodi_id) {
            $grouped_data_query = $grouped_data_query->where('mahasiswas.prodi_id', $prodi_id);
        }

        if ($angkatan) {
            $grouped_data_query = $grouped_data_query->where('mahasiswas.angkatan', $angkatan);
        }

        // Group by and fetch the results
        $grouped_data = $grouped_data_query
            ->groupBy('surveys.type', 'mahasiswas.angkatan')
            ->get()
            ->groupBy('angkatan');

        // Data untuk Grouped Bar Chart
        $data['berdasarkan_angkatan'] = [
            'labels' => $grouped_data->keys(),
            'data' => $grouped_data->map(function ($angkatanGroup) {
                return $angkatanGroup->pluck('total', 'type');
            }),
        ];
        // Return hasil sebagai respons JSON
        $messages = [
            'status' => 'success',
            'html' => view('report-data', $data)->render(),
        ];

        return response()->json($messages);
    }
}
