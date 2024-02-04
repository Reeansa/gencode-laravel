<?php

namespace App\Http\Controllers\Dashboard\Profile;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show( User $user ): View
    {
        $user = User::with( 'roles' )->find( $user->id );
        return view( 'administrator.profile.show', compact( 'user' ) );
    }

    public function edit( User $user ): View
    {
        return view( 'administrator.profile.edit', compact( 'user' ) );
    }

    public function update( Request $request, User $user ): RedirectResponse
    {
        $request->validate( [ 
            'firstName'   => [ 'required' ],
            'lastName'    => [ 'required' ],
            'email'       => [ 'required', 'email:rfc,dns', 'unique:users,email,' . $user->id . ',id' ],
            'phone'       => [ 'required' ],
            'fullAddress' => [ 'required' ],
        ] );

        $data = [ 
            'first_name' => $request->input( 'firstName' ),
            'last_name'  => $request->input( 'lastName' ),
            'email'      => $request->input( 'email' ),
            'phone'      => $request->input( 'phone' ),
            'address'    => $request->input( 'fullAddress' ),
        ];

        $user->update( $data );
        return redirect()->route( 'profile.show', $user->id )->with( [ 
            'type'    => 'Update Profile',
            'success' => 'Foto profil berhasil diubah',
            'error'   => 'Foto profil gagal diubah',
        ] );
    }

    public function updateImage( Request $request, User $user ): RedirectResponse
    {
        $request->validate( [ 
            'image' => [ 'required', 'image', 'mimes:png,jpg,jpeg', 'max:2048' ]
        ] );

        if ( $request->hasFile( 'image' ) ) {
            // delete image
            if ( $user->image ) {
                Storage::disk( 'administrator' )->delete( $user->image );
            }
            $filePath             = Storage::disk( 'administrator' )->put( 'images/profile', request()->file( 'image' ), 'public' );
            $validated[ 'image' ] = $filePath;
        }
        $update = $user->update( $validated );

        if ( $update ) {
            return redirect()->route( 'profile.show', $user->id )->with( [ 
                'type'    => 'Update Profile',
                'success' => 'Profile updated successfully',
            ] );
        }

        return redirect()->route( 'profile.edit', $user->id )->with( [ 
            'type'  => 'Update Profile',
            'error' => 'Profile updated failed',
        ] );
    }

    public function updatePassword( Request $request, User $user ): RedirectResponse
    {

        $request->validate( [ 
            'oldPassword'     => [ 'required', function ($attribute, $value, $fail) use ($user) {
                $this->validateOldPassword( $attribute, $value, $fail, $user );
            } ],
            'newPassword'     => [ 'required', 'min:6' ],
            'confirmPassword' => [ 'required', 'same:newPassword' ],
        ] );

        $data = [ 
            'password' => $request->input( 'confirmPassword' ),
        ];
        $user->update( $data );

        return redirect()->route( 'users-admin.index' )->with( [ 
            'type'    => 'success',
            'success' => 'Password ' . $user->first_name . ' ' . $user->last_name . ' berhasil diubah'
        ] );
    }

    protected function validateOldPassword( $attribute, $value, $fail, $users_admin )
    {
        if ( !Hash::check( $value, $users_admin->password ) ) {
            $fail( __( 'The :attribute is incorrect.' ) );
        }
    }
}
