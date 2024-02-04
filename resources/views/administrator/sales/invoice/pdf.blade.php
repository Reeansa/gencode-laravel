<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Invoice</title>
        <link rel="shortcut icon" href="{{ public_path('administrator/assets/img/logo/logo.png') }}" type="image/x-icon">
        <link href="{{ public_path('administrator/assets/css/style.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ public_path('administrator/assets/css/app.min.css') }}">
    </head>

    <body style="background-color: #fff !important; font-family: Poppins;">
        <div class="m-t-15 lh-2">
            <div class="inline-block">
                <img class="img-fluid mb-4" src="{{ public_path('administrator/assets/img/logo/logo.png') }}"
                    width="100" alt="">
                <address class="p-l-10">
                    <h2 class="font-weight-semibold text-dark">Gencode</h2>
                    <span>Institut Teknologi Telkom Purwokerto</span><br>
                    <span>Purwokerto Kidul, Kec, Purwokerto Selatan., Kabupaten Banyumas, Jawa Tengah
                        53147</span><br>
                    <abbr class="text-dark" title="Phone">Phone:</abbr>
                    <span>(+62) 895-1772-1586</span>
                </address>
            </div>
            <div class="float-right">
                <h2>FAKTUR</h2>
            </div>
        </div>
        <div class="row m-t-20 lh-2">
            <div class="col-sm-5 float-right">
                <div class="m-t-80">
                    <div class="text-dark text-uppercase d-inline-block">
                        <span class="font-weight-semibold text-dark">Nomor Inovice :</span>
                        <span>{{ $invoice->invoice_number }}</span>
                    </div>
                </div>
                <div class="text-dark text-uppercase d-inline-block">
                    <span class="font-weight-semibold text-dark">Tanggal :</span>
                    @php
                        $date = $invoice->created_at;
                        $dateConvert = date('d M Y', strtotime($date));
                    @endphp
                    <span>{{ $dateConvert }}</span>
                </div>
            </div>
            <div class="col-sm-5">
                <h3 class="p-l-10">Faktur Untuk:</h3>
                <address class="p-l-10 m-t-10">
                    <span class="font-weight-semibold text-dark">{{ $invoice->customer->first_name }}
                        {{ $invoice->customer->last_name }}</span><br>
                    <span>{{ $invoice->customer->email }}</span>
                </address>
            </div>
        </div>
        <div class="m-t-20">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Produk</th>
                            <th>Gambar</th>
                            <th>Harga</th>
                            <th>link</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>{{ $invoice->order->product->name }}</td>
                            <td><img src="{{ public_path('administrator/storage/' . $invoice->order->product->productImage->first()->image) }}"
                                    width="80" alt=""></td>
                            <td>
                                @if ($invoice->negotiable_price)
                                    <s>Rp. {{ number_format($invoice->price) }}</s>
                                    <p>Rp. {{ number_format($invoice->negotiable_price) }}</p>
                                @else
                                    <p>Rp. {{ number_format($invoice->price) }}</p>
                                @endif
                            </td>
                            <td>
                                {{ $invoice->link }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row m-t-30 lh-1-8">
                <div class="text-right">
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
            <div class="row m-t-30 lh-2">
                <div class="col-sm-12">
                    <div class="border-bottom p-v-20">
                        <p class="text-opacity"><small>{{ date('Y') }} Nama Perusahaan. Hak Cipta Dilindungi
                                Undang-Undang.
                                Institut Teknologi Telkom Purwokerto, Purwokerto, Indonesia</small></p>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row m-v-100">
                    <div class="col-sm-3 float-right">
                        <small><span class="font-weight-semibold text-dark">Phone:</span> (+62)
                            895-1772-1586</small>
                        <br>
                        <small>gencode@support.com</small>
                    </div>
                    <div class="col-sm-3">
                        <img class="m-t-5" width="100" src="{{ public_path('buyer/assets/icon/logo.png') }}"
                            alt="">
                    </div>

                </div>
            </div>
        </div>
    </body>

</html>
