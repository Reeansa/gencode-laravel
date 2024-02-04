<div class="rev_slider_wrapper fullwidthbanner-container">
    <div id="rev-slider1" class="rev_slider fullwidthabanner">
        <ul>
            <!-- Slide 1 -->
            @foreach ($slider as $sliders)
                <li data-transition="random">
                <!-- Main Image -->
                <img src="@if ($sliders->image != null) {{ asset('administrator/storage/'.$sliders->image) }} @else {{ asset('assets/images/product/thumb-1.jpg') }} @endif" alt="" data-bgposition="center center" style="filter: brightness(0.5);" data-no-retina>

                <!-- Layers -->
                <div class="tp-caption tp-resizeme font-weight-300 rounded px-5" style="background: white;" data-x="['left','left','left','center']"
                    data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']"
                    data-voffset="['-93','-93','-93','-93']" data-fontsize="['24','24','24','18']"
                    data-lineheight="['72','72','72','36']" data-width="full" data-height="none"
                    data-whitespace="normal" data-transform_idle="o:1;"
                    data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                    data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                    data-mask_in="x:0px;y:[100%];" data-mask_out="x:inherit;y:inherit;" data-start="700"
                    data-splitin="none" data-splitout="none" data-responsive_offset="on">
                    WEBSITE BARU HADIR!
                </div>

                <div class="tp-caption tp-resizeme font-weight-500 rounded px-5" style="background: white;" data-x="['left','left','left','center']"
                    data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']"
                    data-voffset="['-42','-42','-42','-42']" data-fontsize="['52','52','52','40']"
                    data-lineheight="['60','60','60','40']" data-width="full" data-height="none"
                    data-whitespace="normal" data-transform_idle="o:1;"
                    data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                    data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                    data-mask_in="x:0px;y:[100%];" data-mask_out="x:inherit;y:inherit;" data-start="1000"
                    data-splitin="none" data-splitout="none" data-responsive_offset="on">
                    SEMUA TENTANG <i>SOURCE CODE</i>
                </div>

                <div class="tp-caption tp-resizeme font-weight-400 rounded px-5" style="background: white;" data-x="['left','left','left','center']"
                    data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']"
                    data-voffset="['12','12','12','12']" data-fontsize="['18','18','18','16']"
                    data-lineheight="['72','72','72','38']" data-width="full" data-height="none"
                    data-whitespace="normal" data-transform_idle="o:1;"
                    data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                    data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                    data-mask_in="x:0px;y:[100%];" data-mask_out="x:inherit;y:inherit;" data-start="1000"
                    data-splitin="none" data-splitout="none" data-responsive_offset="on">
                    ADA DI INDONESIA
                </div>

                <div class="tp-caption" data-x="['left','left','left','center']" data-hoffset="['0','0','0','0']"
                    data-y="['middle','middle','middle','middle']" data-voffset="['80','80','80','80']"
                    data-width="full" data-height="none" data-whitespace="normal" data-transform_idle="o:1;"
                    data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                    data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                    data-mask_in="x:0px;y:[100%];" data-mask_out="x:inherit;y:inherit;" data-start="1000"
                    data-splitin="none" data-splitout="none" data-responsive_offset="on">
                    <a href="{{ route('beranda.index') }}" class="themesflat-button has-padding-36 bg-accent has-shadow"><span>SHOP NOW</span></a>
                </div>
            </li>
            @endforeach
            <!-- /End Slide 1 -->
        </ul>
    </div>
</div>
