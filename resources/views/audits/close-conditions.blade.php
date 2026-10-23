<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Audit Close - Audit Dokumen Rekam Medis</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #eef3f7;
            font-family: Arial, Helvetica, sans-serif;
            color: #17324d;
            font-size: 14px;
        }

        /* =====================================================
           HEADER
        ===================================================== */

        .header {
            background: #0f4f86;
            color: white;
            padding: 14px 20px;
            border-bottom: 4px solid #d7e6f0;
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

        /* =====================================================
           CONTAINER
        ===================================================== */

        .container {
            width: 96%;
            max-width: 1250px;
            margin: 18px auto;
        }

        /* =====================================================
           STATUS
        ===================================================== */

        .status {
            display: flex;
            align-items: center;
            gap: 8px;

            background: #ffffff;
            border: 1px solid #ccdbe5;
            border-radius: 5px;

            padding: 10px 14px;
            margin-bottom: 12px;

            color: #164f79;
            font-weight: bold;
        }

        .status-dot {
            width: 11px;
            height: 11px;
            border-radius: 50%;
            background: #e74c5b;
            display: inline-block;
        }

        /* =====================================================
           PANEL
        ===================================================== */

        .panel {
            background: white;
            border: 1px solid #c9d9e3;
            border-radius: 5px;
            margin-bottom: 14px;
            box-shadow: 0 1px 3px rgba(0,0,0,.06);
            overflow: hidden;
        }

        .panel-title {
            background: #e4f2fb;
            border-bottom: 1px solid #c7dbe8;
            padding: 11px 14px;

            font-size: 16px;
            font-weight: bold;
            color: #174f78;
        }

        .panel-body {
            padding: 15px;
        }

        /* =====================================================
           DATA PASIEN
        ===================================================== */

        .patient-grid {
            display: grid;
            grid-template-columns: 170px 1fr 170px 1fr;

            border-top: 1px solid #d8e2e8;
            border-left: 1px solid #d8e2e8;
        }

        .data-label {
            background: #f1f6f9;
            padding: 10px 12px;

            font-weight: bold;
            color: #31526c;

            border-right: 1px solid #d8e2e8;
            border-bottom: 1px solid #d8e2e8;
        }

        .data-value {
            background: #fff;
            padding: 10px 12px;

            color: #183d58;

            border-right: 1px solid #d8e2e8;
            border-bottom: 1px solid #d8e2e8;
        }

        /* =====================================================
           FORM CLOSE
        ===================================================== */

        .close-form {
            margin-top: 18px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 180px 1fr;
            align-items: center;

            border: 1px solid #d5e0e7;
            border-bottom: none;
        }

        .form-row:last-child {
            border-bottom: 1px solid #d5e0e7;
        }

        .form-label {
            background: #f1f6f9;
            padding: 10px 12px;

            font-weight: bold;
            color: #31526c;

            border-right: 1px solid #d5e0e7;
        }

        .form-control-area {
            padding: 8px 10px;
            background: white;
        }

        input[type="date"],
        select {
            width: 100%;
            max-width: 320px;

            height: 38px;

            border: 1px solid #b8cad6;
            border-radius: 4px;

            padding: 6px 10px;

            background: white;
            color: #17324d;
            font-size: 14px;
        }

        input[type="date"]:focus,
        select:focus {
            outline: none;
            border-color: #2d79ad;
            box-shadow: 0 0 0 2px rgba(45,121,173,.12);
        }

        /* =====================================================
           KONDISI PASIEN
        ===================================================== */

        .condition-title {
            margin-top: 22px;
            margin-bottom: 10px;

            font-size: 15px;
            font-weight: bold;

            color: #174f78;
        }

        .condition-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .condition-item {
            display: flex;
            align-items: center;
            justify-content: space-between;

            min-height: 48px;

            padding: 8px 12px;

            background: #ffffff;

            border: 1px solid #cbd9e3;
            border-radius: 4px;
        }

        .condition-item:hover {
            background: #f5f9fc;
        }

        .condition-left {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .condition-left input {
            width: 17px;
            height: 17px;
            cursor: pointer;
        }

        .condition-name {
            font-size: 14px;
            color: #183d58;
        }

        .condition-code {
            color: #728797;
            font-size: 12px;
        }

        /* =====================================================
           FOOTER ACTION
        ===================================================== */

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 8px;

            margin-top: 18px;
            padding-top: 14px;

            border-top: 1px solid #d8e2e8;
        }

        .btn {
            min-height: 38px;

            padding: 8px 17px;

            border-radius: 4px;
            border: 1px solid transparent;

            font-size: 13px;
            font-weight: bold;

            cursor: pointer;
        }

        .btn-close {
            background: #e8f5e9;
            border-color: #a9d6ad;
            color: #216b28;
        }

        .btn-close:hover {
            background: #d9efd9;
        }

        .btn-cancel {
            background: #f4f6f8;
            border-color: #bdcbd4;
            color: #425a6b;
        }

        .btn-cancel:hover {
            background: #e8edf1;
        }

        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 850px) {

            .patient-grid {
                grid-template-columns: 150px 1fr;
            }

            .condition-grid {
                grid-template-columns: 1fr;
            }

            .form-row {
                grid-template-columns: 150px 1fr;
            }
        }

        @media (max-width: 600px) {

            .header-title {
                font-size: 19px;
            }

            .patient-grid {
                grid-template-columns: 1fr;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .form-label {
                border-right: none;
                border-bottom: 1px solid #d5e0e7;
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

    {{-- =====================================================
         HEADER
    ===================================================== --}}

    <div class="header">

        <div class="header-title">
            AUDIT DOKUMEN REKAM MEDIS
        </div>

        <div class="header-subtitle">
            RSUD Prof. Dr. Margono Soekarjo Purwokerto
        </div>

    </div>


    <div class="container">

        {{-- =================================================
             STATUS
        ================================================== --}}

        <div class="status">
            <span class="status-dot"></span>
            AUDIT CLOSE
        </div>


        {{-- =================================================
             DATA PASIEN
        ================================================== --}}

        <div class="panel">

            <div class="panel-title">
                PILIH KONDISI PASIEN UNTUK AUDIT CLOSE
            </div>

            <div class="panel-body">

                <div class="patient-grid">

                    {{-- NO REG --}}
                    <div class="data-label">
                        No Registrasi
                    </div>

                    <div class="data-value">
                        {{ $patient->registrasi_id ?? '-' }}
                    </div>


                    {{-- NO RM --}}
                    <div class="data-label">
                        No RM
                    </div>

                    <div class="data-value">
                        {{ $patient->no_rm ?? '-' }}
                    </div>


                    {{-- NAMA --}}
                    <div class="data-label">
                        Nama Pasien
                    </div>

                    <div class="data-value">
                        {{ $patient->nama ?? '-' }}
                    </div>


                    {{-- JENIS LAYANAN --}}
                    <div class="data-label">
                        Jenis Layanan
                    </div>

                    <div class="data-value">
                        {{ $patient->jenis_layanan ?? '-' }}
                    </div>


                    {{-- RUANGAN --}}
                    <div class="data-label">
                        Ruangan
                    </div>

                    <div class="data-value">
                        {{ $patient->ruang_deskripsi ?? '-' }}
                    </div>


                    {{-- KASUS --}}
                    <div class="data-label">
                        Jenis Kasus
                    </div>

                    <div class="data-value">
                        {{ $caseType ?? '-' }}
                    </div>

                </div>


                {{-- =================================================
                     FORM CLOSE
                ================================================== --}}

                <form
                    method="POST"
                    action="{{ route('audits.close.store', $audit) }}"
                    class="close-form"
                >

                    @csrf


                    {{-- PATIENT ID --}}
                    <input
                        type="hidden"
                        name="patient_id"
                        value="{{ $patient->id }}"
                    >


                    {{-- CASE TYPE --}}
                    <input
                        type="hidden"
                        name="case_type"
                        value="{{ $caseType }}"
                    >


                    {{-- SERVICE TYPE --}}
                    <input
                        type="hidden"
                        name="service_type"
                        value="{{ $serviceType }}"
                    >


                    {{-- =================================================
                         TANGGAL PULANG
                    ================================================== --}}

                    <div class="form-row">

                        <div class="form-label">
                            Tanggal Pulang
                        </div>

                        <div class="form-control-area">

                            <input
                                type="date"
                                name="tanggal_pulang"
                                value="{{ now('Asia/Jakarta')->format('Y-m-d') }}"
                                readonly
                                required
                            >

                        </div>

                    </div>


                    {{-- =================================================
                         KEADAAN PULANG
                    ================================================== --}}

                    <div class="form-row">

                        <div class="form-label">
                            Keadaan Pulang
                        </div>

                        <div class="form-control-area">

                            <select
                                name="keadaan_pulang"
                                required
                                id="keadaan_pulang"
                            >

                                <option value="">
                                    -- Pilih Keadaan Pulang --
                                </option>

                                <option value="PULANG HIDUP">
                                    PULANG HIDUP
                                </option>

                                <option value="MENINGGAL">
                                    MENINGGAL
                                </option>

                                <option value="APS">
                                    ATAS PERMINTAAN SENDIRI (APS)
                                </option>

                                <option value="DIRUJUK">
                                    DIRUJUK
                                </option>

                            </select>

                        </div>

                    </div>


                    {{-- =================================================
                         KONDISI PASIEN
                    ================================================== --}}

                    <div class="condition-title">
                        KONDISI PASIEN
                    </div>


                    <div class="condition-grid">

                        {{-- OPERASI --}}
                        <label class="condition-item">

                            <span class="condition-left">

                                <input
                                    type="checkbox"
                                    name="conditions[]"
                                    value="surgery"
                                >

                                <span class="condition-name">
                                    Operasi
                                </span>

                            </span>

                            <span class="condition-code">
                                surgery
                            </span>

                        </label>


                        {{-- TRANSFUSI --}}
                        <label class="condition-item">

                            <span class="condition-left">

                                <input
                                    type="checkbox"
                                    name="conditions[]"
                                    value="transfusion"
                                >

                                <span class="condition-name">
                                    Transfusi
                                </span>

                            </span>

                            <span class="condition-code">
                                transfusion
                            </span>

                        </label>


                        {{-- ICU --}}
                        <label class="condition-item">

                            <span class="condition-left">

                                <input
                                    type="checkbox"
                                    name="conditions[]"
                                    value="icu"
                                >

                                <span class="condition-name">
                                    ICU / ICCU
                                </span>

                            </span>

                            <span class="condition-code">
                                icu
                            </span>

                        </label>


                        {{-- MENINGGAL --}}
                        <label class="condition-item">

                            <span class="condition-left">

                                <input
                                    type="checkbox"
                                    name="conditions[]"
                                    value="death"
                                    id="conditionDeath"
                                >

                                <span class="condition-name">
                                    Meninggal
                                </span>

                            </span>

                            <span class="condition-code">
                                death
                            </span>

                        </label>


                        {{-- KEMOTERAPI --}}
                        <label class="condition-item">

                            <span class="condition-left">

                                <input
                                    type="checkbox"
                                    name="conditions[]"
                                    value="chemotherapy"
                                >

                                <span class="condition-name">
                                    Kemoterapi
                                </span>

                            </span>

                            <span class="condition-code">
                                chemotherapy
                            </span>

                        </label>


                        {{-- HEMODIALISIS --}}
                        <label class="condition-item">

                            <span class="condition-left">

                                <input
                                    type="checkbox"
                                    name="conditions[]"
                                    value="hd"
                                >

                                <span class="condition-name">
                                    Hemodialisis
                                </span>

                            </span>

                            <span class="condition-code">
                                hd
                            </span>

                        </label>


                        {{-- APS --}}
                        <label class="condition-item">

                            <span class="condition-left">

                                <input
                                    type="checkbox"
                                    name="conditions[]"
                                    value="aps"
                                    id="conditionAps"
                                >

                                <span class="condition-name">
                                    Atas Permintaan Sendiri (APS)
                                </span>

                            </span>

                            <span class="condition-code">
                                aps
                            </span>

                        </label>


                        {{-- TRANSFER EKSTERNAL --}}
                        <label class="condition-item">

                            <span class="condition-left">

                                <input
                                    type="checkbox"
                                    name="conditions[]"
                                    value="external_transfer"
                                >

                                <span class="condition-name">
                                    Transfer Eksternal
                                </span>

                            </span>

                            <span class="condition-code">
                                external_transfer
                            </span>

                        </label>


                        {{-- PASIEN KRITIKAL --}}
                        <label class="condition-item">

                            <span class="condition-left">

                                <input
                                    type="checkbox"
                                    name="conditions[]"
                                    value="critical"
                                >

                                <span class="condition-name">
                                    Pasien Kritikal
                                </span>

                            </span>

                            <span class="condition-code">
                                critical
                            </span>

                        </label>


                        {{-- PROGRAM CAIRAN BAYI --}}
                        <label class="condition-item">

                            <span class="condition-left">

                                <input
                                    type="checkbox"
                                    name="conditions[]"
                                    value="baby_fluid"
                                >

                                <span class="condition-name">
                                    Program Cairan Bayi
                                </span>

                            </span>

                            <span class="condition-code">
                                baby_fluid
                            </span>

                        </label>

                    </div>


                    {{-- =================================================
                         BUTTON
                    ================================================== --}}

                    <div class="actions">

                        <button
                            type="button"
                            class="btn btn-cancel"
                            onclick="history.back()"
                        >
                            ← Kembali
                        </button>

                        <button
                            type="submit"
                            class="btn btn-close"
                        >
                            ✓ Buat Audit CLOSE
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- =====================================================
         SCRIPT
    ===================================================== --}}

    <script>

        const keadaanPulang =
            document.getElementById('keadaan_pulang');

        const conditionDeath =
            document.getElementById('conditionDeath');

        const conditionAps =
            document.getElementById('conditionAps');


        /*
        |--------------------------------------------------------------------------
        | MENINGGAL → OTOMATIS CENTANG DEATH
        |--------------------------------------------------------------------------
        */

        keadaanPulang.addEventListener('change', function () {

            if (this.value === 'MENINGGAL') {

                conditionDeath.checked = true;

            } else {

                conditionDeath.checked = false;

            }

        });


        /*
        |--------------------------------------------------------------------------
        | APS → OTOMATIS CENTANG APS
        |--------------------------------------------------------------------------
        */

        keadaanPulang.addEventListener('change', function () {

            if (this.value === 'APS') {

                conditionAps.checked = true;

            } else {

                conditionAps.checked = false;

            }

        });

    </script>

</body>
</html>