<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Customer;
use App\Models\Orders;
use App\Models\Product;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        if ( $user->role == 'Super Administrator' ) {

            $totalOrdersToday     = Orders::whereDate( 'created_at', now()->toDateString() )->count();
            $totalOrdersYesterday = Orders::whereDate( 'created_at', now()->subDay()->toDateString() )->count();

            if ( $totalOrdersYesterday > 0 ) {
                $orderChangePercentage = ( ( $totalOrdersToday - $totalOrdersYesterday ) / $totalOrdersYesterday ) * 100;
            }
            else {
                $orderChangePercentage = 0;
            }

            $data = [ 
                'orders'           => Orders::latest()->take( 10 )->get(),
                'products'         => Product::orderBy( 'sales', 'desc' )->take( 5 )->get(),
                'precentageOrders' => $orderChangePercentage,
                'users'            => User::all(),
                'customers'        => Customer::orderBy( 'created_at', 'desc' )->take( 5 )->get(),
            ];

            return view( 'administrator.pages.dashboard', $data );
        }

        else {
            $totalOrdersToday     = Orders::where( 'user_id', $user->id )->whereDate( 'created_at', now()->toDateString() )->count();
            $totalOrdersYesterday = Orders::where( 'user_id', $user->id )->whereDate( 'created_at', now()->subDay()->toDateString() )->count();

            if ( $totalOrdersYesterday > 0 ) {
                $orderChangePercentage = ( ( $totalOrdersToday - $totalOrdersYesterday ) / $totalOrdersYesterday ) * 100;
            }
            else {
                $orderChangePercentage = 0;
            }

            $data = [ 
                'orders'           => Orders::where( 'user_id', $user->id )->latest()->take( 10 )->get(),
                'products'         => Product::where( 'user_id', $user->id )->orderBy( 'sales', 'desc' )->take( 5 )->get(),
                'precentageOrders' => $orderChangePercentage,
                'users'            => User::where( 'id', $user->id )->get(),
                'customers'        => Customer::orderBy( 'created_at', 'desc' )->take( 5 )->get(),
            ];
            return view( 'administrator.pages.dashboard', $data );
        }

    }
}
