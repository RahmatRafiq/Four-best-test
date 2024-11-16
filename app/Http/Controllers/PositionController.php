<?php

namespace App\Http\Controllers;

use App\Helpers\DataTable;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        return view('admin.position.index');
    }

    public function json(Request $request)
    {
        $search = $request->search['value'];

        $query = Position::query()
            ->where('id', 'like', "%{$search}%")
            ->orWhere('name', 'like', "%{$search}%");

        if ($request->filled('search')) {
            $query->orWhere('id', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%");
        }

        $columns = [
            'id',
            'name',
            'created_at',
            'updated_at',
        ];

        if ($request->filled('order')) {
            $query->orderBy($columns[$request->order[0]['column']], $request->order[0]['dir']);
        }

        $data = DataTable::paginate($query, $request);

        return response()->json($data);
    }

    public function create()
    {
        return view('admin.position.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:positions',
            'default_check_in' => 'nullable|date_format:H:i',
            'default_check_out' => 'nullable|date_format:H:i',
        ]);

        Position::create($validatedData);

        return redirect()->route('position.index')->with('success', 'Position created successfully');
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $position = Position::findOrFail($id); // Ambil satu posisi berdasarkan ID
        return view('admin.position.edit', compact('position'));
    }

    public function update(Request $request, Position $position)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:positions,name,' . $position->id,
            'default_check_in' => 'nullable|date_format:H:i',
            'default_check_out' => 'nullable|date_format:H:i',
        ]);

        $position->update($validatedData);

        return redirect()->route('position.index')->with('success', 'Position updated successfully');
    }

    public function destroy(Position $position)
    {
        $position->delete();
        return response()->json(['message' => 'Position deleted successfully']);
    }
}
