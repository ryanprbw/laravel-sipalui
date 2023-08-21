<?php

namespace App\Models\DatabaseP3KE;

use App\Models\Receiver\ReceiverPriority;
use App\Models\Reference\RefCity;
use App\Models\Reference\RefDistrict;
use App\Models\Reference\RefProvince;
use App\Models\Reference\RefVillage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataFamily extends Model
{
    use HasFactory, \Awobaz\Compoships\Compoships;

    protected $table = 'data_families';
    protected $primaryKey = 'family_id';
    protected $guarded = [];
    public $timestamps = false;


    public final function population(): \Awobaz\Compoships\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(DataPopulation::class, ['family_id', 'population_nik'], ['family_id', 'population_nik']);
    }

    public final function populations(): \Awobaz\Compoships\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(DataPopulation::class, 'family_id', 'family_id');
    }

    public final function province(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(RefProvince::class, 'prov_code', 'prov_code');
    }

    public final function city(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(RefCity::class, ['prov_code', 'city_code'], ['prov_code', 'city_code']);
    }


    public final function district(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(RefDistrict::class, ['prov_code', 'city_code', 'district_code'], ['prov_code', 'city_code', 'district_code']);
    }

    public final function village(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(RefVillage::class, ['prov_code', 'city_code', 'district_code', 'village_code'], ['prov_code', 'city_code', 'district_code', 'village_code']);
    }

    public final function receiver_priority(): \Awobaz\Compoships\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ReceiverPriority::class, 'family_id', 'family_id')
            ->orderBy('assistance_priority_id');
    }

}
