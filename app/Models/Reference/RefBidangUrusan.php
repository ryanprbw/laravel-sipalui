<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefBidangUrusan extends Model
{
    use HasFactory;

    protected $table = 'ref_bidang_urusan';
    protected $primaryKey = 'bidang_id';
    protected $guarded = [];
}
