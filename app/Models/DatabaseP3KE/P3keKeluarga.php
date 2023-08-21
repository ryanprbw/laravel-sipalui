<?php

namespace App\Models\DatabaseP3KE;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class P3keKeluarga extends Model
{
    use HasFactory;

    protected $table = 'p3ke_keluarga';
    protected $primaryKey = 'keluarga_id';
    protected $guarded = [];
    public $timestamps = false;

}
