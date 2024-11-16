@extends('layouts.app')

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <div class="card-header">
            <h5 class="card-title">Edit Posisi</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('position.update', $position->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Posisi</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ old('name', $position->name) }}" required>
                </div>
                <div class="mb-3">
                    <label for="default_check_in" class="form-label">Jam Masuk</label>
                    <input type="time" class="form-control" id="default_check_in" name="default_check_in"
                        value="{{ old('default_check_in', $position->default_check_in) }}">
                </div>

                <div class="mb-3">
                    <label for="default_check_out" class="form-label">Jam Pulang</label>
                    <input type="time" class="form-control" id="default_check_out" name="default_check_out"
                        value="{{ old('default_check_out', $position->default_check_out) }}">
                </div>

                <button type="submit" class="btn btn-primary">Perbarui Posisi</button>
            </form>
        </div>
    </div>
</div>
@endsection