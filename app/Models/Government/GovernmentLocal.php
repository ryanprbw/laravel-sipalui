<?php

namespace App\Models\Government;

use App\Models\Reference\RefCity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GovernmentLocal extends Model
{
    use HasFactory;

    protected $table = 'government_local';
    protected $primaryKey = 'government_id';
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];

    public final function city(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(RefCity::class, 'city_code', 'city_code');
    }

    public final function agencies(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(GovernmentAgencies::class, 'government_id', 'government_id');
    }

}
