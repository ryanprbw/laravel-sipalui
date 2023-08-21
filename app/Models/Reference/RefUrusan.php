<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefUrusan extends Model
{
    use HasFactory;

    protected $table = 'ref_urusan';
    protected $primaryKey = 'urusan_id';
    protected $guarded = [];
}
