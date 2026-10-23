<?php

namespace App\Http\Controllers;

use App\Models\Audit;

class AuditController extends Controller
{
    public function index()
    {
        $audits = Audit::with(['patient', 'room'])
            ->latest()
            ->get();

        return view('audits.index', compact('audits'));
    }
}