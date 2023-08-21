<?php

namespace App\Models\Utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtiDesil extends Model
{
    use HasFactory;

    protected $table = 'uti_desil';
    protected $primaryKey = 'desil_id';
    protected $guarded = [];

}
