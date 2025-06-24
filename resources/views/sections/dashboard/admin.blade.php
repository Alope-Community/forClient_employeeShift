<div class="row g-4">
    <!-- Admin -->
    <div class="col-md-4">
        <div class="card card-border-left border-red">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-0">{{ __('Admin') }}</h5>
                    <p class="fs-4 mb-0">{{ $countAdmins }}</p>
                </div>
                <i class="bi bi-person-fill icon"></i>
            </div>
        </div>
    </div>

    <!-- Shift Leader -->
    <div class="col-md-4">
        <div class="card card-border-left border-blue">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-0">{{ __('Shift Leader') }}</h5>
                    <p class="fs-4 mb-0">{{ $countLeaders }}</p>
                </div>
                <i class="bi bi-person-fill icon"></i>
            </div>
        </div>
    </div>

    <!-- Karyawan -->
    <div class="col-md-4">
        <div class="card card-border-left border-navy">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-0">{{ __('Karyawan') }}</h5>
                    <p class="fs-4 mb-0">{{ $countEmployees }}</p>
                </div>
                <i class="bi bi-person-fill icon"></i>
            </div>
        </div>
    </div>

    <!-- Shift -->
    <div class="col-md-6">
        <div class="card card-border-left border-green">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-0">{{ __('Shift') }}</h5>
                    <p class="fs-4 mb-0">{{ $countShifts }}</p>
                </div>
                <i class="bi bi-clock icon"></i>
            </div>
        </div>
    </div>

    <!-- Laporan -->
    <div class="col-md-6">
        <div class="card card-border-left border-yellow">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-0">{{ __('Laporan') }}</h5>
                    <p class="fs-4 mb-0">{{ $countReports }}</p>
                </div>
                <i class="bi bi-journal-bookmark-fill icon"></i>
            </div>
        </div>
    </div>

</div>

<hr class="my-4">
<h4 class="mb-4">{{ __('Data Karyawan Berdasarkan Divisi') }}</h4>

{{-- Unit Personnel --}}
<div class="table-responsive">
    <table id="unit-table" class="table table-bordered table-striped nowrap" style="width:100%">
        <thead>
            <tr class="table-dark">
                <th colspan="5" class="text-center">{{ __('Unit Personnel') }}</th>
            </tr>
            <tr class="table-dark">
                <th>{{ __('No.') }}</th>
                <th>{{ __('Nama Karyawan') }}</th>
                <th>{{ __('Jenis Kelamin') }}</th>
                <th>{{ __('Nomor Telepon') }}</th>
                <th>{{ __('Alamat') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($unitPersonnel as $index => $employee)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->gender ?? '-' }}</td>
                    <td>{{ $employee->phone_number ?? '-' }}</td>
                    <td>{{ $employee->address ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Ash FGD Personnel --}}
<div class="table-responsive mt-5">
    <table id="ash-fgd-table" class="table table-bordered table-striped nowrap" style="width:100%">
        <thead>
            <tr class="table-dark">
                <th colspan="5" class="text-center">{{ __('Ash FGD Personnel') }}</th>
            </tr>
            <tr class="table-dark">
                <th>{{ __('No.') }}</th>
                <th>{{ __('Nama Karyawan') }}</th>
                <th>{{ __('Jenis Kelamin') }}</th>
                <th>{{ __('Nomor Telepon') }}</th>
                <th>{{ __('Alamat') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ashFgdPersonnel as $index => $employee)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->gender ?? '-' }}</td>
                    <td>{{ $employee->phone_number ?? '-' }}</td>
                    <td>{{ $employee->address ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- WTP Personnel --}}
<div class="table-responsive mt-5">
    <table id="wtp-table" class="table table-bordered table-striped nowrap" style="width:100%">
        <thead>
            <tr class="table-dark">
                <th colspan="5" class="text-center">{{ __('WTP Personnel') }}</th>
            </tr>
            <tr class="table-dark">
                <th>{{ __('No.') }}</th>
                <th>{{ __('Nama Karyawan') }}</th>
                <th>{{ __('Jenis Kelamin') }}</th>
                <th>{{ __('Nomor Telepon') }}</th>
                <th>{{ __('Alamat') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($wtpPersonnel as $index => $employee)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->gender ?? '-' }}</td>
                    <td>{{ $employee->phone_number ?? '-' }}</td>
                    <td>{{ $employee->address ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#unit-table').DataTable({
                responsive: true,
            });

            $('#ash-fgd-table').DataTable({
                responsive: true,
            });

            $('#wtp-table').DataTable({
                responsive: true,
            });
        });
    </script>
@endpush
