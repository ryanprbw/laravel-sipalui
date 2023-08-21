<?php

namespace App\Models\Utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtiFacilityCooking extends Model
{
    use HasFactory;

    protected $table = 'uti_facility_cooking';
    protected $primaryKey = 'facility_cooking_id';
    protected $guarded = [];

}
