<?php

namespace App\Http\Controllers\Website\About;

use App\Models\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        $customer = Auth::guard( 'customer' )->user();
        if ( $customer ) {
            $cart = Cart::with( 'product' )->where( 'customer_id', $customer->id )->get();

            return view( 'buyer.about.index', compact( 'cart', 'customer' ) );
        }

        return view( 'buyer.about.index' );
    }
}
