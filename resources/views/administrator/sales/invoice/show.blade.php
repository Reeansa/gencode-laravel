@extends('administrator.template')
@section('title', 'Invoices')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div id="invoice" class="p-h-30">
                    <div class="m-t-15 lh-2">
                        <div class="inline-block">
                            <img class="img-fluid mb-4" src="{{ asset('administrator/assets/img/logo/logo.png') }}"
                                width="100" alt="">
                            <address class="p-l-10">
                                <span class="font-weight-semibold text-dark">Gencode</span><br>
                                <span>Institut Teknologi Telkom Purwokerto</span><br>
                                <span>Purwokerto Kidul, Kec, Purwokerto Selatan., Kabupaten Banyumas, Jawa Tengah
                                    53147</span><br>
                                <abbr class="text-dark" title="Phone">Phone:</abbr>
                                <span>(+62) 895-1772-1586</span>
                            </address>
                        </div>
                        <div class="float-right">
                            <h2>INVOICE</h2>
                        </div>
                    </div>
                    <div class="row m-t-20 lh-2">
                        <div class="col-sm-9">
                            <h3 class="p-l-10 m-t-10">Invoice To:</h3>
                            <address class="p-l-10 m-t-10">
                                <span class="font-weight-semibold text-dark">{{ $invoice->customer->first_name }}
                                    {{ $invoice->customer->last_name }}</span><br>
                                <span>{{ $invoice->customer->email }}</span><br>
                                <span>{{ $invoice->customer->address }} </span><br>
                            </address>
                        </div>
                        <div class="col-sm-3">
                            <div class="m-t-80">
                                <div class="text-dark text-uppercase d-inline-block">
                                    <span class="font-weight-semibold text-dark">Invoice No :</span>
                                </div>
                                <div class="float-right">{{ $invoice->invoice_number }}</div>
                            </div>
                            <div class="text-dark text-uppercase d-inline-block">
                                <span class="font-weight-semibold text-dark">Date :</span>
                            </div>
                            @php
                                $date = $invoice->created_at;
                                $dateConvert = date('d M Y', strtotime($date));
                            @endphp
                            <div class="float-right">{{ $dateConvert }}</div>
                        </div>
                    </div>
                    <div class="m-t-20">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Product</th>
                                        <th>images</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>{{ $invoice->order->product->name }}</td>
                                        <td><img src="{{ asset('administrator/storage/' . $invoice->order->product->productImage->first()->image) }}"
                                                width="80" alt=""></td>
                                        <td>
                                            @if ($invoice->negotiable_price)
                                                <s>Rp. {{ number_format($invoice->price) }}</s>
                                                <p>Rp. {{ number_format($invoice->negotiable_price) }}</p>
                                                @else
                                                <p>Rp. {{ number_format($invoice->price) }}</p>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row m-t-30 lh-1-8">
                            <div class="col-sm-12">
                                <div class="float-right text-right">
                                    <hr>
                                    @if ($invoice->negotiable_price)
                                        <s><span class="font-weight-semibold text-dark">Total : </span>Rp.
                                            {{ number_format($invoice->price) }}</s>
                                        <h3><span class="font-weight-semibold text-dark">Total : </span>Rp.
                                            {{ number_format($invoice->negotiable_price) }}</h3>
                                    @else
                                        {
                                        <h3><span class="font-weight-semibold text-dark">Total : </span>Rp.
                                            {{ number_format($invoice->price) }}</h3>
                                        }
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-30 lh-2">
                            <div class="col-sm-12">
                                <div class="border-bottom p-v-20">
                                    <p class="text-opacity"><small>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                            Ratione accusamus fuga iure optio nam repellat! In, rerum illum a obcaecati
                                            dolorem numquam id veniam optio sed libero iure pariatur repellat?.</small></p>
                                </div>
                            </div>
                        </div>
                        <div class="row m-v-20">
                            <div class="col-sm-6">
                                <img class="img-fluid text-opacity m-t-5" width="100"
                                    src="{{ asset('buyer/assets/icon/logo.png') }}" alt="">
                            </div>
                            <div class="col-sm-6 text-right">
                                <small><span class="font-weight-semibold text-dark">Phone:</span> (+62)
                                    895-1772-1586</small>
                                <br>
                                <small>gencode@support.com</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
