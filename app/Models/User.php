<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Bonus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'date_of_join',
        'address',
        'position',
        'grade',
        'image',
        'dep_id'//forein key
    ];
    public function departments(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'dep_id'); 
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

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'atten_id');
    }

    public function payrolls()
    {
        return $this->hasMany(Payrol::class,);
    }

    public function taxes()
    {
        return $this->hasMany(Tax::class,);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class,);
    }

    public function position()
    {
        return $this->belongsTo(Position::class,);
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
