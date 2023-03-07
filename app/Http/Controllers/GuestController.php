<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Resources\AgendaResource;
use App\Http\Resources\DiscussionResource;
use App\Models\Agenda;
use App\Models\Blog;
use App\Models\Discussion;
use App\Models\Major;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('status', '!=', 0)->limit(4)->get();
        $agendas = Agenda::where('status', '!=', 0)->limit(5)->get();
        return view('content.guest.v_home', compact('blogs', 'agendas'));
    }

    public function login()
    {
        return view('content.guest.v_login');
    }

    public function discussion()
    {
        session()->put('title', 'Diskusi');
        if (Auth::guard('user')->check()) {
            $discuss = Discussion::latest()->where('status', '!=', 0)->get();
            $discussions = DiscussionResource::collection($discuss)->resolve();
            $discussions = Helper::paginate($discussions)->setPath(route('discussion'));
            // dd($discussions);
            return view('content.guest.v_discussion', compact('discussions'));
        }
        return view('content.guest.v_login');
    }

    public function alumni()
    {
        $majors = Major::where('status', 1)->get();
        $year = User::groupBy('graduating_class')->get();
        dd($year);
        return view('content.guest.v_alumni', compact('majors'));
    }

    public function agenda(Request $request)
    {
        session()->put('title', 'Agenda');
        $sort_search = null;
        $my_agenda = [];
        $pure_agenda = Agenda::latest()->where('status', 1);
        if ($_GET['appear'] == 'not-yet') {
            $pure_agenda = $pure_agenda->where('start_date', '>', now());
        }
        if ($_GET['appear'] == 'done') {
            $pure_agenda = $pure_agenda->where('start_date', '<', now());
        }

        if ($request->search != null){
            $pure_agenda = $pure_agenda
                        ->where('title', 'like', '%'.$request->search.'%');
            $sort_search = $request->search;
        }
        $pure_agenda = $pure_agenda->get();
        $agenda = AgendaResource::collection($pure_agenda)->resolve();
        $agendas = Helper::paginate($agenda)->setPath(route('agenda'));
        if (Auth::guard('user')->check()) {
            $my_agenda = Agenda::latest()->where([
                ['role', session('role')],
                ['id_user', session('id')],
                ['status', '!=', 0],
            ])->get();
            $my_agenda = AgendaResource::collection($my_agenda)->resolve();
        }
        // dd($my_agenda);
        return view('content.guest.v_agenda', compact('agendas', 'sort_search', 'my_agenda'));
    }
}
