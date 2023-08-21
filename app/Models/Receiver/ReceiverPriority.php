<?php

namespace App\Models\Receiver;

use App\Models\DatabaseP3KE\DataFamily;
use App\Models\Utility\UtiSourceFund;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiverPriority extends Model
{
    use HasFactory;

    protected $table = 'receiver_priority';
    protected $primaryKey = 'receiver_priority_id';
    protected $fillable = ['assistance_priority_id', 'agency_id', 'government_id', 'family_id', 'source_fund_id', 'year'];
    protected $hidden = ['created_at', 'updated_at'];

    public final function family(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(DataFamily::class, 'family_id', 'family_id')
            ->join('data_populations', 'data_populations.population_nik', '=', 'data_families.population_nik');
    }

    public final function source_fund(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(UtiSourceFund::class, 'source_fund_id', 'source_fund_id');
    }

}
