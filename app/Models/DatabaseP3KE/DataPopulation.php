<?php

namespace App\Models\DatabaseP3KE;

use App\Models\Receiver\ReceiverPriority;
use App\Models\Reference\RefCity;
use App\Models\Reference\RefDistrict;
use App\Models\Reference\RefProvince;
use App\Models\Reference\RefVillage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPopulation extends Model
{
    use HasFactory, \Awobaz\Compoships\Compoships;

    protected $table = 'data_populations';
    protected $primaryKey = 'population_id';
    protected $guarded = [];


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


}
