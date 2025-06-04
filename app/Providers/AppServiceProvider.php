<?php

namespace App\Providers;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

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
        App::setLocale(Session::get('locale', config('app.locale')));

        Authenticate::redirectUsing(function ($request) {
            $prefix = $request->route() ? $request->route()->getPrefix() : null;

            if ($prefix === '/employee' || $prefix === '/auth/employee') {
                $prefix = 'employee';
            }

            if ($prefix === '/leader' || $prefix === '/auth/leader') {
                $prefix = 'shift_leader';
            }

            if ($prefix === '/admin' || $prefix === '/auth/admin') {
                $prefix = 'admin';
            }

            if ($prefix === 'employee') {
                return route('employee.login.view');
            } else if ($prefix === 'shift_leader') {
                return route('shift-leader.login.view');
            } else if ($prefix === 'admin') {
                return route('admin.login.view');
            }
            
            return route('employee.login.view');
        });
    }
}
