<?php
namespace App\Models;

use App\Models\EmployeeSalary;
use App\Models\Position;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'user_id',
        'position_id',
        'name',
        'email',
        'employee_number',
        'nik',
        'phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function salary()
    {
        return $this->hasOne(EmployeeSalary::class);
    }
}
