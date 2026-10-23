<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use App\Models\AuditForm;
use App\Services\PatientApiService;
use App\Models\Patient;
use App\Models\Form;
use App\Models\AuditIndicator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Room;
use App\Models\Doctor;


class AuditFormController extends Controller
{
   public function show(Request $request, Audit $audit)
{
    $audit->load([
        'patient',
        'room',
        'doctor',
        'auditForms.form',
        'auditForms.indicators.indicator',
    ]);

// =====================================================
// FILTER BULAN, TAHUN, DAN RUANGAN
// =====================================================

$bulan = $request->get('bulan', $audit->audit_date?->month ?? now()->month);
$tahun = $request->get('tahun', $audit->audit_date?->year ?? now()->year);
$ruanganId = $request->get('ruangan', $audit->room_id);

// =====================================================
// DAFTAR AUDIT CLOSE
// Digunakan untuk mengetahui pasien yang sudah selesai
// =====================================================



// =====================================================
// DAFTAR PASIEN AKTIF
// Pasien yang sudah OPEN tetapi belum CLOSE
// =====================================================

$openAudits = Audit::with('patient')
    ->where('audit_type', 'OPEN')
    ->whereMonth('audit_date', $bulan)
    ->whereYear('audit_date', $tahun)
    ->when($ruanganId, function ($query) use ($ruanganId) {
        $query->where('room_id', $ruanganId);
    })

    ->orderByDesc('id')
    ->get();

$patients = $openAudits
    ->pluck('patient')
    ->filter()
    ->unique('id')
    ->values();

$auditTypes = Audit::whereIn(
    'patient_id',
    $patients->pluck('id')
)
    ->get()
    ->groupBy('patient_id');

    // =====================================================
    // Ambil semua ruangan aktif
    // =====================================================

    $rooms = \App\Models\Room::where('is_active', true)
        ->orderBy('name')
        ->get();

    // =====================================================
    // Ambil tahun audit
    // =====================================================

    $years = Audit::selectRaw(
        "strftime('%Y', audit_date) as tahun"
    )
        ->whereNotNull('audit_date')
        ->distinct()
        ->orderByDesc('tahun')
        ->pluck('tahun');

   return view('audits.show', compact(
    'audit',
    'patients',
    'auditTypes',
    'rooms',
    'years',
    'bulan',
    'tahun',
    'ruanganId'
));

}
    public function update(Request $request, Audit $audit)
{
    $data = $request->validate([
        'indicators' => ['nullable', 'array'],
        'indicators.*.answer' => ['nullable', 'in:Ya'],
        'indicators.*.terbaca' => ['required', 'in:Ya,Tidak'],
        'indicators.*.lengkap' => ['required', 'in:Ya,Tidak'],
    ]);

    DB::transaction(function () use ($audit, $data) {

        foreach ($audit->auditForms as $auditForm) {

            foreach ($auditForm->indicators as $auditIndicator) {

                $input = $data['indicators'][$auditIndicator->id] ?? null;

                // =============================================
                // JIKA CHECKBOX TIDAK ADA DI REQUEST
                // JANGAN LANGSUNG DIUBAH MENJADI TIDAK
                // =============================================
                if (!$input) {
                    continue;
                }

                $answer = $input['answer'] ?? $auditIndicator->answer;

                $terbaca = $input['terbaca'];
                $lengkap = $input['lengkap'];

                $score =
                    $answer === 'Ya' &&
                    $terbaca === 'Ya' &&
                    $lengkap === 'Ya'
                        ? 1
                        : 0;

                $auditIndicator->update([
                    'answer' => $answer,
                    'terbaca' => $terbaca,
                    'lengkap' => $lengkap,
                    'score' => $score,
                ]);
            }

            // Hitung ulang nilai formulir
            $auditForm->score = $auditForm->calculateScore();
            $auditForm->save();
        }
    });

    return redirect()
        ->route('audits.show', $audit)
        ->with('success', 'Audit berhasil disimpan.');
}
public function updateForms(Request $request, Audit $audit)
{
    $data = $request->validate([
        'forms' => ['nullable', 'array'],
        'forms.*' => ['integer', 'exists:forms,id'],
    ]);

    $selectedForms = collect($data['forms'] ?? [])
        ->map(fn ($id) => (int) $id)
        ->unique()
        ->values();

    DB::transaction(function () use ($audit, $selectedForms) {

        // =====================================================
        // 1. HAPUS FORM YANG SUDAH TIDAK DIPILIH
        // =====================================================

        $audit->auditForms()
            ->whereNotIn('form_id', $selectedForms->toArray())
            ->delete();


        // =====================================================
        // 2. TAMBAHKAN FORM YANG DIPILIH
        // =====================================================

        foreach ($selectedForms as $formId) {

            $auditForm = $audit->auditForms()->firstOrCreate(
                [
                    'form_id' => $formId,
                ],
                [
                    'score' => 100,
                ]
            );


            // =================================================
            // 3. AMBIL INDIKATOR AKTIF
            // =================================================

            $indicators = Form::findOrFail($formId)
                ->indicators()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get();


            // =================================================
            // 4. BUAT INDIKATOR BARU DENGAN NILAI 100%
            // =================================================

            foreach ($indicators as $indicator) {

                AuditIndicator::firstOrCreate(
                    [
                        'audit_form_id' => $auditForm->id,
                        'indicator_id' => $indicator->id,
                    ],
                    [
                        'answer' => 'Ya',
                        'terbaca' => 'Ya',
                        'lengkap' => 'Ya',
                        'score' => 1,
                        'notes' => null,
                    ]
                );
            }


            // =================================================
            // 5. HITUNG NILAI FORM
            // =================================================

            $auditForm->score = $auditForm->calculateScore();
            $auditForm->save();
        }
    });


    return redirect()
        ->route('audits.show', $audit)
        ->with('success', 'Formulir audit berhasil diterapkan.');
}
public function updateStatus(Request $request, Audit $audit)
{
    $data = $request->validate([
        'status' => ['required', 'in:open,closed'],
    ]);

    $audit->update([
        'status' => $data['status'],
    ]);

    $message = $data['status'] === 'open'
        ? 'Audit berhasil dibuka.'
        : 'Audit berhasil ditutup.';

    return redirect()
        ->route('audits.show', $audit)
        ->with('success', $message);
}
public function createType(Audit $audit, Request $request)
{
    $data = $request->validate([
        'audit_type' => ['required', 'in:OPEN,CLOSE'],

        'patient_id' => [
            'nullable',
            'integer',
            'exists:patients,id'
        ],

        'case_type' => [
            'required',
            'in:BEDAH,NON-BEDAH,ANAK,KEBIDANAN,NEONATUS'
        ],

        'service_type' => [
            'nullable',
            'in:RAJAL,IGD,RAWAT INAP,VK'
        ],
    ]);

    $auditType = $data['audit_type'];

    $patientId = $data['patient_id'] ?? $audit->patient_id;

    $patient = Patient::findOrFail($patientId);

if ($auditType === 'CLOSE') {

    /*
    |--------------------------------------------------------------------------
    | Ambil kasus dari Audit OPEN pasien
    |--------------------------------------------------------------------------
    | Audit CLOSE harus mengikuti jenis kasus yang sudah
    | ditentukan ketika pasien dibuat sebagai Audit OPEN.
    */

    $openAudit = Audit::where('patient_id', $patient->id)
        ->where('audit_type', 'OPEN')
        ->latest('id')
        ->first();

    $caseType = $openAudit?->case_type
        ?? $data['case_type'];

    $serviceType = $data['service_type'] ?? null;

    if (!$serviceType) {

        if ($patient->jenis_layanan === 'Rawat Jalan') {

            $serviceType = 'RAJAL';

        } elseif ($patient->ruang_deskripsi === 'IGD') {

            $serviceType = 'IGD';

        } elseif ($patient->ruang_deskripsi === 'VK') {

            $serviceType = 'VK';

        } else {

            $serviceType = 'RAWAT INAP';
        }
    }

    return view('audits.close-conditions', [
        'audit' => $audit,
        'patient' => $patient,

        // PENTING: gunakan kasus dari Audit OPEN
        'caseType' => $caseType,

        'serviceType' => $serviceType,
    ]);
}
    /*
    |--------------------------------------------------------------------------
    | Tentukan ruangan pasien
    |--------------------------------------------------------------------------
    */

 $room = $this->findOrCreateRoom(
    $patient->ruang_deskripsi
);

    /*
    |--------------------------------------------------------------------------
    | Cek apakah audit OPEN/CLOSE sudah ada
    |--------------------------------------------------------------------------
    */

    $existingAudit = Audit::where('patient_id', $patient->id)
        ->where('audit_type', $auditType)
        ->first();

    if ($existingAudit) {
        return redirect()
            ->route('audits.show', $existingAudit)
            ->with(
                'success',
                'Audit ' . $auditType . ' sudah tersedia.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Buat audit baru
    |--------------------------------------------------------------------------
    */

    $newAudit = Audit::create([
        'patient_id' => $patient->id,
        'room_id' => $room->id,
        'audit_date' => now()->toDateString(),

        'case_type' => $data['case_type'],

        'diagnosis_id' => $patient->diagnosis_id,
        'diagnosis_description' => $patient->deskripsi_diagnosa,

        'doctor_id' => $patient->dokter_id,
        'doctor_name' => $patient->nama_dokter,

        'audit_type' => $auditType,
        'status' => 'open',
    ]);

    /*
    |--------------------------------------------------------------------------
    | Ambil FORM
    |--------------------------------------------------------------------------
    |
    | OPEN:
    |   ambil semua rule OPEN sesuai kasus + pelayanan.
    |
    | CLOSE:
    |   hanya ambil rule CLOSE yang condition = NULL.
    |
    |   Form dengan condition khusus seperti:
    |   surgery
    |   death
    |   icu
    |   transfusion
    |   chemotherapy
    |   hd
    |   aps
    |   external_transfer
    |   critical
    |
    |   TIDAK dimasukkan otomatis.
    |
    |--------------------------------------------------------------------------
    */

    $query = Form::where('is_active', true)
        ->whereHas('rules', function ($query) use (
            $auditType,
            $data
        ) {

            $query
                ->where('audit_type', $auditType)
                ->where(
                    'case_type',
                    $data['case_type']
                )
                ->where('is_active', true);

            /*
            |--------------------------------------------------------------------------
            | Untuk CLOSE hanya ambil form dasar.
            |--------------------------------------------------------------------------
            */

            if ($auditType === 'CLOSE') {
                $query->whereNull('condition');
            }

            /*
            |--------------------------------------------------------------------------
            | Filter service type
            |--------------------------------------------------------------------------
            */

            if (!empty($data['service_type'])) {
                $query->where(function ($q) use ($data) {

                    $q->whereNull('service_type')
                        ->orWhere(
                            'service_type',
                            $data['service_type']
                        );

                });
            }
        })
        ->orderBy('form_category_id')
        ->orderBy('sort_order');

    $forms = $query->get();

    /*
    |--------------------------------------------------------------------------
    | Buat audit_forms + indikator
    |--------------------------------------------------------------------------
    */

    foreach ($forms as $form) {

        $auditForm = $newAudit->auditForms()->create([
            'form_id' => $form->id,
            'score' => 100,
        ]);

        $indicators = $form->indicators()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        foreach ($indicators as $indicator) {

            AuditIndicator::create([
                'audit_form_id' => $auditForm->id,
                'indicator_id' => $indicator->id,

                // Default awal
                'answer' => 'Ya',
                'terbaca' => 'Ya',
                'lengkap' => 'Ya',
                'score' => 1,
            ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Jika tidak ada form
    |--------------------------------------------------------------------------
    */

    if ($forms->isEmpty()) {

        return redirect()
            ->route('audits.show', $newAudit)
            ->with(
                'warning',
                'Audit berhasil dibuat tetapi belum ada formulir yang sesuai dengan kasus tersebut.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Langsung buka audit
    |--------------------------------------------------------------------------
    */

    return redirect()
        ->route('audits.show', $newAudit)
        ->with(
            'success',
            'Audit ' . $auditType .
            ' berhasil dibuat dengan formulir sesuai kasus.'
        );
}
public function storeClose(Audit $audit, Request $request)
{
    $data = $request->validate([
    'patient_id' => [
        'required',
        'integer',
        'exists:patients,id'
    ],

    'case_type' => [
        'required',
        'in:BEDAH,NON-BEDAH,ANAK,KEBIDANAN,NEONATUS'
    ],

    'service_type' => [
        'required',
        'in:RAJAL,IGD,RAWAT INAP,VK'
    ],

    'tanggal_pulang' => [
        'required',
        'date'
    ],

    'keadaan_pulang' => [
        'required',
        'in:PULANG HIDUP,MENINGGAL,APS,DIRUJUK'
    ],

    'conditions' => [
        'nullable',
        'array'
    ],

    'conditions.*' => [
        'in:surgery,death,icu,transfusion,chemotherapy,hd,aps,external_transfer,critical,baby_fluid'
    ],
]);

    $patient = Patient::findOrFail($data['patient_id']);
    /*
|--------------------------------------------------------------------------
| Ambil jenis kasus dari Audit OPEN
|--------------------------------------------------------------------------
*/

$openAudit = Audit::where('patient_id', $patient->id)
    ->where('audit_type', 'OPEN')
    ->latest('id')
    ->first();

$caseType = $openAudit?->case_type
    ?? $data['case_type'];
/*
|--------------------------------------------------------------------------
| UPDATE DATA PULANG PASIEN
|--------------------------------------------------------------------------
*/

$patient->update([
    'tanggal_pulang' => $data['tanggal_pulang'],
    'keadaan_pulang' => $data['keadaan_pulang'],
]);
    /*
    |--------------------------------------------------------------------------
    | Cek apakah CLOSE sudah ada
    |--------------------------------------------------------------------------
    */

    $existingAudit = Audit::where('patient_id', $patient->id)
        ->where('audit_type', 'CLOSE')
        ->first();

    if ($existingAudit) {
        return redirect()
            ->route('audits.show', $existingAudit)
            ->with(
                'success',
                'Audit CLOSE pasien ini sudah tersedia.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Tentukan ruangan
    |--------------------------------------------------------------------------
    */

  $room = $this->findOrCreateRoom(
    $patient->ruang_deskripsi
);

    /*
    |--------------------------------------------------------------------------
    | Buat Audit CLOSE
    |--------------------------------------------------------------------------
    */

 $newAudit = Audit::create([
    'patient_id' => $patient->id,
    'room_id' => $room->id,
    'audit_date' => now()->toDateString(),

    // Gunakan kasus dari Audit OPEN
    'case_type' => $caseType,

    'diagnosis_id' => $patient->diagnosis_id,
    'diagnosis_description' => $patient->deskripsi_diagnosa,
    'doctor_id' => $patient->dokter_id,
    'doctor_name' => $patient->nama_dokter,
    'audit_type' => 'CLOSE',
    'status' => 'open',
]);

    /*
    |--------------------------------------------------------------------------
    | Simpan kondisi yang dipilih
    |--------------------------------------------------------------------------
    */

    foreach ($data['conditions'] ?? [] as $condition) {

        $newAudit->conditions()->create([
            'condition' => $condition,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Ambil FORM CLOSE
    |
    | 1. Ambil form umum: condition NULL
    | 2. Ambil form sesuai kondisi yang dipilih
    |--------------------------------------------------------------------------
    */

  /*
|--------------------------------------------------------------------------
| AMBIL FORM YANG SUDAH DIPILIH SAAT OPEN
|--------------------------------------------------------------------------
*/

$selectedOpenFormIds = collect();

if ($openAudit) {

    $selectedOpenFormIds = $openAudit->auditForms()
        ->pluck('form_id');
}


/*
|--------------------------------------------------------------------------
| AMBIL KONDISI CLOSE
|--------------------------------------------------------------------------
*/

$selectedConditions = $data['conditions'] ?? [];


/*
|--------------------------------------------------------------------------
| AMBIL FORM CLOSE SESUAI RULE
|--------------------------------------------------------------------------
*/

$closeForms = Form::where('is_active', true)
    ->whereHas('rules', function ($query) use (
        $caseType,
        $selectedConditions
    ) {

        $query
            ->where('audit_type', 'CLOSE')
            ->where('case_type', $caseType)
            ->where('is_active', true)
            ->where(function ($q) use ($selectedConditions) {

                /*
                |--------------------------------------------------------------------------
                | FORM CLOSE UMUM
                |--------------------------------------------------------------------------
                */

                $q->whereNull('condition');

                /*
                |--------------------------------------------------------------------------
                | FORM CLOSE BERDASARKAN KONDISI
                |--------------------------------------------------------------------------
                */

                if (!empty($selectedConditions)) {

                    $q->orWhereIn(
                        'condition',
                        $selectedConditions
                    );
                }

            });

    })
    ->get();


/*
|--------------------------------------------------------------------------
| GABUNGKAN:
|
| 1. Form yang dipilih saat OPEN
| 2. Form CLOSE sesuai kondisi
|--------------------------------------------------------------------------
*/

$selectedFormIds = $selectedOpenFormIds
    ->merge($closeForms->pluck('id'))
    ->unique()
    ->values();


/*
|--------------------------------------------------------------------------
| AMBIL DATA FORM FINAL
|--------------------------------------------------------------------------
*/

$forms = Form::where('is_active', true)
    ->whereIn('id', $selectedFormIds)
    ->orderBy('form_category_id')
    ->orderBy('sort_order')
    ->get();

    /*
    |--------------------------------------------------------------------------
    | Buat AuditForm + indikator
    |--------------------------------------------------------------------------
    */

    foreach ($forms as $form) {

        $auditForm = $newAudit->auditForms()->create([
            'form_id' => $form->id,
            'score' => 100,
        ]);

        $indicators = $form->indicators()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        foreach ($indicators as $indicator) {

            AuditIndicator::create([
                'audit_form_id' => $auditForm->id,
                'indicator_id' => $indicator->id,
                'answer' => 'Ya',
                'terbaca' => 'Ya',
                'lengkap' => 'Ya',
                'score' => 1,
            ]);
        }
    }

    return redirect()
        ->route('audits.show', $newAudit)
        ->with(
            'success',
            'Audit CLOSE berhasil dibuat sesuai kondisi pasien.'
        );
}
public function searchPatient(
    Request $request,
    PatientApiService $patientApi
) {
    $request->validate([
        'noreg' => ['required', 'string', 'max:50'],
    ]);

    $patient = $patientApi->getPatientByRegistration(
        $request->noreg
    );

    if (!$patient) {
        return back()->with(
            'error',
            'Data pasien tidak ditemukan atau API tidak dapat diakses.'
        );
    }

    return view('audits.patient-result', [
        'patient' => $patient,
    ]);
}
public function usePatient(Request $request)
{
    $data = $request->validate([
        'no_rm' => ['required', 'string'],
        'registrasi_id' => ['required', 'string'],
        'nama' => ['required', 'string'],
        'jenis_layanan' => ['nullable', 'string'],
        'tanggal_masuk' => ['nullable', 'string'],
        'tanggal_pulang' => ['nullable', 'string'],
        'ruang_deskripsi' => ['nullable', 'string'],
        'diagnosis_id' => ['nullable', 'string'],
        'deskripsi_diagnosa' => ['nullable', 'string'],
        'dokter_id' => ['nullable', 'string'],
        'nama_dokter' => ['nullable', 'string'],
        'keadaan_pulang' => ['nullable', 'string'],

        'case_type' => [
            'required',
            'in:BEDAH,NON-BEDAH,ANAK,KEBIDANAN,NEONATUS',
        ],
    ]);

    /*
    |--------------------------------------------------------------------------
    | 1. KONVERSI TANGGAL DARI API
    |--------------------------------------------------------------------------
    */

    $tanggalMasuk = null;

    if (!empty($data['tanggal_masuk'])) {
        try {
            $tanggalMasuk = \Carbon\Carbon::createFromFormat(
                'd-m-Y',
                $data['tanggal_masuk']
            )->format('Y-m-d');
        } catch (\Exception $e) {
            $tanggalMasuk = null;
        }
    }

    $tanggalPulang = null;

    if (!empty($data['tanggal_pulang'])) {
        try {
            $tanggalPulang = \Carbon\Carbon::createFromFormat(
                'd-m-Y',
                $data['tanggal_pulang']
            )->format('Y-m-d');
        } catch (\Exception $e) {
            $tanggalPulang = null;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | 2. CARI DOKTER DARI MASTER DOCTORS
    |--------------------------------------------------------------------------
    */

  // DPJP mengikuti data API RS secara langsung
$doctorCode = $data['dokter_id'] ?? null;
$doctorName = $data['nama_dokter'] ?? null;
    /*
    |--------------------------------------------------------------------------
    | 4. SIMPAN / UPDATE PASIEN
    |--------------------------------------------------------------------------
    */

    $patient = Patient::updateOrCreate(
        [
            'registrasi_id' => $data['registrasi_id'],
        ],
        [
            'no_rm' => $data['no_rm'],
            'nama' => $data['nama'],
            'jenis_layanan' => $data['jenis_layanan'],
            'tanggal_masuk' => $tanggalMasuk,
            'tanggal_pulang' => $tanggalPulang,
            'ruang_deskripsi' => $data['ruang_deskripsi'],
            'diagnosis_id' => $data['diagnosis_id'],
            'deskripsi_diagnosa' => $data['deskripsi_diagnosa'],

            // DOKTER DARI MASTER
            'dokter_id' => $doctorCode,
            'nama_dokter' => $doctorName,

            'keadaan_pulang' => $data['keadaan_pulang'],
        ]
    );

    /*
    |--------------------------------------------------------------------------
    | 5. TENTUKAN JENIS PELAYANAN
    |--------------------------------------------------------------------------
    */

    $serviceType = 'RAWAT INAP';

    if ($patient->ruang_deskripsi === 'IGD') {

        $serviceType = 'IGD';

    } elseif ($patient->ruang_deskripsi === 'VK') {

        $serviceType = 'VK';

    } elseif ($patient->jenis_layanan === 'Rawat Jalan') {

        $serviceType = 'RAJAL';
    }

    /*
    |--------------------------------------------------------------------------
    | 6. CARI RUANGAN PASIEN
    |--------------------------------------------------------------------------
    */

  $room = $this->findOrCreateRoom(
    $patient->ruang_deskripsi
);

    /*
    |--------------------------------------------------------------------------
    | 7. CARI AUDIT OPEN YANG SUDAH ADA
    |--------------------------------------------------------------------------
    */

    $openAudit = Audit::where('patient_id', $patient->id)
        ->where('audit_type', 'OPEN')
        ->first();

    /*
    |--------------------------------------------------------------------------
    | 8. JIKA OPEN BELUM ADA → BUAT AUDIT OPEN
    |--------------------------------------------------------------------------
    */

    if (!$openAudit) {

        $openAudit = Audit::create([
            'patient_id' => $patient->id,

            'room_id' => $room->id,

            'audit_date' => now()->toDateString(),

            'case_type' => $data['case_type'],

            'diagnosis_id' => $patient->diagnosis_id,

            'diagnosis_description' =>
                $patient->deskripsi_diagnosa,

            /*
            |--------------------------------------------------------------
            | DOKTER
            |--------------------------------------------------------------
            */

            'doctor_id' => $doctorCode,

            'doctor_name' => $doctorName,

            'audit_type' => 'OPEN',

            'status' => 'open',
        ]);

        /*
        |--------------------------------------------------------------------------
        | 9. AMBIL FORM OPEN
        |--------------------------------------------------------------------------
        */

        $forms = Form::where('is_active', true)
            ->whereHas('rules', function ($query) use (
                $data,
                $serviceType
            ) {

                $query
                    ->where(
                        'audit_type',
                        'OPEN'
                    )

                    ->where(
                        'case_type',
                        $data['case_type']
                    )

                    ->where(
                        'is_active',
                        true
                    )

                    ->where(function ($q) use (
                        $serviceType
                    ) {

                        $q->whereNull(
                            'service_type'
                        )

                        ->orWhere(
                            'service_type',
                            $serviceType
                        );
                    });
            })

            ->orderBy(
                'form_category_id'
            )

            ->orderBy(
                'sort_order'
            )

            ->get();

        /*
        |--------------------------------------------------------------------------
        | 10. MASUKKAN FORM KE AUDIT
        |--------------------------------------------------------------------------
        */

        foreach ($forms as $form) {

            $auditForm =
                $openAudit
                    ->auditForms()
                    ->create([
                        'form_id' => $form->id,
                        'score' => 100,
                    ]);

            /*
            |--------------------------------------------------------------------------
            | 11. BUAT INDIKATOR
            |--------------------------------------------------------------------------
            */

            $indicators =
                $form
                    ->indicators()
                    ->where(
                        'is_active',
                        true
                    )
                    ->orderBy(
                        'sort_order'
                    )
                    ->get();

            foreach ($indicators as $indicator) {

                AuditIndicator::create([
                    'audit_form_id' =>
                        $auditForm->id,

                    'indicator_id' =>
                        $indicator->id,

                    'answer' => 'Ya',

                    'terbaca' => 'Ya',

                    'lengkap' => 'Ya',

                    'score' => 1,
                ]);
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | 12. MASUK KE HALAMAN AUDIT OPEN
    |--------------------------------------------------------------------------
    */

    return redirect()
        ->route(
            'audits.show',
            $openAudit
        )
        ->with(
            'success',
            'Pasien berhasil ditambahkan dan Audit OPEN siap dilakukan.'
        );
}
private function findOrCreateRoom(?string $roomName): Room
{
    $roomName = trim($roomName ?? '');

    if ($roomName === '') {
        $roomName = 'TIDAK DIKETAHUI';
    }

    /*
    |--------------------------------------------------------------------------
    | Cari ruangan yang sudah ada
    |--------------------------------------------------------------------------
    */

    $room = Room::where('name', $roomName)->first();

    if ($room) {
        return $room;
    }

    /*
    |--------------------------------------------------------------------------
    | Kalau belum ada → buat otomatis
    |--------------------------------------------------------------------------
    */

    return Room::create([
        'name' => $roomName,
        'code' => null,
        'is_active' => true,
    ]);
}
public function deletePatient(Audit $audit)
{
    // Simpan informasi ruangan sebelum audit dihapus
    $roomId = $audit->room_id;

    DB::transaction(function () use ($audit) {

        $patient = $audit->patient;

        if (!$patient) {
            return;
        }

        // Hapus seluruh audit milik pasien
        $audits = Audit::where('patient_id', $patient->id)->get();

        foreach ($audits as $patientAudit) {
            $patientAudit->delete();
        }

        // Hapus data pasien
        $patient->delete();
    });

    // =====================================================
    // CARI AUDIT LAIN DI RUANGAN YANG SAMA
    // AGAR TETAP KEMBALI KE HALAMAN AUDIT
    // =====================================================

    $nextAudit = Audit::where('room_id', $roomId)
        ->orderByRaw("CASE WHEN audit_type = 'OPEN' THEN 0 ELSE 1 END")
        ->orderByDesc('id')
        ->first();

    if ($nextAudit) {
        return redirect()
            ->route('audits.show', $nextAudit)
            ->with('success', 'Data pasien dan seluruh audit berhasil dihapus.');
    }

    // Kalau memang tidak ada audit lain di ruangan tersebut
    return redirect()
        ->route('audits.index')
        ->with('success', 'Data pasien dan seluruh audit berhasil dihapus.');
}
}