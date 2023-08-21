<?php

namespace App\Models\Nomination;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NominationPopulation extends Model
{
    use HasFactory;

    protected $table = 'nomination_populations';
    protected $primaryKey = 'nomination_id';
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];

}


