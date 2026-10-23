<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Audit Dokumen Rekam Medis</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #eef2f5;
            color: #222;
            font-size: 14px;
        }

        /* ================= HEADER ================= */

        .header {
            background: linear-gradient(to right, #ffffff, #e8f4fc);
            border-bottom: 1px solid #b8cee0;
            padding: 10px 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-title h1 {
            margin: 0;
            color: #12366b;
            font-size: 24px;
        }

        .header-title p {
            margin: 3px 0 0;
            color: #31516f;
            font-size: 15px;
        }

        .actions {
            display: flex;
            height: 65px;
        }

        .action-button {
            width: 90px;
            border-left: 1px solid #b8cee0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: #f8fbfd;
            cursor: pointer;
        }

        .action-button:hover {
            background: #e4f1fb;
        }

        .action-icon {
            font-size: 25px;
        }

        .action-text {
            font-size: 12px;
            margin-top: 3px;
        }

        /* ================= FILTER ================= */

        .filter-bar {
            background: #dceefa;
            border: 1px solid #bdd8eb;
            margin: 6px 15px;
            padding: 8px 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .filter-bar label {
            font-weight: bold;
            color: #183b63;
        }

        .filter-bar select {
            height: 30px;
            padding: 3px 25px 3px 8px;
            border: 1px solid #9eb6c8;
            background: white;
            border-radius: 3px;
        }

        /* ================= LAYOUT ================= */

        .workspace {
            display: grid;
            grid-template-columns: 350px 1fr;
            gap: 8px;
            padding: 0 15px 15px;
        }

        .panel {
            background: white;
            border: 1px solid #c3d0da;
        }

        .panel-title {
            background: linear-gradient(#dff1fc, #c7e5f7);
            border-bottom: 1px solid #abc8dc;
            color: #153b69;
            font-weight: bold;
            font-size: 16px;
            padding: 8px 10px;
        }

        /* ================= PATIENT ================= */

        .patient-search {
            padding: 8px;
            border-bottom: 1px solid #d0d8df;
        }

        .patient-search input {
            width: 100%;
            height: 34px;
            border: 1px solid #aebdca;
            border-radius: 3px;
            padding: 7px 10px;
        }

        .patient-list {
            max-height: calc(100vh - 180px);
            overflow-y: auto;
        }


        /* ================= MAIN ================= */

        .main {
            min-width: 0;
        }

        /* ================= DATA PASIEN ================= */

        .patient-data {
            margin-bottom: 8px;
        }

        .data-grid {
            display: grid;
            grid-template-columns: 130px 1fr 130px 1.4fr;
        }

        .data-label,
        .data-value {
            min-height: 36px;
            padding: 7px 9px;
            border-bottom: 1px solid #d9e0e5;
            border-right: 1px solid #d9e0e5;
        }

        .data-label {
            background: #f1f4f6;
            font-weight: bold;
        }

        .data-value {
            background: white;
        }

        /* ================= TABLE ================= */

        .document-panel {
            background: white;
            border: 1px solid #c3d0da;
        }

        .table-wrapper {
            overflow-x: auto;
            max-height: calc(100vh - 430px);
            overflow-y: auto;
        }

        .audit-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        .audit-table th {
            position: sticky;
            top: 0;
            z-index: 2;
            background: #eef1f3;
            border: 1px solid #c3cbd2;
            padding: 8px;
            text-align: center;
            font-weight: bold;
        }

        .audit-table td {
            border: 1px solid #d0d6db;
            padding: 5px 7px;
        }

        /* ================= FORM HEADER ================= */

        .form-row td {
            background: #8ec8ed;
            font-weight: bold;
            color: #102f50;
        }

        .form-check {
            width: 70px;
            text-align: center;
        }

        .code-column {
            width: 80px;
            text-align: center;
        }

        .indicator-number {
            width: 55px;
            text-align: center;
            color: #555;
        }

        .indicator-name {
            padding-left: 12px !important;
        }

        .select-column {
            width: 145px;
            text-align: center;
        }

        .checkbox {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .yes-no {
            width: 125px;
            height: 30px;
            border: 1px solid #9caebb;
            background: white;
            border-radius: 3px;
            padding: 3px 8px;
        }

        /* ================= SCORE ================= */

        .score-panel {
            margin-top: 8px;
            background: linear-gradient(#dff1fc, #c8e6f8);
            border: 1px solid #b5d3e7;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .score-title {
            font-size: 20px;
            font-weight: bold;
            color: #163c6a;
        }

        .score-value {
            background: white;
            border: 1px solid #9bb9cf;
            min-width: 190px;
            text-align: center;
            padding: 8px 20px;
            font-size: 27px;
            font-weight: bold;
            color: #124b82;
        }

        /* ================= RESPONSIVE ================= */

        @media (max-width: 1000px) {

            .workspace {
                grid-template-columns: 280px 1fr;
            }

            .data-grid {
                grid-template-columns: 110px 1fr;
            }

            .actions {
                display: none;
            }
        }
        .form-selection {
    margin-bottom: 8px;
}

.form-category {
    border-bottom: 1px solid #d5dce2;
}

.category-title {
    background: #eef3f6;
    border-bottom: 1px solid #d1d9df;
    padding: 7px 10px;
    font-weight: bold;
    color: #244766;
}

.form-options {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
}

.form-option {
    display: flex;
    align-items: center;
    gap: 7px;
    padding: 7px 10px;
    border-bottom: 1px solid #edf0f2;
    cursor: pointer;
}

.form-option:hover {
    background: #eef8ff;
}

.form-option input {
    width: 17px;
    height: 17px;
    cursor: pointer;
}

.form-code {
    font-weight: bold;
    color: #1d4f7a;
    min-width: 70px;
}

.form-selection-footer {
    padding: 8px;
    text-align: right;
    background: #f5f7f9;
}

/* ===============================
   DAFTAR PASIEN
================================ */

.patient-list {
    width: 100%;
    max-height: calc(100vh - 180px);
    overflow-y: auto;
}

.patient-item {
    display: flex;
    align-items: flex-start;
    width: 100%;
    min-height: 82px;
    padding: 9px 10px;
    gap: 8px;

    text-decoration: none;
    color: #222;
    background: #ffffff;

    border-bottom: 1px solid #d5dde3;

    box-sizing: border-box;
}

.patient-item:hover {
    background: #f1f6fa;
}

.patient-item.active {
    background: #8fc8e8;
}

/* Nomor pasien */

.patient-no {
    width: 22px;
    flex: 0 0 22px;
    padding-top: 2px;

    font-size: 13px;
    font-weight: normal;
}

/* Informasi pasien */

.patient-info {
    flex: 1;
    min-width: 0;
}

/* Nama */

.patient-name {
    font-size: 13px;
    font-weight: 600;
    line-height: 18px;

    white-space: normal;
}

/* No RM */

.patient-rm {
    margin-top: 2px;

    font-size: 11px;
    font-weight: bold;
    color: #333;
}

/* Tombol OPEN / CLOSE */

.patient-audit-status {
    display: flex;
    align-items: center;
    gap: 5px;

    margin-top: 6px;
}

/* Form tombol */

.audit-mini-form {
    display: inline-block;
    margin: 0;
    padding: 0;
}

/* Tombol */

.audit-mini {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    min-width: 58px;
    height: 21px;

    padding: 2px 7px;

    border-radius: 3px;
    border: 1px solid #b8c4cc;

    background: white;

    font-family: Arial, Helvetica, sans-serif;
    font-size: 10px;
    font-weight: bold;

    text-decoration: none;

    cursor: pointer;
}

/* OPEN sudah ada */

.audit-mini.open {
    background: #e5f5e9;
    border-color: #7dbb8d;
    color: #287a3e;
}

/* CLOSE sudah ada */

.audit-mini.close {
    background: #f9e4e4;
    border-color: #d38f8f;
    color: #a43b3b;
}

/* OPEN/CLOSE belum ada */

.audit-mini.empty {
    background: #f2f2f2;
    border-color: #c8c8c8;
    color: #777;
}

.audit-mini:hover {
    filter: brightness(0.97);
}

.patient-item.active .patient-name {
    font-weight: 700;
}
.api-search-form {
    margin: 8px 0 10px 0;
    padding: 8px 10px;
    background: #f4f7f9;
    border-top: 1px solid #d5dde3;
    border-bottom: 1px solid #d5dde3;
}

.api-search-title {
    font-size: 11px;
    font-weight: bold;
    margin-bottom: 5px;
}

.api-search-row {
    display: flex;
    gap: 4px;
}

.api-search-row input {
    flex: 1;
    min-width: 0;
    height: 28px;
    padding: 4px 7px;
    border: 1px solid #bfcbd3;
    border-radius: 3px;
    font-size: 11px;
}

.api-search-row button {
    height: 28px;
    padding: 0 10px;
    border: 1px solid #999;
    border-radius: 3px;
    background: #e8eef2;
    cursor: pointer;
    font-size: 11px;
}

.api-search-row button:hover {
    background: #dce5ea;
}
/* =========================================================
   TAMPILAN BARU AUDIT RM
========================================================= */

body {
    background: #f3f6f9;
    color: #243447;
    font-size: 14px;
}

/* ================= HEADER BARU ================= */

.header {
    min-height: 76px;
    padding: 12px 22px;
    background: linear-gradient(135deg, #0d3b66, #145da0);
    border: none;
    color: white;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 2px 6px rgba(0,0,0,.12);
}

.header-title h1 {
    margin: 0;
    color: white;
    font-size: 22px;
    font-weight: 700;
    letter-spacing: .3px;
}

.header-title p {
    margin: 4px 0 0;
    color: #dceeff;
    font-size: 13px;
}

/* Tombol laporan */

.report-button {
    display: inline-flex;
    align-items: center;
    gap: 8px;

    padding: 10px 18px;

    border: 1px solid rgba(255,255,255,.45);
    border-radius: 6px;

    background: rgba(255,255,255,.12);
    color: white;

    text-decoration: none;
    font-weight: 600;
    font-size: 13px;

    transition: .2s;
}

.report-button:hover {
    background: rgba(255,255,255,.22);
    color: white;
}

/* ================= STATUS AUDIT ================= */

.audit-toolbar {
    margin: 10px 15px 8px;

    background: white;
    border: 1px solid #d6e0e8;
    border-radius: 6px;

    padding: 8px 12px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    box-shadow: 0 1px 3px rgba(0,0,0,.05);
}

.audit-current {
    font-weight: 700;
    color: #244b70;
}

.audit-status-buttons {
    display: flex;
    gap: 7px;
}

.status-button {
    height: 32px;
    padding: 0 14px;

    border-radius: 5px;

    font-size: 12px;
    font-weight: 700;

    cursor: pointer;
    background: white;

    transition: .2s;
}

.open-button {
    border: 1px solid #72b98b;
    color: #24763d;
}

.open-button:hover,
.open-button.active {
    background: #e5f7eb;
}

.close-button {
    border: 1px solid #df8585;
    color: #a33a3a;
}

.close-button:hover,
.close-button.active {
    background: #fde9e9;
}

/* ================= ALERT ================= */

.alert-message {
    margin: 10px 15px;
    padding: 10px 14px;

    border-radius: 5px;

    font-size: 13px;
}

/* ================= ACTION BAR ================= */

.actions {
    height: auto;
    display: flex;
    gap: 5px;
}

.action-button {
    width: 72px;
    min-height: 52px;

    border: 1px solid #d2dce4;
    border-radius: 5px;

    background: white;

    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

    cursor: pointer;

    transition: .2s;
}

.action-button:hover {
    background: #eef6fc;
    border-color: #9fc2dc;
}

.action-icon {
    font-size: 19px;
}

.action-text {
    font-size: 10px;
    margin-top: 3px;
    font-weight: 600;
    color: #36546d;
}

/* ================= FILTER ================= */

.filter-bar {
    margin: 8px 15px;

    background: white;
    border: 1px solid #d5e0e8;
    border-radius: 6px;

    padding: 9px 12px;

    display: flex;
    align-items: center;
    gap: 8px;

    box-shadow: 0 1px 3px rgba(0,0,0,.04);
}

.filter-bar label {
    font-size: 12px;
    color: #31536f;
}

.filter-bar select {
    min-width: 115px;
    height: 32px;

    border: 1px solid #bccbd7;
    border-radius: 4px;

    padding: 4px 8px;

    background: white;
}

/* ================= WORKSPACE ================= */

.workspace {
    display: grid;
    grid-template-columns: 310px minmax(0, 1fr);

    gap: 10px;

    padding: 0 15px 15px;
}

/* ================= PANEL ================= */

.panel,
.document-panel {
    background: white;

    border: 1px solid #d2dde5;
    border-radius: 6px;

    overflow: hidden;

    box-shadow: 0 1px 3px rgba(0,0,0,.04);
}

.panel-title {
    background: #e7f3fb;
    border-bottom: 1px solid #c5dbe9;

    color: #17466f;

    font-size: 14px;
    font-weight: 700;

    padding: 9px 12px;
}

/* ================= DATA PASIEN ================= */

.data-grid {
    display: grid;
    grid-template-columns: 125px minmax(120px, 1fr)
                           125px minmax(160px, 1.5fr);
}

.data-label {
    background: #f3f6f8;
    color: #3a5265;
    font-weight: 600;
}

.data-value {
    background: white;
    color: #273b4a;
}

.data-label,
.data-value {
    min-height: 37px;

    padding: 8px 10px;

    border-bottom: 1px solid #e0e6eb;
    border-right: 1px solid #e0e6eb;
}

/* ================= DAFTAR PASIEN ================= */

.patient-search {
    padding: 10px;
    background: #fafcfd;
}

.patient-search input {
    height: 34px;
    border: 1px solid #bdccd7;
    border-radius: 4px;
}

.patient-item {
    min-height: 86px;
    padding: 10px;

    border-bottom: 1px solid #e1e7eb;

    transition: .15s;
}

.patient-item:hover {
    background: #f3f8fc;
}

.patient-item.active {
    background: #dceffb;
    border-left: 4px solid #1683c5;
    padding-left: 6px;
}

.patient-name {
    color: #17466f;
    font-size: 13px;
}

.patient-rm {
    color: #657785;
}

/* ================= API SEARCH ================= */

.api-search-form {
    margin: 0;
    padding: 9px 10px;

    background: #f5f8fa;

    border-top: 1px solid #e0e6eb;
    border-bottom: 1px solid #e0e6eb;
}

.api-search-title {
    color: #36556c;
    font-size: 11px;
    margin-bottom: 6px;
}

.api-search-row {
    display: flex;
    gap: 5px;
}

.api-search-row input {
    height: 30px;
    font-size: 11px;
}

.api-search-row button {
    height: 30px;

    border: 1px solid #347eaf;
    border-radius: 4px;

    background: #347eaf;
    color: white;

    font-weight: 600;
}

.api-search-row button:hover {
    background: #286b96;
}

/* ================= PILIH FORM ================= */

.form-selection {
    margin-bottom: 10px;
}

.form-category {
    border-bottom: 1px solid #dce3e8;
}

.category-title {
    background: #f0f6fa;

    border-bottom: 1px solid #d9e3e9;

    padding: 7px 11px;

    color: #285573;
    font-size: 12px;
    font-weight: 700;
}

.form-options {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
}

.form-option {
    min-height: 36px;

    padding: 7px 10px;

    display: flex;
    align-items: center;
    gap: 7px;

    border-bottom: 1px solid #edf1f4;

    font-size: 12px;

    cursor: pointer;
}

.form-option:hover {
    background: #f5faff;
}

.form-option input {
    width: 16px;
    height: 16px;
}

.form-code {
    min-width: 68px;
    color: #155789;
    font-weight: 700;
}

.form-selection-footer {
    padding: 9px;

    background: #f7f9fa;

    border-top: 1px solid #dce3e8;

    text-align: right;
}

.form-selection-footer .button {
    padding: 7px 14px;

    border: 1px solid #2879ae;
    border-radius: 4px;

    background: #2879ae;
    color: white;

    font-weight: 600;

    cursor: pointer;
}

/* ================= TABEL AUDIT ================= */

.table-wrapper {
    max-height: 540px;
}

.audit-table {
    min-width: 850px;
}

.audit-table th {
    background: #edf3f7;
    color: #36566d;

    padding: 8px;

    font-size: 12px;
}

.audit-table td {
    padding: 6px 8px;
    font-size: 12px;
}

.form-row td {
    background: #dceffb;
    color: #194b70;

    border-top: 1px solid #bdd7e8;
}

.indicator-name {
    color: #394d5b;
}

/* ================= SELECT ================= */

.yes-no {
    width: 105px;
    height: 29px;

    border: 1px solid #b9c8d3;
    border-radius: 4px;

    background: white;

    font-size: 12px;
}

/* ================= NILAI ================= */

.score-panel {
    margin-top: 10px;

    background: white;

    border: 1px solid #cbdbe6;
    border-radius: 6px;

    padding: 10px 14px;

    box-shadow: 0 1px 3px rgba(0,0,0,.04);
}

.score-title {
    font-size: 15px;
    color: #285575;
}

.score-value {
    min-width: 145px;

    padding: 7px 15px;

    border: 1px solid #aac4d6;
    border-radius: 5px;

    font-size: 21px;

    color: #155789;
    background: #f6fbfe;
}

/* ================= RESPONSIVE ================= */

@media (max-width: 900px) {

    .workspace {
        grid-template-columns: 1fr;
    }

    .patient-list {
        max-height: 280px;
    }

    .data-grid {
        grid-template-columns: 120px 1fr;
    }

    .form-options {
        grid-template-columns: 1fr;
    }

    .header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }

    .actions {
        width: 100%;
    }

    .audit-toolbar {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }
}
/* =========================================================
   FILTER + ACTION BAR
========================================================= */

.filter-bar {
    margin: 8px 15px;

    min-height: 52px;

    background: white;
    border: 1px solid #d5e0e8;
    border-radius: 6px;

    padding: 7px 10px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 15px;

    box-shadow: 0 1px 3px rgba(0,0,0,.04);
}

.filter-left {
    display: flex;
    align-items: center;
    gap: 7px;
}

.filter-left label {
    font-size: 12px;
    font-weight: 600;
    color: #31536f;
    margin-left: 3px;
}

.filter-left select {
    height: 32px;
    min-width: 105px;

    padding: 4px 8px;

    border: 1px solid #bccbd7;
    border-radius: 4px;

    background: white;

    font-size: 12px;
    color: #263f52;
}

.filter-actions {
    display: flex;
    align-items: center;
    gap: 5px;
}

.top-action {
    height: 34px;

    padding: 0 12px;

    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 4px;

    border-radius: 4px;

    font-family: Arial, Helvetica, sans-serif;
    font-size: 11px;
    font-weight: 600;

    text-decoration: none;

    cursor: pointer;

    transition: .15s;
}

.top-action:hover {
    filter: brightness(.96);
}

/* SIMPAN */

.top-action.save {
    border: 1px solid #4b91bd;
    background: #e7f4fc;
    color: #1b628e;
}

/* HAPUS */

.top-action.delete {
    border: 1px solid #d18c8c;
    background: #fceded;
    color: #a13c3c;
}

/* BATAL */

.top-action.cancel {
    border: 1px solid #aebbc4;
    background: #f3f5f6;
    color: #536572;
}

/* KELUAR */

.top-action.exit {
    border: 1px solid #9aaebb;
    background: #eef2f4;
    color: #405563;
}


/* RESPONSIVE */

@media (max-width: 900px) {

    .filter-bar {
        flex-direction: column;
        align-items: stretch;
    }

    .filter-left {
        flex-wrap: wrap;
    }

    .filter-actions {
        justify-content: flex-end;
    }

}
/* =========================================================
   WARNA BERDASARKAN JENIS AUDIT
========================================================= */

/* OPEN = HIJAU MUDA */
body.audit-open {
    background: #f1faf4;
}

body.audit-open .panel {
    background: #ffffff;
}

body.audit-open .panel-title {
    background: #e8f6ec;
    border-color: #c8e5d0;
    color: #216b3a;
}

body.audit-open .filter-bar {
    background: #f7fcf8;
    border-color: #cfe5d5;
}

body.audit-open .patient-data {
    background: #ffffff;
    border-color: #cfe3d5;
}

body.audit-open .data-label {
    background: #eef8f1;
}


/* CLOSE = MERAH MUDA */
body.audit-close {
    background: #fff4f4;
}

body.audit-close .panel {
    background: #ffffff;
}

body.audit-close .panel-title {
    background: #fdeaea;
    border-color: #efcccc;
    color: #9a3038;
}

body.audit-close .filter-bar {
    background: #fff8f8;
    border-color: #efd2d2;
}

body.audit-close .patient-data {
    background: #ffffff;
    border-color: #ead0d0;
}

body.audit-close .data-label {
    background: #fdf0f0;
}
/* =========================================================
   TOMBOL AKSI - LEBIH RAPI & MODERN
========================================================= */

.filter-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 8px;
    flex-wrap: nowrap;
}

.filter-actions .btn {
    height: 38px;
    min-width: 78px;
    padding: 0 14px;

    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;

    border-radius: 6px;
    border: 1px solid #b9cbd7;

    font-family: Arial, Helvetica, sans-serif;
    font-size: 13px;
    font-weight: 600;

    cursor: pointer;
    transition: all .15s ease;

    box-shadow: 0 1px 2px rgba(0,0,0,.04);
}

/* efek ketika mouse diarahkan */
.filter-actions .btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 3px 7px rgba(0,0,0,.10);
}

/* ketika ditekan */
.filter-actions .btn:active {
    transform: translateY(0);
    box-shadow: none;
}


/* SIMPAN */
.filter-actions .btn-save {
    background: #eaf4fb;
    border-color: #75add0;
    color: #17618e;
}

.filter-actions .btn-save:hover {
    background: #dceef9;
}


/* HAPUS */
.filter-actions .btn-delete {
    background: #fff0f2;
    border-color: #e7a0aa;
    color: #c9364d;
}

.filter-actions .btn-delete:hover {
    background: #ffe2e6;
}


/* BATAL */
.filter-actions .btn-cancel {
    background: #f3f6f8;
    border-color: #b9c8d2;
    color: #536b7b;
}

.filter-actions .btn-cancel:hover {
    background: #e7edf1;
}


/* KELUAR */
.filter-actions .btn-exit {
    background: #f7f3ef;
    border-color: #d7bda5;
    color: #8b5a35;
}

.filter-actions .btn-exit:hover {
    background: #f1e8df;
}


/* ICON */
.filter-actions .btn .icon {
    width: 17px;
    height: 17px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    font-size: 14px;
    line-height: 1;
}


/* TEKS */
.filter-actions .btn .text {
    line-height: 1;
}


/* KHUSUS OPEN */
body.audit-open .filter-actions .btn-save {
    border-color: #79bd91;
    color: #267346;
}


/* KHUSUS CLOSE */
body.audit-close .filter-actions .btn-save {
    border-color: #d28b91;
    color: #9e3038;
}

.top-toolbar {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    margin-bottom: 10px;
}

.top-toolbar .filter-left {
    display: flex;
    align-items: center;
    gap: 8px;
    flex: 1;
}

.top-toolbar .filter-left label {
    margin: 0;
    white-space: nowrap;
}

.top-toolbar .filter-left select {
    height: 38px;
    min-width: 105px;
}

.top-toolbar .filter-left select:last-child {
    min-width: 160px;
}

.top-toolbar .filter-actions {
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 0;
    flex-shrink: 0;
}

.top-toolbar .filter-actions form {
    margin: 0;
    padding: 0;
}

.top-toolbar .filter-actions .btn {
    height: 38px;
    min-width: 78px;
    padding: 0 14px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    white-space: nowrap;
}
    </style>
</head>

<body class="{{ $audit->audit_type === 'OPEN' ? 'audit-open' : 'audit-close' }}">
@if (session('success'))
    <div style="
        margin: 10px 0;
        padding: 10px 15px;
        background: #dff0d8;
        border: 1px solid #b2d8a8;
        color: #3c763d;
        border-radius: 4px;
    ">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div style="
        margin: 10px 0;
        padding: 10px 15px;
        background: #f2dede;
        border: 1px solid #ebcccc;
        color: #a94442;
        border-radius: 4px;
    ">
        {{ session('error') }}
    </div>
@endif
{{-- ================= HEADER ================= --}}

<div class="header">

    <div class="header-title">

        <h1>
            AUDIT DOKUMEN REKAM MEDIS
        </h1>

        <p>
            RSUD Prof. Dr. Margono Soekarjo Purwokerto
        </p>

    </div>

    {{-- TOMBOL LAPORAN --}}
    <a
        href="{{ url('/laporan') }}"
        class="report-button"
    >
        📊 Lihat Laporan
    </a>

</div>


{{-- ================= STATUS AUDIT ================= --}}

<div class="audit-toolbar">

    <div class="audit-current">

        @if($audit->audit_type === 'OPEN')

            🟢 AUDIT OPEN AKTIF

        @else

            🔴 AUDIT CLOSE AKTIF

        @endif

    </div>


   

</div>
{{-- ================= FILTER ================= --}}

<div class="top-toolbar">

    <div class="filter-left">

        <label>Bulan</label>
        <select name="bulan" id="bulan" onchange="applyAuditFilter()">
            @for ($i = 1; $i <= 12; $i++)
                <option value="{{ $i }}"
                    {{ (int) $bulan === $i ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                </option>
            @endfor
        </select>

        <label>Tahun</label>
        <select name="tahun" id="tahun" onchange="applyAuditFilter()">
            @foreach ($years as $year)
                <option value="{{ $year }}"
                    {{ (string) $tahun === (string) $year ? 'selected' : '' }}>
                    {{ $year }}
                </option>
            @endforeach
        </select>

        <label>Ruangan</label>
        <select name="ruangan" id="ruangan" onchange="applyAuditFilter()">
            @foreach ($rooms as $room)
                <option value="{{ $room->id }}"
                    {{ (int) $ruanganId === (int) $room->id ? 'selected' : '' }}>
                    {{ $room->name }}
                </option>
            @endforeach
        </select>

    </div>


    <div class="filter-actions">

        <button type="submit"
                form="auditForm"
                class="btn btn-save">
            💾 Simpan
        </button>

        <form method="POST"
              action="{{ route('audits.patient.delete', $audit) }}"
              onsubmit="return confirm('Hapus pasien ini?')">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-delete">
                ✕ Hapus
            </button>
        </form>

        <button type="button"
                class="btn btn-cancel"
                onclick="history.back()">
            ↩ Batal
        </button>

        <a href="{{ route('audits.index') }}"
           class="btn btn-exit">
            ⇥ Keluar
        </a>

    </div>

</div>
    {{-- ================= WORKSPACE ================= --}}

    <div class="workspace">


        {{-- ================= DAFTAR PASIEN ================= --}}

        <div class="panel">

            <div class="panel-title">
                DAFTAR PASIEN
            </div>

            <div class="patient-search">

    <input
        type="text"
        id="patientSearch"
        placeholder="Cari nama pasien / no. RM..."
    >

</div>

<form
    method="POST"
    action="{{ route('audits.patient.search') }}"
    class="api-search-form"
>
    @csrf
<input
    type="hidden"
    name="audit_id"
    value="{{ $audit->id }}"
>
    <div class="api-search-title">
        Cari No Registrasi dari SIMRS
    </div>

    <div class="api-search-row">
        <input
            type="text"
            name="noreg"
            placeholder="Masukkan No Registrasi..."
            required
        >

        <button type="submit">
            Cari
        </button>
    </div>
</form>

          <div class="patient-list">

    @foreach ($patients as $patient)

        @php
            $patientAudits = $auditTypes->get($patient->id, collect());

            $openAudit = $patientAudits->firstWhere('audit_type', 'OPEN');
            $closeAudit = $patientAudits->firstWhere('audit_type', 'CLOSE');
        @endphp

       <div
    class="patient-item patient-link
        {{ $patient->id === $audit->patient_id ? 'active' : '' }}"
    data-search="{{ strtolower($patient->nama . ' ' . $patient->no_rm) }}"
>

            {{-- NOMOR --}}

            <div class="patient-no">
                {{ $loop->iteration }}
            </div>


            {{-- INFORMASI PASIEN --}}

            <div class="patient-info">

                <div class="patient-name">
                    {{ $patient->nama }}
                </div>

                <div class="patient-rm">
                    {{ $patient->no_rm }}
                </div>


                {{-- OPEN / CLOSE --}}

               <div class="patient-audit-status">

   {{-- ================= OPEN ================= --}}

@if ($openAudit)

    <a
        href="{{ route('audits.show', $openAudit) }}"
        class="audit-mini open"
        onclick="event.stopPropagation();"
    >
        🟢 OPEN
    </a>

@else

    <form
        method="POST"
        action="{{ route('audits.type.create', ['audit' => $audit]) }}"
    
        class="audit-mini-form"
        onclick="event.stopPropagation();"
    >

        @csrf

        <input
            type="hidden"
            name="audit_type"
            value="OPEN"
        >

        <input
            type="hidden"
            name="patient_id"
            value="{{ $patient->id }}"
        >

        <input
            type="hidden"
            name="case_type"
            value="{{ $audit->case_type }}"
        >

        <input
            type="hidden"
            name="service_type"
            value="{{ $audit->patient->jenis_layanan === 'Rawat Jalan'
                ? 'RAJAL'
                : ($audit->patient->ruang_deskripsi === 'IGD'
                    ? 'IGD'
                    : ($audit->patient->ruang_deskripsi === 'VK'
                        ? 'VK'
                        : 'RAWAT INAP')) }}"
        >

        <button
            type="submit"
            class="audit-mini empty"
        >
            ⚪ OPEN
        </button>

    </form>

@endif
{{-- ================= CLOSE ================= --}}

@if ($closeAudit)

    <a
        href="{{ route('audits.show', $closeAudit) }}"
        class="audit-mini close"
        onclick="event.stopPropagation();"
    >
        🔴 CLOSE
    </a>

@else

    <form
        method="POST"
        action="{{ route('audits.type.create', ['audit' => $audit]) }}"
        class="audit-mini-form"
        onclick="event.stopPropagation();"
    >

        @csrf

        <input
            type="hidden"
            name="audit_type"
            value="CLOSE"
        >

        <input
            type="hidden"
            name="patient_id"
            value="{{ $patient->id }}"
        >

        <input
            type="hidden"
            name="case_type"
            value="{{ $audit->case_type }}"
        >

        <input
            type="hidden"
            name="service_type"
            value="{{ $audit->patient->jenis_layanan === 'Rawat Jalan'
                ? 'RAJAL'
                : ($audit->patient->ruang_deskripsi === 'IGD'
                    ? 'IGD'
                    : ($audit->patient->ruang_deskripsi === 'VK'
                        ? 'VK'
                        : 'RAWAT INAP')) }}"
        >

        <button
            type="submit"
            class="audit-mini empty"
        >
            ⚪ CLOSE
        </button>

    </form>

@endif

</div>

            </div>

        </div>

    @endforeach


            </div>

        </div>


        {{-- ================= AREA UTAMA ================= --}}

        <div class="main">


          {{-- ================= DATA PASIEN ================= --}}

<div class="patient-data panel">

    <div class="panel-title">
        {{ $audit->audit_type === 'OPEN' ? 'OPEN AUDIT' : 'CLOSE AUDIT' }}
    </div>

  <div class="data-grid">

    {{-- RUANGAN --}}
    <div class="data-label">
        Ruangan
    </div>
    <div class="data-value">
        {{ $audit->room->name ?? '-' }}
    </div>

    {{-- KASUS --}}
    <div class="data-label">
        Kasus
    </div>
    <div class="data-value">
        {{ $audit->case_type ?? '-' }}
    </div>


    {{-- NAMA --}}
    <div class="data-label">
        Nama
    </div>
    <div class="data-value">
        {{ $audit->patient->nama ?? '-' }}
    </div>

    {{-- TANGGAL --}}
    <div class="data-label">
        @if ($audit->audit_type === 'OPEN')
            Tgl Masuk
        @else
            Tgl Keluar
        @endif
    </div>

    <div class="data-value">
        @if ($audit->audit_type === 'OPEN')

            @if ($audit->patient->tanggal_masuk)
                {{ \Carbon\Carbon::parse($audit->patient->tanggal_masuk)->format('d/m/Y') }}
            @else
                -
            @endif

        @else

            @if ($audit->patient->tanggal_pulang)
                {{ \Carbon\Carbon::parse($audit->patient->tanggal_pulang)->format('d/m/Y') }}
            @else
                -
            @endif

        @endif
    </div>


    {{-- NO RM --}}
    <div class="data-label">
        No RM
    </div>
    <div class="data-value">
        {{ $audit->patient->no_rm ?? '-' }}
    </div>

    {{-- TGL AUDIT --}}
    <div class="data-label">
        Tgl Audit
    </div>
    <div class="data-value">
        @if ($audit->audit_date)
            {{ \Carbon\Carbon::parse($audit->audit_date)->format('d/m/Y') }}
        @else
            -
        @endif
    </div>


    {{-- NO REG --}}
    <div class="data-label">
        No Reg
    </div>
    <div class="data-value">
        {{ $audit->patient->registrasi_id ?? '-' }}
    </div>

    {{-- SMF --}}
    <div class="data-label">
        SMF
    </div>
    <div class="data-value">
        {{ $audit->doctor?->bagian ?? '-' }}
    </div>


    {{-- DPJP --}}
    <div class="data-label">
        DPJP
    </div>
    <div class="data-value">
        {{ $audit->doctor?->nama_dokter ?? $audit->doctor_name ?? '-' }}
    </div>


    {{-- KEADAAN PULANG HANYA UNTUK CLOSE --}}
    @if ($audit->audit_type === 'CLOSE')

        <div class="data-label">
            Keadaan Pulang
        </div>

        <div class="data-value">
            {{ $audit->patient->keadaan_pulang ?? '-' }}
        </div>

    @endif

</div>

            {{-- ================= STANDAR DOKUMEN ================= --}}

    {{-- ================= PILIH FORMULIR ================= --}}

<div class="panel form-selection">

    <div class="panel-title">
        PILIH FORMULIR AUDIT
    </div>

   <form
    method="POST"
    action="{{ route('audits.forms.update', $audit) }}"
    id="formSelectionForm"
>

        @csrf

        @php
            $selectedFormIds = $audit->auditForms
                ->pluck('form_id')
                ->toArray();
        @endphp

        @foreach (\App\Models\FormCategory::with(['forms' => function ($query) {
            $query->where('is_active', true)
                  ->orderBy('sort_order');
        }])->where('is_active', true)->get() as $category)

            <div class="form-category">

                <div class="category-title">
                    {{ $category->name }}
                </div>

                <div class="form-options">

                    @foreach ($category->forms as $form)

                        <label class="form-option">

                            <input
                                type="checkbox"
                                name="forms[]"
                                value="{{ $form->id }}"
                               {{ $audit->auditForms->contains('form_id', $form->id) ? 'checked' : '' }}
                            >

                            <span class="form-code">
                                {{ $form->code }}
                            </span>

                            <span>
                                {{ $form->name }}
                            </span>

                        </label>

                    @endforeach

                </div>

            </div>

        @endforeach

        <div class="form-selection-footer">

            <button
                type="submit"
                class="button"
            >
                Terapkan Formulir
            </button>

        </div>

    </form>

</div>
<form
    method="POST"
    action="{{ route('audits.update', $audit) }}"
    id="auditForm"
>
    @csrf
            <div class="document-panel">

                <div class="panel-title">
                    STANDAR DOKUMEN
                </div>

                <div class="table-wrapper">

                    <table class="audit-table">

                        <thead>

                            <tr>

                                <th class="indicator-number">
                                    No
                                </th>

                                <th class="form-check">
                                    Ya / Tidak
                                </th>

                                <th class="code-column">
                                    Kode
                                </th>

                                <th>
                                    Standar Dokumen / Indikator
                                </th>

                                <th class="select-column">
                                    Terbaca
                                </th>

                                <th class="select-column">
                                    Lengkap
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($audit->auditForms as $auditForm)

                                {{-- FORM --}}

                                <tr class="form-row">

                                    <td class="indicator-number">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="form-check">

                                        <input
                                            type="checkbox"
                                            class="checkbox form-checkbox"
                                            data-form="{{ $auditForm->id }}"
                                            checked
                                        >

                                    </td>

                                    <td class="code-column">

                                        {{ $auditForm->form->code }}

                                    </td>

                                    <td colspan="3">

                                        {{ $auditForm->form->name }}

                                    </td>

                                </tr>


                                {{-- INDIKATOR --}}

                                @foreach ($auditForm->indicators as $auditIndicator)

                                    <tr
                                        class="indicator-row"
                                        data-form="{{ $auditForm->id }}"
                                    >

                                        <td class="indicator-number">

                                            {{ $loop->parent->iteration }}.{{
                                                $loop->iteration
                                            }}

                                        </td>

                                        <td class="form-check">

                                           <input
    type="checkbox"
    class="checkbox indicator-checkbox"
    name="indicators[{{ $auditIndicator->id }}][answer]"
    value="Ya"
    {{ $auditIndicator->answer === 'Ya' ? 'checked' : '' }}
>

                                        </td>

                                        <td></td>

                                        <td class="indicator-name">

                                            {{ $auditIndicator->indicator->name }}

                                        </td>

                                        <td class="select-column">

                                            <select
    class="yes-no terbaca"
    name="indicators[{{ $auditIndicator->id }}][terbaca]"
>

    <option
        value="Ya"
        {{ $auditIndicator->terbaca === 'Ya' ? 'selected' : '' }}
    >
        Ya
    </option>

    <option
        value="Tidak"
        {{ $auditIndicator->terbaca === 'Tidak' ? 'selected' : '' }}
    >
        Tidak
    </option>

</select>

                                        </td>

                                        <td class="select-column">

                                            <select
    class="yes-no lengkap"
    name="indicators[{{ $auditIndicator->id }}][lengkap]"
>

    <option
        value="Ya"
        {{ $auditIndicator->lengkap === 'Ya' ? 'selected' : '' }}
    >
        Ya
    </option>

    <option
        value="Tidak"
        {{ $auditIndicator->lengkap === 'Tidak' ? 'selected' : '' }}
    >
        Tidak
    </option>

</select>

                                        </td>

                                    </tr>

                                @endforeach

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- ================= NILAI ================= --}}

            <div class="score-panel">

    <div class="score-title">
        Nilai Audit
    </div>

    <div
        class="score-value"
        id="scoreValue"
    >
        100 %
    </div>

   

