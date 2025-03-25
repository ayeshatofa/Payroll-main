<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;
    protected $table = 'salaries';
    protected $primaryKey = 'salary_id';
    public $incrementing = true;
    protected $keyType = 'int';
    
    protected $fillable = ['basic_salary', 'allowance', 'grade','tax_rate', 'total_salary'];
}
