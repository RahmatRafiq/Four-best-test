@extends('layouts.app')

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <div class="card-header">
            <h5 class="card-title">Edit Pegawai</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('employee.update', $employee->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="position_id" class="form-label">Jabatan</label>
                    <select class="form-select" id="position_id" name="position_id" required>
                        <option value="">Pilih Jabatan</option>
                        @foreach ($positions as $position)
                        <option value="{{ $position->id }}" {{ $position->id == $employee->position_id ? 'selected' : '' }}>
                            {{ $position->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" class="form-control" id="nik" name="nik" value="{{ $employee->nik }}" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Telepon</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $employee->phone }}">
                </div>

                <div class="mb-3">
                    <label for="employee_number" class="form-label">Nomor Pegawai</label>
                    <input type="text" class="form-control" id="employee_number" name="employee_number" value="{{ $employee->employee_number }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Perbarui Pegawai</button>
            </form>
        </div>
    </div>
</div>
@endsection
