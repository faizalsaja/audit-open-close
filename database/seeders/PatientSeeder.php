<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        $patients = [
            [
                'no_rm' => 'DUMMY004',
                'registrasi_id' => 'REG004',
                'nama' => 'SITI AMINAH, NY',
                'jenis_layanan' => 'Rawat Inap',
                'tanggal_masuk' => '2026-09-05',
                'tanggal_pulang' => null,
                'ruang_deskripsi' => 'WIJAYA KUSUMA',
                'diagnosis_id' => 'K35.8',
                'deskripsi_diagnosa' => 'Apendisitis akut',
                'dokter_id' => 'D101',
                'nama_dokter' => 'DOKTER BEDAH, Sp.B',
                'keadaan_pulang' => null,
            ],

            [
                'no_rm' => 'DUMMY005',
                'registrasi_id' => 'REG005',
                'nama' => 'BUDI SANTOSO, TN',
                'jenis_layanan' => 'Rawat Inap',
                'tanggal_masuk' => '2026-09-06',
                'tanggal_pulang' => null,
                'ruang_deskripsi' => 'WIJAYA KUSUMA',
                'diagnosis_id' => 'K40.9',
                'deskripsi_diagnosa' => 'Hernia inguinalis',
                'dokter_id' => 'D102',
                'nama_dokter' => 'DOKTER BEDAH UMUM, Sp.B',
                'keadaan_pulang' => null,
            ],

            [
                'no_rm' => 'DUMMY006',
                'registrasi_id' => 'REG006',
                'nama' => 'DEWI LESTARI, NY',
                'jenis_layanan' => 'Rawat Jalan',
                'tanggal_masuk' => '2026-09-08',
                'tanggal_pulang' => '2026-09-08',
                'ruang_deskripsi' => 'POLIKLINIK',
                'diagnosis_id' => 'I10',
                'deskripsi_diagnosa' => 'Hipertensi esensial',
                'dokter_id' => 'D103',
                'nama_dokter' => 'DOKTER PENYAKIT DALAM, Sp.PD',
                'keadaan_pulang' => 'PULANG HIDUP',
            ],

            [
                'no_rm' => 'DUMMY007',
                'registrasi_id' => 'REG007',
                'nama' => 'AHMAD FAUZI, TN',
                'jenis_layanan' => 'Rawat Jalan',
                'tanggal_masuk' => '2026-09-08',
                'tanggal_pulang' => '2026-09-08',
                'ruang_deskripsi' => 'POLIKLINIK',
                'diagnosis_id' => 'E11.9',
                'deskripsi_diagnosa' => 'Diabetes melitus tipe 2',
                'dokter_id' => 'D104',
                'nama_dokter' => 'DOKTER PENYAKIT DALAM, Sp.PD',
                'keadaan_pulang' => 'PULANG HIDUP',
            ],

            [
                'no_rm' => 'DUMMY008',
                'registrasi_id' => 'REG008',
                'nama' => 'RINA WULANDARI, NY',
                'jenis_layanan' => 'Rawat Inap',
                'tanggal_masuk' => '2026-09-07',
                'tanggal_pulang' => null,
                'ruang_deskripsi' => 'WIJAYA KUSUMA',
                'diagnosis_id' => 'C50.9',
                'deskripsi_diagnosa' => 'Neoplasma ganas payudara',
                'dokter_id' => 'D307',
                'nama_dokter' => 'M. YAMSUN, dr.Spb(K)Onk',
                'keadaan_pulang' => null,
            ],

            [
                'no_rm' => 'DUMMY009',
                'registrasi_id' => 'REG009',
                'nama' => 'NURHAYATI, NY',
                'jenis_layanan' => 'Rawat Inap',
                'tanggal_masuk' => '2026-09-07',
                'tanggal_pulang' => null,
                'ruang_deskripsi' => 'WIJAYA KUSUMA',
                'diagnosis_id' => 'J18.9',
                'deskripsi_diagnosa' => 'Pneumonia',
                'dokter_id' => 'D105',
                'nama_dokter' => 'DOKTER SPESIALIS PARU, Sp.P',
                'keadaan_pulang' => null,
            ],

            [
                'no_rm' => 'DUMMY010',
                'registrasi_id' => 'REG010',
                'nama' => 'AGUS SETIAWAN, TN',
                'jenis_layanan' => 'Rawat Inap',
                'tanggal_masuk' => '2026-09-08',
                'tanggal_pulang' => null,
                'ruang_deskripsi' => 'WIJAYA KUSUMA',
                'diagnosis_id' => 'K40.9',
                'deskripsi_diagnosa' => 'Hernia inguinalis',
                'dokter_id' => 'D102',
                'nama_dokter' => 'DOKTER BEDAH UMUM, Sp.B',
                'keadaan_pulang' => null,
            ],

            [
                'no_rm' => 'DUMMY011',
                'registrasi_id' => 'REG011',
                'nama' => 'LIA ANGGRAENI, NY',
                'jenis_layanan' => 'Persalinan',
                'tanggal_masuk' => '2026-09-09',
                'tanggal_pulang' => null,
                'ruang_deskripsi' => 'VK',
                'diagnosis_id' => 'O80',
                'deskripsi_diagnosa' => 'Persalinan spontan',
                'dokter_id' => 'D106',
                'nama_dokter' => 'DOKTER OBSTETRI DAN GINEKOLOGI, Sp.OG',
                'keadaan_pulang' => null,
            ],

            [
                'no_rm' => 'DUMMY012',
                'registrasi_id' => 'REG012',
                'nama' => 'MAYA SARI, NY',
                'jenis_layanan' => 'Persalinan',
                'tanggal_masuk' => '2026-09-09',
                'tanggal_pulang' => null,
                'ruang_deskripsi' => 'VK',
                'diagnosis_id' => 'O82',
                'deskripsi_diagnosa' => 'Persalinan dengan seksio sesarea',
                'dokter_id' => 'D106',
                'nama_dokter' => 'DOKTER OBSTETRI DAN GINEKOLOGI, Sp.OG',
                'keadaan_pulang' => null,
            ],

            [
                'no_rm' => 'DUMMY013',
                'registrasi_id' => 'REG013',
                'nama' => 'HENDRA WIJAYA, TN',
                'jenis_layanan' => 'Rawat Jalan',
                'tanggal_masuk' => '2026-09-09',
                'tanggal_pulang' => '2026-09-09',
                'ruang_deskripsi' => 'IGD',
                'diagnosis_id' => 'R10.9',
                'deskripsi_diagnosa' => 'Nyeri abdomen',
                'dokter_id' => 'D107',
                'nama_dokter' => 'DOKTER IGD',
                'keadaan_pulang' => 'PULANG HIDUP',
            ],
        ];

        foreach ($patients as $patient) {
            Patient::updateOrCreate(
                [
                    'no_rm' => $patient['no_rm'],
                ],
                $patient
            );
        }
    }
}