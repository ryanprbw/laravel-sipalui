<?php

namespace App\Models\Utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtiStatusMarry extends Model
{
    use HasFactory;

    protected $table = 'uti_status_marry';
    protected $primaryKey = 'marry_id';
    protected $guarded = [];
}
