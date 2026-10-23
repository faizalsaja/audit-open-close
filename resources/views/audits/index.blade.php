<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Daftar Audit Rekam Medis</title>


    <style>

        * {
            box-sizing: border-box;
        }

        body {

            margin: 0;

            background: #eef3f7;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

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

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;

        }


        .header-info {
            min-width: 0;
        }


        .header-title {

            margin: 0;

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

            max-width: 1400px;

            margin: 18px auto;

        }


        /* =====================================================
           STATUS
        ===================================================== */

        .status-bar {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 10px;

            background: #ffffff;

            border: 1px solid #cbd9e3;

            border-radius: 5px;

            padding: 10px 14px;

            margin-bottom: 14px;

        }


        .status-title {

            display: flex;

            align-items: center;

            gap: 8px;

            color: #164f79;

            font-weight: bold;

        }


        .status-dot {

            width: 11px;

            height: 11px;

            border-radius: 50%;

            background: #35c98a;

            display: inline-block;

        }


        /* =====================================================
           BUTTON
        ===================================================== */

        .btn {

            height: 38px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 7px;

            padding: 0 15px;

            border-radius: 5px;

            border: 1px solid transparent;

            font-size: 13px;

            font-weight: 600;

            text-decoration: none;

            cursor: pointer;

            transition: all .15s ease;

        }


        .btn:hover {

            transform: translateY(-1px);

            box-shadow:
                0 3px 7px rgba(0,0,0,.10);

        }


        .btn:active {

            transform: translateY(0);

            box-shadow: none;

        }


        .btn-add {

            background: #eaf4fb;

            border-color: #78afd0;

            color: #17618e;

        }


        .btn-add:hover {

            background: #dceef9;

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
           PANEL
        ===================================================== */

        .card {

            background: #ffffff;

            border: 1px solid #c9d9e3;

            border-radius: 5px;

            overflow: hidden;

            box-shadow:
                0 1px 3px rgba(0,0,0,.06);

        }


        .card-title {

            background: #e4f2fb;

            border-bottom: 1px solid #c7dbe8;

            padding: 11px 14px;

            color: #174f78;

            font-size: 15px;

            font-weight: bold;

        }


        /* =====================================================
           TABLE
        ===================================================== */

        .table-wrapper {

            width: 100%;

            overflow-x: auto;

        }


        table {

            width: 100%;

            min-width: 900px;

            border-collapse: collapse;

        }


        thead th {

            background: #edf5f9;

            color: #31526c;

            font-size: 12px;

            font-weight: bold;

            text-align: left;

            padding: 11px 10px;

            border-bottom: 1px solid #cbd9e3;

            white-space: nowrap;

        }


        tbody td {

            padding: 11px 10px;

            border-bottom: 1px solid #e1e8ed;

            color: #28475d;

            vertical-align: middle;

        }


        tbody tr {

            transition:
                background-color .12s ease;

        }


        tbody tr.audit-row {

            cursor: pointer;

        }


        tbody tr.audit-row:hover {

            background: #f0f8fc;

        }


        tbody tr:last-child td {

            border-bottom: none;

        }


        /* =====================================================
           NOMOR
        ===================================================== */

        .number {

            width: 45px;

            text-align: center;

            color: #6c8190;

        }


        /* =====================================================
           NAMA PASIEN
        ===================================================== */

        .patient-name {

            font-weight: 600;

            color: #174f78;

        }


        .rm-number {

            font-family:
                Consolas,
                "Courier New",
                monospace;

            font-size: 13px;

        }


        /* =====================================================
           BADGE OPEN / CLOSE
        ===================================================== */

        .badge {

            display: inline-flex;

            align-items: center;

            gap: 6px;

            padding: 5px 10px;

            border-radius: 12px;

            font-size: 11px;

            font-weight: bold;

            white-space: nowrap;

        }


        .badge-dot {

            width: 7px;

            height: 7px;

            border-radius: 50%;

        }


        .badge-open {

            background: #e9f8ee;

            border: 1px solid #a9d9b7;

            color: #267341;

        }


        .badge-open .badge-dot {

            background: #35b968;

        }


        .badge-close {

            background: #fff0f1;

            border: 1px solid #e4a5ad;

            color: #bd3447;

        }


        .badge-close .badge-dot {

            background: #df4d61;

        }


        .badge-default {

            background: #f3f5f6;

            border: 1px solid #cbd5da;

            color: #5b6d77;

        }


        /* =====================================================
           SCORE
        ===================================================== */

        .score {

            font-weight: bold;

            color: #174f78;

        }


        /* =====================================================
           EMPTY
        ===================================================== */

        .empty {

            text-align: center;

            padding: 35px 20px !important;

            color: #718491;

        }


        .empty-icon {

            font-size: 28px;

            margin-bottom: 8px;

        }


        /* =====================================================
           FOOTER
        ===================================================== */

        .table-footer {

            background: #f7fafc;

            border-top: 1px solid #dce5ea;

            padding: 9px 12px;

            color: #718491;

            font-size: 12px;

        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 700px) {

            .header {

                flex-direction: column;

                align-items: flex-start;

            }


            .btn-add {

                width: 100%;

            }


            .status-bar {

                flex-direction: column;

                align-items: stretch;

            }


            .container {

                width: 94%;

            }

        }

    </style>

</head>


<body>


    {{-- =====================================================
         HEADER
    ===================================================== --}}

    <div class="header">

        <div class="header-info">

            <div class="header-title">
                AUDIT DOKUMEN REKAM MEDIS
            </div>

            <div class="header-subtitle">
                RSUD Prof. Dr. Margono Soekarjo Purwokerto
            </div>

        </div>


        <a
            href="{{ route('audits.create') }}"
            class="btn btn-add"
        >

            <span class="icon">
                ＋
            </span>

            <span>
                Tambah Audit
            </span>

        </a>

    </div>


    <div class="container">


        {{-- =================================================
             STATUS BAR
        ================================================== --}}

        <div class="status-bar">

            <div class="status-title">

                <span class="status-dot"></span>

                DAFTAR AUDIT REKAM MEDIS

            </div>

        </div>


        {{-- =================================================
             DATA AUDIT
        ================================================== --}}

        <div class="card">

            <div class="card-title">

                DAFTAR AUDIT

            </div>


            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th class="number">
                                No
                            </th>

                            <th>
                                No. RM
                            </th>

                            <th>
                                Nama Pasien
                            </th>

                            <th>
                                Ruangan
                            </th>

                            <th>
                                Tanggal Audit
                            </th>

                            <th>
                                Jenis Audit
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Nilai
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($audits as $audit)

                            <tr
                                class="audit-row"
                                onclick="window.location='{{ route('audits.show', $audit) }}'"
                            >

                                {{-- NO --}}

                                <td class="number">
                                    {{ $loop->iteration }}
                                </td>


                                {{-- NO RM --}}

                                <td>

                                    <span class="rm-number">

                                        {{ $audit->patient->no_rm ?? '-' }}

                                    </span>

                                </td>


                                {{-- NAMA --}}

                                <td>

                                    <span class="patient-name">

                                        {{ $audit->patient->nama ?? '-' }}

                                    </span>

                                </td>


                                {{-- RUANGAN --}}

                                <td>

                                    {{ $audit->room->name ?? '-' }}

                                </td>


                                {{-- TANGGAL AUDIT --}}

                                <td>

                                    @if($audit->audit_date)

                                        {{ $audit->audit_date->format('d/m/Y') }}

                                    @else

                                        -

                                    @endif

                                </td>


                                {{-- JENIS AUDIT --}}

                                <td>

                                    @if($audit->audit_type === 'OPEN')

                                        <span class="badge badge-open">

                                            <span class="badge-dot"></span>

                                            OPEN

                                        </span>

                                    @elseif($audit->audit_type === 'CLOSE')

                                        <span class="badge badge-close">

                                            <span class="badge-dot"></span>

                                            CLOSE

                                        </span>

                                    @else

                                        <span class="badge badge-default">

                                            -

                                        </span>

                                    @endif

                                </td>


                                {{-- STATUS --}}

                                <td>

                                    @if($audit->status === 'open')

                                        <span class="badge badge-open">

                                            <span class="badge-dot"></span>

                                            Aktif

                                        </span>

                                    @elseif($audit->status === 'closed')

                                        <span class="badge badge-close">

                                            <span class="badge-dot"></span>

                                            Selesai

                                        </span>

                                    @else

                                        <span class="badge badge-default">

                                            {{ ucfirst($audit->status ?? '-') }}

                                        </span>

                                    @endif

                                </td>


                                {{-- NILAI --}}

                                <td class="score">

                                    {{ $audit->overall_score ?? '-' }}

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="8"
                                    class="empty"
                                >

                                    <div class="empty-icon">
                                        📋
                                    </div>

                                    Belum ada data audit.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- FOOTER --}}

            @if($audits->count() > 0)

                <div class="table-footer">

                    Menampilkan
                    <strong>{{ $audits->count() }}</strong>
                    data audit

                </div>

            @endif

        </div>

    </div>


</body>

</html>