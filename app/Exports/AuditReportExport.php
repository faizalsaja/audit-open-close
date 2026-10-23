<?php

namespace App\Exports;

use App\Models\Audit;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AuditReportExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithStyles,
    ShouldAutoSize
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Ambil data sesuai filter Laporan
     */
    public function collection(): \Illuminate\Support\Enumerable
    {
        $query = Audit::with([
            'patient',
            'room',
            'doctor',
            'auditForms.form.rules',
            'auditForms.indicators.indicator',
        ]);

        // FILTER BULAN
        if ($this->request->filled('bulan')) {
            $query->whereMonth(
                'audit_date',
                $this->request->bulan
            );
        }

        // FILTER TAHUN
        if ($this->request->filled('tahun')) {
            $query->whereYear(
                'audit_date',
                $this->request->tahun
            );
        }

        // FILTER RUANGAN
        if ($this->request->filled('ruangan')) {
            $query->where(
                'room_id',
                $this->request->ruangan
            );
        }

        // FILTER JENIS AUDIT
        if ($this->request->filled('audit_type')) {
            $query->where(
                'audit_type',
                $this->request->audit_type
            );
        }

        $audits = $query
            ->orderBy('audit_date', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        $rows = collect();

        foreach ($audits as $audit) {

            $formScores = $audit->auditForms
                ->pluck('score')
                ->filter(fn ($score) => $score !== null);

            $perDrm = $formScores->count() > 0
                ? round($formScores->avg(), 2)
                : 0;

            foreach ($audit->auditForms as $auditForm) {

                $indicators = $auditForm->indicators;

                /*
                 * IDENTITAS
                 */
                $identityNames = [
                    'Nama Pasien',
                    'No. Rekam Medik',
                    'Tanggal Lahir / Usia',
                    'Alamat',
                ];

                $identity = $indicators
                    ->whereIn(
                        'indicator.name',
                        $identityNames
                    )
                    ->where('answer', 'Ya')
                    ->count();

                /*
                 * TERBACA
                 */
                $terbaca = $indicators
                    ->where(
                        'indicator.name',
                        'Tulisan Jelas / Terbaca'
                    )
                    ->first();

                /*
                 * AUTENTIFIKASI
                 */
                $tandaTangan = $indicators
                    ->where(
                        'indicator.name',
                        'Tanda Tangan'
                    )
                    ->first();

                $namaCap = $indicators
                    ->where(
                        'indicator.name',
                        'Nama / Cap / Stempel DPJP'
                    )
                    ->first();

                $tanggalJam = $indicators
                    ->where(
                        'indicator.name',
                        'Tanggal dan Jam Penulisan'
                    )
                    ->first();

                /*
                 * KOREKSI
                 */
                $koreksi = $indicators
                    ->where(
                        'indicator.name',
                        'Pencatatan Koreksi Sesuai'
                    )
                    ->first();

                /*
                 * NILAI PER FORMULIR
                 */
                $perFormulir = $auditForm->score !== null
                    ? round($auditForm->score, 2)
                    : 0;

                /*
                 * RULE FORM
                 */
                $rule = $auditForm->form
                    ->rules
                    ->where(
                        'audit_type',
                        $audit->audit_type
                    )
                    ->where(
                        'case_type',
                        $audit->case_type
                    )
                    ->first();

                $wajib = ($rule && $rule->is_required)
                    ? 'YA'
                    : 'TIDAK';

                /*
                 * MASUKKAN KE BARIS EXCEL
                 */
                $rows->push([
                    'audit' => $audit,
                    'auditForm' => $auditForm,
                    'rule' => $rule,

                    'identity' => $identity,
                    'terbaca' => $terbaca,
                    'tandaTangan' => $tandaTangan,
                    'namaCap' => $namaCap,
                    'tanggalJam' => $tanggalJam,
                    'koreksi' => $koreksi,

                    'perFormulir' => $perFormulir,
                    'perDrm' => $perDrm,
                    'wajib' => $wajib,
                ]);
            }
        }

        return $rows;
    }

    /**
     * Header Excel
     */
    public function headings(): array
    {
        return [
            'NAMA',
            'NO RM',
            'NO REG',
            'DPJP',
            'SMF',
            'RUANGAN',
            'KASUS',
            'TGL PULANG',
            'TGL AUDIT',
            'KEADAAN PULANG',

            'No Formulir',
            'Nama Formulir',
            'KASUS',
            'WAJIB',
            'KETERANGAN DOKUMEN',

            'IDENTITAS',
            'TERBACA',

            'TANDA TANGAN',
            'NAMA / CAP / STEMPEL DPJP',
            'TANGGAL DAN JAM PENULISAN',

            'KOREKSI SESUAI',

            'PER FORMULIR',
            'PER DRM',
            'PER RUANGAN',

            'KETERANGAN',
            'DENUMERATOR RUANGAN',
        ];
    }

    /**
     * Isi setiap baris Excel
     */
    public function map($row): array
{
    $audit = $row['audit'];
    $auditForm = $row['auditForm'];
    $rule = $row['rule'];

    return [

        // DATA PASIEN
        $audit->patient->nama ?? '-',

        $audit->patient->no_rm ?? '-',

        $audit->patient->registrasi_id ?? '-',

        // DPJP - MENGIKUTI API RS
        $audit->doctor_name
            ?? $audit->patient->nama_dokter
            ?? '-',

        // SMF
        $audit->doctor->bagian ?? '-',

        // RUANGAN
        $audit->room->name ?? '-',

        // KASUS
        $audit->case_type ?? '-',

        // TANGGAL PULANG
        $audit->patient->tanggal_pulang
            ? \Carbon\Carbon::parse(
                $audit->patient->tanggal_pulang
            )->format('d/m/Y')
            : '-',

        // TANGGAL AUDIT
        $audit->audit_date
            ? $audit->audit_date->format('d/m/Y')
            : '-',

        // KEADAAN PULANG
        $audit->audit_type === 'CLOSE'
            ? ($audit->patient->keadaan_pulang ?? '-')
            : '-',

        // FORMULIR
        $auditForm->form->code ?? '-',

        $auditForm->form->name ?? '-',

        $rule->case_type
            ?? $audit->case_type
            ?? '-',

        // WAJIB
        $row['wajib'],

        // KETERANGAN DOKUMEN
        $auditForm->form->keterangan_dokumen ?? '-',

        // IDENTITAS
        $row['identity'] > 0
            ? 'V'
            : '',

        // TERBACA
        $row['terbaca']?->answer === 'Ya'
            ? 'V'
            : '',

        // TANDA TANGAN
        $row['tandaTangan']?->answer === 'Ya'
            ? 'V'
            : '',

        // NAMA / CAP / STEMPEL DPJP
        $row['namaCap']?->answer === 'Ya'
            ? 'V'
            : '',

        // TANGGAL DAN JAM
        $row['tanggalJam']?->answer === 'Ya'
            ? 'V'
            : '',

        // KOREKSI
        $row['koreksi']?->answer === 'Ya'
            ? 'SESUAI'
            : 'TIDAK SESUAI',

        // NILAI PER FORMULIR
        $row['perFormulir'],

        // PER DRM
        $row['perDrm'],

        // PER RUANGAN
        $row['perDrm'],

        // KETERANGAN
        '',

        // DENUMERATOR
        1,
    ];
}

    /**
     * Styling Excel
     */
    public function styles(Worksheet $sheet): ?array
    {
        $sheet->getStyle('A1:Z1')->getFont()->setBold(true);

        $sheet->getStyle('A1:Z1')
            ->getAlignment()
            ->setHorizontal('center')
            ->setVertical('center');

        $sheet->getStyle('A:Z')
            ->getAlignment()
            ->setVertical('center');

        $sheet->freezePane('A2');

        return [];
    }
}