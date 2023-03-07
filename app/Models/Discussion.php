<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    use HasFactory;
    protected $table = 'discussions';

    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function admins()
    {
        return $this->belongsTo(Admin::class, 'id_user', 'id');
    }

    public function comments()
    {
        return $this->hasMany(CommentDiscussion::class, 'id_discussion', 'id');
    }
}
