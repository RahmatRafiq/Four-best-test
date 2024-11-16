@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Daftar Absensi</h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nomor Pegawai</th>
                    <th>Nama Karyawan</th>
                    <th>Check-In</th>
                    <th>Check-Out</th>
                    <th>Keterlambatan (Menit)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $attendance)
                    <tr>
                        <td>{{ $attendance->date }}</td>
                        <td>{{ $attendance->employee->employee_number ?? '-' }}</td>
                        <td>{{ $attendance->employee->name ?? 'Tidak Ditemukan' }}</td>
                        <td>{{ $attendance->check_in ?? '-' }}</td>
                        <td>{{ $attendance->check_out ?? '-' }}</td>
                        <td>{{ $attendance->late_minutes }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
