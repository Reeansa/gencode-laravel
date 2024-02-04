<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CustomStatusCheckMiddleware
{
    public function handle( $request, Closure $next )
    {
        // Periksa apakah pengguna sudah login
        if ( Auth::check() ) {
            // Ambil data pengguna yang sedang login
            $user = Auth::user();

            // Periksa apakah status pengguna adalah nonaktif
            if ( $user->status == 0 ) {
                // Jika ya, lakukan logout
                Auth::logout();

                // Redirect ke halaman login atau halaman lain yang sesuai
                return redirect( '/login' )->with( 'error', 'Akun nonaktif. Silakan login kembali.' );
            }
        }

        return $next( $request );
    }
}