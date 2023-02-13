<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorySurvey extends Model
{
    use HasFactory;
    protected $table = 'category_surveys';

    protected $guarded = [];
}
