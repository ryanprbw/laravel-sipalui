<?php

namespace App\Models\Utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtiFacilityLighting extends Model
{
    use HasFactory;

    protected $table = 'uti_facility_lightings';
    protected $primaryKey = 'facility_lighting_id';
    protected $guarded = [];
}
