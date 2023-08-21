<?php

namespace App\Models\Assistance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssistanceInnovation extends Model
{
    use HasFactory;

    protected $table = 'assistance_innovations';
    protected $primaryKey = 'assistance_innovation_id';
    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at'];

    public final function priority(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(AssistancePriority::class, 'assistance_priority_id', 'assistance_priority_id');
    }
}
