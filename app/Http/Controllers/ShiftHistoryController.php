<?php

namespace App\Http\Controllers;

use App\Models\ShiftReport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ShiftHistoryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $user = auth()->user();
        $isAdmin = auth()->guard('admin')->check();

        $reportsQuery = \App\Models\ShiftReport::query()
            ->with(['shiftChange']);

        // Jika bukan admin, filter hanya yang statusnya pending dan milik user terkait
        if (!$isAdmin) {
            $reportsQuery->where('employee_id', $user->id)
                ->whereHas('shiftChange', function ($query) {
                    $query->whereNot('status', 'pending')->where('type', 'change');
                })
                ->with([
                    'shiftChange' => function ($query) {
                        $query->whereNot('status', 'pending');
                    }
                ]);
        }

        $reports = $reportsQuery->latest()->get();

        return view("pages.data-riwayat-shift.index", compact('reports'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $report = \App\Models\ShiftReport::with([
            'employee',
            'fromShift',
            'toShift',
            'shiftChange'
        ])->findOrFail($id);

        $isAdmin = auth()->guard('admin')->check();
        $user = auth()->user();

        // Jika bukan admin, pastikan laporan milik user terkait
        if (!$isAdmin && $report->employee_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        return view("pages.data-riwayat-shift.show", compact('report'));
    }
    
    public function download($id)
    {
        $report = ShiftReport::with(['employee', 'fromEmployee', 'fromShift', 'toShift', 'shiftChange'])->findOrFail($id);

        $pdf = Pdf::loadView('pdf.shift-report', compact('report'))
            ->setOption([
                'fontDir' => storage_path('/fonts'),
                'fontCache' => storage_path('/fonts'),
                'defaultFont' => 'Noto Sans SC'
            ]);;

        return $pdf->download('riwayat-pergantian-shift-' . $report->employee->name . '.pdf');
    }
}
