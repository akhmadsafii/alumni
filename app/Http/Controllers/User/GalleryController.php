<?php

namespace App\Http\Controllers\User;

use App\Helpers\Helper;
use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\GalleryResource;
use App\Models\Gallery;
use App\Traits\Nestcode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{
    use Nestcode;
    public function index(Request $request)
    {
        $sort_search = null;
        $galleries = Gallery::latest()->where('status', '!=', 0);
        if ($request->search != null) {
            $galleries = $galleries->where('name', 'like', '%' . $request->search . '%');
            $sort_search = $request->search;
        }
        $galleries = $galleries->get();
        $galleries = GalleryResource::collection($galleries)->resolve();
        $galleries = Helper::paginate($galleries)->setPath(route('gallery.public'));
        return view('content.guest.galleries.v_gallery', compact('galleries', 'sort_search'));
    }

    public function detail($title)
    {
        $this->countGalleryView($title);
        $gallery = Gallery::where('galleries.code', $title)->select('galleries.*', 'users.name as name_user', 'users.file as file_user', 'admins.name as name_admin', 'admins.file as file_admin')
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
