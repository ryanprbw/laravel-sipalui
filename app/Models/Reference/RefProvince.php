<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefProvince extends Model
{
    use HasFactory;

    protected $table = 'ref_provinces';
    protected $primaryKey = 'prov_id';
    protected $guarded = [];
}
