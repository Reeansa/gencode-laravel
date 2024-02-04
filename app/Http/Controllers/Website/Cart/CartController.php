<?php

namespace App\Http\Controllers\Website\Cart;

use App\Models\Cart;
use App\Models\History;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index()
    {
        $customer = Auth::guard( 'customer' )->user();
        if ( $customer ) {
            $cart = Cart::with( 'product' )->where( 'customer_id', $customer->id )->get();
            if ( $cart->isEmpty() ) {
                return redirect()->route( 'beranda.index' )->with( 'error', 'Tidak ada produk dalam keranjang' );
            }
            return view( 'buyer.cart.index', compact( 'cart' ) );
        }
        return view( 'buyer.cart.index' );
    }

    public function store( Request $request ): RedirectResponse
    {
        $request->validate( [ 
            'product' => [ 'required' ],
        ] );

        $customer     = Auth::guard( 'customer' )->user();
        $previousCart = Cart::where( 'customer_id', $customer->id )
            ->where( 'product_id', $request->product )
            ->exists();

        if ( $previousCart ) {
            return redirect()->route( 'cart.index', $customer->id )->with( 'error', 'Produk sudah ada dalam keranjang' );
        }

        $previousPurchase = Orders::where( 'customer_id', $customer->id )
            ->where( 'product_id', $request->product )
            ->where( 'status', '=', 'sudah bayar' )
            ->exists();

        if ( $previousPurchase ) {
            return redirect()->route( 'customer.history', $customer->id )->with( 'error', 'Anda sudah pernah membeli produk ini.' );
        }

        $cart = Cart::where( 'customer_id', $customer->id )
            ->where( 'product_id', $request->product )
            ->first();

        if ( $cart ) {
            return redirect()->route( 'cart.index', $customer->id )->with( 'error', 'Produk sudah ada dalam keranjang' );
        }
        else {
            Cart::create( [ 
                'customer_id' => $customer->id,
                'product_id'  => $request->product,
                'quantity'    => 1,
            ] );

            return redirect()->route( 'cart.index', $customer->id )->with( 'success', 'Produk berhasil ditambahkan ke keranjang' );
        }
    }


    public function buyProduct( Cart $cart, $quantity = 1 )
    {
        $user               = $cart->product->user_id;
        $checkProfileSeller = User::find( $user );
        
        if ( $checkProfileSeller->phone ) {
            $previousPurchase = Orders::where( 'customer_id', $cart->customer_id )
                ->where( 'product_id', $cart->product_id )
                ->where( 'status', '=', 'sudah bayar' )
                ->exists();

            if ( $previousPurchase ) {
                return back()->with( 'error', 'Anda sudah pernah membeli produk ini sebelumnya.' );
            }

            $seller = $cart->product->user_id;
            if ( $seller ) {
                $sellerId    = User::find( $seller )->id;
                $orderNumber = 'INV-' . str_pad( $sellerId, 8, "0", STR_PAD_LEFT );
                $isDuplicate = History::where( 'order_number', $orderNumber )->exists();
                if ( $isDuplicate ) {
                    $orderNumber .= '-' . rand( 100, 999 );
                }
                History::create( [ 
                    'customer_id'  => $cart->customer_id,
                    'product_id'   => $cart->product_id,
                    'order_number' => $orderNumber,
                    'status'       => 'belum bayar'
                ] );
                
                Orders::create( [ 
                    'customer_id'  => $cart->customer_id,
                    'product_id'   => $cart->product_id,
                    'user_id'      => $cart->product->user_id,
                    'order_number' => $orderNumber,
                    'payment_by'   => 'negosiasi',
                    'status'       => 'belum bayar'
                ] );

                Cart::where( 'product_id', $cart->product_id )->delete();

                $form   = '<form action="' . route( 'whatsapp.send', $cart->product->user_id ) . '" method="post" id="whatsappForm">' . csrf_field();
                $form .= '<input type="hidden" name="name" value="' . $cart->product->name . '">';
                $form .= '<input type="hidden" name="price" value="' . $cart->product->price . '">';
                $form .= '</form>';
                $script = '<script>' . 'document.getElementById("whatsappForm").submit();' . '</script>';

                return view( 'buyer.cart.redirect_with_post', compact( 'form', 'script' ) );
            }
        }
        else {
            return back()->with( 'error', 'Penjual belum mengisi nomor telepon' );
        }

        $previousPurchase = Orders::where( 'customer_id', $cart->customer_id )
            ->where( 'product_id', $cart->product_id )
            ->where( 'status', '=', 'sudah bayar' )
            ->exists();

        if ( $previousPurchase ) {
            return back()->with( 'error', 'Anda sudah pernah membeli produk ini sebelumnya.' );
        }

        return back()->with( 'error', 'Terjadi kesalahan' );
    }

    public function sendWhatsAppMessage( Request $request, User $user )
    {
        $customer = Auth::guard( 'customer' )->user();
        if ( !$customer ) {
            return redirect()->back()->with( 'error', 'Customer tidak ditemukan' );
        }

        $customer    = $customer->first_name . ' ' . $customer->last_name;
        $nameProduct = $request->name;
        $price       = $request->price;

        $currentTime = date( 'H' );

        if ( $currentTime >= 5 && $currentTime < 12 ) {
            $greeting = "Selamat pagi";
        }
        elseif ( $currentTime >= 12 && $currentTime < 18 ) {
            $greeting = "Selamat siang";
        }
        elseif ( $currentTime >= 18 && $currentTime < 24 ) {
            $greeting = "Selamat sore";
        }
        else {
            $greeting = "Selamat malam";
        }

        $message = "Halo, $greeting, perkenalkan saya $customer\n";
        $message .= "saya mendapatkan kontak anda melalui website *gencode*\n";
        $message .= "saya tertarik dengan produk yang dijual yaitu *$nameProduct*\n";

        $customerPhone = '+62' . substr( $user->phone, 1 );

        if ( $price ) {
            $message .= "dengan harga yaitu: Rp. *$price*\n\n";
            $message .= "apakah bisa melakukan negosiasi?";
            $whatsapp = "https://wa.me/$customerPhone?text=" . urlencode( $message );
            session()->put( 'whatsapp_url', $whatsapp );
            return redirect()->route( 'beranda.index' )->with( 'success', 'Pesan berhasil dikirim' );
        }
        else {
            return redirect()->route( 'beranda.index' )->with( 'error', 'Pesan gagal dikirim' );
        }
    }

    public function destroy( Cart $cart )
    {
        $cart = Cart::with( 'product' )->where( 'customer_id', $cart->customer_id )->first();
        $cart->delete();
        return redirect()->route( 'cart.index', $cart->customer_id )->with( 'success', 'Cart berhasil dihapus' );
    }
}
