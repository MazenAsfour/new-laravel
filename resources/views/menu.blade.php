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
                    <a id="{{ $category->id }}-tab" data-toggle="tab" href="#{{ $category->id }}" role="tab"
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
                    <div class="tab-pane fade show single-member {{ $key === 0 ? 'active' : '' }}"
                        id="{{ $category->id }}" role="tabpanel" aria-labelledby="{{ $category->id }}-tab">
                        <div class="row" id="products-container-{{ $category->id }}">
                            @foreach($category->products as $product)
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

</section>



@push('custom-scripts')
<script src="{{ asset('newtheme/js/jquery-1.12.1.min.js') }}"></script>
<script src="{{ asset('newtheme/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('newtheme/js/gijgo.min.js') }}"></script>
<script src="{{ asset('newtheme/js/menu.js') }}"></script>
@endpush


@endsection