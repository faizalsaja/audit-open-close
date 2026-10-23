<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\AuditFormController;
use App\Http\Controllers\ReportController;
use App\Exports\AuditReportExport;
use Maatwebsite\Excel\Facades\Excel;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/audits', [AuditController::class, 'index'])
    ->name('audits.index');

Route::post('/audits/search-patient', [AuditFormController::class, 'searchPatient'])
    ->name('audits.patient.search');

    Route::post('/audits/use-patient', [AuditFormController::class, 'usePatient'])
    ->name('audits.patient.use');
    Route::get('/audits/create', function () {
    return view('audits.create');
})->name('audits.create');

Route::get('/laporan', [ReportController::class, 'index'])
    ->name('reports.index');
Route::get('/laporan/download', function (\Illuminate\Http\Request $request) {
    $fileName = 'Laporan_Audit_Rekam_Medis_' . now()->format('Ymd_His') . '.xlsx';

    return Excel::download(
        new AuditReportExport($request),
        $fileName
    );
})->name('reports.download');
Route::get('/audits/{audit}', [AuditFormController::class, 'show'])
    ->name('audits.show');

Route::post('/audits/{audit}', [AuditFormController::class, 'update'])
    ->name('audits.update');
    Route::delete('/audits/{audit}/patient', [AuditFormController::class, 'deletePatient'])
    ->name('audits.patient.delete');

Route::post('/audits/{audit}/forms', [AuditFormController::class, 'updateForms'])
    ->name('audits.forms.update');

Route::post('/audits/{audit}/status', [AuditFormController::class, 'updateStatus'])
    ->name('audits.status.update');

Route::post('/audits/{audit}/type', [AuditFormController::class, 'createType'])
    ->name('audits.type.create');
    Route::post('/audits/{audit}/close', [AuditFormController::class, 'storeClose'])
    ->name('audits.close.store');