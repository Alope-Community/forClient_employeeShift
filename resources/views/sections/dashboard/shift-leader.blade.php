<div class="">
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
        <p>{{ __('Tidak ada notifikasi') }}.</p>
    @endforelse

    <hr class="my-4">
    <h4 class="mb-4">Data Karyawan Berdasarkan Divisi</h4>

    <table id="unit-table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th colspan="5" class="text-center">Unit Personnel</th>
            </tr>
            <tr>
                <th>ID</th>
                <th>Nama Karyawan</th>
                <th>Jenis Kelamin</th>
                <th>Nomor Telepon</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($unitPersonnel as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->gender ?? '-' }}</td>
                    <td>{{ $employee->phone_number ?? '-' }}</td>
                    <td>{{ $employee->address ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table id="ash-fgd-table" class="table table-bordered table-striped mt-5">
        <thead>
            <tr>
                <th colspan="5" class="text-center">Ash FGD Personnel</th>
            </tr>
            <tr>
                <th>ID</th>
                <th>Nama Karyawan</th>
                <th>Jenis Kelamin</th>
                <th>Nomor Telepon</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ashFgdPersonnel as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->gender ?? '-' }}</td>
                    <td>{{ $employee->phone_number ?? '-' }}</td>
                    <td>{{ $employee->address ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table id="wtp-table" class="table table-bordered table-striped mt-5">
        <thead>
            <tr>
                <th colspan="5" class="text-center">WTP Personnel</th>
            </tr>
            <tr>
                <th>ID</th>
                <th>Nama Karyawan</th>
                <th>Jenis Kelamin</th>
                <th>Nomor Telepon</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($wtpPersonnel as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>
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
