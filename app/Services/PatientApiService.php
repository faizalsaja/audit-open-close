<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PatientApiService
{
    /*
    |--------------------------------------------------------------------------
    | BASE URL API
    |--------------------------------------------------------------------------
    |
    | API proxy untuk mengambil data pasien berdasarkan No Registrasi.
    |
    */

    protected string $baseUrl;

    /*
    |--------------------------------------------------------------------------
    | DATA DUMMY
    |--------------------------------------------------------------------------
    |
    | Struktur dibuat mengikuti response API RS.
    |
    | CATATAN:
    | SMF TIDAK ditulis di sini.
    | SMF diambil otomatis dari:
    |
    | DokterId
    |    ↓
    | doctors.kode_dokter
    |    ↓
    | doctors.bagian
    |
    */

    protected array $dummyPatients = [

        /*
        |--------------------------------------------------------------------------
        | 1. PASIEN - IGD
        |--------------------------------------------------------------------------
        */

        '1012310002' => [
            'NoRm' => '00833225',
            'RegistrasiId' => '1012310002',
            'Nama' => 'IMAM SUPARDI TN',
            'JenisLayanan' => 'Rawat Jalan',
            'TanggalMasuk' => '31-12-2010',
            'TanggalPulang' => null,
            'RuangDeskripsi' => 'IGD',
            'DiagnosisId' => null,
            'DeskripsiDiagnosa' => null,

            'DokterId' => 'D086',
            'NamaDokter' => 'ABDILLAH Dr.',

            'KeadaanPulang' => null,
        ],

        /*
        |--------------------------------------------------------------------------
        | 2. PASIEN - WIJAYA KUSUMA
        |--------------------------------------------------------------------------
        |
        | D307 sudah diverifikasi:
        | M. YAMSUN, dr.SpB(K)Onk
        | BAGIAN: BEDAH ONKOLOGI
        |
        */

        '1012310003' => [
            'NoRm' => ' ',
            'RegistrasiId' => '1012310003',
            'Nama' => 'SITI AMINAH, NY',
            'JenisLayanan' => 'Rawat Inap',
            'TanggalMasuk' => '10-09-2026',
            'TanggalPulang' => null,
            'RuangDeskripsi' => 'WIJAYA KUSUMA',
            'DiagnosisId' => 'C50.9',
            'DeskripsiDiagnosa' => 'Neoplasma ganas payudara',

            'DokterId' => 'D307',
            'NamaDokter' => 'M. YAMSUN, dr.SpB(K)Onk',

            'KeadaanPulang' => null,
        ],

        /*
        |--------------------------------------------------------------------------
        | 3. PASIEN - SERUNI
        |--------------------------------------------------------------------------
        */

        '1012310004' => [
            'NoRm' => '00833227',
            'RegistrasiId' => '1012310004',
            'Nama' => 'BUDI SANTOSO TN',
            'JenisLayanan' => 'Rawat Inap',
            'TanggalMasuk' => '11-09-2026',
            'TanggalPulang' => null,
            'RuangDeskripsi' => 'SERUNI',
            'DiagnosisId' => 'J18.9',
            'DeskripsiDiagnosa' => 'Pneumonia, tidak spesifik',

            'DokterId' => 'D238',
            'NamaDokter' => 'SURYO PERMADI, Dr.Sp.P',

            'KeadaanPulang' => null,
        ],

        /*
        |--------------------------------------------------------------------------
        | 4. PASIEN - KENANGA
        |--------------------------------------------------------------------------
        */

        '1012310005' => [
            'NoRm' => '00833228',
            'RegistrasiId' => '1012310005',
            'Nama' => 'DEWI LESTARI, NY',
            'JenisLayanan' => 'Rawat Inap',
            'TanggalMasuk' => '12-09-2026',
            'TanggalPulang' => null,
            'RuangDeskripsi' => 'KENANGA',
            'DiagnosisId' => 'I10',
            'DeskripsiDiagnosa' => 'Hipertensi esensial (primer)',

            'DokterId' => 'D218',
            'NamaDokter' => 'HEPPY OKTAVIANTO,Dr,M.Sc,SpPD',

            'KeadaanPulang' => null,
        ],

        /*
        |--------------------------------------------------------------------------
        | 5. PASIEN - TERATAI
        |--------------------------------------------------------------------------
        */

        '1012310006' => [
            'NoRm' => '00833229',
            'RegistrasiId' => '1012310006',
            'Nama' => 'AGUS PRAYOGA TN',
            'JenisLayanan' => 'Rawat Inap',
            'TanggalMasuk' => '13-09-2026',
            'TanggalPulang' => null,
            'RuangDeskripsi' => 'TERATAI',
            'DiagnosisId' => 'K35.8',
            'DeskripsiDiagnosa' => 'Apendisitis akut lainnya',

            'DokterId' => 'D320',
            'NamaDokter' => 'SYAMSUL ANAM, dr.SpB',

            'KeadaanPulang' => null,
        ],

        /*
        |--------------------------------------------------------------------------
        | 6. PASIEN - MAWAR
        |--------------------------------------------------------------------------
        */

        '1012310007' => [
            'NoRm' => '00833230',
            'RegistrasiId' => '1012310007',
            'Nama' => 'RINA ANGGRAENI, NY',
            'JenisLayanan' => 'Rawat Inap',
            'TanggalMasuk' => '14-09-2026',
            'TanggalPulang' => null,
            'RuangDeskripsi' => 'MAWAR',
            'DiagnosisId' => 'O80',
            'DeskripsiDiagnosa' => 'Persalinan spontan',

            'DokterId' => 'D215',
            'NamaDokter' => 'ANGGITA VETERINA, Dr.SpOG',

            'KeadaanPulang' => null,
        ],

        /*
        |--------------------------------------------------------------------------
        | 7. PASIEN - DAHLIA
        |--------------------------------------------------------------------------
        */

        '1012310008' => [
            'NoRm' => '00833231',
            'RegistrasiId' => '1012310008',
            'Nama' => 'FADLI RAMADHAN TN',
            'JenisLayanan' => 'Rawat Inap',
            'TanggalMasuk' => '15-09-2026',
            'TanggalPulang' => null,
            'RuangDeskripsi' => 'DAHLIA',
            'DiagnosisId' => 'S72.0',
            'DeskripsiDiagnosa' => 'Fraktur leher femur',

            'DokterId' => 'D193',
            'NamaDokter' => 'ARIS HANDOKO, Dr, Sp.OT',

            'KeadaanPulang' => null,
        ],

        /*
        |--------------------------------------------------------------------------
        | 8. PASIEN - CENDANA
        |--------------------------------------------------------------------------
        */

        '1012310009' => [
            'NoRm' => '00833232',
            'RegistrasiId' => '1012310009',
            'Nama' => 'MAYA SARI, NY',
            'JenisLayanan' => 'Rawat Inap',
            'TanggalMasuk' => '16-09-2026',
            'TanggalPulang' => null,
            'RuangDeskripsi' => 'CENDANA',
            'DiagnosisId' => 'E11.9',
            'DeskripsiDiagnosa' => 'Diabetes melitus tipe 2 tanpa komplikasi',

            'DokterId' => 'D346',
            'NamaDokter' => 'GEDE PERDANA P, dr.SPPD,MBiomed',

            'KeadaanPulang' => null,
        ],

        /*
        |--------------------------------------------------------------------------
        | 9. PASIEN - FLAMBOYAN
        |--------------------------------------------------------------------------
        |
        | D192 sudah diverifikasi:
        | TRI BUDIYANTO, DR, SpU.
        | BAGIAN: BEDAH UROLOGI
        |
        */

        '1012310010' => [
            'NoRm' => '00833233',
            'RegistrasiId' => '1012310010',
            'Nama' => 'YANTO SETIAWAN TN',
            'JenisLayanan' => 'Rawat Inap',
            'TanggalMasuk' => '17-09-2026',
            'TanggalPulang' => null,
            'RuangDeskripsi' => 'FLAMBOYAN',
            'DiagnosisId' => 'N20.0',
            'DeskripsiDiagnosa' => 'Batu ginjal',

            'DokterId' => 'D192',
            'NamaDokter' => 'TRI BUDIYANTO, DR, SpU.',

            'KeadaanPulang' => null,
        ],

        /*
        |--------------------------------------------------------------------------
        | 10. PASIEN - MELATI
        |--------------------------------------------------------------------------
        */

        '1012310011' => [
            'NoRm' => '00833234',
            'RegistrasiId' => '1012310011',
            'Nama' => 'NURUL HIDAYATI, NY',
            'JenisLayanan' => 'Rawat Inap',
            'TanggalMasuk' => '18-09-2026',
            'TanggalPulang' => null,
            'RuangDeskripsi' => 'MELATI',
            'DiagnosisId' => 'J44.9',
            'DeskripsiDiagnosa' => 'Penyakit paru obstruktif kronik',

            'DokterId' => 'D321',
            'NamaDokter' => 'TEGUH BUDI SANTOSA, dr.Sp.P',

            'KeadaanPulang' => null,
        ],

        /*
        |--------------------------------------------------------------------------
        | 11. PASIEN - WIJAYA KUSUMA
        |--------------------------------------------------------------------------
        */

        '1012310012' => [
            'NoRm' => '00833235',
            'RegistrasiId' => '1012310012',
            'Nama' => 'ANDI SETIAWAN TN',
            'JenisLayanan' => 'Rawat Inap',
            'TanggalMasuk' => '19-09-2026',
            'TanggalPulang' => null,
            'RuangDeskripsi' => 'WIJAYA KUSUMA',
            'DiagnosisId' => 'K40.9',
            'DeskripsiDiagnosa' => 'Hernia inguinalis',

            'DokterId' => 'D307',
            'NamaDokter' => 'M. YAMSUN, dr.SpB(K)Onk',

            'KeadaanPulang' => null,
        ],

        /*
        |--------------------------------------------------------------------------
        | 12. PASIEN - SERUNI
        |--------------------------------------------------------------------------
        */

        '1012310013' => [
            'NoRm' => '00833236',
            'RegistrasiId' => '1012310013',
            'Nama' => 'SRI WAHYUNI, NY',
            'JenisLayanan' => 'Rawat Inap',
            'TanggalMasuk' => '20-09-2026',
            'TanggalPulang' => null,
            'RuangDeskripsi' => 'SERUNI',
            'DiagnosisId' => 'I50.9',
            'DeskripsiDiagnosa' => 'Gagal jantung, tidak spesifik',

            'DokterId' => 'D218',
            'NamaDokter' => 'HEPPY OKTAVIANTO,Dr,M.Sc,SpPD',

            'KeadaanPulang' => null,
        ],

        /*
        |--------------------------------------------------------------------------
        | 13. PASIEN - KENANGA
        |--------------------------------------------------------------------------
        */

        '1012310014' => [
            'NoRm' => '00833237',
            'RegistrasiId' => '1012310014',
            'Nama' => 'RUDI HARTONO TN',
            'JenisLayanan' => 'Rawat Inap',
            'TanggalMasuk' => '21-09-2026',
            'TanggalPulang' => null,
            'RuangDeskripsi' => 'KENANGA',
            'DiagnosisId' => 'A09',
            'DeskripsiDiagnosa' => 'Gastroenteritis dan kolitis',

            'DokterId' => 'D192',
            'NamaDokter' => 'TRI BUDIYANTO, DR, SpU.',

            'KeadaanPulang' => null,
        ],

        /*
        |--------------------------------------------------------------------------
        | 14. PASIEN - TERATAI
        |--------------------------------------------------------------------------
        */

        '1012310015' => [
            'NoRm' => '00833238',
            'RegistrasiId' => '1012310015',
            'Nama' => 'FITRI HANDAYANI, NY',
            'JenisLayanan' => 'Rawat Inap',
            'TanggalMasuk' => '22-09-2026',
            'TanggalPulang' => null,
            'RuangDeskripsi' => 'TERATAI',
            'DiagnosisId' => 'O34.2',
            'DeskripsiDiagnosa' => 'Perawatan ibu karena parut rahim',

            'DokterId' => 'D215',
            'NamaDokter' => 'ANGGITA VETERINA, Dr.SpOG',

            'KeadaanPulang' => null,
        ],

        /*
        |--------------------------------------------------------------------------
        | 15. PASIEN - MAWAR
        |--------------------------------------------------------------------------
        */

        '1012310016' => [
            'NoRm' => '00833239',
            'RegistrasiId' => '1012310016',
            'Nama' => 'LINA MARIA, NY',
            'JenisLayanan' => 'Rawat Inap',
            'TanggalMasuk' => '23-09-2026',
            'TanggalPulang' => null,
            'RuangDeskripsi' => 'MAWAR',
            'DiagnosisId' => 'O80',
            'DeskripsiDiagnosa' => 'Persalinan spontan',

            'DokterId' => 'D215',
            'NamaDokter' => 'ANGGITA VETERINA, Dr.SpOG',

            'KeadaanPulang' => null,
        ],

        /*
        |--------------------------------------------------------------------------
        | 16. PASIEN - DAHLIA
        |--------------------------------------------------------------------------
        */

        '1012310017' => [
            'NoRm' => '00833240',
            'RegistrasiId' => '1012310017',
            'Nama' => 'BAMBANG IRAWAN TN',
            'JenisLayanan' => 'Rawat Inap',
            'TanggalMasuk' => '23-09-2026',
            'TanggalPulang' => null,
            'RuangDeskripsi' => 'DAHLIA',
            'DiagnosisId' => 'M16.1',
            'DeskripsiDiagnosa' => 'Coxarthrosis primer bilateral',

            'DokterId' => 'D193',
            'NamaDokter' => 'ARIS HANDOKO, Dr, Sp.OT',

            'KeadaanPulang' => null,
        ],

        /*
        |--------------------------------------------------------------------------
        | 17. PASIEN - CENDANA
        |--------------------------------------------------------------------------
        */

        '1012310018' => [
            'NoRm' => '00833241',
            'RegistrasiId' => '1012310018',
            'Nama' => 'HARIYANTO TN',
            'JenisLayanan' => 'Rawat Inap',
            'TanggalMasuk' => '24-09-2026',
            'TanggalPulang' => null,
            'RuangDeskripsi' => 'CENDANA',
            'DiagnosisId' => 'E11.9',
            'DeskripsiDiagnosa' => 'Diabetes melitus tipe 2 tanpa komplikasi',

            'DokterId' => 'D346',
            'NamaDokter' => 'GEDE PERDANA P, dr.SPPD,MBiomed',

            'KeadaanPulang' => null,
        ],

        /*
        |--------------------------------------------------------------------------
        | 18. PASIEN - FLAMBOYAN
        |--------------------------------------------------------------------------
        */

        '1012310019' => [
            'NoRm' => '00833242',
            'RegistrasiId' => '1012310019',
            'Nama' => 'EDI SUSANTO TN',
            'JenisLayanan' => 'Rawat Inap',
            'TanggalMasuk' => '24-09-2026',
            'TanggalPulang' => null,
            'RuangDeskripsi' => 'FLAMBOYAN',
            'DiagnosisId' => 'N20.0',
            'DeskripsiDiagnosa' => 'Batu ginjal',

            'DokterId' => 'D192',
            'NamaDokter' => 'TRI BUDIYANTO, DR, SpU.',

            'KeadaanPulang' => null,
        ],

        /*
        |--------------------------------------------------------------------------
        | 19. PASIEN - IGD
        |--------------------------------------------------------------------------
        */

        '1012310020' => [
            'NoRm' => '00833243',
            'RegistrasiId' => '1012310020',
            'Nama' => 'FIRMAN MAULANA TN',
            'JenisLayanan' => 'Rawat Jalan',
            'TanggalMasuk' => '24-09-2026',
            'TanggalPulang' => null,
            'RuangDeskripsi' => 'IGD',
            'DiagnosisId' => 'R10.9',
            'DeskripsiDiagnosa' => 'Nyeri abdomen, tidak spesifik',

            'DokterId' => 'D086',
            'NamaDokter' => 'ABDILLAH Dr.',

            'KeadaanPulang' => null,
        ],

        /*
        |--------------------------------------------------------------------------
        | 20. PASIEN - NEONATUS
        |--------------------------------------------------------------------------
        */

        '1012310021' => [
            'NoRm' => '00833244',
            'RegistrasiId' => '1012310021',
            'Nama' => 'BAYI NY. RINA',
            'JenisLayanan' => 'Rawat Inap',
            'TanggalMasuk' => '24-09-2026',
            'TanggalPulang' => null,
            'RuangDeskripsi' => 'WIJAYA KUSUMA',
            'DiagnosisId' => 'P07.9',
            'DeskripsiDiagnosa' => 'Gangguan terkait masa neonatus, tidak spesifik',

            'DokterId' => 'D215',
            'NamaDokter' => 'ANGGITA VETERINA, Dr.SpOG',

            'KeadaanPulang' => null,
        ],
    ];

    /*
    |--------------------------------------------------------------------------
    | CONSTRUCTOR
    |--------------------------------------------------------------------------
    */

public function __construct()
{
    $this->baseUrl = rtrim(
        env('API_BASE_URL', ''),
        '/'
    );
}

    /*
    |--------------------------------------------------------------------------
    | GET PATIENT BY REGISTRATION
    |--------------------------------------------------------------------------
    */

public function getPatientByRegistration(string $noreg): ?array
{
    try {

        $url = $this->baseUrl . '/reg/' . urlencode($noreg);

        $response = Http::timeout(10)
            ->withoutVerifying()
            ->withToken(env('API_BEARER_TOKEN'))
            ->acceptJson()
            ->get($url);

        \Log::info('PATIENT API', [
            'url' => $url,
            'status' => $response->status(),
            'response' => $response->json(),
        ]);

   if ($response->successful()) {
    $data = $response->json();

    if (
        isset($data['result']) &&
        is_array($data['result']) &&
        !empty($data['result'])
    ) {
        $result = $data['result'];

        // Samakan nama field API dengan field aplikasi
        $result['DeskripsiDiagnosa'] =
            $result['DeskripsiDiagnosis'] ?? null;

        return $result;
    }
}

    } catch (\Throwable $e) {

        \Log::error('PATIENT API ERROR', [
            'message' => $e->getMessage(),
        ]);
    }

    return null;
}
}