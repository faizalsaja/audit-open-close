<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Hasil Pencarian Pasien - Audit Rekam Medis</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background: #eef3f7;
            font-family: Arial, Helvetica, sans-serif;
            color: #17324d;
            font-size: 14px;
        }

        /* =========================================================
           HEADER
        ========================================================= */

        .header {
            background: #0f4f86;
            color: white;
            padding: 14px 20px;
            border-bottom: 4px solid #d8e7f2;
        }

        .header-title {
            font-size: 24px;
            font-weight: bold;
            letter-spacing: .3px;
        }

        .header-subtitle {
            margin-top: 4px;
            font-size: 13px;
        }

        /* =========================================================
           CONTAINER
        ========================================================= */

        .container {
            width: 96%;
            max-width: 1400px;
            margin: 18px auto;
        }

        /* =========================================================
           PANEL
        ========================================================= */

        .panel {
            background: #ffffff;
            border: 1px solid #cbd9e3;
            border-radius: 5px;
            margin-bottom: 15px;
            box-shadow: 0 1px 3px rgba(0,0,0,.06);
            overflow: hidden;
        }

        .panel-title {
            background: #e7f3fb;
            border-bottom: 1px solid #c7dbe9;
            padding: 11px 14px;
            font-size: 15px;
            font-weight: bold;
            color: #154d78;
        }

        .panel-body {
            padding: 18px;
        }

        /* =========================================================
           STATUS
        ========================================================= */

        .status {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: #f0f8ff;
            border: 1px solid #c7dce9;
            border-radius: 4px;
            padding: 7px 11px;
            margin-bottom: 15px;
            color: #14527e;
            font-weight: bold;
        }

        .status-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #35c98a;
            display: inline-block;
        }

        /* =========================================================
           DATA PASIEN
        ========================================================= */

        .patient-grid {
            display: grid;
            grid-template-columns: 180px 1fr 180px 1fr;
            border: 1px solid #d5e0e7;
        }

        .patient-label {
            background: #f2f6f9;
            border-right: 1px solid #d5e0e7;
            border-bottom: 1px solid #d5e0e7;
            padding: 10px 12px;
            font-weight: bold;
            color: #31526c;
        }

        .patient-value {
            padding: 10px 12px;
            border-bottom: 1px solid #d5e0e7;
            color: #183d58;
            background: #fff;
        }

        /* =========================================================
           FORM
        ========================================================= */

        .form-section {
            margin-top: 20px;
            max-width: 600px;
        }

        .form-group {
            margin-bottom: 17px;
        }

        .form-label {
            display: block;
            font-weight: bold;
            color: #31526c;
            margin-bottom: 7px;
        }

        select {
            width: 100%;
            height: 40px;
            border: 1px solid #b9cad6;
            border-radius: 4px;
            background: #fff;
            padding: 0 10px;
            color: #17324d;
            font-size: 14px;
            outline: none;
        }

        select:focus {
            border-color: #2d79ad;
            box-shadow: 0 0 0 2px rgba(45,121,173,.12);
        }

        .case-preview {
            margin-top: 8px;
            padding: 9px 11px;
            background: #f5f9fc;
            border: 1px solid #d5e2ea;
            border-radius: 4px;
            color: #4b6476;
        }

        .case-preview strong {
            color: #174f78;
        }

        /* =========================================================
           BUTTON
        ========================================================= */

        .actions {
            display: flex;
            gap: 8px;
            margin-top: 20px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 38px;
            padding: 8px 16px;
            border-radius: 4px;
            border: 1px solid transparent;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-primary {
            background: #2f80b7;
            border-color: #286f9f;
            color: white;
        }

        .btn-primary:hover {
            background: #256e9f;
        }

        .btn-secondary {
            background: #f5f7f9;
            border-color: #b9c8d3;
            color: #31526c;
        }

        .btn-secondary:hover {
            background: #e9eef2;
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 900px) {

            .patient-grid {
                grid-template-columns: 140px 1fr;
            }

            .patient-grid .right-label,
            .patient-grid .right-value {
                display: none;
            }

            .container {
                width: 94%;
            }
        }

        @media (max-width: 600px) {

            .header-title {
                font-size: 19px;
            }

            .patient-grid {
                grid-template-columns: 1fr;
            }

            .patient-label {
                border-right: none;
                border-bottom: none;
                padding-bottom: 4px;
            }

            .patient-value {
                padding-top: 4px;
            }

            .actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    {{-- =========================================================
         HEADER
    ========================================================= --}}

    <div class="header">

        <div class="header-title">
            AUDIT DOKUMEN REKAM MEDIS
        </div>

        <div class="header-subtitle">
            RSUD Prof. Dr. Margono Soekarjo Purwokerto
        </div>

    </div>


    <div class="container">

        {{-- =====================================================
             STATUS
        ====================================================== --}}

        <div class="status">
            <span class="status-dot"></span>
            HASIL PENCARIAN PASIEN
        </div>


        {{-- =====================================================
             DATA PASIEN
        ====================================================== --}}

        <div class="panel">

            <div class="panel-title">
                DATA PASIEN
            </div>

            <div class="panel-body">

                <div class="patient-grid">

                    {{-- NO REG --}}
                    <div class="patient-label">
                        No Registrasi
                    </div>

                    <div class="patient-value">
                        {{ $patient['RegistrasiId'] ?? '-' }}
                    </div>


                    {{-- NO RM --}}
                    <div class="patient-label right-label">
                        No RM
                    </div>

                    <div class="patient-value right-value">
                        {{ $patient['NoRm'] ?? '-' }}
                    </div>


                    {{-- NAMA --}}
                    <div class="patient-label">
                        Nama
                    </div>

                    <div class="patient-value">
                        {{ $patient['Nama'] ?? '-' }}
                    </div>


                    {{-- JENIS LAYANAN --}}
                    <div class="patient-label right-label">
                        Jenis Layanan
                    </div>

                    <div class="patient-value right-value">
                        {{ $patient['JenisLayanan'] ?? '-' }}
                    </div>


                    {{-- RUANGAN --}}
                    <div class="patient-label">
                        Ruangan
                    </div>

                    <div class="patient-value">
                        {{ $patient['RuangDeskripsi'] ?? '-' }}
                    </div>


                    {{-- DOKTER --}}
                    <div class="patient-label right-label">
                        DPJP
                    </div>

                    <div class="patient-value right-value">
                        {{ $patient['NamaDokter'] ?? '-' }}
                    </div>


                    {{-- DIAGNOSIS --}}
                    <div class="patient-label">
                        Diagnosis
                    </div>

                    <div class="patient-value">
                        @if(!empty($patient['DiagnosisId']))
                            <strong>{{ $patient['DiagnosisId'] }}</strong>
                            -
                        @endif

                        {{ $patient['DeskripsiDiagnosa'] ?? '-' }}
                    </div>


                    {{-- TANGGAL MASUK --}}
                    <div class="patient-label right-label">
                        Tanggal Masuk
                    </div>

                    <div class="patient-value right-value">
                        {{ $patient['TanggalMasuk'] ?? '-' }}
                    </div>

                </div>


                {{-- =================================================
                     PILIH KASUS
                ================================================== --}}

                <div class="form-section">

                    <div class="form-group">

                        <label
                            for="case_type"
                            class="form-label"
                        >
                            Kasus Pasien
                        </label>

                        <form
                            method="POST"
                            action="{{ route('audits.patient.use') }}"
                        >

                            @csrf

                            {{-- DATA PASIEN --}}
                            <input
                                type="hidden"
                                name="no_rm"
                                value="{{ $patient['NoRm'] ?? '' }}"
                            >

                            <input
                                type="hidden"
                                name="registrasi_id"
                                value="{{ $patient['RegistrasiId'] ?? '' }}"
                            >

                            <input
                                type="hidden"
                                name="nama"
                                value="{{ $patient['Nama'] ?? '' }}"
                            >

                            <input
                                type="hidden"
                                name="jenis_layanan"
                                value="{{ $patient['JenisLayanan'] ?? '' }}"
                            >

                            <input
                                type="hidden"
                                name="tanggal_masuk"
                                value="{{ $patient['TanggalMasuk'] ?? '' }}"
                            >

                            <input
                                type="hidden"
                                name="tanggal_pulang"
                                value="{{ $patient['TanggalPulang'] ?? '' }}"
                            >

                            <input
                                type="hidden"
                                name="ruang_deskripsi"
                                value="{{ $patient['RuangDeskripsi'] ?? '' }}"
                            >

                            <input
                                type="hidden"
                                name="diagnosis_id"
                                value="{{ $patient['DiagnosisId'] ?? '' }}"
                            >

                            <input
                                type="hidden"
                                name="deskripsi_diagnosa"
                                value="{{ $patient['DeskripsiDiagnosa'] ?? '' }}"
                            >

                            <input
                                type="hidden"
                                name="dokter_id"
                                value="{{ $patient['DokterId'] ?? '' }}"
                            >

                            <input
                                type="hidden"
                                name="nama_dokter"
                                value="{{ $patient['NamaDokter'] ?? '' }}"
                            >

                            <input
                                type="hidden"
                                name="keadaan_pulang"
                                value="{{ $patient['KeadaanPulang'] ?? '' }}"
                            >


                            {{-- PILIH KASUS --}}
                            <select
                                name="case_type"
                                id="case_type"
                                required
                                onchange="updateCasePreview()"
                            >

                                <option value="">
                                    -- Pilih Kasus --
                                </option>

                                <option value="NON-BEDAH">
                                    NON-BEDAH
                                </option>

                                <option value="BEDAH">
                                    BEDAH
                                </option>

                                <option value="ANAK">
                                    ANAK
                                </option>

                                <option value="KEBIDANAN">
                                    KEBIDANAN
                                </option>

                                <option value="NEONATUS">
                                    NEONATUS
                                </option>

                            </select>


                            <div
                                class="case-preview"
                                id="casePreview"
                            >
                                <strong>Jenis Kasus:</strong>
                                <span id="caseText">-</span>
                            </div>


                            {{-- BUTTON --}}
                            <div class="actions">

                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                >
                                    ✓ Gunakan Pasien untuk Audit
                                </button>

                                <button
                                    type="button"
                                    class="btn btn-secondary"
                                    onclick="history.back()"
                                >
                                    ← Kembali
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <script>

        function updateCasePreview() {

            const select =
                document.getElementById('case_type');

            const text =
                document.getElementById('caseText');

            if (select.value === '') {

                text.textContent = '-';

            } else {

                text.textContent = select.value;

            }
        }

    </script>

</body>
</html>