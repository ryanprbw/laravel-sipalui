<?php

namespace App\Models\Utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtiFacilityFloor extends Model
{
    use HasFactory;

    protected $table = 'uti_facility_floors';
    protected $primaryKey = 'facility_floor_id';
    protected $guarded = [];
}
