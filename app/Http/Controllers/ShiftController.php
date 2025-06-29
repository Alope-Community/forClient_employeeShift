<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shifts = Shift::all();

        return view('pages.data-shift.index', compact('shifts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.data-shift.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'group' => 'required|string|max:255|unique:shifts,group',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i',
            ], [
                'group.unique' => 'Group shift sudah ada, silakan gunakan nama group yang berbeda.',
            ]);

            $start = \Carbon\Carbon::createFromFormat('H:i', $request->start_time);
            $end = \Carbon\Carbon::createFromFormat('H:i', $request->end_time);

            // tambah hari untuk shift malam
            if ($end->lessThanOrEqualTo($start)) {
                $end->addDay();
            }

            // Hitung durasi dalam jam
            $durationInHours = $start->diffInHours($end);

            // Validasi durasi harus 8 jam
            if ($durationInHours != 8) {
                return redirect()->back()->withErrors(['error' => 'Durasi shift harus tepat 8 jam.']);
            }

            Shift::create([
                'name' => $request->name,
                'group' => $request->group,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ]);

            $isAdmin = auth()->guard('admin')->check();

            if ($isAdmin) {
                return redirect()->route('admin.shift.index')->with('success', 'Shift created successfully.');
            }

            return redirect()->route('shift-leader.shift.index')->with('success', 'Shift created successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $shift = Shift::findOrFail($id);

        return view('pages.data-shift.edit', compact('shift'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $shift = Shift::findOrFail($id);

        return view('pages.data-shift.show', compact('shift'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'group' => 'required|string|max:255|unique:shifts,group,' . $id,
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i',
            ], [
                'group.unique' => 'Group shift sudah ada, silakan gunakan nama group yang berbeda.',
            ]);

            $start = \Carbon\Carbon::createFromFormat('H:i', $request->start_time);
            $end = \Carbon\Carbon::createFromFormat('H:i', $request->end_time);

            // tambah hari untuk shift malam
            if ($end->lessThanOrEqualTo($start)) {
                $end->addDay();
            }

            // Hitung durasi dalam jam
            $durationInHours = $start->diffInHours($end);

            // Validasi durasi harus 8 jam
            if ($durationInHours != 8) {
                return redirect()->back()->withErrors(['error' => 'Durasi shift harus tepat 8 jam.']);
            }

            $shift = Shift::findOrFail($id);

            $shift->update([
                'name' => $request->name,
                'group' => $request->group,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ]);

            $isAdmin = auth()->guard('admin')->check();

            if ($isAdmin) {
                return redirect()->route('admin.shift.index')->with('success', 'Shift updated successfully.');
            }
            return redirect()->route('shift-leader.shift.index')->with('success', 'Shift updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $shift = Shift::findOrFail($id);
            $shift->delete();

            $isAdmin = auth()->guard('admin')->check();

            if ($isAdmin) {
                return redirect()->route('admin.shift.index')->with('success', 'Shift deleted successfully.');
            }
            return redirect()->route('shift-leader.shift.index')->with('success', 'Shift deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'An error occurred while deleting the shift: ' . $th->getMessage());
        }
    }
}
