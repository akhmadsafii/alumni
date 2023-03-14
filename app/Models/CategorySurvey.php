<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorySurvey extends Model
{
    use HasFactory;

    protected $table = 'category_surveys';

    protected $guarded = [];

    public function surveys()
    {
        return $this->hasMany(Survey::class, 'id_category', 'id')->where('status', '!=', 0);
    }

    public function answers()
    {
        return $this->hasMany(SurveyAnswer::class, 'id_category', 'id')->where('status', '!=', 0);
    }
}
