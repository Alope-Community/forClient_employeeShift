<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\ShiftLeader;
use App\Models\ShiftReport;
use App\Notifications\shiftReportNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LeaveApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $reports = ShiftReport::where('employee_id', $request->user()->id)
            ->whereHas('shiftChange', function ($query) {
                $query->where('status', 'pending');
            })
            ->with([
                'employee',
                'fromShift',
                'toShift',
                'shiftChange' => function ($query) {
                    $query->where('status', 'pending');
                }
            ])
            ->latest()
            ->get();

        return view('pages.leave-application.index', compact('reports'));
    }

    public function create()
    {
        $shifts = Shift::all();
        return view('pages.leave-application.create', compact('shifts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'from_shift_id' => 'required|exists:shifts,id',
            'to_shift_id' => 'required|exists:shifts,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $shiftReport = ShiftReport::create([
            'employee_id' => $request->user()->id,
            'from_shift_id' => $request->from_shift_id,
            'to_shift_id' => $request->to_shift_id,
            'title' => $request->title,
            'description' => $request->description,
            'time' => now(),
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

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/shift_reports', 'public');
            $shiftReport->image = $imagePath;
            $shiftReport->save();
        }

        if (!$shiftReport) {
            return back()->withErrors(['error' => 'Gagal mengajukan perubahan shift.']);
        }

        $shiftLeaders = ShiftLeader::all();

        foreach ($shiftLeaders as $shiftLeader) {
            $shiftLeader->notify(new ShiftReportNotification(auth()->user()->name, $shiftReport->time, $shiftReport->description));
        }

        return back()->with('success', 'Pengajuan perubahan shift berhasil diajukan. Mohon tunggu konfirmasi dari atasan.');
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $shiftReport = shiftReport::findOrFail($id);
        $shiftReport->from_shift_id = $request->from_shift_id;
        $shiftReport->to_shift_id = $request->to_shift_id;
        $shiftReport->title = $request->title;
        $shiftReport->description = $request->description;
        $shiftReport->address = $request->address;

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
        $shifts = Shift::all();

        return view('pages.leave-application.edit', compact('report', 'shifts'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shiftReport = shiftReport::findOrFail($id);

        if ($shiftReport->image) {
            Storage::disk('public')->delete($shiftReport->image);
        }

        if (!$shiftReport->delete()) {
            return back()->withErrors(['error' => 'Gagal menghapus pengajuan perubahan shift.']);
        }

        return back()->with('success', 'Pengajuan perubahan shift berhasil dihapus.');
    }
}
