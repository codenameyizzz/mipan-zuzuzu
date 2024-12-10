<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Prodi;
use App\Models\Response;
use App\Models\User;
use Illuminate\Http\Request;

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

    public function getReport(Request $request)
    {
        $prodi_id = $request->prodi_id;
        $angkatan = $request->angkatan;

        $prodi = Prodi::find($prodi_id);
        $mahasiswas = $prodi->mahasiswas->where('angkatan', $angkatan);
        $arrayUserId = $mahasiswas->pluck('user_id');
        $responses = Response::with('Survey')->whereIn('user_id', $arrayUserId)->get();

        $data['data'] = User::selectRaw("date_format(created_at, '%Y-%m-%d') as date, count(*) as aggregate")
            ->whereDate('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->get();

        $status_mahasiswa = $responses->groupBy('Survey.title')->map(function ($group) {
            return $group->count();
        });

        //mendapatkan pekerjaan
        $totalResponses = $responses
            ->filter(function ($response) {
                return $response->question_text == 'Dalam berapa bulan Anda mendapatkan pekerjaan pertama?';
            });

        $total1 = $totalResponses->whereIn('answer', ['<1', '1', '2', '3', '4', '5', '6'])->count();
        $total2 = $totalResponses->whereIn('answer', ['7', '8', '9', '10', '11', '12'])->count();

        $seberapa_erat = $responses
            ->filter(function ($response) {
                return $response->question_text == 'Seberapa erat hubungan bidang studi dengan pekerjaan Anda?';
            })->groupBy('answer')
            ->groupBy('answer')
            ->map(function ($group) {
                return $group->count();
            });

        $rata_rata_pendapatan = $responses
            ->filter(function ($response) {
                return $response->question_text == 'Berapa rata-rata pendapatan Anda per bulan? (take home pay)';
            })
            ->groupBy(function ($response) {
                $nominal = preg_replace('/[^0-9]/', '', $response->answer);
                $nominal = (int)$nominal;

                if ($nominal >= 1000000 && $nominal <= 3000000) {
                    return '1jt-3jt';
                } elseif ($nominal > 3000000 && $nominal <= 5000000) {
                    return '3jt-5jt';
                } elseif ($nominal > 5000000 && $nominal <= 10000000) {
                    return '5jt-10jt';
                } elseif ($nominal > 10000000 && $nominal <= 20000000) {
                    return '10jt-20jt';
                } elseif ($nominal > 20000000 && $nominal <= 50000000) {
                    return '20jt-50jt';
                } elseif ($nominal > 50000000) {
                    return '50jt+';
                } else {
                    return 'Invalid';
                }
            })
            ->map(function ($group) {
                return $group->count();
            });

        $data['status_mahasiswa'] = [
            'labels' => $status_mahasiswa->keys(),
            'data' => $status_mahasiswa->values(),
        ];
        $data['mendapatkan_pekerjaan'] = [
            'labels' => ['<1-6 bulan', '7-12 bulan'],
            'data' => [$total1, $total2],
        ];
        $data['seberapa_erat'] = [
            'labels' => $seberapa_erat->keys(),
            'data' => $seberapa_erat->values(),
        ];
        $data['rata_rata_pendapatan'] = [
            'labels' => $rata_rata_pendapatan->keys(),
            'data' => $rata_rata_pendapatan->values(),
        ];

        $messages = [
            'status' => 'success',
            'html' => view('report-data', $data)->render(),
        ];

        return $messages;
    }
}
