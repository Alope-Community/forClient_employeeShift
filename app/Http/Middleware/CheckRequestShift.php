<?php

namespace App\Http\Middleware;

use App\Models\Schedule;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRequestShift
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $now = Carbon::now();

        $employee = $request->user();

        if ($employee) {
            $schedule = Schedule::where('employee_id', $employee->id)
                ->whereDate('date', now())
                ->orderBy('created_at', 'desc')
                ->first();

            // dd($schedule);

            if ($schedule) {
                $scheduleTime = Carbon::parse($schedule->date);
                $cutoffTime = $scheduleTime->copy()->subHours(3);

                if ($now->gte($cutoffTime)) {
                    return redirect()->back()->withErrors([
                        'shift' => __('Mohon maaf, pengajuan shift hanya dapat dilakukan paling lambat 3 jam sebelum waktu mulai.'),
                    ]);
                }
            }
        }

        return $next($request);
    }
}
