<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    // Display branch managers
    public function branchManagers()
    {
        $branchManagers = User::whereHas('role', function($query) {
            $query->where('name', 'Branch Manager');
        })->with(['role', 'branch'])->latest()->get();

        $branches = Branch::all();

        return Inertia::render('Users/BranchManagers', [
            'branchManagers' => $branchManagers,
            'branches' => $branches,
            'stats' => [
                'activeBranches' => Branch::count(),
                'thisMonth' => User::whereHas('role', fn($q) => $q->where('name', 'Branch Manager'))
                    ->where('created_at', '>=', now()->subMonth())->count(),
                'assignedBranches' => User::whereHas('role', fn($q) => $q->where('name', 'Branch Manager'))
                    ->whereNotNull('branch_id')->count()
            ]
        ]);
    }

    // Store new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'branch_id' => 'nullable|exists:branches,id',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'branch_id' => $request->branch_id,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'created_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'User created successfully.');
    }

    // Update user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'branch_id' => 'nullable|exists:branches,id',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'branch_id' => $request->branch_id,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->back()->with('success', 'User updated successfully.');
    }

    // Delete user
    public function destroy(User $user)
    {
        $user->delete();
        
        return redirect()->back()->with('success', 'User deleted successfully.');
    }
}