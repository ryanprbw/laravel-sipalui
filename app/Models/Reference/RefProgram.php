<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefProgram extends Model
{
    use HasFactory, \Awobaz\Compoships\Compoships;

    protected $table = 'ref_program';
    protected $primaryKey = 'program_id';
    protected $guarded = [];
}
