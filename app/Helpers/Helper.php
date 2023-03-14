<?php

namespace App\Helpers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class Helper
{
    public static function check_and_make_dir($path)
    {
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
    }

    public static function env_update($old, $new)
    {
        $path = base_path('.env');
        $content = file_get_contents($path);
        if (file_exists($path)) {
            file_put_contents($path, str_replace($old, $new, $content));
        }
    }

    public static function str_random($length)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    public static function option_array()
    {
        $option = [
            5 => 'Sangat Baik',
            4 => 'Baik',
            3 => 'Cukup Baik',
            2 => 'Kurang Baik',
            1 => 'Tidak Baik'
        ];
        return $option;
    }

    public static function paginate($items, $perPage = 12, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public static function get_option($value)
    {
        switch ($value) {
            case 5:
                return 'Sangat Baik';
                break;
            case 4:
                return 'Baik';
                break;
            case 3:
                return 'Cukup Baik';
                break;
            case 2:
                return 'Kurang Baik';
                break;
            case 1:
                return 'Tidak Baik';
                break;
            default:
                return 'Error';
                break;
        }
    }
}
