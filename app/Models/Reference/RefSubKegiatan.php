<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefSubKegiatan extends Model
{
    use HasFactory, \Awobaz\Compoships\Compoships;

    protected $table = 'ref_subkegiatan';
    protected $primaryKey = 'subkegiatan_id';
    protected $guarded = [];
}
