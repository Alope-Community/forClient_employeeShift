<div class="main p-3 ms-5 mt-3">
    <h3>{{ __('Notifikasi') }}</h3>
    @forelse(auth()->user()->unreadNotifications as $notification)
        <div class="alert alert-info mb-2">
            <div>
                <strong>{{ $notification->data['title'] }}</strong><br>
                {{ $notification->data['message'] }}<br>
                <small>{{ $notification->created_at->diffForHumans() }}</small>
            </div>
            <a href="{{ route('shift-leader.shift-change.edit', $notification->data['report_id']) }}"
                class="btn btn-primary mt-2">{{ __('Verifikasi Sekarang') }}</a>
        </div>
    @empty
        <p>{{ __('Tidak ada notifikasi') }}</p>
    @endforelse

    <hr class="my-4">
    <h4 class="mb-4">{{ __('Data Karyawan Berdasarkan Divisi')}}</h4>

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
