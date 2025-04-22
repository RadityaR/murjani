<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daftar Pegawai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            padding: 0;
            font-size: 18px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
        }
        th {
            background-color: #f0f0f0;
        }
        .footer {
            text-align: right;
            font-size: 10px;
            margin-top: 20px;
        }
        .section-title {
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>DAFTAR PEGAWAI</h1>
        <p>Tanggal Export: {{ now()->format('d F Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama Lengkap</th>
                <th>No. KTP</th>
                <th>Golongan/Pangkat</th>
                <th>Profesi</th>
                <th>Unit Kerja</th>
                <th>Status Kepegawaian</th>
                <th>Email</th>
                <th>No. Telepon</th>
                <th>Alamat</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Status Pernikahan</th>
                <th>Agama</th>
                <th>Golongan Darah</th>
                <th>Tinggi Badan (cm)</th>
                <th>Berat Badan (kg)</th>
                <th>Hobi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($employees as $index => $employee)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $employee->nip }}</td>
                    <td>{{ $employee->full_name }}</td>
                    <td>{{ $employee->identity_number ?? '-' }}</td>
                    <td>{{ $employee->rankClass->name ?? '-' }}</td>
                    <td>{{ $employee->position->title ?? '-' }}</td>
                    <td>{{ $employee->unit->name ?? '-' }}</td>
                    <td>{{ $employee->employment_status }}</td>
                    <td>{{ $employee->user->email ?? '-' }}</td>
                    <td>{{ $employee->phone_number ?? '-' }}</td>
                    <td>{{ $employee->address ?? '-' }}</td>
                    <td>{{ $employee->birth_date ? $employee->birth_date->format('d F Y') : '-' }}</td>
                    <td>{{ $employee->gender }}</td>
                    <td>{{ $employee->marital_status }}</td>
                    <td>{{ $employee->religion }}</td>
                    <td>{{ $employee->blood_type }}</td>
                    <td>{{ $employee->height_cm ?? '-' }}</td>
                    <td>{{ $employee->weight_kg ?? '-' }}</td>
                    <td>{{ $employee->hobbies ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="19" style="text-align: center;">Tidak ada data pegawai</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d F Y H:i:s') }}</p>
    </div>
</body>
</html> 