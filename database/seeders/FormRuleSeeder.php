<?php

namespace Database\Seeders;

use App\Models\Form;
use App\Models\FormRule;
use Illuminate\Database\Seeder;

class FormRuleSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | RESET RULE LAMA
        |--------------------------------------------------------------------------
        |
        | Supaya rule yang sudah tidak sesuai tidak tertinggal di database.
        |
        */
        FormRule::query()->delete();


        /*
        |--------------------------------------------------------------------------
        | HELPER
        |--------------------------------------------------------------------------
        */

        $add = function (
            string $auditType,
            string $caseType,
            ?string $serviceType,
            string $code,
            ?string $name = null,
            bool $required = false,
            ?string $condition = null
        ) {
            $query = Form::where('code', $code);

            /*
             * Beberapa kode seperti RM.08.IMP memiliki
             * beberapa nama berbeda.
             */
            if ($name !== null) {
                $query->where('name', $name);
            }

            $form = $query->first();

            if (!$form) {
                $this->command->warn(
                    "Form tidak ditemukan: {$code}" .
                    ($name ? " - {$name}" : '')
                );

                return;
            }

            FormRule::create([
                'form_id' => $form->id,
                'audit_type' => $auditType,
                'case_type' => $caseType,
                'service_type' => $serviceType,
                'is_required' => $required,
                'condition' => $condition,
                'is_active' => true,
            ]);
        };


        /*
        |--------------------------------------------------------------------------
        | DAFTAR CASE DASAR RAWAT INAP
        |--------------------------------------------------------------------------
        |
        | UMUM pada master kita representasikan sebagai:
        | NON-BEDAH, ANAK, BEDAH, dan NEONATUS.
        |
        */

        $inpatientCases = [
            'NON-BEDAH',
            'ANAK',
            'BEDAH',
            'NEONATUS',
        ];


        /*
        |--------------------------------------------------------------------------
        | OPEN - FORM UMUM RAWAT INAP
        |--------------------------------------------------------------------------
        */

        $openGeneralForms = [
            ['RM11', 'Rencana Pemulangan Pasien', true],
            ['RM06', 'Asesmen Medis Rawat Inap', true],
            ['RM06.1', 'Pemeriksaan Penderita Lanjutan', true],
            ['SP15', 'General Consent', true],
            ['SP18', 'Lembar Transfer / Serah Terima Pasien Internal', true],
            ['SP26', 'Persetujuan Tindakan Kedokteran', false],
            ['SP27', 'Penolakan Tindakan Kedokteran', false],
        ];

        foreach ($inpatientCases as $caseType) {

            foreach ($openGeneralForms as [$code, $name, $required]) {

                /*
                 * RM11, RM06, RM06.1, SP15, SP18, SP26, SP27
                 * berlaku pada rawat inap umum.
                 */
                $add(
                    'OPEN',
                    $caseType,
                    'RAWAT INAP',
                    $code,
                    $name,
                    $required
                );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | OPEN - BEDAH
        |--------------------------------------------------------------------------
        */

       $add(
    'OPEN',
    'BEDAH',
    null,
    'SP31',
    'Persetujuan Tindakan Anestesi/Sedasi',
    true,
    'anesthesia'
);

        $add(
    'OPEN',
    'BEDAH',
    null,
    'PENANDA',
    'Form Penanda Lokasi Operasi',
    true,
    'surgery'
);


        /*
        |--------------------------------------------------------------------------
        | OPEN - RAWAT JALAN
        |--------------------------------------------------------------------------
        */

        $add(
            'OPEN',
            'NON-BEDAH',
            'RAJAL',
            'RM02',
            'Asesmen Rawat Jalan',
            false
        );

        $add(
            'OPEN',
            'NON-BEDAH',
            'RAJAL',
            'RM03',
            'Konsultasi',
            false
        );


        /*
        |--------------------------------------------------------------------------
        | OPEN - IGD
        |--------------------------------------------------------------------------
        */

        $add(
            'OPEN',
            'NON-BEDAH',
            'IGD',
            'RM.01.A2',
            'Konsultasi IGD',
            false
        );

        $add(
            'OPEN',
            'NON-BEDAH',
            'IGD',
            'RM01',
            'RM IGD',
            false
        );
$add(
    'OPEN',
    'BEDAH',
    'IGD',
    'RM.01.A2',
    'Konsultasi IGD',
    false
);

$add(
    'OPEN',
    'BEDAH',
    'IGD',
    'RM01',
    'RM IGD',
    false
);

        /*
        |--------------------------------------------------------------------------
        | OPEN - KEBIDANAN / VK
        |--------------------------------------------------------------------------
        */

        $openObstetri = [
            'Asesmen Awal Kebidanan',
            'Asesmen Medis Pasien Rawat Inap Obstetri (Kala I Persalinan)',
            'Asesmen Medis Pasien Rawat Inap Obstetri (Patograf)',
            'Ringkasan Catatan Persalinan',
            'Asesmen Medis Rawat Inap Obstetri (Kala I Persalinan Pemeriksaan Sebelum Pulang)',
        ];

       foreach ($openObstetri as $name) {

    $add(
        'OPEN',
        'KEBIDANAN',
        null,
        'RM.08.IMP',
        $name,
        false
    );
}


        /*
        |--------------------------------------------------------------------------
        | CLOSE - FORM UMUM
        |--------------------------------------------------------------------------
        |
        | Berdasarkan master:
        | CASE = UMUM
        |
        | Form ini berlaku untuk kasus rawat inap dasar.
        |
        */

        $closeGeneralForms = [
            ['RM06.A1', 'Konsultasi Rawat Inap', false],
            ['RM07', 'CPPT', true],
            ['RM10.3', 'Program dan Pelaksanaan Pemberian Obat', true],
            ['RM10.4', 'Pengkajian Gizi', true],
            ['RM10.5', 'Rekonsiliasi Obat', false],
            ['RM12', 'Assesmen Kebutuhan Informasi dan Edukasi Serta Catatan Edukasi Pasien/Keluarga', true],
            ['RM12a', 'Resume Perawatan', true],
            ['RM13', 'Ringkasan Akhir Perawatan Inap', true],
            ['RM14', 'Ringkasan Rawat Inap', true],
            ['SP19', 'Lembar Transfer Eksternal', false],
            ['SP32', 'Persetujuan Tindakan Transfusi', false],
            ['SP53', 'Serah Terima Pasien Kritikal', false],
            ['SP59', 'Komunikasi dan Edukasi Harian', false],
        ];

        foreach ($inpatientCases as $caseType) {

            foreach ($closeGeneralForms as [$code, $name, $required]) {

                /*
                 * Tanpa condition = otomatis masuk.
                 * Untuk SP32/SP19/SP53 nanti kita hapus
                 * dari daftar otomatis dan buat berdasarkan condition.
                 */
                $condition = null;

                if ($code === 'SP19') {
                    $condition = 'external_transfer';
                }

                if ($code === 'SP32') {
                    $condition = 'transfusion';
                }

                if ($code === 'SP53') {
                    $condition = 'critical';
                }

                $add(
                    'CLOSE',
                    $caseType,
                    null,
                    $code,
                    $name,
                    $required,
                    $condition
                );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | CLOSE - BEDAH
        |--------------------------------------------------------------------------
        */

        $closeSurgeryForms = [
            ['RM06-L', 'Laporan Operasi', true],
            ['RM06.J', 'Asesmen Pra Anastesi/ Konsul Pra Bedah', true],
            ['RM06.K1.B', 'Penolakan Tindakan Anestesi/Sedasi', false],
            ['RM06.K2', 'Catatan Anastesi', true],
            ['RM06.K3', 'Monitoring Ruang Pemulihan', true],
            ['RM06.K5', 'Rencana Pasca Operasi (Instruksi Post OP) Terintegrasi', true],
            ['RM06.L1', 'Ceklist Pelayanan Tindakan Operasi', true],
            ['RM06.L2', 'Dokumen Asuhan Keperawatan Peri Operatif', true],
            ['RM06.L3', 'Surgical Safety Checklist', true],
        ];

        foreach ($closeSurgeryForms as [$code, $name, $required]) {

            $add(
                'CLOSE',
                'BEDAH',
                null,
                $code,
                $name,
                $required,
                'surgery'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | CLOSE - SP35
        |--------------------------------------------------------------------------
        |
        | Master:
        | SP35 = CASE BEDAH
        |
        */

        $add(
            'CLOSE',
            'BEDAH',
            null,
            'SP35',
            'Informasi Penundaan Pelayanan',
            false
        );


        /*
        |--------------------------------------------------------------------------
        | CLOSE - NEONATUS
        |--------------------------------------------------------------------------
        */

        $add(
            'CLOSE',
            'NEONATUS',
            null,
            'RM08.IMP.NEON',
            'Assesmen Awal Pasien Rawat Inap Neonatus',
            true
        );

        $add(
            'CLOSE',
            'NEONATUS',
            null,
            'CAIRAN.BAYI',
            'Dokumen Keperawatan Program Terapi dan Kebutuhan Cairan Bayi',
            false,
            'baby_fluid'
        );


        /*
        |--------------------------------------------------------------------------
        | CLOSE - MENINGGAL
        |--------------------------------------------------------------------------
        */

        foreach ($inpatientCases as $caseType) {

            $add(
                'CLOSE',
                $caseType,
                null,
                'MENINGGAL',
                'Surat Keterangan Meninggal',
                false,
                'death'
            );

            $add(
                'CLOSE',
                $caseType,
                null,
                'RM13.A',
                'Sebab Kematian',
                false,
                'death'
            );

            $add(
                'CLOSE',
                $caseType,
                null,
                'SP21',
                'Serah Terima Jenazah',
                false,
                'death'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | CLOSE - KEMOTERAPI
        |--------------------------------------------------------------------------
        */

        $add(
    'CLOSE',
    'NON-BEDAH',
    null,
    'RM17',
    'Laporan Kemoterapi',
    false,
    'chemotherapy'
);

$add(
    'CLOSE',
    'BEDAH',
    null,
    'RM17',
    'Laporan Kemoterapi',
    false,
    'chemotherapy'
);


        /*
        |--------------------------------------------------------------------------
        | CLOSE - HEMODIALISIS
        |--------------------------------------------------------------------------
        */

        $add(
    'CLOSE',
    'NON-BEDAH',
    null,
    'RM17.1.01',
    'Asesmen Hemodialisis',
    false,
    'hd'
);
$add(
    'CLOSE',
    'BEDAH',
    null,
    'RM17.1.01',
    'Asesmen Hemodialisis',
    false,
    'hd'
);

        /*
        |--------------------------------------------------------------------------
        | CLOSE - APS
        |--------------------------------------------------------------------------
        */

       $add(
    'CLOSE',
    'NON-BEDAH',
    null,
    'APS',
    'Atas Permintaan Sendiri (APS)',
    false,
    'aps'
);
$add(
    'CLOSE',
    'BEDAH',
    null,
    'APS',
    'Atas Permintaan Sendiri (APS)',
    false,
    'aps'
);
/*
|--------------------------------------------------------------------------
| CLOSE - ICU
|--------------------------------------------------------------------------
*/

$add(
    'CLOSE',
    'BEDAH',
    null,
    'SP34.A',
    'Indikasi Pasien Masuk ICU / ICCU',
    false,
    'icu'
);

$add(
    'CLOSE',
    'BEDAH',
    null,
    'SP34.B',
    'Indikasi Pasien Keluar ICU / ICCU',
    false,
    'icu'
);

        /*
        |--------------------------------------------------------------------------
        | SELESAI
        |--------------------------------------------------------------------------
        */

        $this->command->info('FormRuleSeeder selesai.');
    }
}