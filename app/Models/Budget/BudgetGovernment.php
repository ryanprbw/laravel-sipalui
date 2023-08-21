<?php

namespace App\Models\Budget;

use App\Models\Reference\RefKegiatan;
use App\Models\Reference\RefProgram;
use App\Models\Reference\RefSubKegiatan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetGovernment extends Model
{
    use HasFactory, \Awobaz\Compoships\Compoships;

    protected $table = 'budget_government';
    protected $primaryKey = 'budget_government_id';
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];


    public final function subkegiatan(): \Awobaz\Compoships\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(RefSubKegiatan::class, ['subkegiatan_code', 'position'], ['subkegiatan_code', 'position']);
    }

}
