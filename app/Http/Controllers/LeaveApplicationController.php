<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Schedule;
use App\Models\Shift;
use App\Models\ShiftLeader;
use App\Models\ShiftReport;
use App\Notifications\shiftReportNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LeaveApplicationController extends Controller
{
    protected $prefix;

    public function __construct()
    {
        if (Auth::guard('admin')->check()) {
            $this->prefix = 'admin';
        } elseif (Auth::guard('shift_leader')->check()) {
            $this->prefix = 'shift-leader';
        } elseif (Auth::guard('employee')->check()) {
            $this->prefix = 'employee';
        } else {
            abort(403, 'Unauthorized');
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $isAdmin = auth()->guard('admin')->check();

        $reportsQuery = ShiftReport::query()
            ->with([
                'employee',
                'fromShift',
                'toShift',
                'shiftChange'
            ])->where('type', 'change')->whereHas('shiftChange', function ($query) {
                $query->where('status', 'pending');
            })
            ->with([
                'shiftChange' => function ($query) {
                    $query->where('status', 'pending');
                }
            ]);

        // Jika bukan admin, filter hanya yang statusnya pending dan milik user terkait
        if (!$isAdmin) {
            $reportsQuery->where('employee_id', $user->id)
                ->where('type', 'change')
                ->whereHas('shiftChange', function ($query) {
                    $query->where('status', 'pending');
                })
                ->with([
                    'shiftChange' => function ($query) {
                        $query->where('status', 'pending');
                    }
                ]);
        }

        $reports = $reportsQuery->latest()->get();

        return view('pages.leave-application.index', compact('reports'));
    }

    public function create()
    {
        // $employees = Employee::with(['schedules' => function ($query) {
        //     $query->orderBy('date', 'desc')->with('shift');
        // }])->where('id', '!=', auth()->user()->id)->get();

        // ambil hanya karyawan dengan jadwal aktif sekarang
        $employees = Employee::where('id', '!=', auth()->user()->id)
            ->whereHas('schedules', function ($query) {
                $query->whereDate('date', now());
            })
            ->with(['schedules' => function ($query) {
                $query->whereDate('date', now())->with('shift');
            }])
            ->get();

        $shifts = Shift::all();

        return view('pages.leave-application.create', compact('employees', 'shifts'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'from_employee_id' => 'required|exists:employees,id',
            'from_shift_id' => 'required|exists:shifts,id',
            'to_shift_id' => 'required|exists:shifts,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'division' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $shiftReport = ShiftReport::create([
            'from_employee_id' => $request->from_employee_id,
            'employee_id' => $request->user()->id,
            'from_shift_id' => $request->from_shift_id,
            'to_shift_id' => $request->to_shift_id,
            'title' => $request->title,
            'description' => $request->description,
            'time' => $request->time,
            'division' => $request->division,
            'address' => $request->address,
            'image' => $request->image
        ]);

        $shiftReport->shiftChange()->updateOrCreate(
            [], // Karena hasOne, tidak perlu kondisi spesifik
            [
                'status' => 'pending',
                'approved_by' => null,
                'approved_at' => null,
            ]
        );

        if ($shiftReport->from_shift_id === $shiftReport->to_shift_id) {
            return back()->withErrors(['error' => 'Shift yang dipilih tidak boleh sama.']);
        }

        if (!$shiftReport) {
            return back()->withErrors(['error' => 'Gagal mengajukan perubahan shift.']);
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/shift_reports', 'public');
            $shiftReport->image = $imagePath;
            $shiftReport->save();
        }

        $shiftLeaders = ShiftLeader::all();

        foreach ($shiftLeaders as $shiftLeader) {
            $shiftLeader->notify(new ShiftReportNotification($shiftReport->id, auth()->user()->name, $shiftReport->time, $shiftReport->description));
        }

        return redirect()->route('employee.leave-application.index')->with('success', 'Pengajuan perubahan shift berhasil diajukan. Mohon tunggu konfirmasi dari atasan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $shiftReport = ShiftReport::findOrFail($id);
        return view('pages.leave-application.show', compact('shiftReport'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'from_shift_id' => 'required|exists:shifts,id',
            'to_shift_id' => 'required|exists:shifts,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'division' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $shiftReport = ShiftReport::findOrFail($id);
        $shiftReport->from_shift_id = $request->from_shift_id;
        $shiftReport->to_shift_id = $request->to_shift_id;
        $shiftReport->title = $request->title;
        $shiftReport->description = $request->description;
        $shiftReport->address = $request->address;
        $shiftReport->division = $request->division;

        if ($request->hasFile('image')) {
            if ($shiftReport->image) {
                Storage::disk('public')->delete($shiftReport->image);
            }
            $imagePath = $request->file('image')->store('images/shift_reports', 'public');
            $shiftReport->image = $imagePath;
        }

        if (!$shiftReport->save()) {
            return back()->withErrors(['error' => 'Gagal memperbarui pengajuan perubahan shift.']);
        }

        return back()->with('success', 'Pengajuan perubahan shift berhasil diperbarui.');
    }

    public function edit($id)
    {
        $report = ShiftReport::findOrFail($id);

        $employees = Employee::where('id', '!=', auth()->user()->id)
            ->whereHas('schedules', function ($query) {
                $query->whereDate('date', now());
            })
            ->with(['schedules' => function ($query) {
                $query->whereDate('date', now())->with('shift');
            }])
            ->get();

        $shifts = Shift::all();

        return view('pages.leave-application.edit', compact('report', 'shifts', 'employees'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shiftReport = ShiftReport::findOrFail($id);

        DatabaseNotification::where('type', ShiftReportNotification::class)
            ->where('data->report_id', $shiftReport->id)
            ->delete();

        if ($shiftReport->image) {
            Storage::disk('public')->delete($shiftReport->image);
        }

        if (!$shiftReport->delete()) {
            return back()->withErrors(['error' => 'Gagal menghapus pengajuan perubahan shift.']);
        }

        return back()->with('success', 'Pengajuan perubahan shift berhasil dihapus.');
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
