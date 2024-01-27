@extends('layouts.app')
@push('custom-style')

<link rel="stylesheet" href="{{ asset('newtheme/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('newtheme/css/all.css') }}">
<link rel="stylesheet" href="{{ asset('newtheme/css/style.css') }}">


@endpush
@section('content')


<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner text-center">
                    <div class="breadcrumb_iner_item">
                        <h2>Food Menu</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb start-->

<!--::chefs_part start::-->
<!-- food_menu start-->
<section class="food_menu gray_bg">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="section_tittle">
                    <p>Popular Menu</p>
                    <h2>Delicious Food Menu</h2>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="nav nav-tabs food_menu_nav" id="myTab" role="tablist">
                    @foreach($categories as $key => $category)
                    <a id="{{ $category->name }}-tab" data-toggle="tab" href="#{{ $category->name }}" role="tab"
                        aria-controls="{{ $category->name }}" aria-selected="false"
                        class="{{ $key === 0 ? 'active' : '' }}">
                        {{ $category->name }}
                        <img src="{{ asset('newtheme/img/icon/play.svg') }}" alt="play">
                    </a>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-12">
                <div class="tab-content" id="myTabContent">
                    @foreach($categories as $key => $category)
                    <div class="tab-pane fade show {{ $key === 0 ? 'active' : '' }} single-member"
                        id="{{ $category->name }}" role="tabpanel" aria-labelledby="{{ $category->name }}-tab">
                        <div class="row">
                            @foreach($selectedCategoryProducts as $product)
                            <div class="col-sm-6 col-lg-6">
                                <div class="single_food_item media">
                                    <img src="{{ asset($product->image_path) }}" class="mr-3" alt="...">
                                    <div class="media-body align-self-center">
                                        <h3>{{ $product->name }}</h3>
                                        <p>{{ $product->description }}</p>
                                        <h5>${{ $product->price }}</h5>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>


            </div>
        </div>
</section>



@push('custom-scripts')
<script src="{{ asset('newtheme/js/jquery-1.12.1.min.js') }}"></script>
<script src="{{ asset('newtheme/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('newtheme/js/gijgo.min.js') }}"></script>
<script src="{{ asset('newtheme/js/custom.js') }}"></script>
@endpush


@endsection@extends('layouts.app')
@push('custom-style')

<link rel="stylesheet" href="{{ asset('newtheme/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('newtheme/css/all.css') }}">
<link rel="stylesheet" href="{{ asset('newtheme/css/style.css') }}">


@endpush
@section('content')


<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner text-center">
                    <div class="breadcrumb_iner_item">
                        <h2>Food Menu</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb start-->

