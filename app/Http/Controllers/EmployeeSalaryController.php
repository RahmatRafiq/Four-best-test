<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\EmployeeSalary;
use Illuminate\Http\Request;

class EmployeeSalaryController extends Controller
{
    public function calculateSalary($employeeId)
    {
        $employee = Employee::with('position', 'salary')->findOrFail($employeeId);

        if (!$employee->salary) {
            return redirect()->back()->withErrors('Karyawan ini belum memiliki data gaji.');
        }

        $attendances = Attendance::where('employee_id', $employee->id)->get();

        $latePenalty = 0;
        $absencePenalty = 0;
        $baseSalary = $employee->salary->base_salary;

        $totalDays = $attendances->whereNotNull('check_in')->whereNotNull('check_out')->count();

        $dailySalary = $totalDays > 0 ? $baseSalary / 30 : 0;

        foreach ($attendances as $attendance) {
            if ($attendance->late_minutes > 15) {
                $latePenalty += $dailySalary * 0.5;
            }

            if (is_null($attendance->check_in) || is_null($attendance->check_out)) {
                $absencePenalty += $dailySalary;
            }
        }

        $netSalary = $baseSalary - $latePenalty - $absencePenalty;

        EmployeeSalary::updateOrCreate(
            ['employee_id' => $employee->id],
            [
                'late_penalty' => $latePenalty,
                'absence_penalty' => $absencePenalty,
                'net_salary' => $netSalary,
            ]
        );

        return redirect()->back()->with('success', 'Gaji karyawan berhasil dihitung.');
    }

    public function index()
    {
        $salaries = EmployeeSalary::with('employee')->get();
        return view('application.salary.index', compact('salaries'));
    }
}
