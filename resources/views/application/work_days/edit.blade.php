@extends('layouts.app')

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <div class="card-header">
            <h5 class="card-title">Edit Hari Kerja</h5>
        </div>
        <form method="POST" action="{{ route('work-days.update', $workDay->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="position_id" class="form-label">Nama Posisi</label>
                <select class="form-select" id="position_id" name="position_id" required>
                    @foreach ($positions as $position)
                        <option value="{{ $position->id }}" {{ $position->id == $workDay->position_id ? 'selected' : '' }}>
                            {{ $position->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ $workDay->date }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection
