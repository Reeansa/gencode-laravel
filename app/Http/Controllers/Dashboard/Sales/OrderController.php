<?php

namespace App\Http\Controllers\Dashboard\Sales;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\History;
use App\Models\Invoice;
use App\Models\Negotiation;
use App\Models\Orders;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Orders::with( 'product' )->get();
        return view( 'administrator.sales.order.index', compact( 'orders' ) );
    }

    public function edit( Orders $order ): View
    {
        return view( 'administrator.sales.order.edit', compact( 'order' ) );
    }

    public function cancel(Orders $order): RedirectResponse {
        Orders::where( 'id', $order->id )->update( [ 'status' => 'cancel' ] );
        History::where( 'id', $order->id )->update( [ 'status' => 'cancel' ] );

        Cart::create( [ 
            'customer_id' => $order->customer_id,
            'product_id'  => $order->product_id,
            'quantity'    => 1,
        ] );

        return redirect()->route( 'order.index' )->with( 'success', 'Negosiasi dibatalkan. Produk telah ditambahkan kembali ke keranjang.' );
    }

    public function negotiatePrice( Request $request, Orders $order ): RedirectResponse
    {
        // Jika pelanggan mengajukan harga negosiasi
        if ( !is_null( $request->paid ) ) {
            $negotiatedPrice = $request->paid;
            $agreed          = true;
            // Buat data negosiasi
            Negotiation::create( [ 
                'customer_id'      => $order->customer_id,
                'order_id'         => $order->id,
                'original_price'   => $request->original_price,
                'negotiated_price' => $request->paid,
                'agreed'           => $agreed,
                'link'             => $request->sourceCode,
            ] );
        }
        else {
            // Jika pelanggan tidak mengubah harga, setujui dengan harga asli
            $negotiatedPrice = $order->product->price;
            $agreed          = true;
        }

        // Jika penawaran diterima, buat invoice
        if ( $agreed ) {

            $invoice = Invoice::create( [ 
                'customer_id'      => $order->customer->id,
                'order_id'         => $order->id,
                'price'            => $order->product->price,
                'negotiable_price' => $negotiatedPrice,
                'link'             => $request->sourceCode,
                'status'           => 'sudah bayar',
                'invoice_number'   => 'INV-' . str_pad( $order->customer_id + 1, 8, "0", STR_PAD_LEFT ),
            ] );

            // update status order menjadi paid
            Orders::where( 'id', $order->id )->update( [ 'status' => 'sudah bayar' ] );
            // update status history menjadi paid
            History::where( 'id', $order->id )->update( [ 'status' => 'sudah bayar' ] );

            $invoice = Invoice::with( 'order' )->where( 'id', $invoice->order_id )->first();
            return redirect()->route( 'invoice.show', $invoice->id )->with( 'success', 'Faktur telah dibuat' );
        }
    }
}
