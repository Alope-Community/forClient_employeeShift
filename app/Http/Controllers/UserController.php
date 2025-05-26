<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\ShiftLeader;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = User::all();
        $shiftLeaders = ShiftLeader::all();
        $employees = Employee::all();

        $users = $admins->map(fn($u) => ['model' => $u, 'role' => 'Admin'])
            ->merge($shiftLeaders->map(fn($u) => ['model' => $u, 'role' => 'Shift Leader']))
            ->merge($employees->map(fn($u) => ['model' => $u, 'role' => 'Employee']));

        return view('pages.data-user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.data-user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,shift_leader,employee',
            'username' => 'required_if:role,employee,shift_leader|nullable|string|max:255',
            'gender' => 'required_if:role,employee,shift_leader|nullable|in:Pria,Wanita',
            'address' => 'required_if:role,employee,shift_leader|nullable|string|max:255',
            'phone_number' => 'required_if:role,employee,shift_leader|nullable|string|max:20',
        ]);

        try {
            if ($request->role === 'admin') {
                User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                ]);
            } elseif ($request->role === 'shift_leader') {
                ShiftLeader::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'username' => $request->username,
                    'gender' => $request->gender,
                    'address' => $request->address,
                    'phone_number' => $request->phone_number,
                    'password' => bcrypt($request->password),
                ]);
            } else {
                Employee::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'username' => $request->username,
                    'gender' => $request->gender,
                    'address' => $request->address,
                    'phone_number' => $request->phone_number,
                    'password' => bcrypt($request->password),
                ]);
            }

            return redirect()->route('data.user.index')->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Gagal menyimpan data user: ' . $e->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id, $role)
    {
        switch ($role) {
            case 'admin':
                $user = User::findOrFail($id);
                break;
            case 'shift_leader':
                $user = ShiftLeader::findOrFail($id);
                break;
            case 'employee':
                $user = Employee::findOrFail($id);
                break;
            default:
                abort(404);
        }

        return view('pages.data-user.show', compact('user', 'role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, string $role)
    {
        switch ($role) {
            case 'admin':
                $user = User::findOrFail($id);
                break;
            case 'shift_leader':
                $user = ShiftLeader::findOrFail($id);
                break;
            case 'employee':
                $user = Employee::findOrFail($id);
                break;
            default:
                abort(404);
        }

        return view('pages.data-user.edit', compact('user', 'role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, string $role)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => "required|string|email|max:255|unique:users,email,{$id}",
            'role' => 'required|in:admin,shift_leader,employee',
            'username' => 'required_if:role,employee,shift_leader|nullable|string|max:255',
            'gender' => 'required_if:role,employee,shift_leader|nullable|in:Pria,Wanita',
            'address' => 'required_if:role,employee,shift_leader|nullable|string|max:255',
            'phone_number' => 'required_if:role,employee,shift_leader|nullable|string|max:20',
            'password' => 'nullable|string|min:8|confirmed', // password tidak wajib diupdate
        ];

        $request->validate($rules);

        switch ($role) {
            case 'admin':
                $user = User::findOrFail($id);
                break;
            case 'shift_leader':
                $user = ShiftLeader::findOrFail($id);
                break;
            case 'employee':
                $user = Employee::findOrFail($id);
                break;
            default:
                abort(404);
        }

        try {
            $user->name = $request->name;
            $user->email = $request->email;

            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }

            if (in_array($role, ['shift_leader', 'employee'])) {
                $user->username = $request->username;
                $user->gender = $request->gender;
                $user->address = $request->address;
                $user->phone_number = $request->phone_number;
            }

            $user->save();

            return redirect()->route('data.user.index')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Gagal mengupdate user: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, string $role)
    {
        switch ($role) {
            case 'admin':
                $user = User::findOrFail($id);
                break;
            case 'shift_leader':
                $user = ShiftLeader::findOrFail($id);
                break;
            case 'employee':
                $user = Employee::findOrFail($id);
                break;
            default:
                abort(404);
        }

        try {
            $user->delete();
            return redirect()->route('data.user.index')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus user: ' . $e->getMessage()]);
        }
    }
}