<!--::chefs_part start::-->
<!-- food_menu start-->
<section class="food_menu gray_bg">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="section_tittle">
                    <p>Popular Menu</p>
                    <h2>Delicious Food Menu</h2>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="nav nav-tabs food_menu_nav" id="myTab" role="tablist">
                    <a class="active" id="Special-tab" data-toggle="tab" href="#Special" role="tab"
                        aria-controls="Special" aria-selected="false">Special <img src="img/icon/play.svg"
                            alt="play"></a>
                    <a id="Breakfast-tab" data-toggle="tab" href="#Breakfast" role="tab" aria-controls="Breakfast"
                        aria-selected="false">Breakfast <img src="img/icon/play.svg" alt="play"></a>
                    <a id="Launch-tab" data-toggle="tab" href="#Launch" role="tab" aria-controls="Launch"
                        aria-selected="false">Launch <img src="img/icon/play.svg" alt="play"></a>
                    <a id="Dinner-tab" data-toggle="tab" href="#Dinner" role="tab" aria-controls="Dinner"
                        aria-selected="false">Dinner <img src="img/icon/play.svg" alt="play"> </a>
                    <a id="Sneaks-tab" data-toggle="tab" href="#Sneaks" role="tab" aria-controls="Sneaks"
                        aria-selected="false">Sneaks <img src="img/icon/play.svg" alt="play"></a>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active single-member" id="Special" role="tabpanel"
                        aria-labelledby="Special-tab">
                        <div class="row">
                            <div class="col-sm-6 col-lg-6">
                                <div class="single_food_item media">
                                    <img src="{{ asset('newtheme/img/food_menu/single_food_1.png') }}" class="mr-3"
                                        alt="...">
                                    <div class="media-body align-self-center">
                                        <h3>Pork Sandwich</h3>
                                        <p>They're wherein heaven seed hath nothing</p>
                                        <h5>$40.00</h5>
                                    </div>
                                </div>
                                <div class="single_food_item media">
                                    <img src="{{ asset('newtheme/img/food_menu/single_food_2.png') }}" class="mr-3"
                                        alt="...">
                                    <div class="media-body align-self-center">
                                        <h3>Roasted Marrow</h3>
                                        <p>They're wherein heaven seed hath nothing</p>
                                        <h5>$40.00</h5>
                                    </div>
                                </div>
                                <div class="single_food_item media">
                                    <img src="{{ asset('newtheme/img/food_menu/single_food_3.png') }}" class="mr-3"
                                        alt="...">
                                    <div class="media-body align-self-center">
                                        <h3>Summer Cooking</h3>
                                        <p>They're wherein heaven seed hath nothing</p>
                                        <h5>$40.00</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-6">
                                <div class="single_food_item media">
                                    <img src="{{ asset('newtheme/img/food_menu/single_food_4.png') }}" class="mr-3"
                                        alt="...">
                                    <div class="media-body align-self-center">
                                        <h3>Easter Delight</h3>
                                        <p>They're wherein heaven seed hath nothing</p>
                                        <h5>$40.00</h5>
                                    </div>
                                </div>
                                <div class="single_food_item media">
                                    <img src="{{ asset('newtheme/img/food_menu/single_food_5.png') }}" class="mr-3"
                                        alt="...">
                                    <div class="media-body align-self-center">
                                        <h3>Tiener Schnitze</h3>
                                        <p>They're wherein heaven seed hath nothing</p>
                                        <h5>$40.00</h5>
                                    </div>
                                </div>
                                <div class="single_food_item media">
                                    <img src="{{ asset('newtheme/img/food_menu/single_food_6.png') }}" class="mr-3"
                                        alt="...">
                                    <div class="media-body align-self-center">
                                        <h3>Chicken Roast</h3>
                                        <p>They're wherein heaven seed hath nothing</p>
                                        <h5>$40.00</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade single-member" id="Breakfast" role="tabpanel"
                        aria-labelledby="Breakfast-tab">
                        <div class="row">
                            <div class="col-sm-6 col-lg-6">
                                <div class="single_food_item media">
                                    <img src="{{ asset('newtheme/img/food_menu/single_food_4.png') }}" class="mr-3"
                                        alt="...">
                                    <div class="media-body align-self-center">
                                        <h3>Easter Delight</h3>
                                        <p>They're wherein heaven seed hath nothing</p>
                                        <h5>$40.00</h5>
                                    </div>
                                </div>
                                <div class="single_food_item media">
                                    <img src="{{ asset('newtheme/img/food_menu/single_food_5.png') }}" class="mr-3"
                                        alt="...">
                                    <div class="media-body align-self-center">
                                        <h3>Tiener Schnitze</h3>
                                        <p>They're wherein heaven seed hath nothing</p>
                                        <h5>$40.00</h5>
                                    </div>
                                </div>
                                <div class="single_food_item media">
                                    <img src="{{ asset('newtheme/img/food_menu/single_food_6.png') }}" class="mr-3"
                                        alt="...">
                                    <div class="media-body align-self-center">
                                        <h3>Chicken Roast</h3>
                                        <p>They're wherein heaven seed hath nothing</p>
                                        <h5>$40.00</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-6">
                                <div class="single_food_item media">
                                    <img src="{{ asset('newtheme/img/food_menu/single_food_1.png') }}" class="mr-3"
                                        alt="...">
                                    <div class="media-body align-self-center">
                                        <h3>Pork Sandwich</h3>
                                        <p>They're wherein heaven seed hath nothing</p>
                                        <h5>$40.00</h5>
                                    </div>
                                </div>
                                <div class="single_food_item media">
                                    <img src="{{ asset('newtheme/img/food_menu/single_food_2.png') }}" class="mr-3"
                                        alt="...">
                                    <div class="media-body align-self-center">
                                        <h3>Roasted Marrow</h3>
                                        <p>They're wherein heaven seed hath nothing</p>
                                        <h5>$40.00</h5>
                                    </div>
                                </div>
                                <div class="single_food_item media">
                                    <img src="{{ asset('newtheme/img/food_menu/single_food_3.png') }}" class="mr-3"
                                        alt="...">
                                    <div class="media-body align-self-center">
                                        <h3>Summer Cooking</h3>
                                        <p>They're wherein heaven seed hath nothing</p>
                                        <h5>$40.00</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade single-member" id="Launch" role="tabpanel" aria-labelledby="Launch-tab">
                        <div class="row">
                            <div class="col-sm-6 col-lg-6">
                                <div class="single_food_item media">
                                    <img src="{{ asset('newtheme/img/food_menu/single_food_1.png') }}" class="mr-3"
                                        alt="...">
                                    <div class="media-body align-self-center">
                                        <h3>Pork Sandwich</h3>
                                        <p>They're wherein heaven seed hath nothing</p>
                                        <h5>$40.00</h5>
                                    </div>
                                </div>
                                <div class="single_food_item media">
                                    <img src="{{ asset('newtheme/img/food_menu/single_food_2.png') }}" class="mr-3"
                                        alt="...">
                                    <div class="media-body align-self-center">
                                        <h3>Roasted Marrow</h3>
                                        <p>They're wherein heaven seed hath nothing</p>
                                        <h5>$40.00</h5>
                                    </div>
                                </div>
                                <div class="single_food_item media">
                                    <img src="{{ asset('newtheme/img/food_menu/single_food_3.png') }}" class="mr-3"
                                        alt="...">
                                    <div class="media-body align-self-center">
                                        <h3>Summer Cooking</h3>
                                        <p>They're wherein heaven seed hath nothing</p>
                                        <h5>$40.00</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-6">
                                <div class="single_food_item media">
                                    <img src="{{ asset('newtheme/img/food_menu/single_food_4.png') }}" class="mr-3"
                                        alt="...">
                                    <div class="media-body align-self-center">
                                        <h3>Easter Delight</h3>
                                        <p>They're wherein heaven seed hath nothing</p>
                                        <h5>$40.00</h5>
                                    </div>
                                </div>
                                <div class="single_food_item media">
                                    <img src="{{ asset('newtheme/img/food_menu/single_food_5.png') }}" class="mr-3"
                                        alt="...">
                                    <div class="media-body align-self-center">
                                        <h3>Tiener Schnitze</h3>
                                        <p>They're wherein heaven seed hath nothing</p>
                                        <h5>$40.00</h5>
                                    </div>
                                </div>
                                <div class="single_food_item media">
                                    <img src="{{ asset('newtheme/img/food_menu/single_food_6.png') }}" class="mr-3"
                                        alt="...">
                                    <div class="media-body align-self-center">
                                        <h3>Chicken Roast</h3>
                                        <p>They're wherein heaven seed hath nothing</p>
                                        <h5>$40.00</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade single-member" id="Dinner" role="tabpanel" aria-labelledby="Dinner-tab">
                        <div class="row">
                            <div class="col-sm-6 col-lg-6">
                                <div class="single_food_item media">
                                    <img src="{{ asset('newtheme/img/food_menu/single_food_4.png') }}" class="mr-3"
                                        alt="...">
                                    <div class="media-body align-self-center">
                                        <h3>Easter Delight</h3>
                                        <p>They're wherein heaven seed hath nothing</p>
                                        <h5>$40.00</h5>
                                    </div>
                                </div>
                                <div class="single_food_item media">
                                    <img src="{{ asset('newtheme/img/food_menu/single_food_5.png') }}" class="mr-3"
                                        alt="...">
                                    <div class="media-body align-self-center">
                                        <h3>Tiener Schnitze</h3>
                                        <p>They're wherein heaven seed hath nothing</p>
                                        <h5>$40.00</h5>
                                    </div>
                                </div>
                                <div class="single_food_item media">
                                    <img src="{{ asset('newtheme/img/food_menu/single_food_6.png') }}" class="mr-3"
                                        alt="...">
                                    <div class="media-body align-self-center">
                                        <h3>Chicken Roast</h3>
                                        <p>They're wherein heaven seed hath nothing</p>
                                        <h5>$40.00</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-6">
                                <div class="single_food_item media">
                                    <img src="{{ asset('newtheme/img/food_menu/single_food_1.png') }}" class="mr-3"
                                        alt="...">
                                    <div class="media-body align-self-center">
                                        <h3>Pork Sandwich</h3>
                                        <p>They're wherein heaven seed hath nothing</p>
                                        <h5>$40.00</h5>
                                    </div>
                                </div>
                                <div class="single_food_item media">
                                    <img src="{{ asset('newtheme/img/food_menu/single_food_2.png') }}" class="mr-3"
                                        alt="...">
                                    <div class="media-body align-self-center">
                                        <h3>Roasted Marrow</h3>
                                        <p>They're wherein heaven seed hath nothing</p>
                                        <h5>$40.00</h5>
                                    </div>
                                </div>
                                <div class="single_food_item media">
                                    <img src="{{ asset('newtheme/img/food_menu/single_food_3.png') }}" class="mr-3"
                                        alt="...">
                                    <div class="media-body align-self-center">
                                        <h3>Summer Cooking</h3>
                                        <p>They're wherein heaven seed hath nothing</p>
                                        <h5>$40.00</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade single-member" id="Sneaks" role="tabpanel" aria-labelledby="Sneaks-tab">
                        <div class="row">
                            <div class="col-sm-6 col-lg-6">
                                <div class="single_food_item media">
                                    <img src="{{ asset('newtheme/img/food_menu/single_food_1.png') }}" class="mr-3"
                                        alt="...">
                                    <div class="media-body align-self-center">
                                        <h3>Pork Sandwich</h3>
                                        <p>They're wherein heaven seed hath nothing</p>
                                        <h5>$40.00</h5>
                                    </div>
                                </div>
                                <div class="single_food_item media">
                                    <img src="{{ asset('newtheme/img/food_menu/single_food_2.png') }}" class="mr-3"
                                        alt="...">
                                    <div class="media-body align-self-center">
                                        <h3>Roasted Marrow</h3>
                                        <p>They're wherein heaven seed hath nothing</p>
                                        <h5>$40.00</h5>
                                    </div>
                                </div>
                                <div class="single_food_item media">
                                    <img src="{{ asset('newtheme/img/food_menu/single_food_3.png') }}" class="mr-3"
                                        alt="...">
                                    <div class="media-body align-self-center">
                                        <h3>Summer Cooking</h3>
                                        <p>They're wherein heaven seed hath nothing</p>
                                        <h5>$40.00</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-6">
                                <div class="single_food_item media">
                                    <img src="{{ asset('newtheme/img/food_menu/single_food_4.png') }}" class="mr-3"
                                        alt="...">
                                    <div class="media-body align-self-center">
                                        <h3>Easter Delight</h3>
                                        <p>They're wherein heaven seed hath nothing</p>
                                        <h5>$40.00</h5>
                                    </div>
                                </div>
                                <div class="single_food_item media">
                                    <img src="{{ asset('newtheme/img/food_menu/single_food_5.png') }}" class="mr-3"
                                        alt="...">
                                    <div class="media-body align-self-center">
                                        <h3>Tiener Schnitze</h3>
                                        <p>They're wherein heaven seed hath nothing</p>
                                        <h5>$40.00</h5>
                                    </div>
                                </div>
                                <div class="single_food_item media">
                                    <img src="{{ asset('newtheme/img/food_menu/single_food_6.png') }}" class="mr-3"
                                        alt="...">
                                    <div class="media-body align-self-center">
                                        <h3>Chicken Roast</h3>
                                        <p>They're wherein heaven seed hath nothing</p>
                                        <h5>$40.00</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>



@push('custom-scripts')
<script src="{{ asset('newtheme/js/jquery-1.12.1.min.js') }}"></script>
<script src="{{ asset('newtheme/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('newtheme/js/gijgo.min.js') }}"></script>
<script src="{{ asset('newtheme/js/custom.js') }}"></script>
@endpush


@endsection