@extends('layouts.app')

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <div class="card-header">
            <h5 class="card-title">Tambah Pegawai Baru</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('employee.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" required placeholder="Nama Pegawai">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Alamat Email</label>
                    <div class="input-group">
                        <span class="input-group-text">@</span>
                        <input type="email" class="form-control" id="email" name="email" required
                            placeholder="Email Pegawai">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        required>
                </div>

                <div class="mb-3">
                    <label for="position_id" class="form-label">Jabatan</label>
                    <select class="form-select" id="position_id" name="position_id" required>
                        <option value="">Pilih Jabatan</option>
                        @foreach ($positions as $position)
                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" class="form-control" id="nik" name="nik" required
                        placeholder="Nomor Induk Karyawan">
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Telepon</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Nomor Telepon">
                </div>

                <div class="mb-3">
                    <label for="employee_number" class="form-label">Nomor Pegawai</label>
                    <input type="text" class="form-control" id="employee_number" name="employee_number" required
                        placeholder="Nomor Pegawai">
                </div>

                <button type="submit" class="btn btn-primary">Tambah Pegawai</button>
            </form>
        </div>
    </div>
</div>
@endsection