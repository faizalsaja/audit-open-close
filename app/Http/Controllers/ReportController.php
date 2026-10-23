<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use App\Models\Room;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // =====================================================
        // QUERY AUDIT
        // =====================================================
        $query = Audit::with([
            'patient',
            'room',
            'doctor',
            'auditForms.form.rules',
            'auditForms.indicators.indicator',
        ]);

        // =====================================================
        // FILTER BULAN
        // =====================================================
        if ($request->filled('bulan')) {
            $query->whereMonth('audit_date', $request->bulan);
        }

        // =====================================================
        // FILTER TAHUN
        // =====================================================
        if ($request->filled('tahun')) {
            $query->whereYear('audit_date', $request->tahun);
        }

        // =====================================================
        // FILTER RUANGAN
        // =====================================================
        if ($request->filled('ruangan')) {
            $query->where('room_id', $request->ruangan);
        }

        // =====================================================
        // FILTER JENIS AUDIT
        // =====================================================
        if ($request->filled('audit_type')) {
            $query->where('audit_type', $request->audit_type);
        }

        $audits = $query
            ->orderBy('audit_date', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        // =====================================================
        // DATA RUANGAN
        // =====================================================
        $rooms = Room::where('is_active', true)
            ->orderBy('name')
            ->get();

        // =====================================================
        // DATA TAHUN
        // =====================================================
        $years = Audit::selectRaw(
            "strftime('%Y', audit_date) as tahun"
        )
            ->whereNotNull('audit_date')
            ->distinct()
            ->orderByDesc('tahun')
            ->pluck('tahun');

        // =====================================================
        // DATA LAPORAN
        // =====================================================
        $rows = collect();

        foreach ($audits as $audit) {

            // =================================================
            // HITUNG NILAI PER DRM
            // =================================================
            $nilaiFormulir = [];

            foreach ($audit->auditForms as $auditForm) {

                $indicators = $auditForm->indicators;

                // Jika tidak ada indikator
                if ($indicators->count() === 0) {
                    $nilaiFormulir[] = 0;
                    continue;
                }

                // ---------------------------------------------
                // HITUNG NILAI FORM DARI INDIKATOR
                // Semua Ya = 100
                // Ada satu saja Tidak = menurunkan nilai
                // ---------------------------------------------
                $totalIndikator = $indicators->count();

                $indikatorMemenuhi = $indicators->filter(function ($item) {
                    return $item->answer === 'Ya'
                        && $item->terbaca === 'Ya'
                        && $item->lengkap === 'Ya';
                })->count();

                $nilaiForm = $totalIndikator > 0
                    ? ($indikatorMemenuhi / $totalIndikator) * 100
                    : 0;

                $nilaiForm = round($nilaiForm, 2);

                $nilaiFormulir[] = $nilaiForm;
            }

            // =================================================
            // NILAI PER DRM
            // =================================================
            $perDrm = count($nilaiFormulir) > 0
                ? round(collect($nilaiFormulir)->avg(), 2)
                : 0;


            // =================================================
            // LOOP SETIAP FORMULIR
            // =================================================
            foreach ($audit->auditForms as $auditForm) {

                $indicators = $auditForm->indicators;

                // =================================================
                // IDENTITAS
                // =================================================
                $identityNames = [
                    'Nama Pasien',
                    'No. Rekam Medik',
                    'Tanggal Lahir / Usia',
                    'Alamat',
                ];

                $identity = $indicators
                    ->whereIn('indicator.name', $identityNames)
                    ->where('answer', 'Ya')
                    ->count();


                // =================================================
                // TERBACA
                // =================================================
                $terbaca = $indicators
                    ->where(
                        'indicator.name',
                        'Tulisan Jelas / Terbaca'
                    )
                    ->first();


                // =================================================
                // REVIEW AUTENTIFIKASI
                // =================================================
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


                // =================================================
                // KOREKSI PENCATATAN
                // =================================================
                $koreksi = $indicators
                    ->where(
                        'indicator.name',
                        'Pencatatan Koreksi Sesuai'
                    )
                    ->first();


                // =================================================
                // HITUNG ULANG NILAI PER FORMULIR
                // =================================================
                $totalIndikator = $indicators->count();

                $indikatorMemenuhi = $indicators->filter(function ($item) {
                    return $item->answer === 'Ya'
                        && $item->terbaca === 'Ya'
                        && $item->lengkap === 'Ya';
                })->count();

                $perFormulir = $totalIndikator > 0
                    ? round(
                        ($indikatorMemenuhi / $totalIndikator) * 100,
                        2
                    )
                    : 0;


                // =================================================
                // FORM RULE
                // =================================================
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

                $wajib = $rule && $rule->is_required
                    ? 'YA'
                    : 'TIDAK';


                // =================================================
                // DOKTER
                // =================================================
                $doctor = $audit->doctor;


                // =================================================
                // MASUKKAN KE ROW LAPORAN
                // =================================================
             // =================================================
// MASUKKAN KE ROW LAPORAN
// =================================================
$rows->push([

    'audit_id' => $audit->id,

    'nama' =>
        $audit->patient->nama ?? '-',

    'no_rm' =>
        $audit->patient->no_rm ?? '-',

    'no_reg' =>
        $audit->patient->registrasi_id ?? '-',

    // DPJP MENGIKUTI DATA API RS
    'dpjp' =>
        $audit->doctor_name
        ?? $audit->patient->nama_dokter
        ?? '-',

    // SMF DARI MASTER DOKTER
    'smf' =>
        $doctor?->bagian ?? '-',

    'ruangan' =>
        $audit->room->name ?? '-',

    'kasus' =>
        $audit->case_type ?? '-',

    'tgl_pulang' =>
        $audit->patient->tanggal_pulang
            ? \Carbon\Carbon::parse(
                $audit->patient->tanggal_pulang
            )->format('d/m/Y')
            : '-',

    'tgl_audit' =>
        $audit->audit_date
            ? $audit->audit_date->format('d/m/Y')
            : '-',

    'keadaan_pulang' =>
        $audit->patient->keadaan_pulang ?? '-',

    'no_formulir' =>
        $auditForm->form->code ?? '-',

    'nama_formulir' =>
        $auditForm->form->name ?? '-',

    'kasus_form' =>
        $rule->case_type
        ?? $audit->case_type
        ?? '-',

    'wajib' =>
        $wajib,

    // KETERANGAN DOKUMEN
    'keterangan_dokumen' =>
        $auditForm->form->keterangan_dokumen ?? '-',

    'identitas' =>
        $identity > 0 ? 'V' : '',

    'terbaca' =>
        $terbaca?->answer === 'Ya'
            ? 'V'
            : '',

    'review_autentifikasi' =>
        collect([
            $tandaTangan?->answer === 'Ya',
            $namaCap?->answer === 'Ya',
            $tanggalJam?->answer === 'Ya',
        ])->filter()->count(),

    'koreksi' =>
        $koreksi?->answer === 'Ya'
            ? 'V'
            : '',

    'per_formulir' =>
        $perFormulir,

    'per_drm' =>
        $perDrm,

    'per_ruangan' =>
        $perDrm,

    'keterangan' => '',

    'denumerator_ruangan' => 1,
]);
            }
        }

        return view(
            'reports.index',
            compact(
                'rows',
                'rooms',
                'years'
            )
        );
    }
}