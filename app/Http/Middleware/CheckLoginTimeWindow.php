<?php

namespace App\Http\Middleware;

use App\Models\Schedule;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLoginTimeWindow
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $now = Carbon::now();

        $email = $request->input('email');
        $employee = \App\Models\Employee::where('email', $email)->first();

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
                        'login' => 'Login ditutup 3 jam sebelum shift dimulai.',
                    ]);
                }
            }
        }

        return $next($request);
    }
}
