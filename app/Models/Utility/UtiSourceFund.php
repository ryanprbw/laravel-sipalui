<?php

namespace App\Models\Utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtiSourceFund extends Model
{
    use HasFactory;

    protected $table = 'uti_source_funds';
    protected $primaryKey = 'source_fund_id';
    protected $guarded = [];
}
