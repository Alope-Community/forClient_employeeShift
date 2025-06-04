<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    protected function detectPrefix()
    {
        foreach (['admin', 'shift_leader', 'employee'] as $guard) {
            if (Auth::guard($guard)->check()) {
                return $guard === 'shift_leader' ? 'shift-leader' : $guard;
            }
        }

        abort(403, 'Unauthorized');
    }

    protected function detectGuard()
    {
        foreach (['admin', 'shift_leader', 'employee'] as $guard) {
            if (Auth::guard($guard)->check()) {
                return $guard;
            }
        }

        abort(403, 'Unauthorized');
    }


    /**
     * Display the profile of the authenticated user.
     */
    public function index()
    {
        $user = Auth::user();

        return view("pages.profile.index", compact('user'));
    }

    /**
     * Show the form for editing the profile.
     */
    public function edit()
    {
        $user = Auth::user();

        return view('pages.profile.edit', compact('user'));
    }

    /**
     * Update the profile of the authenticated user.
     */
    public function update(Request $request)
    {
        try {
            $guard = $this->detectGuard();
            $prefix = $this->detectPrefix();
            $user = Auth::guard($guard)->user();
            $table = $user->getTable(); // Ambil nama tabel dari model

            $rules = [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:' . $table . ',email,' . $user->id,
                'password' => 'nullable|string|min:8|confirmed',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            ];

            // Hanya validasi ini jika bukan admin
            if ($guard !== 'admin') {
                $rules['username'] = 'required|string|max:255|unique:' . $table . ',username,' . $user->id;
                $rules['gender'] = 'required|in:Pria,Wanita';
                $rules['phone_number'] = 'required|string|max:15';
            }

            $validated = $request->validate($rules);

            if (!empty($validated['password'])) {
                $validated['password'] = bcrypt($validated['password']);
            } else {
                unset($validated['password']); // Jangan ubah password jika kosong
            }

            if ($request->hasFile('photo')) {
                $imagePath = $request->file('photo')->store('images/profile', 'public');
                $validated['photo'] = $imagePath;
            }

            $user->update($validated);

            return redirect()->route($prefix . '.profile.index')->with('success', 'Profil berhasil diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors([
                'error' => 'Terjadi kesalahan saat memperbarui profil: ' . $th->getMessage(),
            ]);
        }
    }
}
