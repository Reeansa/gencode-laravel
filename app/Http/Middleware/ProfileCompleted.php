<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ProfileCompleted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ( $user && $this->profileIsComplete( $user ) ) {
            return $next( $request );
        }

        return redirect()->route( 'dashboard' )->with([ 
            'type' => 'Halaman Produk',
            'error' => 'Silakan lengkapi profil Anda terlebih dahulu!'
        ]);
    }

    private function profileIsComplete( $user )
    {
        return !empty( $user->first_name ) && !empty( $user->last_name ) && !empty( $user->address ) && !empty( $user->phone );
    }
}
