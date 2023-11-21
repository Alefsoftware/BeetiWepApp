@extends('front.layouts.main')

@section('content')
@include('admin.includes.messages')

    <section class="home-slider position-relative mb-30">
    <div class="container">
        <div class="home-slide-cover mt-30">
            <div class="hero-slider-1 style-4 dot-style-1 dot-style-1-position-1">
                @foreach($sliders as $slider)

                <div class="single-hero-slider single-animation-wrap" style="background-image: url({{$slider->image}})">
                    <a href="{{$slider->link}}">
                    <div class="slider-content">
                         <h1 style="max-width:700px;" class="display-2 mb-40">
                           {{$slider->title_en}}
                        </h1>

                        <p class="mb-65">{{$slider->description_en}}</p>
                    </a>
                        <form class="form-subcriber d-flex" action="{{route('storeSubscriber')}}" method="post">
                            @csrf
                            <input type="email"  name="email" placeholder="Your emaill address" />
                            <button class="btn" type="submit">Subscribe</button>
                        </form>
                    </div>
                </div>

                @endforeach

            </div>
            <div class="slider-arrow hero-slider-1-arrow"></div>
        </div>
    </div>
</section>
<!--End hero slider-->
<section class="popular-categories section-padding">
    <div class="container wow animate__animated animate__fadeIn">
        <div class="section-title">
            <div class="title">
                <h3>Featured Categories</h3>

            </div>
            <div class="slider-arrow slider-arrow-2 flex-right carausel-10-columns-arrow" id="carausel-10-columns-arrows"></div>
        </div>
        <div class="carausel-10-columns-cover position-relative">
            <div class="carausel-10-columns" id="carausel-10-columns">
                @foreach($categories as $category)
                <div class="card-2 bg-9 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                    <figure class="img-hover-scale overflow-hidden">
                        <a href="#"><img src="{{$category->logo}}" alt=""   onerror="this.onerror=null;this.src='{{ asset('default_product.png') }}';"/></a>
                    </figure>
                    <h6><a href="#">{{$category->title}}</a></h6>
                    <span>{{$category->products_count}} items</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!--End category slider-->
<section class="banners mb-25">
    <div class="container">
        <div class="row">
            @foreach($ads as $row)
            @if($row->position == 'Top')
            <div class="col-lg-4 col-md-6">
                <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay="0">
                    <img src="{{asset($row->image)}}" alt=""  onerror="this.onerror=null;this.src='{{ asset('default_product.png') }}';" />
                    <div class="banner-text">
                        <h4>
                           {!! $row->des_field !!}
                        </h4>
                        <a href="{{url('http://' .$row->link)}}" target="_blank" class="btn btn-xs">{{__('Shop Now')}} <i class="fi-rs-arrow-small-right"></i></a>
                    </div>
                </div>
            </div>
            @endif
      @endforeach
        </div>
    </div>
