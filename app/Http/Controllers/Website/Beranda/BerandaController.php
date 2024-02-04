<?php

namespace App\Http\Controllers\Website\Beranda;

use App\Models\Cart;
use App\Models\Invoice;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\productImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BerandaController extends Controller
{
    public function index(): View
    {
        $product = Product::all();
        foreach ($product as $products) {
            $products->iniid = $products->id;
        }
        $slider  = productImage::with('product')->where('product_id', $products->iniid)->take(3)->get();

        foreach ( $product as $products ) {
            if ( $products->is_new && now()->greaterThan( $products->new_until ) ) {
                $products->update( [ 
                    'is_new'    => false,
                    'new_until' => null,
                ] );
            }
        }

        $customer = Auth::guard( 'customer' )->user();
        if ( $customer ) {
            $product = Product::all();
            $cart    = Cart::with( 'product' )->where( 'customer_id', $customer->id )->get();
            return view( 'buyer.home.index', compact( 'product', 'cart', 'customer', 'slider' ) );
        }

        return view( 'buyer.home.index', compact( 'product', 'slider' ) );
    }
}
