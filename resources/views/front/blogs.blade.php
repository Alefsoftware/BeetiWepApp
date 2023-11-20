@extends('front.layouts.main')
@section('content')
@include('admin.includes.messages')
<main class="main">
    <div class="page-header mt-30 mb-75">
        <div class="container">
            <div class="archive-header">
                <div class="row align-items-center">
                    <div class="col-xl-3">
                        <h1 class="mb-15">Blog & News</h1>
                        <div class="breadcrumb">
                            <a href="{{url('/')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                            <span></span> Blog & News
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="page-content mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop-product-fillter mb-50 pr-30">
                        <div class="totall-product">
                            <h2>
                                <img class="w-36px mr-10" src="assets/imgs/theme/icons/category-1.svg" alt="" />
                                {{__('Blogs')}}
                            </h2>
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
                                        <span><i class="fi-rs-apps-sort"></i>Sort:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span>Featured <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        <li><a class="active" href="#">Featured</a></li>
                                        <li><a href="#">Newest</a></li>
                                        <li><a href="#">Most comments</a></li>
                                        <li><a href="#">Release Date</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="loop-grid pr-30">
                        <div class="row">
                            @foreach($rows as $blog)
                            <article class="col-xl-3 col-lg-6 col-md-6 text-center hover-up mb-30 animated">
                                <div class="post-thumb">
                                    <a href="{{route('blog.details',$blog->slug)}}">
                                        <img class="border-radius-15" src="{{$blog->image}}" alt="" />
                                    </a>
                                    {{-- <div class="entry-meta">
                                        <a class="entry-meta meta-2" href="blog-category-grid.html"><i class="fi-rs-heart"></i></a>
                                    </div> --}}
                                </div>
                                <div class="entry-content-2">
                                    {{-- <h6 class="mb-10 font-sm"><a class="entry-meta text-muted" href="blog-category-grid.html">Side Dish</a></h6> --}}
                                    <h4 class="post-title mb-15">
                                        <a href="{{route('blog.details',$blog->slug)}}">{{$blog->title_field}}</a>
                                    </h4>
                                    <div class="entry-meta font-xs color-grey mt-10 pb-10">
                                        <div>
                                            <span class="post-on mr-10">{{\Carbon\Carbon::parse($blog->created_at)->format('d F Y')}}</span>

                                        </div>
                                    </div>
                                </div>
                            </article>
                            @endforeach

                        </div>
                    </div>
                    <div class="pagination-area mt-20 mb-20">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-start">
                                @if ($rows->previousPageUrl())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $rows->previousPageUrl() }}">
                                            <i class="fi-rs-arrow-small-left"></i>
                                        </a>
                                    </li>
                                @endif

                                @foreach ($rows->getUrlRange(1, $rows->lastPage()) as $page => $url)
                                    <li class="page-item {{ $page == $rows->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                @if ($rows->nextPageUrl())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $rows->nextPageUrl() }}">
                                            <i class="fi-rs-arrow-small-right"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

@stop
