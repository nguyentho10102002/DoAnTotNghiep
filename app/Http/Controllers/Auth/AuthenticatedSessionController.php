<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->regenerateToken();

        $request->authenticate();

        $request->session()->regenerate();

        if($request->user()->status === 'inactive'){
            Auth::guard('web')->logout();
            $request->session()->regenerateToken();
            toastr('Tài khoản đã bị cấm hoặc có lỗi vui lòng liên hệ bộ phận hỗ trợ!', 'error', 'Account Banned!');
            return redirect('/');
        }

        if($request->user()->role === 'admin'){
            return redirect()->intended('/admin/dashboard');
        }elseif($request->user()->role === 'vendor'){
            return redirect()->intended('/vendor/dashboard');
        }

        return redirect()->intended(RouteServiceProvider::HOME);
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
