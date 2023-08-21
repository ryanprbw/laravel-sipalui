<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Government\GovernmentAgencies;
use App\Models\Government\GovernmentLocal;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'password',
        'level_id',
        'is_active',
        'government_id',
        'agency_id',
    ];

    protected $with = ['level', 'government', 'agency'];

    protected $hidden = ['password', 'created_at', 'updated_at'];

    public final function level(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(UserLevel::class, 'level_id', 'level_id');
    }

    public final function government(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(GovernmentLocal::class, 'government_id', 'government_id');
    }

    public final function agency(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(GovernmentAgencies::class, 'agency_id', 'agency_id');
    }

    public final function password(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Hash::make($value),
        );
    }

}
