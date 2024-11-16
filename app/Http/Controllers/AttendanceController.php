<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with('employee')->orderBy('date', 'desc')->get();
        return view('application.attendance.index', compact('attendances'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('application.attendance.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_number' => 'required|exists:employees,employee_number', // Validasi berdasarkan nomor pegawai
            'type' => 'required|in:check_in,check_out',
        ]);

        $employee = Employee::where('employee_number', $request->employee_number)->firstOrFail(); // Cari karyawan berdasarkan nomor pegawai
        $today = Carbon::today()->toDateString();

        $attendance = Attendance::firstOrCreate(
            ['employee_id' => $employee->id, 'date' => $today],
            ['check_in' => null, 'check_out' => null, 'late_minutes' => 0]
        );

        if ($request->type === 'check_in') {
            $attendance->check_in = Carbon::now();
            $lateMinutes = Carbon::parse($attendance->check_in)
                ->diffInMinutes(Carbon::parse($employee->position->default_check_in), false);
            $attendance->late_minutes = max(0, $lateMinutes);
        } elseif ($request->type === 'check_out') {
            $attendance->check_out = Carbon::now();
        }

        $attendance->save();

        return redirect()->back()->with('success', 'Absensi berhasil direkam.');
    }

}
