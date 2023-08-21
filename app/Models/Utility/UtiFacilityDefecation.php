<?php

namespace App\Models\Utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtiFacilityDefecation extends Model
{
    use HasFactory;

    protected $table = 'uti_facility_defecations';
    protected $primaryKey = 'facility_defecation_id';
    protected $guarded = [];
}
