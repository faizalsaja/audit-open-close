<?php

namespace Database\Seeders;

use App\Models\Form;
use App\Models\FormCategory;
use Illuminate\Database\Seeder;

class FormSeeder extends Seeder
{
    public function run(): void
    {
        // =====================================================
        // AMBIL KATEGORI
        // =====================================================

        $poliklinik = FormCategory::where(
            'name',
            'TAMBAHAN PASIEN VIA POLIKLINIK'
        )->firstOrFail();

        $igd = FormCategory::where(
            'name',
            'TAMBAHAN PASIEN VIA IGD'
        )->firstOrFail();

        $indikatorUtama = FormCategory::where(
            'name',
            'INDIKATOR UTAMA'
        )->firstOrFail();

        $bedah = FormCategory::where(
            'name',
            'TAMBAHAN KASUS BEDAH'
        )->firstOrFail();

        $persalinan = FormCategory::where(
            'name',
            'TAMBAHAN KASUS PERSALINAN VIA VK'
        )->firstOrFail();


        // =====================================================
        // OPEN - TAMBAHAN PASIEN VIA POLIKLINIK
        // =====================================================

        $this->createForm(
            $poliklinik->id,
            'RM02',
            'Asesmen Rawat Jalan',
            1
        );

        $this->createForm(
            $poliklinik->id,
            'RM03',
            'Konsultasi',
            2
        );


        // =====================================================
        // OPEN - TAMBAHAN PASIEN VIA IGD
        // =====================================================

        $this->createForm(
            $igd->id,
            'RM.01.A2',
            'Konsultasi IGD',
            1
        );

        $this->createForm(
            $igd->id,
            'RM01',
            'RM IGD',
            2
        );


        // =====================================================
        // OPEN - INDIKATOR UTAMA
        // =====================================================

        $this->createForm(
            $indikatorUtama->id,
            'RM11',
            'Rencana Pemulangan Pasien',
            1
        );

        $this->createForm(
            $indikatorUtama->id,
            'RM06',
            'Asesmen Medis Rawat Inap',
            2
        );

        $this->createForm(
            $indikatorUtama->id,
            'RM06.1',
            'Pemeriksaan Penderita Lanjutan',
            3
        );

        $this->createForm(
            $indikatorUtama->id,
            'SP15',
            'General Consent',
            4
        );

        $this->createForm(
            $indikatorUtama->id,
            'SP18',
            'Lembar Transfer / Serah Terima Pasien Internal',
            5
        );

        $this->createForm(
            $indikatorUtama->id,
            'SP26',
            'Persetujuan Tindakan Kedokteran',
            6
        );

        $this->createForm(
            $indikatorUtama->id,
            'SP27',
            'Penolakan Tindakan Kedokteran',
            7
        );


        // =====================================================
        // OPEN - KASUS BEDAH
        // =====================================================

        $this->createForm(
            $bedah->id,
            'SP31',
            'Persetujuan Tindakan Anestesi/Sedasi',
            1
        );

        $this->createForm(
            $bedah->id,
            'PENANDA',
            'Form Penanda Lokasi Operasi',
            2
        );


        // =====================================================
        // OPEN - KEBIDANAN / VK
        // =====================================================

        $this->createForm(
            $persalinan->id,
            'RM.08.IMP',
            'Asesmen Awal Kebidanan',
            1
        );

        $this->createForm(
            $persalinan->id,
            'RM.08.IMP',
            'Asesmen Medis Pasien Rawat Inap Obstetri (Kala I Persalinan)',
            2
        );

        $this->createForm(
            $persalinan->id,
            'RM.08.IMP',
            'Asesmen Medis Pasien Rawat Inap Obstetri (Patograf)',
            3
        );

        $this->createForm(
            $persalinan->id,
            'RM.08.IMP',
            'Ringkasan Catatan Persalinan',
            4
        );

        $this->createForm(
            $persalinan->id,
            'RM.08.IMP',
            'Asesmen Medis Rawat Inap Obstetri (Kala I Persalinan Pemeriksaan Sebelum Pulang)',
            5
        );


        // =====================================================
        // CLOSE - UMUM
        // =====================================================

        $this->createForm(
            $indikatorUtama->id,
            'APS',
            'Atas Permintaan Sendiri (APS)',
            20
        );

        $this->createForm(
            $indikatorUtama->id,
            'RM06.A1',
            'Konsultasi Rawat Inap',
            21
        );

        $this->createForm(
            $indikatorUtama->id,
            'RM07',
            'CPPT',
            22
        );

        $this->createForm(
            $indikatorUtama->id,
            'RM10.3',
            'Program dan Pelaksanaan Pemberian Obat',
            23
        );

        $this->createForm(
            $indikatorUtama->id,
            'RM10.4',
            'Pengkajian Gizi',
            24
        );

        $this->createForm(
            $indikatorUtama->id,
            'RM10.5',
            'Rekonsiliasi Obat',
            25
        );

        $this->createForm(
            $indikatorUtama->id,
            'RM12',
            'Assesmen Kebutuhan Informasi dan Edukasi Serta Catatan Edukasi Pasien/Keluarga',
            26
        );

        $this->createForm(
            $indikatorUtama->id,
            'RM12a',
            'Resume Perawatan',
            27
        );

        $this->createForm(
            $indikatorUtama->id,
            'RM13',
            'Ringkasan Akhir Perawatan Inap',
            28
        );

        $this->createForm(
            $indikatorUtama->id,
            'RM13.A',
            'Sebab Kematian',
            29
        );

        $this->createForm(
            $indikatorUtama->id,
            'RM14',
            'Ringkasan Rawat Inap',
            30
        );

        $this->createForm(
            $indikatorUtama->id,
            'SP19',
            'Lembar Transfer Eksternal',
            31
        );

        $this->createForm(
            $indikatorUtama->id,
            'SP21',
            'Serah Terima Jenazah',
            32
        );

        $this->createForm(
            $indikatorUtama->id,
            'SP32',
            'Persetujuan Tindakan Transfusi',
            33
        );

        $this->createForm(
            $indikatorUtama->id,
            'SP34.A',
            'Indikasi Pasien Masuk ICU / ICCU',
            34
        );

        $this->createForm(
            $indikatorUtama->id,
            'SP34.B',
            'Indikasi Pasien Keluar ICU / ICCU',
            35
        );

        $this->createForm(
            $indikatorUtama->id,
            'SP35',
            'Informasi Penundaan Pelayanan',
            36
        );

        $this->createForm(
            $indikatorUtama->id,
            'SP49',
            'Assesmen Awal dan Ulang Nyeri Critical-Care Pain Obersevasion Toll (CPOT)',
            37
        );

        $this->createForm(
            $indikatorUtama->id,
            'SP53',
            'Serah Terima Pasien Kritikal',
            38
        );

        $this->createForm(
            $indikatorUtama->id,
            'SP59',
            'Komunikasi dan Edukasi Harian',
            39
        );

        $this->createForm(
            $indikatorUtama->id,
            'RM17',
            'Laporan Kemoterapi',
            40
        );

        $this->createForm(
            $indikatorUtama->id,
            'RM17.1.01',
            'Asesmen Hemodialisis',
            41
        );

        $this->createForm(
            $indikatorUtama->id,
            'MENINGGAL',
            'Surat Keterangan Meninggal',
            42
        );


        // =====================================================
        // CLOSE - BEDAH
        // =====================================================

        $this->createForm(
            $bedah->id,
            'RM06-L',
            'Laporan Operasi',
            10
        );

        $this->createForm(
            $bedah->id,
            'RM06.J',
            'Asesmen Pra Anastesi/ Konsul Pra Bedah',
            11
        );

        $this->createForm(
            $bedah->id,
            'RM06.K1.B',
            'Penolakan Tindakan Anestesi/Sedasi',
            12
        );

        $this->createForm(
            $bedah->id,
            'RM06.K2',
            'Catatan Anastesi',
            13
        );

        $this->createForm(
            $bedah->id,
            'RM06.K3',
            'Monitoring Ruang Pemulihan',
            14
        );

        $this->createForm(
            $bedah->id,
            'RM06.K5',
            'Rencana Pasca Operasi (Instruksi Post OP) Terintegrasi',
            15
        );

        $this->createForm(
            $bedah->id,
            'RM06.L1',
            'Ceklist Pelayanan Tindakan Operasi',
            16
        );

        $this->createForm(
            $bedah->id,
            'RM06.L2',
            'Dokumen Asuhan Keperawatan Peri Operatif',
            17
        );

        $this->createForm(
            $bedah->id,
            'RM06.L3',
            'Surgical Safety Checklist',
            18
        );


        // =====================================================
        // CLOSE - NEONATUS
        // =====================================================

        $this->createForm(
            $persalinan->id,
            'RM08.IMP.NEON',
            'Assesmen Awal Pasien Rawat Inap Neonatus',
            10
        );

        $this->createForm(
            $persalinan->id,
            'CAIRAN.BAYI',
            'Dokumen Keperawatan Program Terapi dan Kebutuhan Cairan Bayi',
            11
        );


        // =====================================================
        // SELESAI
        // =====================================================

        $this->command->info(
            'Master formulir OPEN dan CLOSE berhasil diperbarui.'
        );
    }


    /**
     * Membuat atau memperbarui formulir.
     */
    private function createForm(
        int $categoryId,
        string $code,
        string $name,
        int $sortOrder
    ): void {

        Form::updateOrCreate(
            [
                'form_category_id' => $categoryId,
                'code' => $code,
                'name' => $name,
            ],
            [
                'sort_order' => $sortOrder,
                'is_active' => true,
            ]
        );
    }
}