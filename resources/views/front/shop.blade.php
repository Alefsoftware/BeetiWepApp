@extends('front.layouts.main')

@section('content')


<main class="main">
    <div class="page-header mt-30 mb-50">
        <div class="container">
            <div class="archive-header">
                <div class="row align-items-center">
                    <div class="col-xl-3">
                        <h1 class="mb-15">Shop</h1>
                        <div class="breadcrumb">
                            <a href="{{url('/')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                            <span></span> Shop
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container mb-30">
        <div class="row">
            <div class="col-lg-4-5">
                <div class="shop-product-fillter">
                    <div class="totall-product">
                        <p>We found <strong class="text-brand">{{count($products)}}</strong> items for you!</p>
                    </div>
                    {{-- <div class="sort-by-product-area">
                        <div class="sort-by-cover mr-10">
                            <div class="sort-by-product-wrap">
                                <div class="sort-by">
                                    <span><i class="fi-rs-apps"></i>Show:</span>
                                </div>
                                <div class="sort-by-dropdown-wrap">
                                    <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                                </div>
                            </div>
                            <div class="sort-by-dropdown">
                                <ul>
                                    <li><a class="active" href="#">50</a></li>
                                    <li><a href="#">100</a></li>
                                    <li><a href="#">150</a></li>
                                    <li><a href="#">200</a></li>
                                    <li><a href="#">All</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="sort-by-cover">
                            <div class="sort-by-product-wrap">
                                <div class="sort-by">
                                    <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                </div>
                                <div class="sort-by-dropdown-wrap">
                                    <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                                </div>
                            </div>
                            <div class="sort-by-dropdown">
                                <ul>
                                    <li><a class="active" href="#">Featured</a></li>
                                    <li><a href="#">Price: Low to High</a></li>
                                    <li><a href="#">Price: High to Low</a></li>
                                    <li><a href="#">Release Date</a></li>
                                    <li><a href="#">Avg. Rating</a></li>
                                </ul>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="row product-grid">
                    @foreach($products as $row)
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{route('product.details',$row->slug)}}">
                                        <img class="default-img" src="{{$row->main_image}}" alt="" onerror="this.onerror=null;this.src='{{ asset('default_product.png') }}';" />
                                        {{-- <img class="hover-img" src="assets/imgs/shop/product-1-2.jpg" alt="" /> --}}
                                    </a>
                                </div>
                                <div class="product-action-1" style="width:45px;">
                                    {{-- <a aria-label="Add To Wishlist" id="wishlist-toggle{{$product->id}}" data-name="{{$product->id}}"    class="action-btn btn-save{{$product->id}}"><i class="fi fi-sr-heart"></i><i class="fi-rs-heart"></i></a> --}}
                                    <a aria-label="Add To Wishlist" data-product="{{$row->id}}" class="action-btn btn-save{{$row->id}} addWishlist "><i class="fi fi-sr-heart"></i><i class="fi-rs-heart"></i></a>
                                    {{-- <a aria-label="Compare"         id="compaire{{$product->id}}"        data-name="{{$product->id}}"     class="action-btn"    href="shop-compare.html"><i class="fi-rs-shuffle"></i></a> --}}
                                    {{-- <a aria-label="Quick view"      lass="action-btn"     data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a> --}}
                                </div>
                                {{-- <div class="product-badges product-badges-position product-badges-mrg">
                                    <span class="hot">Hot</span>
                                </div> --}}
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="{{route('shop',['category'=>@$row->category_id])}}">{{@$row->category->title}}</a>
                                </div>
                                <h2><a href="{{route('product.details',$row->slug)}}">{{$row->title}}</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width:  @if($row->review->count('rate')==0){{0}}@else{{(number_format($row->review->sum('rate')/$row->review->count('rate'),1)/5)*100}}@endif%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> ({{$row->AvgRate}})</span>
                                </div>
                                <div>
                                    <span class="font-small text-muted">By <a href="{{route('shop',['provider'=>$row->provider_id])}}">{{@$row->provider->name}}</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>${{$row->MinPrice}}</span>
                                        {{-- <span class="old-price">$32.8</span> --}}
                                    </div>
                                    {{-- <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end product card-->
                    @endforeach
                </div>
                <!--product grid-->
                <div class="pagination-area mt-20 mb-20">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-start">
                            @if ($products->previousPageUrl())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $products->previousPageUrl() }}">
                                        <i class="fi-rs-arrow-small-left"></i>
                                    </a>
                                </li>
                            @endif

                            @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $products->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach

                            @if ($products->nextPageUrl())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $products->nextPageUrl() }}">
                                        <i class="fi-rs-arrow-small-right"></i>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>

                <!--End Deals-->
            </div>

            <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                <div class="sidebar-widget widget-category-2 mb-30">
                    <h5 class="section-title style-1 mb-30">Category</h5>
                    <ul>
                        @foreach($categories as $row)
                        <li>
                            <a href="{{route('shop',['category'=>$row->id])}}"> <img src="{{$row->logo}}" alt="" />{{$row->title}}</a><span class="count">{{count($row->products)}}</span>
                        </li>
                        @endforeach

                    </ul>
                </div>
                <!-- Fillter By Price -->
                <div class="sidebar-widget price_range range mb-30">
                    <h5 class="section-title style-1 mb-30">Fillter by price</h5>
                    {{-- <div class="price-filter">
                        <div class="price-filter-inner">
                            <div id="slider-range" class="mb-20"></div>
                            <div class="d-flex justify-content-between">
                                <div class="caption">From: <strong id="slider-range-value1" class="text-brand"></strong></div>
                                <div class="caption">To: <strong id="slider-range-value2" class="text-brand"></strong></div>
                            </div>
                        </div>
                    </div> --}}

                    <form action="{{route('shop')}}" method="get">
                            {{-- newwwwww --}}




                        {{-- <div data-role="page"> --}}


                        <div data-role="main" class="ui-content">

                            <div data-role="rangeslider">
                                <label for="price-min">Price:</label>
                                <input type="range" name="min" id="price-min" value="{{ old('min') }}" min="0" max="1000">
                                <label for="price-max">Price:</label>
                                <input type="range" name="max" id="price-max" value="{{ old('max') }}" min="0" max="1000">
                            </div>


                        </div>
                        {{-- </div> --}}
{{-- end newwwwww --}}
                    {{-- <div class="list-group">
                        <div class="list-group-item mb-10 mt-10">
                            <label class="fw-900">Color</label>
                            <div class="custome-checkbox">
                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="" />
                                <label class="form-check-label" for="exampleCheckbox1"><span>Red (56)</span></label>
                                <br />
                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox2" value="" />
                                <label class="form-check-label" for="exampleCheckbox2"><span>Green (78)</span></label>
                                <br />
                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox3" value="" />
                                <label class="form-check-label" for="exampleCheckbox3"><span>Blue (54)</span></label>
                            </div>
                            <label class="fw-900 mt-15">Item Condition</label>
                            <div class="custome-checkbox">
                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox11" value="" />
                                <label class="form-check-label" for="exampleCheckbox11"><span>New (1506)</span></label>
                                <br />
                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox21" value="" />
                                <label class="form-check-label" for="exampleCheckbox21"><span>Refurbished (27)</span></label>
                                <br />
                                <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox31" value="" />
                                <label class="form-check-label" for="exampleCheckbox31"><span>Used (45)</span></label>
                            </div>
                        </div>
                    </div> --}}
                    <button type="submit" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i> Fillter</button>
                </form>
                </div>
                <!-- Product sidebar Widget -->
                {{-- <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
                    <h5 class="section-title style-1 mb-30">New products</h5>
                    <div class="single-post clearfix">
                        <div class="image">
                            <img src="assets/imgs/shop/thumbnail-3.jpg" alt="#" />
                        </div>
                        <div class="content pt-10">
                            <h5><a href="shop-product-detail.html">Chen Cardigan</a></h5>
                            <p class="price mb-0 mt-5">$99.50</p>
                            <div class="product-rate">
                                <div class="product-rating" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="single-post clearfix">
                        <div class="image">
                            <img src="assets/imgs/shop/thumbnail-4.jpg" alt="#" />
                        </div>
                        <div class="content pt-10">
                            <h6><a href="shop-product-detail.html">Chen Sweater</a></h6>
                            <p class="price mb-0 mt-5">$89.50</p>
                            <div class="product-rate">
                                <div class="product-rating" style="width: 80%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="single-post clearfix">
                        <div class="image">
                            <img src="assets/imgs/shop/thumbnail-5.jpg" alt="#" />
                        </div>
                        <div class="content pt-10">
                            <h6><a href="shop-product-detail.html">Colorful Jacket</a></h6>
                            <p class="price mb-0 mt-5">$25</p>
                            <div class="product-rate">
                                <div class="product-rating" style="width: 60%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="banner-img wow fadeIn mb-lg-0 animated d-lg-block d-none">
                    <img src="assets/imgs/banner/banner-11.png" alt="" />
                    <div class="banner-text">
                        <span>Oganic</span>
                        <h4>
                            Save 17% <br />
                            on <span class="text-brand">Oganic</span><br />
                            Juice
                        </h4>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</main>


@endsection
