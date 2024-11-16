<?php

namespace App\Http\Controllers;

use App\Helpers\DataTable;
use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('position', 'user')->get();
        return view('application.employees.index', compact('employees'));
    }

    public function json(Request $request)
    {
        $search = $request->search['value'];

        $query = Employee::query()
            ->with(['position', 'user']) // Eager load relasi position dan user
            ->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });

        if ($request->filled('search')) {
            $query->orWhere('nik', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
                ->orWhere('employee_number', 'like', "%{$search}%");
        }

        $columns = [
            'id',
            'user.name', // Akses nama dari relasi user
            'position.name', // Akses nama dari relasi position
            'phone',
            'employee_number',
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
        $positions = Position::all();
        return view('application.employees.create', compact('positions'));
    }

    public function store(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'name' => 'required|string|max:255', // Nama user
            'email' => 'required|email|unique:users,email', // Email user
            'password' => 'required|string|min:8|confirmed', // Password user
            'position_id' => 'required|exists:positions,id', // ID posisi
            'nik' => 'required|unique:employees,nik', // NIK pegawai
            'phone' => 'nullable|string|max:15', // Nomor telepon opsional
            'employee_number' => 'required|unique:employees,employee_number', // Nomor pegawai unik
        ]);

        // Gunakan transaksi database
        DB::transaction(function () use ($validated) {
            // Buat user baru
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']), // Hash password
            ]);

            // Assign role ke user
            $role = Role::where('name', 'pegawai')->firstOrFail();
            $user->assignRole($role);

            // Buat employee baru
            Employee::create([
                'user_id' => $user->id, // Relasi ke user
                'position_id' => $validated['position_id'],
                'nik' => $validated['nik'],
                'phone' => $validated['phone'] ?? null,
                'employee_number' => $validated['employee_number'],
            ]);
        });

        return redirect()->route('employee.index')->with('success', 'Pegawai berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $positions = Position::all();
        return view('application.employees.edit', compact('employee', 'positions'));
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $validated = $request->validate([
            'position_id' => 'required|exists:positions,id',
            'nik' => 'required|unique:employees,nik,' . $employee->id,
            'phone' => 'nullable|string|max:15',
            'employee_number' => 'required|unique:employees,employee_number,' . $employee->id,
        ]);

        $employee->update($validated);
        return redirect()->route('employees.index')->with('success', 'Pegawai berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Employee::findOrFail($id)->delete();
        return redirect()->route('employees.index')->with('success', 'Pegawai berhasil dihapus.');
    }
}
