<?php

namespace App\Http\Controllers\Dashboard\Account;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Orders;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(): View
    {
        $customer = Customer::all();
        foreach ( $customer as $customers ) {
            $customers->orders = Orders::where( 'customer_id', $customers->id )->get();
            $customers->amount = 0;

            foreach ( $customers->orders as $order ) {
                $customers->amount += $order->product->price;
            }
        }
        return view( 'administrator.customer.index', compact( 'customer' ) );
    }

    public function show( Customer $customer ): View
    {
        return view( 'administrator.customer.show', compact( 'customer' ) );
    }

    public function edit( Customer $customer ): View
    {
        return view( 'administrator.customer.edit', compact( 'customer' ) );
    }

    public function update( Request $request, Customer $customer ): RedirectResponse
    {
        $request->validate( [ 
            'firstName' => [ 'required' ],
            'lastName'  => [ 'required' ],
            'email'     => [ 'required', 'email', 'unique:customers,email,' . $customer->email . ',email' ],
            'phone'     => [ 'required', 'numeric' ],
        ] );

        $data = [ 
            'first_name' => $request->input( 'firstName' ),
            'last_name'  => $request->input( 'lastName' ),
            'email'      => $request->input( 'email' ),
            'phone'      => $request->input( 'phone' ),
            'address'    => $request->input( 'address' ),
        ];

        $customer->update( $data );

        if ( $customer ) {
            return redirect()->route( 'customer.show', $customer->id )->with( [
                'type' => 'Ubah Detail Profil',
                'success' => 'Pembaruan Detail profil berhasil!'] );
        }
        else {
            return back()->with( [
                'type' => 'Ubah Detail Profil',
                'error' => 'Pembaruan profil gagal, silakan coba lagi'] );
        }
    }

    public function updateImages( Request $request, Customer $customer ): RedirectResponse
    {
        $request->validate( [ 
            'image' => [ 'required','image', 'mimes:png,jpg,jpeg', 'max:2048' ],
        ] );

        $image = $request->file( 'image' );

        if ( $image ) {
            if ( $customer->image && $customer->image !== 'thumb-1.jpg' ) {
                $imagePath = public_path( 'buyer/assets/images/profile' ) . '/' . $customer->image;

                if ( file_exists( $imagePath ) ) {
                    unlink( $imagePath );
                }
                else {
                    return back();
                }
            }

            $imageName = time() . '.' . $image->getClientOriginalName();
            $image->move( public_path( 'buyer/assets/images/profile' ), $imageName );
            $customer->update( [ 
                'image' => $imageName,
            ] );
            return redirect()->route( 'customer.show', $customer->id )->with( 'success', 'Pembaruan foto profil berhasil!' );
        }
        else {
            $customer->update( [ 
                'image' => 'thumb-1.jpg',
            ] );
        }

        return redirect()->route( 'customer.show', $customer->id )->with( 'success', 'Pembaruan foto profil ke foto default berhasil!' );
    }

    public function updateStatus( Request $request, Customer $customer ): RedirectResponse
    {
        $loggedInUserId = $customer->id;

        $customer->status = ( $customer->status == '1' ) ? '0' : '1';
        $customer->update();

        if ( $loggedInUserId == $customer->id && $customer->status == '0' ) {
            Auth::guard( 'customer' )->logout();
        }

        return redirect()->route( 'customer.index' )->with( [ 
            'type'    => 'Ubah Status',
            'success' => 'Status ' . $customer->first_name . ' ' . $customer->last_name . ' berhasil diubah'
        ] );
    }

    public function updatePassword( Request $request, Customer $customer ): RedirectResponse
    {
        $request->validate( [ 
            'oldPassword'     => [ 
                'required',
                function ($attribute, $value, $fail) use ($customer) {
                    $this->validateOldPassword( $attribute, $value, $fail, $customer );
                }
            ],
            'newPassword'     => [ 'required', 'min:6' ],
            'confirmPassword' => [ 'required', 'min:6', 'same:newPassword' ],
        ] );

        $data = [ 
            'password' => $request->input( 'confirmPassword' ),
        ];
        $customer->update( $data );

        return redirect()->route( 'customer.index' )->with( [ 
            'type'    => 'success',
            'success' => 'Kata sandi ' . $customer->first_name . ' ' . $customer->last_name . ' berhasil diubah'
        ] );
    }
    protected function validateOldPassword( $attribute, $value, $fail, $customer )
    {
        if ( !Hash::check( $value, $customer->password ) ) {
            $fail( __( 'The :attribute salah.' ) );
        }
    }
}
