@extends('front.layouts.main')

@section('content')


<main class="main pages mb-80">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{url('/')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Vendors
                </div>
            </div>
        </div>
        <div class="page-content pt-50">
            <div class="container">
                <div class="archive-header-2 text-center">
                    <h1 class="display-2 mb-50">Vendors</h1>
                    {{-- <div class="row">
                        <div class="col-lg-5 mx-auto">
                            <div class="sidebar-widget-2 widget_search mb-50">
                                <div class="search-form">
                                    <form action="">
                                        <input type="text" name="title" placeholder="Search vendors (by name)..." />
                                        <button type="submit"><i class="fi-rs-search"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
                {{-- <div class="row mb-50">
                    <div class="col-12 col-lg-8 mx-auto">
                        <div class="shop-product-fillter">
                            <div class="totall-product">
                                <p>We have <strong class="text-brand">{{count($providers)}}</strong> vendors now</p>
                            </div>
                            <div class="sort-by-product-area">
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
                                            <li><a class="active" href="#">Mall</a></li>
                                            <li><a href="#">Featured</a></li>
                                            <li><a href="#">Preferred</a></li>
                                            <li><a href="#">Total items</a></li>
                                            <li><a href="#">Avg. Rating</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="row vendor-grid">
                    @foreach ( $providers as $row )

                    <div class="col-lg-3 col-md-6 col-12 col-sm-6">
                        <div class="vendor-wrap mb-40">
                            <div class="vendor-img-action-wrap">
                                <div class="vendor-img">
                                    <a href="{{route('shop',['provider'=>$row->id])}}">
                                        <img class="default-img" src="{{$row->profile_img}}" alt="" onerror="this.onerror=null;this.src='{{ asset('default_user.png') }}';" />
                                    </a>
                                </div>
                                {{-- <div class="product-badges product-badges-position product-badges-mrg">
                                    <span class="hot">Mall</span>
                                </div> --}}
                            </div>
                            <div class="vendor-content-wrap">
                                <div class="d-flex justify-content-between align-items-end mb-30">
                                    <div>
                                        <div class="product-category">
                                            <span class="text-muted">Since {{$row->created_at->format('Y')}}</span>
                                        </div>
                                        <h4 class="mb-5"><a href="{{route('shop',['provider'=>$row->id])}}">{{$row->name}}</a></h4>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width:{{(($row->rate)/5)*100}}%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> ({{$row->rate}})</span>
                                        </div>
                                    </div>
                                    <div class="mb-10">
                                        <span class="font-small total-product">{{count($row->activeProducts)}} products</span>
                                    </div>
                                </div>
                                {{-- <div class="vendor-info mb-30">
                                    <ul class="contact-infor text-muted">
                                        <li><img src="assets/imgs/theme/icons/icon-location.svg" alt="" /><strong>Address: </strong> <span>5171 W Campbell Ave undefined Kent, Utah 53127 United States</span></li>
                                        <li><img src="assets/imgs/theme/icons/icon-contact.svg" alt="" /><strong>Call Us:</strong><span>{{$row->mobile}}</span></li>
                                    </ul>
                                </div> --}}
                                <a href="{{route('shop',['provider'=>$row->id])}}" class="btn btn-xs">{{__('Visit Store')}} <i class="fi-rs-arrow-small-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <!--end vendor card-->
              @endforeach

                </div>
                <div class="pagination-area mt-20 mb-20">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-start">
                            @if ($providers->previousPageUrl())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $providers->previousPageUrl() }}">
                                        <i class="fi-rs-arrow-small-left"></i>
                                    </a>
                                </li>
                            @endif

                            @foreach ($providers->getUrlRange(1, $providers->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $providers->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach

                            @if ($providers->nextPageUrl())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $providers->nextPageUrl() }}">
                                        <i class="fi-rs-arrow-small-right"></i>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>

            </div>
        </div>
    </main>
    @stop
