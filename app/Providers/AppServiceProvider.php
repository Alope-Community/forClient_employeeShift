<?php

namespace App\Providers;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Authenticate::redirectUsing(function ($request) {
            $prefix = $request->route() ? $request->route()->getPrefix() : null;

            if ($prefix === '/employee' || $prefix === '/auth/employee') {
                $prefix = 'employee';
            }

            if ($prefix === '/leader' || $prefix === '/auth/leader') {
                $prefix = 'shift_leader';
            }

            if ($prefix === 'employee') {
                return route('employee.login.view');
            } else if ($prefix === 'shift_leader') {
                return route('shift-leader.login.view');
            }
            
            return route('employee.login.view');
        });
    }
}
