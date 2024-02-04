<?php

namespace App\Http\Controllers\Website\Produk;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ProdukController extends Controller
{
    public function index(): View
    {
        $customer = Auth::guard( 'customer' )->user();
        $slider   = Product::where( 'is_new', 1 )->take( 3 )->get();
        if ( $customer ) {
            $product = Product::latest()->filter( request( [ 'search' ] ) )->paginate( 20 );
            $cart    = Cart::with( 'product' )->where( 'customer_id', $customer->id )->get();

            return view( 'buyer.source-code.index', compact( 'product', 'cart', 'slider' ) );
        }
        $product = Product::latest()->filter( request( [ 'search' ] ) )->paginate( 20 );
        return view( 'buyer.source-code.index', compact( 'product', 'slider' ) );
    }
    public function show(Product $produk): View
    {
        $customer = Auth::guard( 'customer' )->user();
        if ( $customer ) {
            $cart = Cart::with( 'product' )->where( 'customer_id', $customer->id )->get();
            return view( 'buyer.source-code.show', compact( 'cart', 'produk') );
        }
        return view ( 'buyer.source-code.show', compact( 'produk' ));
    }
}
