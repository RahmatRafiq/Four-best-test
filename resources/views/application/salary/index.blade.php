@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Daftar Gaji Karyawan</h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Karyawan</th>
                    <th>Gaji Pokok</th>
                    <th>Potongan Keterlambatan</th>
                    <th>Potongan Ketidakhadiran</th>
                    <th>Gaji Bersih</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($salaries as $salary)
                    <tr>
                        <td>{{ $salary->employee->name }}</td>
                        <td>{{ number_format($salary->base_salary, 2) }}</td>
                        <td>{{ number_format($salary->late_penalty, 2) }}</td>
                        <td>{{ number_format($salary->absence_penalty, 2) }}</td>
                        <td>{{ number_format($salary->net_salary, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
