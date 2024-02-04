<?php

namespace App\Http\Controllers\Dashboard\Sales;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class InvoiceController extends Controller
{
    public function index(): View
    {
        $invoice = Invoice::with( 'customer' )->get();
        return view( 'administrator.sales.invoice.index', compact( 'invoice' ) );
    }
    public function show( Invoice $invoice ): View
    {
        $invoice = Invoice::with( 'customer', 'order' )->findOrFail( $invoice->order_id );
        return view( 'administrator.sales.invoice.show', compact( 'invoice' ) );
    }

    public function print( Invoice $invoice )
    {
        $pdf = Pdf::setOption( [ 'isPhpEnabled' => true ] );
        $pdf->loadView( 'administrator.sales.invoice.pdf', compact( 'invoice' ) );
        return $pdf->stream();
    }
}
