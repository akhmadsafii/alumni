<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryOther extends Model
{
    use HasFactory;

    protected $table = 'category_others';

    protected $guarded = [];

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'id_category_other', 'id')->where('status', '!=', 0);
    }
}
