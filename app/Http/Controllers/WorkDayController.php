<?php

namespace App\Http\Controllers;

use App\Models\WorkDay;
use App\Models\Position;
use Illuminate\Http\Request;

class WorkDayController extends Controller
{
    public function index()
    {
        $workDays = WorkDay::with('position')->get();
        return view('application.work_days.index', compact('workDays'));
    }

    public function create()
    {
        $positions = Position::all();
        return view('application.work_days.create', compact('positions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'position_id' => 'required|exists:positions,id',
            'date' => 'required|date',
        ]);

        $position = Position::findOrFail($validated['position_id']);

        WorkDay::create([
            'position_id' => $validated['position_id'],
            'date' => $validated['date'],
            'check_in' => $position->default_check_in,
            'check_out' => $position->default_check_out,
        ]);

        return redirect()->route('work-days.index')->with('success', 'Hari kerja berhasil ditambahkan.');
    }

    public function edit(WorkDay $workDay)
    {
        $positions = Position::all();
        return view('application.work_days.edit', compact('workDay', 'positions'));
    }

    public function update(Request $request, WorkDay $workDay)
    {
        $validated = $request->validate([
            'position_id' => 'required|exists:positions,id',
            'date' => 'required|date',
        ]);

        $position = Position::findOrFail($validated['position_id']);

        $workDay->update([
            'position_id' => $validated['position_id'],
            'date' => $validated['date'],
            'check_in' => $position->default_check_in,
            'check_out' => $position->default_check_out,
        ]);

        return redirect()->route('work-days.index')->with('success', 'Hari kerja berhasil diperbarui.');
    }
}
