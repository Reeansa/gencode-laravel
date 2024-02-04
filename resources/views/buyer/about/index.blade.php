@extends('buyer.template')
@section('title', 'Tentang Kami')
@section('page', 'Tentang Kami')
@section('content')
    @include('buyer.partials.pagetitle')
    <section class="flat-row flat-iconbox">
        <div class="container">
            <div class="title-section margin_bottom_17 d-flex flex-column pb-5" style="gap: 2rem;">
                <h3 class="title">Selamat datang di Gencode - Destinasi Utama untuk Solusi Kode Berkualitas!</h3>
                <p>Kami di Gencode menghadirkan inovasi di dunia pengembangan perangkat lunak dengan menyediakan akses mudah ke
                    source code berkualitas tinggi. Sebagai platform e-commerce yang fokus pada kategori full-stack, Gencode
                    memahami kebutuhan komunitas pengembang yang selalu mencari solusi efektif dan efisien.</p>
            </div>
            {{-- <div class="d-flex flex-column text-center mb-5 pb-5" style="gap: 1rem; border-bottom: 2px solid #00818a;">
                <h3>Selamat datang di Gencode - Destinasi Utama untuk Solusi Kode Berkualitas!</h3>
                <p>Kami di Gencode menghadirkan inovasi di dunia pengembangan perangkat lunak dengan menyediakan akses mudah ke source code berkualitas tinggi. Sebagai platform e-commerce yang fokus pada kategori full-stack, Gencode memahami kebutuhan komunitas pengembang yang selalu mencari solusi efektif dan efisien.</p>

            </div> --}}
            <div class="row">
                <div class="col-md-4">
                    <div class="iconbox text-center">
                        <div class="box-header nomargin">
                            <div class="icon">
                                <i class="fa fa-map-marker"></i>
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-content">
                            <p>Jl. DI Panjaitan No.128, Karangreja, Purwokerto Kidul, Kec. Purwokerto Sel., Kabupaten
                                Banyumas, Jawa Tengah 53147</p>
                        </div><!-- /.box-content -->
                    </div><!-- /.iconbox -->
                </div><!-- /.col-md-4 -->
                <div class="col-md-4">
                    <div class="divider h0"></div>
                    <div class="iconbox text-center">
                        <div class="box-header">
                            <div class="icon">
                                <i class="fa fa-phone"></i>
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-content">
                            <p>+62 89517721586</p>
                        </div><!-- /.box-content -->
                    </div><!-- /.iconbox -->
                </div><!-- /.col-md-4 -->
                <div class="col-md-4">
                    <div class="divider h0"></div>
                    <div class="iconbox text-center">
                        <div class="box-header">
                            <div class="icon">
                                <i class="fa fa-envelope"></i>
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-content">
                            <p>gencode@gmail.com</p>
                        </div><!-- /.box-content -->
                    </div><!-- /.iconbox -->
                </div><!-- /.col-md-4 -->
            </div><!-- /.row -->
            <div class="divider h43"></div>
            <div class="row">
                <div class="col-md-12">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1176.2061603367843!2d109.24832555336431!3d-7.435327593312823!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655ea49d9f9885%3A0x62be0b6159700ec9!2sInstitut%20Teknologi%20Telkom%20Purwokerto!5e0!3m2!1sid!2sid!4v1703306489803!5m2!1sid!2sid"
                        width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.flat-row -->
    {{-- <section class="flat-row flat-contact">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-section margin_bottom_17">
                        <h2 class="title">
                            Send Us Email
                        </h2>
                    </div><!-- /.title-section -->
                </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
            <div class="row">
                <div class="wrap-contact">
                    <form novalidate="" class="contact-form" id="contactform" method="post" action="#">
                        <div class="form-text-wrap clearfix">
                            <div class="contact-name clearfix">
                                <label>Name</label>
                                <input type="text" aria-required="true" size="30" value="" name="author"
                                    id="author">
                            </div>
                            <div class="contact-email">
                                <label>Email</label>
                                <input type="email" size="30" value="" name="email" id="email">
                            </div>
                            <div class="contact-subject">
                                <label>Subject</label>
                                <input type="text" aria-required="true" size="30" value="" name="subject"
                                    id="subject">
                            </div>
                        </div>

                        <div class="contact-message clearfix margin-top-40">
                            <label>Message</label>
                            <textarea class="" tabindex="4" name="message" required></textarea>
                        </div>
                        <div class="form-submit margin-top-32 ">
                            <button class="contact-submit">SEND</button>
                        </div>
                    </form>
                </div><!-- /.wrap-contact -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.flat-row --> --}}
@endsection
