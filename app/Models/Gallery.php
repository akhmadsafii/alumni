<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'galleries';

    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function admins()
    {
        return $this->belongsTo(Admin::class, 'id_user', 'id');
    }
}
