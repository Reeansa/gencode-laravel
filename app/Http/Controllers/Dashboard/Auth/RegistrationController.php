<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    public function registration(): View
    {
        return view( 'administrator.auth.registration' );
    }

    public function registering( Request $request ): RedirectResponse
    {
        $request->validate( [ 
            'firstName'       => [ 'required' ],
            'lastName'        => [ 'required' ],
            'email'           => [ 'required', 'email', 'unique:users,email' ],
            'password'        => [ 'required', 'min:6' ],
            'confirmPassword' => [ 'required', 'min:6', 'same:password' ],
        ] );

        $data = [ 
            'roles_id'   => 2,
            'first_name' => $request->input('firstName'),
            'last_name'  => $request->input('lastName'),
            'email'      => $request->input('email'),
            'password'   => $request->input('confirmPassword'),
            'status'     => 1,

        ];
        
        User::create( $data );
        return redirect()->route( 'login' )->with( 'success', 'Pendaftaran berhasil. Silakan masuk.' );
    }
}
