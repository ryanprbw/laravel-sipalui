<?php

namespace App\Models\Utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtiFacilityRoof extends Model
{
    use HasFactory;

    protected $table = 'uti_facility_roofs';
    protected $primaryKey = 'facility_roof_id';
    protected $guarded = [];
}
