<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected $fillable = ['amount', 'description', 'month', 'user_id'];

    public function users()
    {
        return $this->hasMany(User::class,);
    }
}
