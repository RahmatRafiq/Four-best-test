@extends('layouts.app')

@section('content')
<div class="card mb-3">
    <div class="card-body">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">Daftar Pegawai</h5>
            <a href="{{ route('employee.create') }}" class="btn btn-success">Tambah Pegawai</a>
        </div>
        <div class="table-responsive">
            <table class="table styled-table" id="employees">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Jabatan</th>
                        <th>Telepon</th>
                        <th>Nomor Pegawai</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('assets/DataTables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/badges.css') }}">
@endpush

@push('javascript')
<script src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
<script>
    $('#employees').DataTable({
        responsive: true,
        serverSide: true,
        processing: true,
        ajax: {
            url: '{{ route('employee.json') }}',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        columns: [
            { data: 'id' },
            { data: 'user.name' },
            { data: 'user.email' },
            { data: 'position.name' },
            { data: 'phone' },
            { data: 'employee_number' },
            {
                data: 'id',
                render: function(data) {
                    return `
                        <a href="{{ route('employee.edit', ':id') }}" class="btn btn-primary btn-sm me-2">Edit</a>
                        <button class="btn btn-danger btn-sm" onclick="deleteEmployee(${data})">Delete</button>
                    `.replace(':id', data);
                },
                orderable: false,
                searchable: false
            }
        ]
    });

    function deleteEmployee(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: 'Data ini tidak bisa dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route('employee.destroy', ':id') }}'.replace(':id', id),
                    type: 'POST',
                    data: { _method: 'DELETE', _token: '{{ csrf_token() }}' },
                    success: function() {
                        $('#employees').DataTable().ajax.reload();
                        Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success');
                    },
                    error: function() {
                        Swal.fire('Error!', 'Gagal menghapus data.', 'error');
                    }
                });
            }
        });
    }
</script>
@endpush