<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        try {
            $user = auth()->user();
            if (!$user) {
                return redirect()->back()->with('error', 'User Not Defined');
            }

            return view('pages.data-user.index', [
                'user' => $user
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
