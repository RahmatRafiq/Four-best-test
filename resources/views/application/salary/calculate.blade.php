@extends('layouts.app')

@section('content')
<div class="card mb-3">
    <div class="card-header">
        <h5 class="card-title">Hitung Gaji Karyawan</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('salary.calculate', ['employeeId' => '']) }}">
            <div class="mb-3">
                <label for="employee_id" class="form-label">Pilih Karyawan</label>
                <select class="form-select" id="employee_id" name="employee_id" onchange="updateUrl(this)">
                    <option value="">Pilih Karyawan</option>
                    @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>
            <a id="calculate-link" href="#" class="btn btn-primary" style="display: none;">Hitung Gaji</a>
        </form>
    </div>
</div>
@endsection

@push('javascript')
<script>
    function updateUrl(select) {
        const employeeId = select.value;
        const calculateLink = document.getElementById('calculate-link');
        if (employeeId) {
            calculateLink.href = `{{ route('salary.calculate', ['employeeId' => ':id']) }}`.replace(':id', employeeId);
            calculateLink.style.display = 'inline-block';
        } else {
            calculateLink.style.display = 'none';
        }
    }
</script>
@endpush
