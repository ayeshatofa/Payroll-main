<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;
    protected $table = 'payrolls';
    protected $fillable = [
        'salary',
        'bonus',
        'deduction',
        'fine',
        'user_id',
        'month',
        'payroll'
    ];
}
