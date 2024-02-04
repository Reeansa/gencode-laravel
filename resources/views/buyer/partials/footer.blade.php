<footer class="p-5 mt-5" style="background-color: #fff;">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
            <img src="{{ asset('buyer/assets/icon/logo.png') }}" width="100" alt="">
            <h5>Gencode</h5>
            <p></p>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
            <ul>
                <li><a href="{{ route('tentang-kami.index') }}">Tentang Kami</a></li>
                <li><a href="{{ route('produk.index') }}">Source Code</a></li>
            </ul>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
            <ul>
                <li><a href="{{ route('customer.login') }}">Login/Daftar</a></li>
                <li><a href="#">Pertanyaan yang Sering Diajukan (FAQ)</a></li>
                <li><a href="#">Jangka waktu layanan</a></li>
                <li><a href="#">Kebijakan Privasi</a></li>
            </ul>
        </div>
    </div>
</footer>

<!-- FOOTER -->
<div class="footer-bottom" style="background-color: #fff;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="copyright text-center">Copyright {{ date('Y') }} <a href="#">Modaz</a>, updated by <a
                        href="">Gencode</a></p>
            </div>
        </div>
    </div>
</div>
