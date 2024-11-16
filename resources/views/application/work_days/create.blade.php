@extends('layouts.app')

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <div class="card-header">
            <h5 class="card-title">Tambah Hari Kerja</h5>
        </div>
        <form method="POST" action="{{ route('work-days.store') }}">
            @csrf
            <div class="mb-3">
                <label for="position_id" class="form-label">Nama Posisi</label>
                <select class="form-select" id="position_id" name="position_id" required>
                    <option value="">Pilih Posisi</option>
                    @foreach ($positions as $position)
                        <option value="{{ $position->id }}">{{ $position->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection
