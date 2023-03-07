<?php

namespace App\Http\Controllers\User;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = DB::table('galleries')
            ->where('galleries.publish', '=', 1)
            ->select('galleries.*', 'users.name as name_user', 'users.file as file_user', 'admins.name as name_admin', 'admins.file as file_admin')
            ->leftJoin('admins', function ($join) {
                $join->on('admins.id', '=', 'galleries.id_user')
                    ->where('galleries.role', '=', 'admin');
            })
            ->leftJoin('users', function ($join) {
                $join->on('users.id', '=', 'galleries.id_user')
                    ->where('galleries.role', '=', 'user');
            })
            // ->get();
            ->paginate(3);
        return view('content.guest.galleries.v_gallery', compact('galleries'));
    }

    public function detail($title)
    {
        $gallery = Gallery::where('galleries.code', $title) ->select('galleries.*', 'users.name as name_user', 'users.file as file_user', 'admins.name as name_admin', 'admins.file as file_admin')
        ->leftJoin('admins', function ($join) {
            $join->on('admins.id', '=', 'galleries.id_user')
                ->where('galleries.role', '=', 'admin');
        })
        ->leftJoin('users', function ($join) {
            $join->on('users.id', '=', 'galleries.id_user')
                ->where('galleries.role', '=', 'user');
        })->first();
        // dd($gallery);
        return view('content.guest.galleries.v_preview', compact('gallery'));
    }

    public function preview($image)
    {
        $image = decrypt($image);
        return ImageHelper::show_drive($image);
    }
}
