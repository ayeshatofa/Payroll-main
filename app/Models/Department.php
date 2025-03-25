<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $primaryKey = 'dep_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $table = 'departments';
    protected $fillable = ['dep_name'];
    public function users(): HasMany
    {
        return $this->hasMany(User::class,);
    }
}
