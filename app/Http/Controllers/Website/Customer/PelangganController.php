<?php

namespace App\Http\Controllers\Website\Customer;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\History;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class PelangganController extends Controller
{

    public function login(): View
    {
        return view( 'buyer.auth.login' );
    }

    public function authenticate( Request $request ): RedirectResponse
    {
        $request->validate( [ 
            'email'    => [ 'required', 'email', 'exists:customers,email' ],
            'password' => [ 'required', 'min:6' ],
        ] );

        $pelanggan = Customer::where( 'email', $request->input( 'email' ) )->first();

        if ( $pelanggan && $pelanggan->status == 1 ) {
            $credentials = [ 
                'email'    => $request->input( 'email' ),
                'password' => $request->input( 'password' ),
            ];

            if ( Auth::guard( 'customer' )->attempt( $credentials ) ) {
                $request->session()->regenerate();
                return redirect()->intended( '/' )->with( [ 
                    'type'    => 'Berhasil login',
                    'success' => 'Nama seller sudah ter-otentikasi, selamat datang ' . $pelanggan->first_name . ' ' . $pelanggan->last_name,
                ] );
            }

            return back()->with( 'error', 'Email atau Kata Sandi salah!' );
        }

        if ( $pelanggan && $pelanggan->status == 0 ) {
            return back()->with( [ 'error' => 'Akun nonaktif, hubungi administrator untuk aktivasi kembali!' ] );
        }

        return back()->with( 'error', 'Email atau Kata Sandi salah!' );
    }

    public function registration(): View
    {
        return view( 'buyer.auth.register' );
    }

    public function registering( Request $request ): RedirectResponse
    {
        $request->validate( [ 
            'firstName'   => [ 'required', 'string' ],
            'lastName'    => [ 'required', 'string' ],
            'email'       => [ 'required', 'email', 'unique:customers,email' ],
            'phoneNumber' => [ 'required', 'numeric' ],
            'password'    => [ 'required', 'min:6' ],
        ] );

        $data = [ 
            'first_name' => $request->input( 'firstName' ),
            'last_name'  => $request->input( 'lastName' ),
            'email'      => $request->input( 'email' ),
            'password'   => $request->input( 'password' ),
            'phone'      => $request->input( 'phoneNumber' ),
        ];

        $pelanggan = Customer::create( $data );

        if ( $pelanggan ) {
            return redirect()->route( 'customer.login' )->with( 'success', 'Pendaftaran berhasil, silakan login' );
        }
        else {
            return back()->with( 'error', 'Registrasi gagal, harap coba lagi' );
        }
    }

    public function show( Customer $pelanggan ): View
    {
        $cart = Cart::with( 'product' )->where( 'customer_id', $pelanggan->id )->get();
        return view( 'buyer.profil.show', compact( 'pelanggan', 'cart' ) );
    }

    public function edit( Customer $pelanggan ): View
    {
        if ( $pelanggan ) {
            $cart = Cart::with( 'product' )->where( 'customer_id', $pelanggan->id )->get();
            return view( 'buyer.profil.edit', compact( 'pelanggan', 'cart' ) );
        }
    }
    
    public function update( Request $request, Customer $pelanggan ): RedirectResponse
    {
        $request->validate( [ 
            'firstName' => [ 'required' ],
            'lastName'  => [ 'required' ],
            'email'     => [ 'required', 'email', 'unique:customers,email,' . $pelanggan->email . ',email' ],
            'phone'     => [ 'required', 'numeric' ],
        ] );

        $data = [ 
            'first_name' => $request->input( 'firstName' ),
            'last_name'  => $request->input( 'lastName' ),
            'email'      => $request->input( 'email' ),
            'phone'      => $request->input( 'phone' ),
            'address'    => $request->input( 'address' ),
        ];

        $pelanggan->update( $data );

        if ( $pelanggan ) {
            return redirect()->route( 'pelanggan.show', $pelanggan->id )->with( 'success', 'Pembaruan Detail profil berhasil!' );
        }
        else {
            return back()->with( 'error', 'Pembaruan profil gagal, silakan coba lagi' );
        }
    }

    public function updateImages( Request $request, Customer $pelanggan ): RedirectResponse
    {
        $request->validate( [ 
            'image' => [ 'required', 'image', 'mimes:png,jpg,jpeg', 'max:2048' ],
        ] );

        $image = $request->file( 'image' );

        if ( $image ) {
            if ( $pelanggan->image && $pelanggan->image !== 'thumb-1.jpg' ) {
                $imagePath = public_path( 'buyer/assets/images/profile' ) . '/' . $pelanggan->image;

                if ( file_exists( $imagePath ) ) {
                    unlink( $imagePath );
                }
                else {
                    return back();
                }
            }

            $imageName = time() . '.' . $image->getClientOriginalName();
            $image->move( public_path( 'buyer/assets/images/profile' ), $imageName );
            $pelanggan->update([
                'image' => $imageName,
            ]);
            return redirect()->route( 'pelanggan.show', $pelanggan->id )->with( 'success', 'Pembaruan foto profil berhasil!' );
        }
        else {
            $pelanggan->update([
                'image' => 'thumb-1.jpg',
            ]);
            return redirect()->route( 'pelanggan.show', $pelanggan->id )->with( 'success', 'Pembaruan foto profil ke foto default berhasil!' );


        }

    }

    public function updatePassword( Request $request, Customer $pelanggan ): RedirectResponse
    {
        $request->validate( [ 
            'currentPassword' => [ 'required', ],
            'newPassword'     => [ 'required', 'min:6' ],
            'confirmPassword' => [ 'required', 'min:6', 'same:newPassword' ],
        ] );
        
        if ( !Hash::check( $request->input( 'currentPassword' ), $pelanggan->password ) ) {  
            return redirect()->back()->withErrors( [ 'currentPassword' => 'Kata sandi saat ini tidak valid' ] );
        }

        $data = [ 
            'password' => $request->input( 'confirmPassword' ),
        ];
        
        $pelanggan->update( $data );
        Session::flush();

        return redirect()->route( 'customer.login', $pelanggan->id )->with( 'success', 'Pembaruan kata sandi berhasil' );
    }

    public function deactiveAccount( Customer $pelanggan ): RedirectResponse
    {
        $pelanggan->update( [ 'status' => 0 ] );
        Auth::guard( 'customer' )->logout();
        return redirect()->route( 'customer.login' )->with( 'success', 'Akun kamu berhasil dinonaktifkan, silahkan hubungi administrator untuk aktivasi kembali' );
    }
    public function destroy(Customer $pelanggan): RedirectResponse
    { 
        if ( $pelanggan ) {
            $pelanggan->delete();

            Auth::guard( 'customer' )->logout();

            return redirect()->route( 'customer.login' )->with( 'success', 'Akun kamu berhasil dihapus, silahkan buat akun kembali jika ingin melakukan login' );
        }

        return redirect()->route( 'customer.login' )->with( 'error', 'Tidak bisa melakukan hapus akun, silahkan coba kembali.' );
    }

    public function history(Customer $pelanggan): View {
        if ( $pelanggan ) {
            $cart     = Cart::with( 'product' )->where( 'customer_id', $pelanggan->id )->get();
            $history = History::with( 'customer' )->where( 'customer_id', $pelanggan->id )->get();
            return view( 'buyer.profil.history.index', compact( 'cart', 'history' ) );
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard( 'customer' )->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route( 'customer.login' )->with( 'success', 'Logout berhasil!, Kami berharap dapat bertemu kembali!' );
    }
}
