<?php

namespace App\Http\Controllers\Website\Histories;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\History;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Customer $customer): View
    {
        $customer = Auth::guard( 'customer' )->user();
        if ( $customer ) {
            $carts    = Cart::with( 'product' )->where( 'customer_id', $customer->id )->get();
            $histories = History::with( 'customer' )->where( 'customer_id', $customer->id )->get();
            return view( 'profile.history.index', compact( 'carts', 'histories' ) );
        }

        return view('auth.login');
    }
}
