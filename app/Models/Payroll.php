<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;
    protected $table = 'payroll';
    protected $fillable = [
        'salary',
        'bonus',
        'deduction',
        'user_id',
        'month',
        'payroll'
    ];
}
