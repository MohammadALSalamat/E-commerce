@extends('layouts.frontlayout.front_desgin')
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                    <!-- Include the left side bar page  -->
          @include('layouts.frontlayout.leftsidebar')
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <!--features_items & show the items here-->
                    <h2 class="title text-center">{{$CMSDetailes->title}}</h2>
                    <p>{{$CMSDetailes->descrption}}</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
