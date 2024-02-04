<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Artisan;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        // Artisan::call( 'storage:link' );
        if ( Auth::check() ) {
            return redirect()->route('dashboard');
        } else {
            return view( 'administrator.auth.login' );
        }
    }

    public function authenticate( Request $request ): RedirectResponse
    {
        $credentials = $request->validate( [ 
            'email'    => [ 'required', 'email' ],
            'password' => [ 'required', 'min:6' ],
        ] );

        $user = User::where( 'email', $request->input( 'email' ) )->first();

        if ( $user && $user->status == 1 && Auth::attempt( $credentials ) ) {
            $request->session()->regenerate();
            return redirect()->intended( 'administrator/dashboard' )->with( [ 
                'type'    => 'Login',
                'success' => 'Anda telah berhasil masuk, selamat datang ' . $user->first_name . ' ' . $user->last_name,
            ] );
        }

        if ( $user && $user->status == 0 ) {
            return back()->with( [ 'error' => 'Akun telah di nonaktif, hubungi administrator untuk aktivasi' ] );
        }

        return back()->with( [ 'error' => 'Email atau password salah!' ] );
    }

    public function logout( Request $request ): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route( 'login' )->with( [ 
            'type'    => 'Keluar',
            'success' => 'Anda telah berhasil keluar'
        ] );
    }


}
