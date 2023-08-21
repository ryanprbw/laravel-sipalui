<?php

namespace App\Models\Government;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GovernmentAgencies extends Model
{
    use HasFactory;

    protected $table = 'government_agencies';
    protected $primaryKey = 'agency_id';
    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at'];

    public final function government(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(GovernmentLocal::class, 'government_id', 'government_id');
    }
}
