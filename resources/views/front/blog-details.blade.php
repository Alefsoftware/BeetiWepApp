@extends('front.layouts.main')
@section('content')
@include('admin.includes.messages')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{url('/')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> <a href="{{url('/blogs')}}">Blog</a> <span></span> {{$blog->title_field}}
            </div>
        </div>
    </div>
    <div class="page-content mb-50">
        <div class="container">
            <div class="row">
                <div class="col-xl-11 col-lg-12 m-auto">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="single-page pt-50 pr-30">
                                <div class="single-header style-2">
                                    <div class="row">
                                        <div class="col-xl-10 col-lg-12 m-auto">
                                            <h6 class="mb-10"><a href="{{url('/blogs')}}">Blog</a></h6>
                                            <h2 class="mb-10"> {{$blog->title_field}}</h2>
                                            <div class="single-header-meta">
                                                <div class="entry-meta meta-1 font-xs mt-15 mb-15">
                                                    {{-- <a class="author-avatar" href="#">
                                                        <img class="img-circle" src=" {{$blog->image}}" alt="" />
                                                    </a> --}}
                                                    {{-- <span class="post-by">By <a href="#">Sugar Rosie</a></span> --}}
                                                    <span class="post-on has-dot"> {{\Carbon\Carbon::parse($blog->created_at)->format('d F Y')}}</span>
                                                    {{-- <span class="time-reading has-dot">8 mins read</span> --}}
                                                </div>
                                                <div class="social-icons single-share">
                                                    <ul class="text-grey-5 d-inline-block">
                                                        <li class="mr-5">
                                                            <a href="#"><img src="assets/imgs/theme/icons/icon-bookmark.svg" alt="" /></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><img src="assets/imgs/theme/icons/icon-heart-2.svg" alt="" /></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="single-content">
                                    <div class="row">
                                        <div class="col-xl-10 col-lg-12 m-auto">
                                            <p class="single-excerpt">{!! $blog->summary_field!!}</h5>
                                            <img class="mb-30 mt-30" src="{{$blog->image}}" alt="" />
                                            <p>{!! $blog->des_field!!}</p>

                                            <!--Entry bottom-->
                                            <div class="entry-bottom mt-50 mb-30">

                                                <div class="social-icons single-share">
                                                   <a class="mb-5"> <strong class="mr-10">Share this:</strong></a>

                                                    {{-- share link --}}
                                                    <div class="sharethis-inline-share-buttons" ></div>
                                                    {{-- end share link --}}

                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 primary-sidebar sticky-sidebar pt-50">
                            <div class="widget-area">

                                <div class="sidebar-widget widget-category-2 mb-50">
                                    <h5 class="section-title style-1 mb-30"><a class="mb-5"> <strong class="mr-10">Share this:</strong></a></h5>
                                       {{-- share link --}}
                                       <div class="sharethis-inline-share-buttons" ></div>
                                       {{-- end share link --}}
                                </div>
                                <!-- Product sidebar Widget -->
                                <div class="sidebar-widget product-sidebar mb-50 p-30 bg-grey border-radius-10">
                                    <h5 class="section-title style-1 mb-30">Related Blogs</h5>
                                    @foreach($related_blogs as $blog)
                                    <div class="single-post clearfix">
                                        <div class="image">
                                            <img src="{{$blog->image}}" alt="{{route('blog.details',$blog->slug)}}" />
                                        </div>
                                        <div class="content pt-10">
                                            <h5><a href="{{route('blog.details',$blog->slug)}}">{{$blog->title_field}}</a></h5>

                                        </div>
                                    </div>
                            @endforeach
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@stop
