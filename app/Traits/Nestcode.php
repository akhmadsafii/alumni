<?php

namespace App\Traits;

use DB;
use Session;

trait Nestcode
{

    public function countBlogView($slug)
    {
        $Key = 'key_' . $slug;
        if (!Session::has($Key)) {
            //increment view count by one
            DB::table('blogs')->where('code', $slug)->increment('total_seen', 1);
            Session::put($Key, 1);
        }
    }

    public function countGalleryView($slug)
    {
        $Key = 'key_' . $slug;
        if (!Session::has($Key)) {
            //increment view count by one
            DB::table('galleries')->where('code', $slug)->increment('total_seen', 1);
            Session::put($Key, 1);
        }
    }
}
