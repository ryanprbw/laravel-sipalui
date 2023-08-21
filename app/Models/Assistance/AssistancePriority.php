<?php

namespace App\Models\Assistance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssistancePriority extends Model
{
    use HasFactory;

    protected $table = 'assistance_priorities';
    protected $primaryKey = 'assistance_priority_id';
    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at'];
}
