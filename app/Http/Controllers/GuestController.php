<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Blog;
use App\Models\CategorySurvey;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuestController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('status', '!=', 0)->limit(4)->get();
        $agendas = Agenda::where('status', '!=', 0)->limit(5)->get();
        // dd($agendas);
        return view('content.guest.v_home', compact('blogs', 'agendas'));
    }
    public function discussion()
    {
        return view('content.guest.v_discussion');
    }

    public function alumni()
    {
        return view('content.guest.v_alumni');
    }

    public function agenda()
    {
        $agendas = DB::table('agendas')
            ->select('agendas.*', 'users.name as name_user', 'admins.name as name_admin')
            ->leftJoin('admins', function ($join) {
                $join->on('admins.id', '=', 'agendas.id_user')
                    ->where('agendas.role', '=', 'admin');
            })
            ->leftJoin('users', function ($join) {
                $join->on('users.id', '=', 'agendas.id_user')
                    ->where('agendas.role', '=', 'user');
            })
            ->paginate(3);
        return view('content.guest.v_agenda', compact('agendas'));
    }
}
