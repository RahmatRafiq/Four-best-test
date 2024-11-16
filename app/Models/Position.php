<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = ['name', 'default_check_in', 'default_check_out'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    public function workDays()
    {
        return $this->hasMany(WorkDay::class);
    }
    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i:s',
        'updated_at' => 'datetime:d-m-Y H:i:s',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->setTimezone('GMT+8')->format('d-m-Y H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->setTimezone('GMT+8')->format('d-m-Y H:i:s');
    }
}
