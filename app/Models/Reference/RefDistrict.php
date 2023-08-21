<?php

namespace App\Models\Reference;

use App\Models\DatabaseP3KE\DataFamily;
use App\Models\DatabaseP3KE\DataPopulation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefDistrict extends Model
{
    use HasFactory, \Awobaz\Compoships\Compoships;

    protected $table = 'ref_districts';
    protected $primaryKey = 'district_id';
    protected $guarded = [];


    public final function populations(): \Awobaz\Compoships\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(DataPopulation::class, ['city_code', 'district_code'], ['city_code', 'district_code']);
    }

    public final function families(): \Awobaz\Compoships\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(DataFamily::class, ['city_code', 'district_code'], ['city_code', 'district_code']);
    }
}
