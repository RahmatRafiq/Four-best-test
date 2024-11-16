<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeSalary extends Model
{
    protected $fillable = [
        'employee_id', 
        'base_salary', 
        'late_penalty', 
        'absence_penalty'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
