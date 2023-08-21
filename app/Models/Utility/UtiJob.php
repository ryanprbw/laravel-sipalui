<?php

namespace App\Models\Utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtiJob extends Model
{
    use HasFactory;

    protected $table = 'uti_job';
    protected $primaryKey = 'job_id';
    protected $guarded = [];
}
