@extends('admin.layouts.master')
@section('content')
    @php
    // dd($product);
    @endphp
<div class="card">
                        <h5 class="card-header">View Product</h5>
                                <div class="card-body">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{url('admin')}}/dashboard">Home</a></li>
                                            <li class="breadcrumb-item"><a href="{{url('admin')}}/products">Products </a></li>
                                            <li class="breadcrumb-item active" aria-current="page">View Product</li>
                                        </ol>
                                    </nav>
                                </div>
                    </div>
					
                <section class="app-user-edit">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-pills" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab"
                                        href="#details" aria-controls="details" role="tab" aria-selected="true">
                                        <i data-feather="user"></i><span class="d-none d-sm-block">Details</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center" id="reviewies-tab" data-toggle="tab"
                                        href="#reviewies" aria-controls="reviewies" role="tab" aria-selected="false">
                                        <i data-feather="info"></i><span class="d-none d-sm-block">Reviewies</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <!-- Details Tab starts -->
                                <div class="tab-pane active" id="details" aria-labelledby="details-tab" role="tabpanel">
                                    <section class="app-ecommerce-details">
                                        <div class="card">
                                            <!-- Product Details starts -->
                                            <div class="card-body">
                                                <div class="row my-2">
                                                    <div
                                                        class="col-12 col-md-5 d-flex align-items-center justify-content-center mb-2 mb-md-0">
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            <img src="{{ $product->images[0]['image_name'] }}"
                                                                class="img-fluid product-img" alt="product image" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-7">
                                                        <h4>{{ $product->title }}</h4>
                                                        <span class="card-text item-company">By <a href="javascript:void(0)"
                                                                class="company-name">Tamam</a></span>
                                                                @foreach ($product->stock as $stock )

                                                        <p class="card-text">Available
                                                            {{ $stock->quantity }} - <span
                                                                class="text-success">In
                                                                stock</span></p>
                                                                @endforeach
                                                        <p class="card-text">
                                                            {{ $product->description }}
                                                        </p>
                                                        <hr />
                                                        <div class="media-body my-auto">
                                                            <p class="card-text">
                                                                Product Average Rate :
                                                                <ul class="unstyled-list list-inline border-left">

                                                                    @php
                                                                            if ($product->avg_rate != 0)

                                                                        {
                                                                        $x = 1;

                                                                        while ($x <= $product->avg_rate) {
                                                                            echo '<li class="ratings-list-item"><i data-feather="star"
                                                                    class="filled-star"></i></li>';
                                                                            $x++;
                                                                        }
                                                                    }
                                                                        else
                                                                        {
                                                                        echo '<li class="ratings-list-item"><i data-feather="star"
                                                                        class="unfilled-star"></i></li>
                                                                <li class="ratings-list-item"><i data-feather="star"
                                                                        class="unfilled-star"></i></li>
                                                                <li class="ratings-list-item"><i data-feather="star"
                                                                        class="unfilled-star"></i></li>
                                                                <li class="ratings-list-item"><i data-feather="star"
                                                                        class="unfilled-star"></i></li>
                                                                <li class="ratings-list-item"><i data-feather="star"
                                                                        class="unfilled-star"></i></li>';
                                                                }
                                                                    @endphp
                                                                </ul>
                                                            </p>

                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Product Details ends -->
                                        </div>
                                    </section>
                                </div>
                                <!-- Details Tab ends -->

                                <!-- Reviewies Tab starts -->
                                <div class="tab-pane" id="reviewies" aria-labelledby="reviewies-tab" role="tabpanel">
                                    <!-- users edit Info form start -->
                                    <div class="col-12">
                                        <div class="card card-employee-task">
                                            <div class="card-body">
                                                <div class="warn-with-time">
                                                    @if ($message = Session::get('success'))
                                                    <div class="alert alert-success">
                                                        <p>{{ $message }}</p>
                                                    </div>
                                                @endif
                                                @if ($errors->any())
                                                    {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}

                                                @endif
                                            </div>
                                                @foreach ($reviews as $review)
                                                    <div
                                                        class="employee-task d-flex justify-content-between align-items-center">
                                                        <div class="media">
                                                            <div class="avatar mr-75">
                                                                <img src="{{ $review->customer->profile_img }}"
                                                                    class="rounded" width="42" height="42"
                                                                    alt="Avatar" />
                                                            </div>
                                                            <div class="media-body my-auto">
                                                                <h6 class="mb-0">{{ $review->customer->name }}
                                                                </h6>
                                                                <ul class="unstyled-list list-inline border-left">

                                                                    @php

                                                                        $x = 1;

                                                                        while ($x <= $review->rate) {
                                                                            echo '<li class="ratings-list-item"><i data-feather="star"
                                                                    class="filled-star"></i></li>';
                                                                            $x++;
                                                                        }
                                                                    @endphp
                                                                </ul>
                                                            </div>
                                                            <div class="media-body my-auto">
                                                                <h6 class="mb-0">{{ $review->note }}</h6>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <a class="dropdown-item" href="{{url('admin/products/review-remove/'.$review->id)}}">
                                                                <i data-feather="trash-2" class="align-middle mr-50"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <!-- users edit Info form ends -->
                                </div>
                                <!-- Reviewies Tab ends -->
                            </div>
                        </div>
                    </div>
                </section>
                <!-- users edit ends -->


@endsection
