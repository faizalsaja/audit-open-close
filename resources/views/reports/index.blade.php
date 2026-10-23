<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laporan Audit Rekam Medis</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f3f6f9;
            color: #263746;
            font-size: 13px;
        }

        /* ================= HEADER ================= */

        .header {
            background: linear-gradient(
                135deg,
                #0d3b66,
                #145da0
            );

            color: white;

            padding: 15px 20px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            box-shadow: 0 2px 5px rgba(0,0,0,.15);
        }

        .header h1 {
            margin: 0;
            font-size: 21px;
        }

        .header p {
            margin: 4px 0 0;
            color: #dceeff;
        }

        .back-button {
            color: white;
            text-decoration: none;

            padding: 8px 14px;

            border: 1px solid rgba(255,255,255,.5);
            border-radius: 5px;

            background: rgba(255,255,255,.1);
        }

        .back-button:hover {
            background: rgba(255,255,255,.2);
        }

        /* ================= FILTER ================= */

        .filter-panel {
            margin: 12px 15px;

            background: white;

            border: 1px solid #d3dfe8;
            border-radius: 6px;

            padding: 12px;

            box-shadow: 0 1px 3px rgba(0,0,0,.05);
        }

        .filter-title {
            color: #17466f;

            font-weight: bold;

            margin-bottom: 10px;
        }

        .filter-form {
            display: flex;

            align-items: end;

            gap: 10px;

            flex-wrap: wrap;
        }

        .filter-group {
            display: flex;

            flex-direction: column;

            gap: 4px;
        }

        .filter-group label {
            font-size: 11px;

            font-weight: bold;

            color: #486273;
        }

        .filter-group select {
            height: 32px;

            min-width: 130px;

            border: 1px solid #bdccd7;

            border-radius: 4px;

            background: white;

            padding: 4px 8px;
        }

        .filter-button {
            height: 32px;

            border: 1px solid #2879ae;

            border-radius: 4px;

            padding: 0 15px;

            background: #2879ae;

            color: white;

            font-weight: bold;

            cursor: pointer;
        }

        .filter-button:hover {
            background: #21678f;
        }

        .reset-button {
            height: 32px;

            display: inline-flex;

            align-items: center;

            padding: 0 13px;

            border: 1px solid #aebbc4;

            border-radius: 4px;

            background: #f2f4f5;

            color: #425866;

            text-decoration: none;
        }

        /* ================= SUMMARY ================= */

        .summary {
            margin: 0 15px 10px;

            display: flex;

            gap: 10px;
        }

        .summary-box {
            background: white;

            border: 1px solid #d3dfe8;

            border-radius: 5px;

            padding: 10px 15px;

            min-width: 180px;
        }

        .summary-label {
            color: #657887;

            font-size: 11px;
        }

        .summary-value {
            color: #17466f;

            font-size: 20px;

            font-weight: bold;

            margin-top: 3px;
        }

        /* ================= TABLE ================= */

        .table-panel {
            margin: 0 15px 20px;

            background: white;

            border: 1px solid #d3dfe8;

            border-radius: 6px;

            overflow: hidden;
        }

        .table-title {
            padding: 10px 12px;

            background: #e7f3fb;

            border-bottom: 1px solid #c6dce9;

            color: #17466f;

            font-weight: bold;
        }

        .table-wrapper {
            width: 100%;

            overflow-x: auto;

            max-height: calc(100vh - 250px);

            overflow-y: auto;
        }

        table {
            border-collapse: collapse;

            min-width: 2800px;

            width: 100%;
        }

        th {
            position: sticky;

            top: 0;

            z-index: 3;

            background: #dcecf6;

            color: #244b66;

            border: 1px solid #b9ccd9;

            padding: 8px 7px;

            text-align: center;

            font-size: 11px;

            white-space: nowrap;
        }

        td {
            border: 1px solid #d8e0e6;

            padding: 7px 8px;

            text-align: center;

            white-space: nowrap;

            font-size: 11px;

            background: white;
        }

        tbody tr:hover td {
            background: #f4f9fc;
        }

        td.text-left {
            text-align: left;
        }

        .score {
            font-weight: bold;

            color: #17638e;
        }

        .check {
            color: #278348;

            font-weight: bold;
        }

        .badge {
            display: inline-block;

            padding: 3px 7px;

            border-radius: 3px;

            font-size: 10px;

            font-weight: bold;
        }

        .badge-ya {
            background: #e4f5e9;
            color: #24733b;
        }

        .badge-tidak {
            background: #fbe8e8;
            color: #9d3b3b;
        }

        /* ================= EMPTY ================= */

        .empty {
            padding: 40px;

            text-align: center;

            color: #748693;
        }
