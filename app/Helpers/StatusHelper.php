<?php

namespace App\Helpers;

class StatusHelper
{
    public static function agendas($status)
    {
        switch ($status) {
            case 1:
                return [
                    'message' => 'Diterima',
                    'class' => 'success',
                ];
                break;
            case 2:
                return [
                    'message' => 'Pending',
                    'class' => 'warning',
                ];
                break;
            case 3:
                return [
                    'message' => 'Ditolak',
                    'class' => 'danger',
                ];
                break;
            default:
                return [
                    'message' => 'Tidak diketahui',
                    'class' => 'append',
                ];
                break;
        }
    }
}
