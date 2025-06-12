<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Formulir Permohonan Tukar Shift</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        td,
        th {
            border: 1px solid black;
            padding: 6px;
            text-align: center;
        }

        .header {
            font-weight: bold;
            text-align: center;
        }

        .note {
            font-size: 10px;
        }
    </style>
</head>

<body>

    @for ($i = 1; $i <= 2; $i++)
        <div>
            <div class="header">Formulir Permohonan Tukar Shift</div>
            <table>
                <tr>
                    <th colspan="4">Alasan Tukar Shift</th>
                </tr>
                <tr>
                    <td colspan="4">{{ $report->description }}</td>
                </tr>
                <tr>
                    <th colspan="2">Pemohon</th>
                    <th colspan="2">Pengganti</th>
                </tr>
                <tr>
                    <td colspan="2">{{ $report->employee->name }}</td>
                    <td colspan="2">{{ $report->fromEmployee->name }}</td>
                </tr>
                <tr>
                    <th>Shift Leader/Monitor</th>
                    <th>Pemohon</th>
                    <th>Shift Leader/Monitor</th>
                    <th>Pengganti</th>
                </tr>
                <tr>
                    <td>{{ $report->shiftChange->approver->name ?? '-' }}</td>
                    <td>{{ $report->employee->name }}</td>
                    <td>{{ $report->shiftChange->approver->name ?? '-' }}</td>
                    <td>{{ $report->fromEmployee->name }}</td>
                </tr>
                <tr>
                    <th colspan="2">Tanggal Mengajukan Formulir Tukar Shift</th>
                    <th colspan="2">Tanggal Tukar Shift</th>
                </tr>
                <tr>
                    <td colspan="2">{{ \Carbon\Carbon::parse($report->created_at)->format('d/m/Y') }}</td>
                    <td colspan="2">{{ \Carbon\Carbon::parse($report->time)->format('d/m/Y') }}</td>
                </tr>
            </table>

            <div class="note">
                <strong>Catatan:</strong> Lembar ke-{{ $i }} diserahkan ke
                {{ $i == 1 ? 'pihak departemen' : 'pemohon' }}.
            </div>

            @if ($i == 1)
                <hr style="margin: 40px 0;">
            @endif
        </div>
    @endfor

</body>

</html>
