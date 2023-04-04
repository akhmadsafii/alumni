<?php

namespace App\Http\Controllers;

use App\Models\CategoryOther;
use App\Models\CategorySurvey;
use App\Models\Survey;
use App\Models\SurveyAnswer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function admin()
    {
        // dd(Auth::guard('admin')->user()->file);
        if (Auth::guard('admin')->check()) {
            session()->put('role', 'admin');
            session()->put('id', Auth::guard('admin')->user()->id);
            session()->put('avatar', Auth::guard('admin')->user()->file == null ? asset('asset/img/user4.jpg') : asset(Auth::guard('admin')->user()->file));
        }
        if (Auth::guard('user')->check()) {
            session()->put('role', 'user');
            session()->put('id', Auth::guard('user')->user()->id);
            session()->put('avatar', Auth::guard('user')->user()->file == null ? asset('asset/img/user4.jpg') : asset(Auth::guard('user')->user()->file));
        }

        $alumni = User::where('status', 1)->get();
        // dd($alumni->count());
        $survei = Survey::where('status', 1)->get();
        $male = $alumni->where('gender', '=', 'male')->count();
        $female = $alumni->where('gender', '=', 'female')->count();
        $partisipant = SurveyAnswer::where('status', 1)
            ->select('id_user')
            ->groupBy('id_user')
            ->get();

        $partisipant_percent = $partisipant->count() < 1 ? 0 : (empty($alumni) ? 0 : round($partisipant->count() / $alumni->count() * 100));

        $statistic = [
            'total_alumni' => $alumni->count(),
            'gender' => [
                'male' => $male,
                'female' => $female,
            ],
            'survei' => $survei->count(),
            'participant' => $partisipant->count(),
            'partisipant_percent' => "$partisipant_percent%",
        ];
        // dd($model);
        $angkatan = [];

        $lulusan = User::where('status', 1)
            ->select('graduating_class')
            ->groupBy('graduating_class')
            ->get();

        foreach ($lulusan as $lulus) {
            $angkatan[] = [
                'lulusan' => $lulus->graduating_class,
                'total' => $alumni->where('graduating_class', $lulus->graduating_class)->count()
            ];
        }

        $survey = [];
        $kategori = CategorySurvey::where('status', 1)->get();
        // $kategori = AlumniSurveiKategori::where('id_sekolah', $id)->get();
        $jawaban = SurveyAnswer::where('status', 1)
            ->select('id_category', DB::raw('COUNT(id_user) as amount'))
            ->groupBy('id_category')
            ->get();

        foreach ($kategori as $survei) {
            $jawaban_count = collect($jawaban)->where('id_category', $survei->id)->first();

            $survey[] = [
                'id' => $survei->id,
                'name' => $survei->name,
                'participant' => empty($jawaban_count) ? 0 : $jawaban_count->amount,
            ];
        }

        // $pekerjaan = [];

        // $jenis = CategoryOther::where([
        //     ['status', 1],
        //     ['type', 'job'],
        // ])->get();
        // $count_almni = $alumni->count();
        // $alumni_pekerjaan = AlumniPekerjaan::where('id_sekolah', $id)
        //     ->select('id', 'id_jenis_pekerjaan', DB::raw('COUNT(id) as jumlah'))
        //     ->groupBy('id_jenis_pekerjaan')
        //     ->get();

        // $bekerja = collect($alumni_pekerjaan)->sum('jumlah');

        // $blm_kerja = $alumni - $bekerja;

        // $belum_kerja = [
        //     'nama' => 'Belum Bekerja',
        //     'jumlah' => $blm_kerja
        // ];

        // foreach ($jenis as $pekerjaan) {
        //     $jumlah = collect($alumni_pekerjaan)->where('id_jenis_pekerjaan', $pekerjaan->id)->first();

        //     $pekerjaan[] = [
        //         'nama' => $pekerjaan->nama,
        //         'jumlah' => empty($jumlah) ? 0 : $jumlah->jumlah,
        //     ];
        // }

        // array_push($model, $belum_kerja);
        // dd($survey);
        $statistic_dashboard = [
            'angkatan' => $angkatan,
            'survey' => $survey,
        ];

        // dd($statistic_dashboard);
        return view('content.dashboard.v_admin', compact('statistic', 'statistic_dashboard'));
    }

    // public function user()
    // {
    //     return view('content-users.dashboard.v_dashboard');
    // }
}
