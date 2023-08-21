<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefKegiatan extends Model
{
    use HasFactory, \Awobaz\Compoships\Compoships;

    protected $table = 'ref_kegiatan';
    protected $primaryKey = 'kegiatan_id';
    protected $guarded = [];
    
}
