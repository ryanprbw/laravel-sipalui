<?php

namespace App\Models\Utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtiEducation extends Model
{
    use HasFactory;

    protected $table = 'uti_educations';
    protected $primaryKey = 'uti_education_id';
    protected $guarded = [];
}
