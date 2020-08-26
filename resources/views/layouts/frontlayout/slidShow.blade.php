<section id="slider">
    <!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                         @foreach ($banners as $key => $banner)
                        <li data-target="#slider-carousel" data-slide-to="0" class="@if($key==0) active @endif"></li>
                             @endforeach
                    </ol>
                    <div class="carousel-inner">
                        <!-- to make the acrive works then put the $key -->
                        @foreach ($banners as $key => $banner)
                        <div class="item @if($key==0) active @endif">
                            <div class="col-sm-6">
                                <h1> <span>Welcome To </span> Shopping</h1>
                                <h2>{{$banner->Title}}</h2>
                                <p>{{$banner->description}} </p>
                                <button type="button" style="color: #fff" class="btn btn-dark hvr-sweep-top get">Get it now</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="{{asset('images/images_frontend/banners/'.$banner->image)}}"
                                    class="girl img-responsive" alt="" />
                                <img src="{{asset('images/images_frontend/images/home/pricing.png')}}" class="pricing"
                                    alt="" />
                            </div>
                        </div>
                        @endforeach

                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>
<!--/slider-->
