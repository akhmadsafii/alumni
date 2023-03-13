<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Resources\AgendaResource;
use App\Http\Resources\DiscussionResource;
use App\Http\Resources\UserResource;
use App\Models\Agenda;
use App\Models\Blog;
use App\Models\CategorySurvey;
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
        $categories = CategorySurvey::where('status', 1)->get();
        // dd($categories);
        $blogs = Blog::where('status', '!=', 0)->limit(4)->get();
        $agendas = Agenda::where('status', '!=', 0)->limit(5)->get();
        return view('content.guest.v_home', compact('blogs', 'agendas', 'categories'));
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

    public function alumni(Request $request)
    {
        $sort_search = null;
        $users = [];
        if ($request->search != null) {
            $sort_search = $request->search;
            $users = User::where('status', 1);
        }
        if ($request->major != null) {
            $major = Major::where('code', $request->major)->first();
            $users = $users->where('id_major', $major['id']);
        }
        if ($request->graduating_class != null) {
            $users = $users->where('graduating_class', $request['graduating_class']);
        }
        if ($request->search != null) {
            $users = $users
                ->where('name', 'like', '%' . $request->search . '%')->get();
            $users = UserResource::collection($users)->resolve();
        }
        $users = Helper::paginate($users)->setPath(route('alumni'));
        $majors = Major::where('status', 1)->get();
        $graduating_class = User::groupBy('graduating_class')->orderBy('graduating_class', 'DESC')->pluck('graduating_class');
        return view('content.guest.v_alumni', compact('majors', 'graduating_class', 'users', 'sort_search'));
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

        if ($request->search != null) {
            $pure_agenda = $pure_agenda
                ->where('title', 'like', '%' . $request->search . '%');
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
