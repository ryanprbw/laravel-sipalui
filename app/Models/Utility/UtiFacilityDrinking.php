<?php

namespace App\Models\Utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtiFacilityDrinking extends Model
{
    use HasFactory;
    protected $table = 'uti_facility_drinkings';
    protected $primaryKey = 'facility_drinking_id';
    protected $guarded = [];
}