</div>

</form>

            </div>

  

    {{-- ================= JAVASCRIPT ================= --}}

    <script>

        /*
         * SEARCH PASIEN
         */

        /*
 * SEARCH PASIEN
 */

const patientSearch = document.getElementById('patientSearch');

if (patientSearch) {

    patientSearch.addEventListener('input', function () {

        const keyword = this.value
            .toLowerCase()
            .trim();

        document
            .querySelectorAll('.patient-link')
            .forEach(function (patient) {

                const text = (
                    patient.dataset.search || ''
                ).toLowerCase();

                if (text.includes(keyword)) {

                    patient.style.display = 'flex';

                } else {

                    patient.style.display = 'none';

                }

            });

    });

}


        /*
         * CHECKBOX FORM
         *
         * Kalau checkbox formulir dicentang,
         * semua indikator di dalam formulir ikut dicentang.
         */

        document
            .querySelectorAll('.form-checkbox')
            .forEach(function (formCheckbox) {

                formCheckbox.addEventListener(
                    'change',
                    function () {

                        const formId =
                            this.dataset.form;

                        document
                            .querySelectorAll(
                                '.indicator-row[data-form="' +
                                formId +
                                '"] .indicator-checkbox'
                            )
                            .forEach(function (checkbox) {

                                checkbox.checked =
                                    formCheckbox.checked;

                            });

                        calculateScore();

                    }
                );

            });


        /*
         * CHECKBOX INDIKATOR
         */

        document
            .querySelectorAll('.indicator-checkbox')
            .forEach(function (checkbox) {

                checkbox.addEventListener(
                    'change',
                    function () {

                        calculateScore();

                    }
                );

            });


        /*
         * TERBACA & LENGKAP
         */

        document
            .querySelectorAll('.terbaca, .lengkap')
            .forEach(function (select) {

                select.addEventListener(
                    'change',
                    function () {

                        calculateScore();

                    }
                );

            });


        /*
         * HITUNG NILAI
         *
         * Indikator bernilai 1 jika:
         *
         * ☑ dicentang
         * Terbaca = Ya
         * Lengkap = Ya
         */

        function calculateScore() {

            const rows =
                document.querySelectorAll('.indicator-row');

            if (rows.length === 0) {

                document.getElementById('scoreValue')
                    .textContent = '0 %';

                return;

            }

            let total = rows.length;
            let memenuhi = 0;

            rows.forEach(function (row) {

                const checkbox =
                    row.querySelector('.indicator-checkbox');

                const terbaca =
                    row.querySelector('.terbaca');

                const lengkap =
                    row.querySelector('.lengkap');

                if (
                    checkbox.checked &&
                    terbaca.value === 'Ya' &&
                    lengkap.value === 'Ya'
                ) {

                    memenuhi++;

                }

            });

            const score =
                (memenuhi / total) * 100;

            document.getElementById('scoreValue')
                .textContent =
                score.toFixed(2) + ' %';

        }


        /*
         * HITUNG SAAT HALAMAN DIBUKA
         */

        calculateScore();
    </script>
<script>
function applyAuditFilter() {

    const bulan = document.getElementById('bulan').value;
    const tahun = document.getElementById('tahun').value;
    const ruangan = document.getElementById('ruangan').value;

    const url = new URL(
        "{{ route('audits.show', $audit) }}",
        window.location.origin
    );

    url.searchParams.set('bulan', bulan);
    url.searchParams.set('tahun', tahun);
    url.searchParams.set('ruangan', ruangan);

    window.location.href = url.toString();
}
</script>
</body>

</html>