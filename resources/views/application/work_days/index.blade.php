@extends('layouts.app')

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">Daftar Hari Kerja</h5>
            <a href="{{ route('work-days.create') }}" class="btn btn-success">Tambah Hari Kerja</a>
        </div>
        <div class="table-responsive">
            <table class="table styled-table" id="workDays">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Posisi</th>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($workDays as $workDay)
                        <tr>
                            <td>{{ $workDay->id }}</td>
                            <td>{{ $workDay->position->name }}</td>
                            <td>{{ $workDay->date }}</td>
                            <td>{{ $workDay->check_in ?? '-' }}</td>
                            <td>{{ $workDay->check_out ?? '-' }}</td>
                            <td>
                                <a href="{{ route('work-days.edit', $workDay->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('work-days.destroy', $workDay->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
