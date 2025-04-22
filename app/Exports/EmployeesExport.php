<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EmployeesExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function query()
    {
        $query = Employee::with(['department', 'position', 'unit', 'rankClass', 'user']);

        if (!empty($this->filters['rank'])) {
            $query->whereHas('rankClass', function($q) {
                $q->where('name', $this->filters['rank']);
            });
        }

        if (!empty($this->filters['position'])) {
            $query->whereHas('position', function($q) {
                $q->where('title', $this->filters['position']);
            });
        }

        return $query;
    }

    public function headings(): array
    {
        return [
            'NIP',
            'Nama Lengkap',
            'No. KTP',
            'Golongan/Pangkat',
            'Profesi',
            'Unit Kerja',
            'Status Kepegawaian',
            'Email',
            'No. Telepon',
            'Alamat',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Status Pernikahan',
            'Agama',
            'Golongan Darah',
            'Tinggi Badan (cm)',
            'Berat Badan (kg)',
            'Hobi'
        ];
    }

    public function map($employee): array
    {
        return [
            $employee->nip,
            $employee->full_name,
            $employee->identity_number ?? '-',
            $employee->rankClass->name ?? '-',
            $employee->position->title ?? '-',
            $employee->unit->name ?? '-',
            $employee->employment_status,
            $employee->user->email ?? '-',
            $employee->phone_number ?? '-',
            $employee->address ?? '-',
            $employee->birth_date ? $employee->birth_date->format('d F Y') : '-',
            $employee->gender,
            $employee->marital_status,
            $employee->religion,
            $employee->blood_type,
            $employee->height_cm ?? '-',
            $employee->weight_kg ?? '-',
            $employee->hobbies ?? '-'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
} 