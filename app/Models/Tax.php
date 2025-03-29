<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;
    protected $table = 'taxes';    
    protected $fillable = ['user_id', 'tax_rate', 'tax_amount','tax_rate', 'payable_salary', 'month'];

    public function users()
    {
        return $this->hasMany(User::class,);
    }       
}
