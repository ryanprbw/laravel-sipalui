<?php

namespace App\Models\Utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtiFamilyHouse extends Model
{
    use HasFactory;

    protected $table = 'uti_family_house';
    protected $primaryKey = 'family_house_id';
    protected $guarded = [];
}
