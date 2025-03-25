<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    use HasFactory;
    protected $table = 'bonuses';
    public $timestamps = false;
    protected $fillable = ['name', 'bonusType', 'rate', 'gradeNumbers', 'month'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_bonuses')
                    ->withPivot('month');
    }

}
