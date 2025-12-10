<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => false,
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();
        
        // Redirect based on role
        if ($user->role) {
            switch ($user->role->name) {
                case 'Admin':
                    return redirect()->intended(route('dashboard.admin'));
                case 'Branch Manager':
                    return redirect()->intended(route('dashboard.manager'));
                case 'Accountant':
                    return redirect()->intended(route('dashboard.accountant'));
                case 'Warden':
                    return redirect()->intended(route('dashboard.warden'));
                case 'Resident':
                    return redirect()->intended(route('dashboard.resident'));
                default:
                    return redirect()->intended(route('dashboard'));
            }
        }

        return redirect()->intended(route('dashboard'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}