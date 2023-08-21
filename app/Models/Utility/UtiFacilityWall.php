<?php

namespace App\Models\Utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtiFacilityWall extends Model
{
    use HasFactory;

    protected $table = 'uti_facility_walls';
    protected $primaryKey = 'facility_wall_id';
    protected $guarded = [];
}