.btn-download-excel {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;

    height: 38px;
    padding: 0 16px;

    background: #217346;
    color: white;
    border: 1px solid #1b5e38;
    border-radius: 6px;

    text-decoration: none;
    font-size: 13px;
    font-weight: 600;

    transition: 0.2s;
}

.btn-download-excel:hover {
    background: #185c37;
    color: white;
    text-decoration: none;
}
/* =========================
   FILTER LAPORAN - COMPACT
   ========================= */

.filter-bar {
    display: flex;
    align-items: flex-end;
    gap: 10px;
    padding: 12px 14px;
}

.filter-group {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.filter-group label {
    font-size: 12px;
    font-weight: 600;
    color: #374151;
}

/* Semua dropdown */
.filter-group select {
    height: 34px;
    min-width: 125px;
    padding: 0 28px 0 10px;

    border: 1px solid #cbd5e1;
    border-radius: 5px;

    background: #fff;
    color: #374151;

    font-size: 12px;
    outline: none;
}

/* Lebar khusus */
.filter-group select[name="bulan"] {
    min-width: 130px;
}

.filter-group select[name="tahun"] {
    min-width: 130px;
}

.filter-group select[name="ruangan"] {
    min-width: 175px;
}

.filter-group select[name="audit_type"] {
    min-width: 130px;
}

/* Semua tombol filter */
.filter-actions {
    display: flex;
    align-items: center;
    gap: 7px;
}

/* Tombol umum */
.filter-actions button,
.filter-actions a {
    height: 34px;
    padding: 0 13px;

    border-radius: 5px;

    font-size: 12px;
    font-weight: 600;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    white-space: nowrap;
}

/* Tampilkan */
.btn-filter {
    background: #287db5;
    color: #fff;
    border: 1px solid #287db5;
}

.btn-filter:hover {
    background: #226b9a;
}

/* Download Excel */
.btn-download-excel {
    height: 34px !important;
    padding: 0 13px !important;

    background: #217346;
    color: #fff;

    border: 1px solid #1b5e38;
    border-radius: 5px;

    font-size: 12px !important;
    font-weight: 600;

    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 5px;

    text-decoration: none;
}

.btn-download-excel:hover {
    background: #185c37;
    color: #fff;
    text-decoration: none;
}

/* Reset */
.filter-actions .btn-reset,
.filter-actions a[href*="reset"] {
    height: 34px;
    padding: 0 13px;

    background: #fff;
    color: #4b5563;

    border: 1px solid #cbd5e1;
    border-radius: 5px;

    font-size: 12px;
}

.filter-actions .btn-reset:hover,
.filter-actions a[href*="reset"]:hover {
    background: #f3f4f6;
}
/* ================= TOMBOL KEMBALI KE AUDIT ================= */

.btn-back {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    height: 34px;
    padding: 0 14px;

    background: rgba(255, 255, 255, 0.10);
    color: #ffffff;

    border: 1px solid rgba(255, 255, 255, 0.55);
    border-radius: 5px;

    text-decoration: none;

    font-size: 12px;
    font-weight: 600;

    white-space: nowrap;

    transition: all 0.2s ease;
}

.btn-back:hover {
    background: #ffffff;
    color: #145da0;
    border-color: #ffffff;
    text-decoration: none;
}
    </style>

</head>

<body>


{{-- ================= HEADER ================= --}}

<div class="header">

    <div>

        <h1>
            LAPORAN AUDIT DOKUMEN REKAM MEDIS
        </h1>

        <p>
            RSUD Prof. Dr. Margono Soekarjo Purwokerto
        </p>

    </div>

@if($rows->isNotEmpty())
    <a
        href="{{ route('audits.show', $rows->first()['audit_id']) }}"
        class="btn-back"
    >
        ← Kembali ke Audit
    </a>
@else
    <a
        href="{{ route('audits.index') }}"
        class="btn-back"
    >
        ← Kembali ke Audit
    </a>
@endif
</div>


{{-- ================= FILTER ================= --}}

<div class="filter-panel">

    <div class="filter-title">
        FILTER LAPORAN
    </div>
    <form
        method="GET"
        action="{{ route('reports.index') }}"
        class="filter-form"
    >

        <div class="filter-group">

            <label>
                Bulan
            </label>

            <select name="bulan">

                <option value="">
                    Semua Bulan
                </option>

                @foreach ([
                    1 => 'Januari',
                    2 => 'Februari',
                    3 => 'Maret',
                    4 => 'April',
                    5 => 'Mei',
                    6 => 'Juni',
                    7 => 'Juli',
                    8 => 'Agustus',
                    9 => 'September',
                    10 => 'Oktober',
                    11 => 'November',
                    12 => 'Desember'
                ] as $nomor => $nama)

                    <option
                        value="{{ $nomor }}"
                        {{ request('bulan') == $nomor ? 'selected' : '' }}
                    >
                        {{ $nama }}
                    </option>

                @endforeach

            </select>

        </div>


        <div class="filter-group">

            <label>
                Tahun
            </label>

            <select name="tahun">

                <option value="">
                    Semua Tahun
                </option>

                @foreach ($years as $year)

                    <option
                        value="{{ $year }}"
                        {{ request('tahun') == $year ? 'selected' : '' }}
                    >
                        {{ $year }}
                    </option>

                @endforeach

            </select>

        </div>


        <div class="filter-group">

            <label>
                Ruangan
            </label>

            <select name="ruangan" id="ruangan">
    <option value="">Semua Ruangan</option>

    @foreach ($rooms as $room)
        <option
            value="{{ $room->id }}"
            {{ request('ruangan') == $room->id ? 'selected' : '' }}
        >
            {{ $room->name }}
        </option>
    @endforeach
</select>

        </div>


        <div class="filter-group">

            <label>
                Jenis Audit
            </label>

            <select name="audit_type">

                <option value="">
                    Semua
                </option>

                <option
                    value="OPEN"
                    {{ request('audit_type') === 'OPEN' ? 'selected' : '' }}
                >
                    OPEN
                </option>

                <option
                    value="CLOSE"
                    {{ request('audit_type') === 'CLOSE' ? 'selected' : '' }}
                >
                    CLOSE
                </option>

            </select>

        </div>


        <button
            type="submit"
            class="filter-button"
        >
            🔍 Tampilkan
        </button>
<a
    href="{{ route('reports.download', request()->query()) }}"
    class="btn-download-excel"
>
    📥 Download Excel
</a>

        <a
            href="{{ route('reports.index') }}"
            class="reset-button"
        >
            Reset
        </a>

    </form>

</div>


{{-- ================= SUMMARY ================= --}}

<div class="summary">

    <div class="summary-box">

        <div class="summary-label">
            Total Audit
        </div>

        <div class="summary-value">
            {{ $rows->pluck('audit_id')->unique()->count() }}
        </div>

    </div>


    <div class="summary-box">

        <div class="summary-label">
            Total Pasien
        </div>

        <div class="summary-value">
            {{ $rows->pluck('no_rm')->unique()->count() }}
        </div>

    </div>


    <div class="summary-box">

        <div class="summary-label">
            Total Formulir
        </div>

        <div class="summary-value">
            {{ $rows->count() }}
        </div>

    </div>

</div>


{{-- ================= TABLE ================= --}}

<div class="table-panel">

    <div class="table-title">

        HASIL LAPORAN AUDIT

    </div>


    <div class="table-wrapper">

        @if ($rows->count() > 0)

            <table>

                <thead>

                    <tr>

                        <th>NAMA</th>

                        <th>NO RM</th>

                        <th>NO REG</th>

                        <th>DPJP</th>

                        <th>SMF</th>

                        <th>RUANGAN</th>

                        <th>KASUS</th>

                        <th>TGL PULANG</th>

                        <th>TGL AUDIT</th>

                        <th>KEADAAN PULANG</th>

                        <th>NO FORMULIR</th>

                        <th>NAMA FORMULIR</th>

                        <th>KASUS</th>

                        <th>WAJIB</th>

                        <th>KETERANGAN DOKUMEN</th>

                        <th>IDENTITAS</th>

                        <th>TERBACA</th>

                        <th>REVIEW AUTENTIFIKASI</th>

                        <th>KOREKSI PENCATATAN DRM</th>

                        <th>PER FORMULIR</th>

                        <th>PER DRM</th>

                        <th>PER RUANGAN</th>

                        <th>KETERANGAN</th>

                        <th>DENUMERATOR RUANGAN</th>

                    </tr>

                </thead>


                <tbody>

                    @foreach ($rows as $row)

                        <tr>

                            <td class="text-left">
                                {{ $row['nama'] }}
                            </td>

                            <td>
                                {{ $row['no_rm'] }}
                            </td>

                            <td>
                                {{ $row['no_reg'] }}
                            </td>

                            <td class="text-left">
                                {{ $row['dpjp'] }}
                            </td>

                            <td>
                                {{ $row['smf'] }}
                            </td>

                            <td>
                                {{ $row['ruangan'] }}
                            </td>

                            <td>
                                {{ $row['kasus'] }}
                            </td>

                            <td>
                                {{ $row['tgl_pulang'] }}
                            </td>

                            <td>
                                {{ $row['tgl_audit'] }}
                            </td>

                            <td>
                                {{ $row['keadaan_pulang'] }}
                            </td>

                            <td>
                                {{ $row['no_formulir'] }}
                            </td>

                            <td class="text-left">
                                {{ $row['nama_formulir'] }}
                            </td>

                            <td>
                                {{ $row['kasus_form'] }}
                            </td>

                            <td>

                                @if ($row['wajib'] === 'YA')

                                    <span class="badge badge-ya">
                                        YA
                                    </span>

                                @else

                                    <span class="badge badge-tidak">
                                        TIDAK
                                    </span>

                                @endif

                            </td>

                            <td class="text-left">
                                {{ $row['keterangan_dokumen'] }}
                            </td>

                            <td>
                                {{ $row['identitas'] }}
                            </td>

                            <td>
                                {{ $row['terbaca'] }}
                            </td>

                            <td>
                                {{ $row['review_autentifikasi'] }}
                            </td>

                            <td>
                                {{ $row['koreksi'] }}
                            </td>

                            <td class="score">
                                {{ number_format($row['per_formulir'], 2) }}
                            </td>

                            <td class="score">
                                {{ number_format($row['per_drm'], 2) }}
                            </td>

                            <td class="score">
                                {{ number_format($row['per_ruangan'], 2) }}
                            </td>

                            <td>
                                {{ $row['keterangan'] }}
                            </td>

                            <td>
                                {{ $row['denumerator_ruangan'] }}
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        @else

            <div class="empty">

                Belum ada data audit yang dapat ditampilkan.

            </div>

        @endif

    </div>

</div>


</body>

</html>