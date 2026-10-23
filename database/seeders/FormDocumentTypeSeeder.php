<?php

namespace Database\Seeders;

use App\Models\Form;
use Illuminate\Database\Seeder;

class FormDocumentTypeSeeder extends Seeder
{
    public function run(): void
    {
        $data = [

            // =========================
            // CLOSE
            // =========================

            ['code' => 'APS', 'name' => 'Atas Permintaan Sendiri (APS)', 'type' => 'MANUAL'],

            ['code' => 'CAIRAN.BAYI', 'name' => 'Dokumen Keperawatan Program Terapi dan Kebutuhan Cairan Bayi', 'type' => 'MANUAL'],

            ['code' => 'MENINGGAL', 'name' => 'Surat Keterangan Meninggal', 'type' => 'MANUAL'],

            ['code' => 'RM06-L', 'name' => 'Laporan Operasi', 'type' => 'ELEKTRONIK'],

            ['code' => 'RM06.A1', 'name' => 'Konsultasi Rawat Inap', 'type' => 'ELEKTRONIK'],

            ['code' => 'RM06.J', 'name' => 'Asesmen Pra Anastesi/ Konsul Pra Bedah', 'type' => 'MANUAL'],

            ['code' => 'RM06.K1.B', 'name' => 'Penolakan Tindakan Anestesi/Sedasi', 'type' => 'MANUAL'],

            ['code' => 'RM06.K2', 'name' => 'Catatan Anastesi', 'type' => 'MANUAL'],

            ['code' => 'RM06.K3', 'name' => 'Monitoring Ruang Pemulihan', 'type' => 'MANUAL'],

            ['code' => 'RM06.K5', 'name' => 'Rencana Pasca Operasi (Instruksi Post OP) Terintegrasi', 'type' => 'MANUAL'],

            ['code' => 'RM06.L1', 'name' => 'Ceklist Pelayanan Tindakan Operasi', 'type' => 'MANUAL'],

            ['code' => 'RM06.L2', 'name' => 'Dokumen Asuhan Keperawatan Peri Operatif', 'type' => 'MANUAL'],

            ['code' => 'RM06.L3', 'name' => 'Surgical Safety Checklist', 'type' => 'MANUAL'],

            ['code' => 'RM07', 'name' => 'CPPT', 'type' => 'ELEKTRONIK'],

            ['code' => 'RM08.IMP.NEON', 'name' => 'Assesmen Awal Pasien Rawat Inap Neonatus', 'type' => 'MANUAL'],

            ['code' => 'RM10.3', 'name' => 'Program dan Pelaksanaan Pemberian Obat', 'type' => 'MANUAL'],

            ['code' => 'RM10.4', 'name' => 'Pengkajian Gizi', 'type' => 'ELEKTRONIK'],

            ['code' => 'RM10.5', 'name' => 'Rekonsiliasi Obat', 'type' => 'MANUAL'],

            ['code' => 'RM11', 'name' => 'Rencana Pemulangan Pasien', 'type' => 'ELEKTRONIK'],

            ['code' => 'RM12', 'name' => 'Assesmen Kebutuhan Informasi dan Edukasi Serta Catatan Edukasi Pasien/Keluarga', 'type' => 'MANUAL'],

            ['code' => 'RM12a', 'name' => 'Resume Perawatan', 'type' => 'MANUAL'],

            ['code' => 'RM13', 'name' => 'Ringkasan Akhir Perawatan Inap', 'type' => 'ELEKTRONIK'],

            ['code' => 'RM13.A', 'name' => 'Sebab Kematian', 'type' => 'MANUAL'],

            ['code' => 'RM14', 'name' => 'Ringkasan Rawat Inap', 'type' => 'ELEKTRONIK'],

            ['code' => 'RM17', 'name' => 'Laporan Kemoterapi', 'type' => 'ELEKTRONIK'],

            ['code' => 'RM17.1.01', 'name' => 'Asesmen Hemodialisis', 'type' => 'ELEKTRONIK'],

            ['code' => 'SP35', 'name' => 'Informasi Penundaan Pelayanan', 'type' => 'MANUAL'],

            ['code' => 'SP19', 'name' => 'Lembar Transfer Eksternal', 'type' => 'MANUAL'],

            ['code' => 'SP21', 'name' => 'Serah Terima Jenazah', 'type' => 'MANUAL'],

            ['code' => 'SP31', 'name' => 'Persetujuan Tindakan Anestesi/Sedasi', 'type' => 'MANUAL'],

            ['code' => 'SP32', 'name' => 'Persetujuan Tindakan Transfusi', 'type' => 'MANUAL'],

            ['code' => 'SP34.A', 'name' => 'Indikasi Pasien Masuk ICU / ICCU', 'type' => 'MANUAL'],

            ['code' => 'SP34.B', 'name' => 'Indikasi Pasien Keluar ICU / ICCU', 'type' => 'MANUAL'],

            ['code' => 'SP49', 'name' => 'Assesmen Awal dan Ulang Nyeri Critical-Care Pain Obersevasion Toll (CPOT)', 'type' => 'MANUAL'],

            ['code' => 'SP53', 'name' => 'Serah Terima Pasien Kritikal', 'type' => 'MANUAL'],

            ['code' => 'SP59', 'name' => 'Komunikasi dan Edukasi Harian', 'type' => 'MANUAL'],

            // =========================
            // OPEN
            // =========================

            ['code' => 'PENANDA', 'name' => 'Form Penanda Lokasi Operasi', 'type' => 'MANUAL'],

            ['code' => 'RM.01.A2', 'name' => 'Konsultasi IGD', 'type' => 'ELEKTRONIK'],

            ['code' => 'RM01', 'name' => 'RM IGD', 'type' => 'ELEKTRONIK'],

            ['code' => 'RM02', 'name' => 'Assesmen Rawat Jalan', 'type' => 'ELEKTRONIK'],

            ['code' => 'RM03', 'name' => 'Konsultasi', 'type' => 'MANUAL'],

            ['code' => 'RM06', 'name' => 'Assesmen Medis Rawat Inap', 'type' => 'ELEKTRONIK'],

            ['code' => 'RM06.1', 'name' => 'Pemeriksaan Penderita Lanjutan', 'type' => 'ELEKTRONIK'],

            ['code' => 'SP15', 'name' => 'General Consent', 'type' => 'MANUAL'],

            ['code' => 'SP18', 'name' => 'Lembar Transfer / Serah Terima Pasien Internal', 'type' => 'MANUAL'],

            ['code' => 'SP26', 'name' => 'Persetujuan Tindakan Kedokteran', 'type' => 'MANUAL'],

            ['code' => 'SP27', 'name' => 'Penolakan Tindakan Kedokteran', 'type' => 'MANUAL'],
        ];

        foreach ($data as $item) {
            Form::where('code', $item['code'])
                ->where('name', $item['name'])
                ->update([
                    'keterangan_dokumen' => $item['type'],
                ]);
        }
    }
}