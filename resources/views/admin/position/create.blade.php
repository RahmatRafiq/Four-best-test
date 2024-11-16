@extends('layouts.app')

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <div class="card-header">
            <h5 class="card-title">Tambah Posisi Baru</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('position.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Posisi</label>
                    <input type="text" class="form-control" id="name" name="name" required
                        placeholder="Masukkan Nama Posisi">
                </div>

                <button type="submit" class="btn btn-primary">Tambah Posisi</button>
            </form>
        </div>
    </div>
</div>
@endsection