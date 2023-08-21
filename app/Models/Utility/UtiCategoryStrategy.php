<?php

namespace App\Models\Utility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtiCategoryStrategy extends Model
{
    use HasFactory;

    protected $table = 'uti_category_strategies';
    protected $primaryKey = 'category_strategy_id';
    protected $guarded = [];


}
