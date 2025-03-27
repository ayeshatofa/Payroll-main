<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $primaryKey = 'atten_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $table = 'attendances';
    protected $fillable = ['date',  'check_in_time', 'check_out_time', 'month', 'user_id', 'status'];
    public function users(): BelongsTo{
        return $this->hasMany(User::class,);
    }
}
