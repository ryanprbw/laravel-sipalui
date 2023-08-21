<?php

namespace App\Models\Reference;

use App\Models\DatabaseP3KE\DataFamily;
use App\Models\DatabaseP3KE\DataPopulation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RefCity extends Model
{
    use HasFactory, \Awobaz\Compoships\Compoships;

    protected $table = 'ref_cities';
    protected $primaryKey = 'city_id';
    protected $guarded = [];


    public final function populations(): \Awobaz\Compoships\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(DataPopulation::class, 'city_code', 'city_code');
    }

    public final function families(): \Awobaz\Compoships\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(DataFamily::class, 'city_code', 'city_code');
    }

}
