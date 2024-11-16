@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Form Absensi</h4>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('attendance.store') }}">
            @csrf

            <div class="mb-3">
                <label for="employee_number" class="form-label">Nomor Pegawai</label>
                <input type="text" class="form-control" id="employee_number" name="employee_number" placeholder="Masukkan Nomor Pegawai" required>
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Tipe Absensi</label>
                <select class="form-select" id="type" name="type" required>
                    <option value="check_in">Check-In</option>
                    <option value="check_out">Check-Out</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Absensi</button>
        </form>
    </div>
</div>
@endsection
