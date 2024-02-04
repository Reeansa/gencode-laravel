<?php

namespace App\Http\Controllers\Dashboard\Account;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $user  = User::with( 'roles' )->get();
        $roles = Role::all();
        return view( 'administrator.user.index', compact( 'user', 'roles' ) );
    }

    public function store( Request $request ): RedirectResponse
    {
        $request->validate( [ 
            'firstName'       => [ 'required' ],
            'lastName'        => [ 'required' ],
            'email'           => [ 'required', 'unique:users,email' ],
            'password'        => [ 'required', 'min:6' ],
            'confirmPassword' => [ 'required', 'min:6', 'same:password' ],
            'roles'           => [ 'required' ],
        ] );

        $data = [ 
            'first_name' => $request->input('firstName'),
            'last_name'  => $request->input('lastName'),
            'email'      => $request->input('email'),
            'password'   => $request->input('confirmPassword'),
            'roles_id'   => $request->input('roles'),
        ];

        $data = User::create( $data );
        return redirect()->route( 'user.index' )->with( [ 
            'type'    => 'Tambah Data',
            'success' => 'Data berhasil ditambahkan'
        ] );
    }

    public function edit( User $user ): View
    {
        $roles = Role::all();
        return view( 'administrator.user.edit', compact( 'user', 'roles' ) );
    }

    public function updatePassword( Request $request, User $user ): RedirectResponse
    {

        $request->validate( [ 
            'oldPassword'     => [ 
                'required',
                function ($attribute, $value, $fail) use ($user) {
                    $this->validateOldPassword( $attribute, $value, $fail, $user );
                }
            ],
            'newPassword'     => [ 'required', 'min:6' ],
            'confirmPassword' => [ 'required', 'min:6', 'same:newPassword' ],
        ] );

        $data = [ 
            'password' => $request->input( 'confirmPassword' ),
        ];
        $user->update( $data );

        return redirect()->route( 'user.index' )->with( [ 
            'type'    => 'success',
            'success' => 'Kata sandi ' . $user->first_name . ' ' . $user->last_name . ' berhasil diubah'
        ] );
    }
    protected function validateOldPassword( $attribute, $value, $fail, $user )
    {
        if ( !Hash::check( $value, $user->password ) ) {
            $fail( __( 'The :attribute Salah!' ) );
        }
    }

    public function updateStatus( Request $request, User $user ): RedirectResponse
    {
        $loggedInUserId = Auth::id();

        $user->status = ( $user->status == '1' ) ? '0' : '1';
        $user->update();

        if ( $loggedInUserId == $user->id && $user->status == '0' ) {
            Auth::logout();
        }

        return redirect()->route( 'user.index' )->with( [ 
            'type'    => 'Ubah Status',
            'success' => 'Status ' . $user->first_name . ' ' . $user->last_name . ' berhasil diubah'
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
                'type'    => 'Ubah Profil',
                'success' => 'Foto profil berhasil diubah',
            ] );
        }

        return redirect()->route( 'profile.edit', $user->id )->with( [ 
            'type'  => 'Ubah Profil',
            'error' => 'Foto profil gagal diubah',
        ] );
    }

    public function update( Request $request, User $user ): RedirectResponse
    {
        $request->validate( [ 
            'firstName' => [ 'required' ],
            'lastName'  => [ 'required' ],
            'email'     => [ 'required', 'email', 'unique:users,email,' . $user->email . ',email' ],
            'status'    => [ 'required' ],
            'role'      => [ 'required' ],
        ] );

        $data = [ 
            'first_name' => $request->input( 'firstName' ),
            'last_name'  => $request->input( 'lastName' ),
            'email'      => $request->input( 'email' ),
            'status'     => $request->input( 'status' ),
            'roles_id'   => $request->input( 'role' ),
        ];

        $user->update( $data );
        return redirect()->route( 'user.index' )->with( [ 
            'type'    => 'Ubah Data',
            'success' => 'Data ' . $user->first_name . ' ' . $user->last_name . ' berhasil diubah'
        ] );
    }

    public function destroy( User $user ): RedirectResponse
    {
        $user->delete();
        return redirect()->route( 'user.index' )->with( [ 
            'type'    => 'Hapus Data',
            'success' => 'Data ' . $user->first_name . ' ' . $user->last_name . ' berhasil dihapus'
        ] );
    }
}
