@extends('front.layouts.main')

@section('content')

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{url('/')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Shop <span></span> Fillter
        </div>
    </div>
</div>
<div class="container mb-30 mt-50">
    <div class="row">
        <div class="col-xl-10 col-lg-12 m-auto">
            <div class="mb-50">
                <h1 class="heading-2 mb-10">Your Wishlist</h1>
                <h6 class="text-body">There are <span class="text-brand">{{count($products)}}</span> products in this list</h6>
            </div>
            <div class="table-responsive shopping-summery">
                @if (\Session::has('message'))
    <div class="alert alert-success text-center">
        <ul>
            <li>{!! \Session::get('message') !!}</li>
        </ul>
    </div>
@endif
                <table class="table table-wishlist">
                    <thead>
                        <tr class="main-heading">
                            <th class="custome-checkbox start pl-30">
                              #
                            </th>
                            <th scope="col" colspan="2">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Stock Status</th>
                            {{-- <th scope="col">Action</th> --}}
                            <th scope="col" class="end">Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        @php($count= $loop->index + 1)
                           <tr class="pt-30">
                            <td class="custome-checkbox pl-30">
                                {{$count}}
                            </td>
                            <td class="image product-thumbnail pt-40"><img src="{{@$product->images[0]->image_name}}" alt="{{$product->title}}" onerror="this.onerror=null;this.src='{{ asset('default_product.png') }}';" /></td>
                            <td class="product-des product-name">
                                <h6><a class="product-name mb-10" href="{{route('product.details',$product->slug)}}">{{$product->title}}</a></h6>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: @if($product->review->count('rate')==0){{0}}@else{{(number_format($product->review->sum('rate')/$product->review->count('rate'),1)/5)*100}}@endif%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (@if($product->review->count('rate')==0){{0}}@else{{number_format($product->review->sum('rate')/$product->review->count('rate'),1)}}@endif)</span>
                                </div>
                            </td>
                            <td class="price" data-title="Price">
                                <h3 class="text-brand">{{session()->get('country')->currency->iso3??EGP}}  {{@$product->prices[0]->price}}</h3>
                            </td>
                            @if($product->is_active==1)
                            <td class="text-center detail-info" data-title="Stock">
                                <span class="stock-status in-stock mb-0"> In Stock</span>
                            </td>
                            @else
                            <td class="text-center detail-info" data-title="Stock">
                                <span class="stock-status out-stock mb-0"> Out Stock </span>
                            </td>
                            @endif
                            {{-- <td class="text-right" data-title="Cart">
                                @if($product->is_active==1)<button class="btn btn-sm">Add to cart</button>@else<button class="btn btn-sm btn-secondary">Contact Us</button>@endif
                            </td> --}}
                            <td class="action text-center" data-title="Remove">
                                <a href="{{url('deleteWishlist/'.$product->id)}}" class="text-body"><i class="fi-rs-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
