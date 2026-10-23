<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Audit - Audit Rekam Medis</title>

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
            padding: 15px 20px;
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
            max-width: 1000px;
            margin: 20px auto;
        }

        /* =====================================================
           STATUS
        ===================================================== */

        .status {
            display: flex;
            align-items: center;
            gap: 8px;

            background: #ffffff;
            border: 1px solid #cbd9e3;
            border-radius: 5px;

            padding: 10px 14px;
            margin-bottom: 14px;

            color: #164f79;
            font-weight: bold;
        }

        .status-dot {
            width: 11px;
            height: 11px;
            border-radius: 50%;
            background: #35c98a;
        }

        /* =====================================================
           PANEL
        ===================================================== */

        .panel {
            background: #ffffff;
            border: 1px solid #c9d9e3;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,.06);
        }

        .panel-title {
            background: #e4f2fb;
            border-bottom: 1px solid #c7dbe8;
            padding: 12px 15px;

            font-size: 16px;
            font-weight: bold;
            color: #174f78;
        }

        .panel-body {
            padding: 20px;
        }

        /* =====================================================
           ERROR
        ===================================================== */

        .alert-error {
            display: flex;
            align-items: center;
            gap: 8px;

            background: #fff0f2;
            border: 1px solid #efb2ba;
            color: #b52f42;

            border-radius: 4px;
            padding: 10px 12px;
            margin-bottom: 18px;
        }

        /* =====================================================
           FORM
        ===================================================== */

        .form-group {
            max-width: 650px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;

            font-weight: bold;
            color: #31526c;
        }

        .input-row {
            display: flex;
            gap: 8px;
        }

        .input-wrapper {
            position: relative;
            flex: 1;
        }

        .input-icon {
            position: absolute;
            left: 12px;
            top: 50%;

            transform: translateY(-50%);

            color: #718797;
            font-size: 14px;
        }

        .form-input {
            width: 100%;
            height: 40px;

            border: 1px solid #b9cad6;
            border-radius: 5px;

            padding: 0 12px 0 34px;

            background: #ffffff;
            color: #17324d;

            font-size: 14px;
        }

        .form-input:focus {
            outline: none;
            border-color: #2d79ad;

            box-shadow:
                0 0 0 2px rgba(45,121,173,.12);
        }

        .form-input::placeholder {
            color: #9aaab5;
        }

        /* =====================================================
           BUTTON
        ===================================================== */

        .actions {
            display: flex;
            align-items: center;
            gap: 8px;

            margin-top: 20px;
            padding-top: 16px;

            border-top: 1px solid #dbe3e8;
        }

        .btn {
            height: 38px;

            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;

            padding: 0 16px;

            border-radius: 5px;
            border: 1px solid transparent;

            font-size: 13px;
            font-weight: 600;

            text-decoration: none;
            cursor: pointer;

            transition: .15s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 6px rgba(0,0,0,.10);
        }

        .btn:active {
            transform: translateY(0);
            box-shadow: none;
        }

        /* CARI */

        .btn-search {
            background: #2f80b7;
            border-color: #286f9f;
            color: #ffffff;
        }

        .btn-search:hover {
            background: #286f9f;
        }

        /* KEMBALI */

        .btn-back {
            background: #f3f6f8;
            border-color: #b9c8d2;
            color: #536b7b;
        }

        .btn-back:hover {
            background: #e8edf1;
        }

        .icon {
            width: 17px;
            height: 17px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            font-size: 14px;
        }

        /* =====================================================
           INFO
        ===================================================== */

        .info-box {
            margin-top: 18px;

            background: #f5f9fc;
            border: 1px solid #d4e1e9;
            border-radius: 4px;

            padding: 11px 13px;

            color: #607788;
            font-size: 12px;
            line-height: 1.5;
        }

        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 600px) {

            .header-title {
                font-size: 19px;
            }

            .container {
                width: 94%;
            }

            .input-row {
                flex-direction: column;
            }

            .btn-search {
                width: 100%;
            }

            .actions {
                flex-direction: column;
                align-items: stretch;
            }

            .btn-back {
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

            TAMBAH AUDIT REKAM MEDIS

        </div>


        {{-- =================================================
             PANEL
        ================================================== --}}

        <div class="panel">

            <div class="panel-title">
                CARI PASIEN DARI SIMRS
            </div>


            <div class="panel-body">

                {{-- ERROR --}}

                @if(session('error'))

                    <div class="alert-error">

                        <span>⚠</span>

                        <span>
                            {{ session('error') }}
                        </span>

                    </div>

                @endif


                {{-- FORM PENCARIAN --}}

                <form
                    method="POST"
                    action="{{ route('audits.patient.search') }}"
                >

                    @csrf


                    <div class="form-group">

                        <label
                            for="noreg"
                            class="form-label"
                        >
                            No Registrasi dari SIMRS
                        </label>


                        <div class="input-row">

                            <div class="input-wrapper">

                                <span class="input-icon">
                                    🔎
                                </span>

                                <input
                                    type="text"
                                    name="noreg"
                                    id="noreg"
                                    class="form-input"
                                    placeholder="Masukkan No Registrasi..."
                                    autocomplete="off"
                                    required
                                >

                            </div>


                            <button
                                type="submit"
                                class="btn btn-search"
                            >

                                <span class="icon">
                                    🔎
                                </span>

                                <span>
                                    Cari
                                </span>

                            </button>

                        </div>


                        <div class="info-box">

                            Masukkan <strong>No Registrasi</strong>
                            pasien dari SIMRS untuk mengambil data pasien
                            sebelum membuat Audit OPEN atau CLOSE.

                        </div>

                    </div>


                    {{-- ACTION --}}

                    <div class="actions">

                        <a
                            href="{{ route('audits.index') }}"
                            class="btn btn-back"
                        >

                            <span class="icon">
                                ←
                            </span>

                            <span>
                                Kembali ke Audit
                            </span>

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</body>
</html>