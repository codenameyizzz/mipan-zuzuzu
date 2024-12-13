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
use App\Models\Mahasiswa;

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
        $prodi = Prodi::where('fakultas_id', $fakultas_id)->get();
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
        $fakultas_id = $request->fakultas_id;
        $prodi_id = $request->prodi_id;
        $angkatan = $request->angkatan;

        $mahasiswaData = Mahasiswa::where('fakultas_id', $fakultas_id);

        $jumlah_mahasiswa_tiap_kategori_query = Answer::select('surveys.type', DB::raw('count(DISTINCT answers.user_id, answers.survey_id) as total'))
            ->join('surveys', 'answers.survey_id', '=', 'surveys.id')
            ->join('mahasiswas', 'answers.user_id', '=', 'mahasiswas.user_id')
            ->where('mahasiswas.fakultas_id', $fakultas_id);

        if ($prodi_id || $angkatan) {
            if ($prodi_id) {
                $mahasiswaData = $mahasiswaData->where('prodi_id', $prodi_id);
                $jumlah_mahasiswa_tiap_kategori_query = $jumlah_mahasiswa_tiap_kategori_query->where('mahasiswas.prodi_id', $prodi_id);
            }

            if ($angkatan) {
                $mahasiswaData = $mahasiswaData->where('angkatan', $angkatan);
                $jumlah_mahasiswa_tiap_kategori_query = $jumlah_mahasiswa_tiap_kategori_query->where('mahasiswas.angkatan', $angkatan);
            }
        }

        $totalMahasiswa = $mahasiswaData->count();

        $total_bekerja = $mahasiswaData->clone()->whereHas('User', function ($query) {
            $query->whereHas('Answers', function ($query) {
                $query->select('survey_id', 'user_id')
                    ->distinct()
                    ->whereHas('Survey', function ($query) {
                        $query->where('type', 'bekerja');
                    });
            });
        })->count();

        $total_belum_bekerja = $mahasiswaData->clone()->whereHas('User', function ($query) {
            $query->whereHas('Answers', function ($query) {
                $query->select('survey_id', 'user_id')
                    ->distinct()
                    ->whereHas('Survey', function ($query) {
                        $query->where('type', 'belum bekerja');
                    });
            });
        })->count();

        $total_wiraswasta = $mahasiswaData->clone()->whereHas('User', function ($query) {
            $query->whereHas('Answers', function ($query) {
                $query->select('survey_id', 'user_id')
                    ->distinct()
                    ->whereHas('Survey', function ($query) {
                        $query->where('type', 'wiraswasta');
                    });
            });
        })->count();

        $total_melanjutkan_pendidikan = $mahasiswaData->clone()->whereHas('User', function ($query) {
            $query->whereHas('Answers', function ($query) {
                $query->select('survey_id', 'user_id')
                    ->distinct()
                    ->whereHas('Survey', function ($query) {
                        $query->where('type', 'melanjutkan pendidikan');
                    });
            });
        })->count();

        $total_mencari_pekerjaan = $mahasiswaData->clone()->whereHas('User', function ($query) {
            $query->whereHas('Answers', function ($query) {
                $query->select('survey_id', 'user_id')
                    ->distinct()
                    ->whereHas('Survey', function ($query) {
                        $query->where('type', 'mencari pekerjaan');
                    });
            });
        })->count();

        $data_jumlah_mahasiswa_tiap_kategori = [
            'bekerja' => $total_bekerja,
            'belum bekerja' => $total_belum_bekerja,
            'wiraswasta' => $total_wiraswasta,
            'melanjutkan pendidikan' => $total_melanjutkan_pendidikan,
            'mencari pekerjaan' => $total_mencari_pekerjaan,
        ];

        $data['jumlah_mahasiswa_tiap_kategori'] = [
            'labels' => ['bekerja', 'belum bekerja', 'wiraswasta', 'melanjutkan pendidikan', 'mencari pekerjaan'],
            'data' => $data_jumlah_mahasiswa_tiap_kategori
        ];

        //perbandingan total mahasiswa dengan jumlah mahasiswa yang mengisi survey
        $data['perbandingan_pengisian_questioner'] = [
            'labels' => ['total mahasiswa', 'total mahasiswa yang mengisi'],
            'data' => [$totalMahasiswa, array_sum($data_jumlah_mahasiswa_tiap_kategori)]
        ];

        $messages = [
            'status' => 'success',
            'html' => view('report-data', $data)->render(),
        ];

        return response()->json($messages);
    }
}