</section>
<!--End banners-->
<section class="product-tabs section-padding position-relative">
    <div class="container">
        <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3>{{__("Popular Products")}}</h3>
            <ul class="nav nav-tabs links" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-0" type="button" role="tab" aria-controls="tab-0" aria-selected="true">All</button>
                </li>
                @foreach($categorys as $allCategory)
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="nav-tab-two" data-bs-toggle="tab" data-bs-target="#tab-{{$allCategory->id}}" type="button" role="tab" aria-controls="tab-two" aria-selected="false">
                        {{$allCategory->title}}</button>
                </li>
                @endforeach
            </ul>
        </div>
        <!--End nav-tabs-->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-0" role="tabpanel" aria-labelledby="tab-0">
                <div class="row product-grid-4">
                    @foreach($products as $product)
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{route('product.details',$product->slug)}}">
                                        <img class="default-img" src="{{@$product->images[0]->image_name}}" alt=""  onerror="this.onerror=null;this.src='{{ asset('default_product.png') }}';" />
                                        @if(count($product->images)>1)
                                        <img class="hover-img" src="{{@$product->images[1]->image_name}}" alt="">
                                        @endif
                                    </a>
                                </div>
                                <div class="product-action-1" style="width:45px;">
                                    {{-- <a aria-label="Add To Wishlist" id="wishlist-toggle{{$product->id}}" data-name="{{$product->id}}"    class="action-btn btn-save{{$product->id}}"><i class="fi fi-sr-heart"></i><i class="fi-rs-heart"></i></a> --}}
                                    <a aria-label="Add To Wishlist" data-product="{{$product->id}}" class="action-btn btn-save{{$product->id}} addWishlist "><i class="fi fi-sr-heart"></i><i class="fi-rs-heart"></i></a>
                                    {{-- <a aria-label="Compare"         id="compaire{{$product->id}}"        data-name="{{$product->id}}"     class="action-btn"    href="shop-compare.html"><i class="fi-rs-shuffle"></i></a> --}}
                                    {{-- <a aria-label="Quick view"      lass="action-btn"     data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a> --}}
                                </div>
                                {{-- <div class="product-badges product-badges-position product-badges-mrg">
                                    <span class="hot">Hot</span>
                                </div> --}}
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="#">{{@$product->category->title}}</a>
                                </div>
                                <h2><a href="{{route('product.details',$product->slug)}}">{{$product->title}}</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: {{($product->AvgRate/5)*100}}%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> ({{$row->AvgRate ??'0'}})</span>
                                </div>
                                <div>
                                    <span class="font-small text-muted">By <a href="{{route('shop',['provider'=>$product->provider_id])}}">{{@$product->provider->name}}</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>{{session::get('country')->currency->iso3??Egp}}{{$product->MinPrice}}</span>
                                        {{-- <span class="old-price">$32.8</span> --}}
                                    </div>
                                    {{-- <div class="add-cart">
                                        <a class="add addcart" href="#" data-product="{{ $product->id }}"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end product card-->
                        @endforeach
                </div>
                <!--End product-grid-4-->
            </div>
            <!--En tab one-->
            @foreach($categorys as $item)

            <div class="tab-pane fade" id="tab-{{$item->id}}" role="tabpanel" aria-labelledby="tab-{{$item->id}}">
                <div class="row product-grid-4">
                @foreach($item->products as $p)
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{route('product.details',$p->slug)}}">
                                    <img class="default-img" src="{{@$p->images[0]->image_name}}" alt="" />
                                        @if(count($p->images)>1)
                                        <img class="hover-img" src="{{@$product->images[1]->image_name}}" alt="">
                                        @endif
                                    </a>
                                </div>
                                <div class="product-action-1" style="width:45px;">
                                    {{-- <a aria-label="Add To Wishlist" id="wishlist-toggle{{$product->id}}" data-name="{{$product->id}}"    class="action-btn btn-save{{$product->id}}"><i class="fi fi-sr-heart"></i><i class="fi-rs-heart"></i></a> --}}
                                    <a aria-label="Add To Wishlist" data-product="{{$product->id}}" class="action-btn btn-save{{$product->id}} addWishlist "><i class="fi fi-sr-heart"></i><i class="fi-rs-heart"></i></a>
                                    {{-- <a aria-label="Compare"         id="compaire{{$product->id}}"        data-name="{{$product->id}}"     class="action-btn"    href="shop-compare.html"><i class="fi-rs-shuffle"></i></a> --}}
                                    {{-- <a aria-label="Quick view"      lass="action-btn"     data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a> --}}
                                </div>
                                {{-- <div class="product-badges product-badges-position product-badges-mrg">
                                    <span class="hot">Hot</span>
                                </div> --}}
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="{{route('product.details',$p->slug)}}">{{$item->title}}</a>
                                </div>
                                <h2><a href="{{route('product.details',$p->slug)}}">{{$p->title}}</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">

                                        <div class="product-rating" style="width: @if($p->review->count('rate')==0){{0}}@else{{(number_format($p->review->sum('rate')/$p->review->count('rate'),1)/5)*100}}@endif%"></div>

                                    </div>
                                    <span class="font-small ml-5 text-muted"> (@if($p->review->count('rate')==0){{0}}@else{{number_format($p->review->sum('rate')/$p->review->count('rate'),1)}}@endif)</span>
                                </div>
                                <div>
                                    <span class="font-small text-muted">By <a href="{{route('shop',['provider'=>$p->provider_id])}}">{{@$p->provider->name}}</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>{{session::get('country')->currency->iso3??EGP}}{{$p->MinPrice}}</span>
                                        {{-- <span class="old-price">$32.8</span>    --}}
                                    </div>
                                    {{-- <div class="add-cart">
                                       <a class="add addcart" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!--end product card-->

                </div>
                <!--End product-grid-4-->
            </div>
            @endforeach


        </div>
        <!--End tab-content-->
    </div>
</section>
<!--Products Tabs-->
<section class="section-padding pb-5">
    <div class="container">
        {{-- <div class="section-title wow animate__animated animate__fadeIn">
            <h3 class="">Daily Best Sells</h3>
            <ul class="nav nav-tabs links" id="myTab-2" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="nav-tab-one-1" data-bs-toggle="tab" data-bs-target="#tab-one-1" type="button" role="tab" aria-controls="tab-one" aria-selected="true">Featured</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="nav-tab-two-1" data-bs-toggle="tab" data-bs-target="#tab-two-1" type="button" role="tab" aria-controls="tab-two" aria-selected="false">Popular</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="nav-tab-three-1" data-bs-toggle="tab" data-bs-target="#tab-three-1" type="button" role="tab" aria-controls="tab-three" aria-selected="false">New added</button>
                </li>
            </ul>
        </div> --}}
        <div class="row">
            @foreach($ads as $row)
            @if($row->position == 'Side')
            <div class="col-lg-3 d-none d-lg-flex wow animate__animated animate__fadeIn">
                <div class="banner-img style-2" style="background:url({{asset($row->image)}})">
                    <div class="banner-text">
                        <h2 class="mb-100">{{$row->title_field}}</h2>
                        <a href="{{$row->link}}" class="btn btn-xs">{{__('Shop Now')}}<i class="fi-rs-arrow-small-right"></i></a>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
            <div class="col-lg-9 col-md-12 wow animate__animated animate__fadeIn" data-wow-delay=".4s">
                <div class="tab-content" id="myTabContent-1">
                    <div class="tab-pane fade show active" id="tab-one-1" role="tabpanel" aria-labelledby="tab-one-1">
                        <div class="carausel-4-columns-cover arrow-center position-relative">
                            <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-arrows"></div>
                            <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">
                               @foreach($ofers_products as $row)
{{-- @dd($row->product->images[0]->image_name) --}}
                                <div class="product-cart-wrap">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{route('product.details',$row->slug)}}">
                                                <img class="default-img" src="{{$row->product->images[0]->image_name}}" alt="" />
                                                {{-- <img class="hover-img" src="{{asset('front/assets/imgs/shop/product-1-2.jpg')}}" alt="" /> --}}
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"> <i class="fi-rs-eye"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            @php

                                                $discount_per = (($row->price - $row->offer_price)/$row->price)*100;
                                            @endphp
                                            <span class="hot">Save {{round($discount_per)}}%</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop-grid-right.html">{{@$row->product->category->title}} </a>
                                        </div>
                                        <h2><a href="{{route('product.details',$row->product->slug)}}">{{$row->product->title}} - {{$row->title}}</a></h2>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">

                                                <div class="product-rating" style="width: @if($row->product->review->count('rate')==0){{0}}@else{{(number_format($row->product->review->sum('rate')/$row->product->review->count('rate'),1)/5)*100}}@endif%"></div>

                                            </div>
                                            <span class="font-small ml-5 text-muted"> (@if($row->product->review->count('rate')==0){{0}}@else{{number_format($row->product->review->sum('rate')/$row->product->review->count('rate'),1)}}@endif)</span>
                                        </div>
                                        <div class="product-price mt-10">
                                            <span>{{session::get('country')->currency->iso3??EGP}}{{$row->offer_price}} </span>
                                            <span class="old-price">${{$row->price}}</span>
                                        </div>
                                        <div class="sold mt-15 mb-15">
                                            <div class="progress mb-5">
                                                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="font-xs text-heading"> {{__('Expire At')}}: {{$row->offer_end_date}}</span>
                                        </div>
                                        <a href="shop-cart.html" class="btn w-100 hover-up"><i class="fi-rs-shopping-cart mr-5"></i>Add To Cart</a>
                                    </div>
                                </div>
                                @endforeach
                                {{-- <!--End product Wrap-->
                                <div class="product-cart-wrap">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="shop-product-right.html">
                                                <img class="default-img" src="{{asset('front/assets/imgs/shop/product-5-1.jpg')}}" alt="" />
                                                <img class="hover-img" src="{{asset('front/assets/imgs/shop/product-5-2.jpg')}}" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"> <i class="fi-rs-eye"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="new">Save 35%</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop-grid-right.html">Hodo Foods</a>
                                        </div>
                                        <h2><a href="shop-product-right.html">All Natural Italian-Style Chicken Meatballs</a></h2>
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 80%"></div>
                                        </div>
                                        <div class="product-price mt-10">
                                            <span>$238.85 </span>
                                            <span class="old-price">$245.8</span>
                                        </div>
                                        <div class="sold mt-15 mb-15">
                                            <div class="progress mb-5">
                                                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="font-xs text-heading"> Sold: 90/120</span>
                                        </div>
                                        <a href="shop-cart.html" class="btn w-100 hover-up"><i class="fi-rs-shopping-cart mr-5"></i>Add To Cart</a>
                                    </div>
                                </div>
                                <!--End product Wrap-->
                                <div class="product-cart-wrap">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="shop-product-right.html">
                                                <img class="default-img" src="{{asset('front/assets/imgs/shop/product-2-1.jpg')}}" alt="" />
                                                <img class="hover-img" src="{{asset('front/assets/imgs/shop/product-2-2.jpg')}}" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"> <i class="fi-rs-eye"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="sale">Sale</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop-grid-right.html">Hodo Foods</a>
                                        </div>
                                        <h2><a href="shop-product-right.html">Angie’s Boomchickapop Sweet and womnies</a></h2>
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 80%"></div>
                                        </div>
                                        <div class="product-price mt-10">
                                            <span>$238.85 </span>
                                            <span class="old-price">$245.8</span>
                                        </div>
                                        <div class="sold mt-15 mb-15">
                                            <div class="progress mb-5">
                                                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="font-xs text-heading"> Sold: 90/120</span>
                                        </div>
                                        <a href="shop-cart.html" class="btn w-100 hover-up"><i class="fi-rs-shopping-cart mr-5"></i>Add To Cart</a>
                                    </div>
                                </div>
                                <!--End product Wrap-->
                                <div class="product-cart-wrap">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="shop-product-right.html">
                                                <img class="default-img" src="{{asset('front/assets/imgs/shop/product-3-1.jpg')}}" alt="" />
                                                <img class="hover-img" src="{{asset('front/assets/imgs/shop/product-3-2.jpg')}}" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"> <i class="fi-rs-eye"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="best">Best sale</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop-grid-right.html">Hodo Foods</a>
                                        </div>
                                        <h2><a href="shop-product-right.html">Foster Farms Takeout Crispy Classic </a></h2>
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 80%"></div>
                                        </div>
                                        <div class="product-price mt-10">
                                            <span>$238.85 </span>
                                            <span class="old-price">$245.8</span>
                                        </div>
                                        <div class="sold mt-15 mb-15">
                                            <div class="progress mb-5">
                                                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="font-xs text-heading"> Sold: 90/120</span>
                                        </div>
                                        <a href="shop-cart.html" class="btn w-100 hover-up"><i class="fi-rs-shopping-cart mr-5"></i>Add To Cart</a>
                                    </div>
                                </div>
                                <!--End product Wrap-->
                                <div class="product-cart-wrap">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="shop-product-right.html">
                                                <img class="default-img" src="{{asset('front/assets/imgs/shop/product-4-1.jpg')}}" alt="" />
                                                <img class="hover-img" src="{{asset('front/assets/imgs/shop/product-4-2.jpg')}}" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"> <i class="fi-rs-eye"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="hot">Save 15%</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop-grid-right.html">Hodo Foods</a>
                                        </div>
                                        <h2><a href="shop-product-right.html">Blue Diamond Almonds Lightly Salted</a></h2>
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 80%"></div>
                                        </div>
                                        <div class="product-price mt-10">
                                            <span>$238.85 </span>
                                            <span class="old-price">$245.8</span>
                                        </div>
                                        <div class="sold mt-15 mb-15">
                                            <div class="progress mb-5">
                                                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="font-xs text-heading"> Sold: 90/120</span>
                                        </div>
                                        <a href="shop-cart.html" class="btn w-100 hover-up"><i class="fi-rs-shopping-cart mr-5"></i>Add To Cart</a>
                                    </div>
                                </div>
                                <!--End product Wrap--> --}}
                            </div>
                        </div>
                    </div>
                    <!--End tab-pane-->
                    {{-- <div class="tab-pane fade" id="tab-two-1" role="tabpanel" aria-labelledby="tab-two-1">
                        <div class="carausel-4-columns-cover arrow-center position-relative">
                            <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-2-arrows"></div>
                            <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns-2">
                                <div class="product-cart-wrap">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="shop-product-right.html">
                                                <img class="default-img" src="{{asset('front/assets/imgs/shop/product-10-1.jpg')}}" alt="" />
                                                <img class="hover-img" src="{{asset('front/assets/imgs/shop/product-10-2.jpg')}}" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"> <i class="fi-rs-eye"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="hot">Save 15%</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="#">Hodo Foods</a>
                                        </div>
                                        <h2><a href="shop-product-right.html">Canada Dry Ginger Ale – 2 L Bottle</a></h2>
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 80%"></div>
                                        </div>
                                        <div class="product-price mt-10">
                                            <span>$238.85 </span>
                                            <span class="old-price">$245.8</span>
                                        </div>
                                        <div class="sold mt-15 mb-15">
                                            <div class="progress mb-5">
                                                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="font-xs text-heading"> Sold: 90/120</span>
                                        </div>
                                        <a href="shop-cart.html" class="btn w-100 hover-up"><i class="fi-rs-shopping-cart mr-5"></i>Add To Cart</a>
                                    </div>
                                </div>
                                <!--End product Wrap-->
                                <div class="product-cart-wrap">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="shop-product-right.html">
                                                <img class="default-img" src="{{asset('front/assets/imgs/shop/product-15-1.jpg')}}" alt="" />
                                                <img class="hover-img" src="{{asset('front/assets/imgs/shop/product-15-2.jpg')}}" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"> <i class="fi-rs-eye"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="new">Save 35%</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop-grid-right.html">Hodo Foods</a>
                                        </div>
                                        <h2><a href="shop-product-right.html">Encore Seafoods Stuffed Alaskan</a></h2>
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 80%"></div>
                                        </div>
                                        <div class="product-price mt-10">
                                            <span>$238.85 </span>
                                            <span class="old-price">$245.8</span>
                                        </div>
                                        <div class="sold mt-15 mb-15">
                                            <div class="progress mb-5">
                                                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="font-xs text-heading"> Sold: 90/120</span>
                                        </div>
                                        <a href="shop-cart.html" class="btn w-100 hover-up"><i class="fi-rs-shopping-cart mr-5"></i>Add To Cart</a>
                                    </div>
                                </div>
                                <!--End product Wrap-->
                                <div class="product-cart-wrap">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="shop-product-right.html">
                                                <img class="default-img" src="{{asset('front/assets/imgs/shop/product-12-1.jpg')}}" alt="" />
                                                <img class="hover-img" src="{{asset('front/assets/imgs/shop/product-12-2.jpg')}}" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"> <i class="fi-rs-eye"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="sale">Sale</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop-grid-right.html">Hodo Foods</a>
                                        </div>
                                        <h2><a href="shop-product-right.html">Gorton’s Beer Battered Fish </a></h2>
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 80%"></div>
                                        </div>
                                        <div class="product-price mt-10">
                                            <span>$238.85 </span>
                                            <span class="old-price">$245.8</span>
                                        </div>
                                        <div class="sold mt-15 mb-15">
                                            <div class="progress mb-5">
                                                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="font-xs text-heading"> Sold: 90/120</span>
                                        </div>
                                        <a href="shop-cart.html" class="btn w-100 hover-up"><i class="fi-rs-shopping-cart mr-5"></i>Add To Cart</a>
                                    </div>
                                </div>
                                <!--End product Wrap-->
                                <div class="product-cart-wrap">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="shop-product-right.html">
                                                <img class="default-img" src="{{asset('front/assets/imgs/shop/product-13-1.jpg')}}" alt="" />
                                                <img class="hover-img" src="{{asset('front/assets/imgs/shop/product-13-2.jpg')}}" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"> <i class="fi-rs-eye"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="best">Best sale</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop-grid-right.html">Hodo Foods</a>
                                        </div>
                                        <h2><a href="shop-product-right.html">Haagen-Dazs Caramel Cone Ice</a></h2>
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 80%"></div>
                                        </div>
                                        <div class="product-price mt-10">
                                            <span>$238.85 </span>
                                            <span class="old-price">$245.8</span>
                                        </div>
                                        <div class="sold mt-15 mb-15">
                                            <div class="progress mb-5">
                                                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="font-xs text-heading"> Sold: 90/120</span>
                                        </div>
                                        <a href="shop-cart.html" class="btn w-100 hover-up"><i class="fi-rs-shopping-cart mr-5"></i>Add To Cart</a>
                                    </div>
                                </div>
                                <!--End product Wrap-->
                                <div class="product-cart-wrap">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="shop-product-right.html">
                                                <img class="default-img" src="{{asset('front/assets/imgs/shop/product-14-1.jpg')}}" alt="" />
                                                <img class="hover-img" src="{{asset('front/assets/imgs/shop/product-14-2.jpg')}}" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"> <i class="fi-rs-eye"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="hot">Save 15%</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop-grid-right.html">Hodo Foods</a>
                                        </div>
                                        <h2><a href="shop-product-right.html">Italian-Style Chicken Meatball</a></h2>
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 80%"></div>
                                        </div>
                                        <div class="product-price mt-10">
                                            <span>$238.85 </span>
                                            <span class="old-price">$245.8</span>
                                        </div>
                                        <div class="sold mt-15 mb-15">
                                            <div class="progress mb-5">
                                                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="font-xs text-heading"> Sold: 90/120</span>
                                        </div>
                                        <a href="shop-cart.html" class="btn w-100 hover-up"><i class="fi-rs-shopping-cart mr-5"></i>Add To Cart</a>
                                    </div>
                                </div>
                                <!--End product Wrap-->
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-three-1" role="tabpanel" aria-labelledby="tab-three-1">
                        <div class="carausel-4-columns-cover arrow-center position-relative">
                            <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-3-arrows"></div>
                            <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns-3">
                                <div class="product-cart-wrap">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="shop-product-right.html">
                                                <img class="default-img" src="{{asset('front/assets/imgs/shop/product-7-1.jpg')}}" alt="" />
                                                <img class="hover-img" src="{{asset('front/assets/imgs/shop/product-7-2.jpg')}}" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"> <i class="fi-rs-eye"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="hot">Save 15%</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop-grid-right.html">Hodo Foods</a>
                                        </div>
                                        <h2><a href="shop-product-right.html">Perdue Simply Smart Organics Gluten Free</a></h2>
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 80%"></div>
                                        </div>
                                        <div class="product-price mt-10">
                                            <span>$238.85 </span>
                                            <span class="old-price">$245.8</span>
                                        </div>
                                        <div class="sold mt-15 mb-15">
                                            <div class="progress mb-5">
                                                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="font-xs text-heading"> Sold: 90/120</span>
                                        </div>
                                        <a href="shop-cart.html" class="btn w-100 hover-up"><i class="fi-rs-shopping-cart mr-5"></i>Add To Cart</a>
                                    </div>
                                </div>
                                <!--End product Wrap-->
                                <div class="product-cart-wrap">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="shop-product-right.html">
                                                <img class="default-img" src="{{asset('front/assets/imgs/shop/product-8-1.jpg')}}" alt="" />
                                                <img class="hover-img" src="{{asset('front/assets/imgs/shop/product-8-2.jpg')}}" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"> <i class="fi-rs-eye"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="new">Save 35%</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop-grid-right.html">Hodo Foods</a>
                                        </div>
                                        <h2><a href="shop-product-right.html">Seeds of Change Organic Quinoa</a></h2>
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 80%"></div>
                                        </div>
                                        <div class="product-price mt-10">
                                            <span>$238.85 </span>
                                            <span class="old-price">$245.8</span>
                                        </div>
                                        <div class="sold mt-15 mb-15">
                                            <div class="progress mb-5">
                                                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="font-xs text-heading"> Sold: 90/120</span>
                                        </div>
                                        <a href="shop-cart.html" class="btn w-100 hover-up"><i class="fi-rs-shopping-cart mr-5"></i>Add To Cart</a>
                                    </div>
                                </div>
                                <!--End product Wrap-->
                                <div class="product-cart-wrap">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="shop-product-right.html">
                                                <img class="default-img" src="{{asset('front/assets/imgs/shop/product-9-1.jpg')}}" alt="" />
                                                <img class="hover-img" src="{{asset('front/assets/imgs/shop/product-9-2.jpg')}}" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"> <i class="fi-rs-eye"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="sale">Sale</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop-grid-right.html">Hodo Foods</a>
                                        </div>
                                        <h2><a href="shop-product-right.html">Signature Wood-Fired Mushroom</a></h2>
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 80%"></div>
                                        </div>
                                        <div class="product-price mt-10">
                                            <span>$238.85 </span>
                                            <span class="old-price">$245.8</span>
                                        </div>
                                        <div class="sold mt-15 mb-15">
                                            <div class="progress mb-5">
                                                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="font-xs text-heading"> Sold: 90/120</span>
                                        </div>
                                        <a href="shop-cart.html" class="btn w-100 hover-up"><i class="fi-rs-shopping-cart mr-5"></i>Add To Cart</a>
                                    </div>
                                </div>
                                <!--End product Wrap-->
                                <div class="product-cart-wrap">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="shop-product-right.html">
                                                <img class="default-img" src="{{asset('front/assets/imgs/shop/product-13-1.jpg')}}" alt="" />
                                                <img class="hover-img" src="{{asset('front/assets/imgs/shop/product-13-2.jpg')}}" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"> <i class="fi-rs-eye"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="best">Best sale</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop-grid-right.html">Hodo Foods</a>
                                        </div>
                                        <h2><a href="shop-product-right.html">Simply Lemonade with Raspberry Juice</a></h2>
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 80%"></div>
                                        </div>
                                        <div class="product-price mt-10">
                                            <span>$238.85 </span>
                                            <span class="old-price">$245.8</span>
                                        </div>
                                        <div class="sold mt-15 mb-15">
                                            <div class="progress mb-5">
                                                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="font-xs text-heading"> Sold: 90/120</span>
                                        </div>
                                        <a href="shop-cart.html" class="btn w-100 hover-up"><i class="fi-rs-shopping-cart mr-5"></i>Add To Cart</a>
                                    </div>
                                </div>
                                <!--End product Wrap-->
                                <div class="product-cart-wrap">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="shop-product-right.html">
                                                <img class="default-img" src="{{asset('front/assets/imgs/shop/product-14-1.jpg')}}" alt="" />
                                                <img class="hover-img" src="{{asset('front/assets/imgs/shop/product-14-2.jpg')}}" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"> <i class="fi-rs-eye"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="hot">Save 15%</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop-grid-right.html">Hodo Foods</a>
                                        </div>
                                        <h2><a href="shop-product-right.html">Organic Quinoa, Brown, & Red Rice</a></h2>
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 80%"></div>
                                        </div>
                                        <div class="product-price mt-10">
                                            <span>$238.85 </span>
                                            <span class="old-price">$245.8</span>
                                        </div>
                                        <div class="sold mt-15 mb-15">
                                            <div class="progress mb-5">
                                                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="font-xs text-heading"> Sold: 90/120</span>
                                        </div>
                                        <a href="shop-cart.html" class="btn w-100 hover-up"><i class="fi-rs-shopping-cart mr-5"></i>Add To Cart</a>
                                    </div>
                                </div>
                                <!--End product Wrap-->
                            </div>
                        </div>
                    </div> --}}
                </div>
                <!--End tab-content-->
            </div>
            <!--End Col-lg-9-->
        </div>
    </div>
</section>
<!--End Best Sales-->
{{-- <section class="section-padding pb-5">
    <div class="container">
        <div class="section-title wow animate__animated animate__fadeIn" data-wow-delay="0">
            <h3 class="">Deals Of The Day</h3>
            <a class="show-all" href="shop-grid-right.html">
                All Deals
                <i class="fi-rs-angle-right"></i>
            </a>
        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="product-cart-wrap style-2 wow animate__animated animate__fadeInUp" data-wow-delay="0">
                    <div class="product-img-action-wrap">
                        <div class="product-img">
                            <a href="shop-product-right.html">
                                <img src="{{asset('front/assets/imgs/banner/banner-5.png')}}" alt=""   onerror="this.onerror=null;this.src='{{ asset('default_product.png') }}';" />
                            </a>
                        </div>
                    </div>
                    <div class="product-content-wrap">
                        <div class="deals-countdown-wrap">
                            <div class="deals-countdown" data-countdown="2025/03/25 00:00:00"></div>
                        </div>
                        <div class="deals-content">
                            <h2><a href="shop-product-right.html">Seeds of Change Organic Quinoa, Brown, & Red Rice</a></h2>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                            <div>
                                <span class="font-small text-muted">By <a href="vendor-details-1.html">NestFood</a></span>
                            </div>
                            <div class="product-card-bottom">
                                <div class="product-price">
                                    <span>$32.85</span>
                                    <span class="old-price">$33.8</span>
                                </div>
                                <div class="add-cart">
                                   <a class="add addcart" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="product-cart-wrap style-2 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                    <div class="product-img-action-wrap">
                        <div class="product-img">
                            <a href="shop-product-right.html">
                                <img src="{{asset('front/assets/imgs/banner/banner-6.png')}}" alt=""  onerror="this.onerror=null;this.src='{{ asset('default_product.png') }}';" />
                            </a>
                        </div>
                    </div>
                    <div class="product-content-wrap">
                        <div class="deals-countdown-wrap">
                            <div class="deals-countdown" data-countdown="2026/04/25 00:00:00"></div>
                        </div>
                        <div class="deals-content">
                            <h2><a href="shop-product-right.html">Perdue Simply Smart Organics Gluten Free</a></h2>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                            <div>
                                <span class="font-small text-muted">By <a href="vendor-details-1.html">Old El Paso</a></span>
                            </div>
                            <div class="product-card-bottom">
                                <div class="product-price">
                                    <span>$24.85</span>
                                    <span class="old-price">$26.8</span>
                                </div>
                                <div class="add-cart">
                                   <a class="add addcart" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 d-none d-lg-block">
                <div class="product-cart-wrap style-2 wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                    <div class="product-img-action-wrap">
                        <div class="product-img">
                            <a href="shop-product-right.html">
                                <img src="{{asset('front/assets/imgs/banner/banner-7.png')}}" alt=""  onerror="this.onerror=null;this.src='{{ asset('default_product.png') }}';" />
                            </a>
                        </div>
                    </div>
                    <div class="product-content-wrap">
                        <div class="deals-countdown-wrap">
                            <div class="deals-countdown" data-countdown="2027/03/25 00:00:00"></div>
                        </div>
                        <div class="deals-content">
                            <h2><a href="shop-product-right.html">Signature Wood-Fired Mushroom and Caramelized</a></h2>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 80%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (3.0)</span>
                            </div>
                            <div>
                                <span class="font-small text-muted">By <a href="vendor-details-1.html">Progresso</a></span>
                            </div>
                            <div class="product-card-bottom">
                                <div class="product-price">
                                    <span>$12.85</span>
                                    <span class="old-price">$13.8</span>
                                </div>
                                <div class="add-cart">
                                   <a class="add addcart" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 d-none d-xl-block">
                <div class="product-cart-wrap style-2 wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                    <div class="product-img-action-wrap">
                        <div class="product-img">
                            <a href="shop-product-right.html">
                                <img src="{{asset('front/assets/imgs/banner/banner-8.png')}}" alt=""  onerror="this.onerror=null;this.src='{{ asset('default_product.png') }}';" />
                            </a>
                        </div>
                    </div>
                    <div class="product-content-wrap">
                        <div class="deals-countdown-wrap">
                            <div class="deals-countdown" data-countdown="2025/02/25 00:00:00"></div>
                        </div>
                        <div class="deals-content">
                            <h2><a href="shop-product-right.html">Simply Lemonade with Raspberry Juice</a></h2>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 80%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (3.0)</span>
                            </div>
                            <div>
                                <span class="font-small text-muted">By <a href="vendor-details-1.html">Yoplait</a></span>
                            </div>
                            <div class="product-card-bottom">
                                <div class="product-price">
                                    <span>$15.85</span>
                                    <span class="old-price">$16.8</span>
                                </div>
                                <div class="add-cart">
                                   <a class="add addcart" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!--End Deals-->
<section class="section-padding mb-30">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-6 mb-sm-5 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay="0">
                <h4 class="section-title style-1 mb-30 animated animated">Top Selling</h4>
                <div class="product-list-small animated animated">
                    @foreach($top_selling as $row)

                    {{-- @dd($$row->prices[0]->MinPrice) --}}
                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a href="{{route('product.details',$row->slug)}}"><img src="{{$row->main_image}}" alt="{{$row->title}}" onerror="this.onerror=null;this.src='{{ asset('default_product.png') }}';" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="{{route('product.details',$row->slug)}}">{{$row->title}}</a>
                            </h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: @if($row->review->count('rate')==0){{0}}@else{{(number_format($row->review->sum('rate')/$row->review->count('rate'),1)/5)*100}}@endif%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> ({{$row->AvgRate}})</span>
                            </div>
                            <div class="product-price">
                                <span>${{$row->MinPrice}}</span>
                                {{-- <span class="old-price">$33.8</span> --}}
                            </div>
                        </div>
                    </article>
                @endforeach
                </div>
            </div>
            {{-- <div class="col-xl-3 col-lg-4 col-md-6 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                <h4 class="section-title style-1 mb-30 animated animated">Trending Products</h4>
                <div class="product-list-small animated animated">
                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a href="shop-product-right.html"><img src="{{asset('front/assets/imgs/shop/thumbnail-4.jpg')}}" alt=""   onerror="this.onerror=null;this.src='{{ asset('default_product.png') }}';"/></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="shop-product-right.html">Organic Cage-Free Grade A Large Brown Eggs</a>
                            </h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                            <div class="product-price">
                                <span>$32.85</span>
                                <span class="old-price">$33.8</span>
                            </div>
                        </div>
                    </article>
                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a href="shop-product-right.html"><img src="{{asset('front/assets/imgs/shop/thumbnail-5.jpg')}}" alt=""  onerror="this.onerror=null;this.src='{{ asset('default_product.png') }}';" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="shop-product-right.html">Seeds of Change Organic Quinoa, Brown, & Red Rice</a>
                            </h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                            <div class="product-price">
                                <span>$32.85</span>
                                <span class="old-price">$33.8</span>
                            </div>
                        </div>
                    </article>
                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a href="shop-product-right.html"><img src="{{asset('front/assets/imgs/shop/thumbnail-6.jpg')}}" alt=""  onerror="this.onerror=null;this.src='{{ asset('default_product.png') }}';" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="shop-product-right.html">Naturally Flavored Cinnamon Vanilla Light Roast Coffee</a>
                            </h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                            <div class="product-price">
                                <span>$32.85</span>
                                <span class="old-price">$33.8</span>
                            </div>
                        </div>
                    </article>
                </div>
            </div> --}}
            <div class="col-xl-4 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-lg-block wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                <h4 class="section-title style-1 mb-30 animated animated">{{__('Recently added')}}</h4>
                <div class="product-list-small animated animated">
                    @foreach($recently_added as $row)
                    {{-- @dd($$row->prices[0]->MinPrice) --}}
                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a href="{{route('product.details',$row->slug)}}"><img src="{{$row->main_image}}" alt=""  onerror="this.onerror=null;this.src='{{ asset('default_product.png') }}';"  /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="{{route('product.details',$row->slug)}}">{{$row->title}}</a>
                            </h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: {{$row->AvgRate}}%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> ({{$row->AvgRate}})</span>
                            </div>
                            <div class="product-price">
                                <span>{{session::get('country')->currency->iso3??EGP}}{{$row->MinPrice}}</span>
                                {{-- <span class="old-price">$33.8</span> --}}
                            </div>
                        </div>
                    </article>
                @endforeach
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-xl-block wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                <h4 class="section-title style-1 mb-30 animated animated">Top Rated</h4>
                <div class="product-list-small animated animated">
                    @foreach($top_rated as $row)
                    {{-- @dd($$row->prices[0]->MinPrice) --}}
                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a href="{{route('product.details',$row->slug)}}"><img src="{{$row->main_image}}" alt="" onerror="this.onerror=null;this.src='{{ asset('default_product.png') }}';" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="{{route('product.details',$row->slug)}}">{{$row->title}}</a>
                            </h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: @if($row->review->count('rate')==0){{0}}@else{{(number_format($row->review->sum('rate')/$row->review->count('rate'),1)/5)*100}}@endif%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> ({{$row->AvgRate}})</span>
                            </div>
                            <div class="product-price">
                                <span>{{session::get('country')->currency->iso3??EGP}}{{$row->MinPrice}}</span>
                                {{-- <span class="old-price">$33.8</span> --}}
                            </div>
                        </div>
                    </article>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!--End 4 columns-->








@endsection
