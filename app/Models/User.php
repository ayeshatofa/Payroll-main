<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Bonus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'date_of_join',
        'address',
        'position',
        'grade',
        'dep_id'//forein key
    ];
    public function departments(): BelongsTo
    {
        return $this->belongsTo(Deparment::class, 'dep_id'); 
    }
    
    public function bonuses()
    {
        return $this->belongsToMany(Bonus::class, 'users_bonuses')
                    ->withPivot('month');
    }

    public function deductions()
    {
        return $this->belongsToMany(Deduction::class, 'user_deductions');
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
