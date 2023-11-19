@extends('front.layouts.main')
@section('content')
<!-- Add this to your HTML file -->
<div class="modal " id="cartAddModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-warning-soft">
            {{-- <div class="modal-header">
                <h5 class="modal-title">Success</h5>

            </div> --}}
            <div class="modal-body" style="background-color: #c1bbb1">
                <p id="cartAddMessage" class="text-white"></p>
            </div>
        </div>
    </div>
</div>
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{url('/')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> <a href="{{route('product.details',$product->slug)}}">{{$product->title}}</a> <span></span>
            </div>
        </div>
    </div>
    <div class="container mb-30">
        <div class="row">
            <div class="col-xl-10 col-lg-12 m-auto">
                <div class="product-detail accordion-detail">
                    <div class="row mb-50 mt-30">
                        <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                            <div class="detail-gallery">
                                <span class="zoom-icon"></span>
                                <!-- MAIN SLIDES -->
                                <div class="product-image-slider">
                                    @foreach($product->images as $row)
                                    <figure class="border-radius-10">
                                        <img src="{{$row->image_name}}" alt="{{$row->title}}" onerror="this.onerror=null;this.src='{{ asset('default_product.png') }}';" />
                                    </figure>

                                        @endforeach
                                </div>
                                <!-- THUMBNAILS -->
                                <div class="slider-nav-thumbnails">
                                    @foreach($product->images as $row)
                                    <div><img src="{{$row->image_name}}" alt="{{$row->title}}" onerror="this.onerror=null;this.src='{{ asset('default_product.png') }}';"/></div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- End Gallery -->
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-info pr-30 pl-30">
                                {{-- <span class="stock-status out-stock"> Sale Off </span> --}}
                                <h2 class="title-detail">{{$product->title}}</h2>
                                <div class="product-detail-rating">
                                    <div class="product-rate-cover text-end">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: {{$product->AvgRate}}%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> ( {{count($product->review)}} {{__('reviews')}})</span>
                                    </div>
                                </div>
                                <div class="clearfix product-price-cover">
                                    <div class="product-price primary-color float-left">
                                        <span class="current-price text-brand" id='price_val'>${{$product->MinPrice}}</span>
                                        {{-- <span>
                                            <span class="save-price font-md color3 ml-15">26% Off</span>
                                            <span class="old-price font-md ml-15">$52</span>
                                        </span> --}}
                                    </div>
                                </div>
                                {{-- <div class="short-desc mb-30">
                                    <p class="font-lg">{!! $product->description !!}</p>
                                </div> --}}
                                <div class="attr-detail attr-size mb-30">
                                    <strong class="mr-10">Size / Weight: </strong>
                                    <ul class="list-filter size-filter font-small">
                                        @foreach($product->prices as $row)
                                        <li><a href="#" id='ProductPriceId' data-priceid={{$row->id}} class="size-link" data-price='{{$row->price}}'>{{$row->title}}</a></li>
                                        {{-- <li class="active"><a href="#">60g</a></li> --}}
                                        <input type="hidden" name="ProductPriceId" value="{{$row->id}}">
                                        @endforeach
                                    </ul>
                                </div>


                                <div class="detail-extralink mb-50">
                                    <div class="detail-qty border radius">
                                        <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                        <input type="text" id='itemcount' name="count"  class="qty-val" value="1" min="1">
                                        <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                    </div>
                                    <div class="product-extra-link2">
                                        <button type="submit" class="button button-add-to-cart addcart" data-product="{{ $product->id }}"><i class="fi-rs-shopping-cart"></i>Add to cart</button>
                                        <a aria-label="Add To Wishlist"  data-product="{{$row->id}}" class="action-btn hover-up{{$row->id}} addWishlist "><i class="fi-rs-heart"></i></a>
                                        {{-- <a aria-label="Compare" class="action-btn hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a> --}}
                                    </div>
                                </div>
                                {{-- <div class="font-xs">
                                    <ul class="mr-50 float-start">
                                        <li class="mb-5">Type: <span class="text-brand">Organic</span></li>
                                        <li class="mb-5">MFG:<span class="text-brand"> Jun 4.2022</span></li>
                                        <li>LIFE: <span class="text-brand">70 days</span></li>
                                    </ul>
                                    <ul class="float-start">
                                        <li class="mb-5">SKU: <a href="#">FWM15VKT</a></li>
                                        <li class="mb-5">Tags: <a href="#" rel="tag">Snack</a>, <a href="#" rel="tag">Organic</a>, <a href="#" rel="tag">Brown</a></li>
                                        <li>Stock:<span class="in-stock text-brand ml-5">8 Items In Stock</span></li>
                                    </ul>
                                </div> --}}
                            </div>
                            <!-- Detail Info -->
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="tab-style3">
                            <ul class="nav nav-tabs text-uppercase">
                                <li class="nav-item">
                                    <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab" href="#Additional-info">Additional info</a>
                                </li> --}}
                                <li class="nav-item">
                                    <a class="nav-link" id="Vendor-info-tab" data-bs-toggle="tab" href="#Vendor-info">Vendor</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Reviews ({{count($product->review)}})</a>
                                </li>
                            </ul>
                            <div class="tab-content shop_info_tab entry-main-content">
                                <div class="tab-pane fade show active" id="Description">
                                    <div class="">
                                        <p>{!! $product->description!!}</p>

                                    </div>
                                </div>
                                {{-- <div class="tab-pane fade" id="Additional-info">
                                    <table class="font-md">
                                        <tbody>
                                            <tr class="stand-up">
                                                <th>Stand Up</th>
                                                <td>
                                                    <p>35″L x 24″W x 37-45″H(front to back wheel)</p>
                                                </td>
                                            </tr>
                                            <tr class="folded-wo-wheels">
                                                <th>Folded (w/o wheels)</th>
                                                <td>
                                                    <p>32.5″L x 18.5″W x 16.5″H</p>
                                                </td>
                                            </tr>
                                            <tr class="folded-w-wheels">
                                                <th>Folded (w/ wheels)</th>
                                                <td>
                                                    <p>32.5″L x 24″W x 18.5″H</p>
                                                </td>
                                            </tr>
                                            <tr class="door-pass-through">
                                                <th>Door Pass Through</th>
                                                <td>
                                                    <p>24</p>
                                                </td>
                                            </tr>
                                            <tr class="frame">
                                                <th>Frame</th>
                                                <td>
                                                    <p>Aluminum</p>
                                                </td>
                                            </tr>
                                            <tr class="weight-wo-wheels">
                                                <th>Weight (w/o wheels)</th>
                                                <td>
                                                    <p>20 LBS</p>
                                                </td>
                                            </tr>
                                            <tr class="weight-capacity">
                                                <th>Weight Capacity</th>
                                                <td>
                                                    <p>60 LBS</p>
                                                </td>
                                            </tr>
                                            <tr class="width">
                                                <th>Width</th>
                                                <td>
                                                    <p>24″</p>
                                                </td>
                                            </tr>
                                            <tr class="handle-height-ground-to-handle">
                                                <th>Handle height (ground to handle)</th>
                                                <td>
                                                    <p>37-45″</p>
                                                </td>
                                            </tr>
                                            <tr class="wheels">
                                                <th>Wheels</th>
                                                <td>
                                                    <p>12″ air / wide track slick tread</p>
                                                </td>
                                            </tr>
                                            <tr class="seat-back-height">
                                                <th>Seat back height</th>
                                                <td>
                                                    <p>21.5″</p>
                                                </td>
                                            </tr>
                                            <tr class="head-room-inside-canopy">
                                                <th>Head room (inside canopy)</th>
                                                <td>
                                                    <p>25″</p>
                                                </td>
                                            </tr>
                                            <tr class="pa_color">
                                                <th>Color</th>
                                                <td>
                                                    <p>Black, Blue, Red, White</p>
                                                </td>
                                            </tr>
                                            <tr class="pa_size">
                                                <th>Size</th>
                                                <td>
                                                    <p>M, S</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> --}}
                                <div class="tab-pane fade" id="Vendor-info">
                                    <div class="vendor-logo d-flex mb-30">
                                        <img src="assets/imgs/vendor/vendor-18.svg" alt="" />
                                        <div class="vendor-name ml-15">
                                            <h6>
                                                <a href="vendor-details-2.html">{{$product->provider->name}}</a>
                                            </h6>
                                            <div class="product-rate-cover text-end">
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width: {{(($product->provider->rate)/5)*100}}%"></div>
                                                </div>
                                                <span class="font-small ml-5 text-muted"> ({{$product->provider->rate}} )</span>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="contact-infor mb-50">
                                        {{-- <li><img src="assets/imgs/theme/icons/icon-location.svg" alt="" /><strong>Address: </strong> <span>5171 W Campbell Ave undefined Kent, Utah 53127 United States</span></li>
                                        <li><img src="assets/imgs/theme/icons/icon-contact.svg" alt="" /><strong>Contact Seller:</strong><span>(+91) - 540-025-553</span></li> --}}
                                    </ul>
                                    <div class="d-flex mb-55">
                                        {{-- <div class="mr-30">
                                            <p class="text-brand font-xs">Rating</p>
                                            <h4 class="mb-0">92%</h4>
                                        </div>
                                        <div class="mr-30">
                                            <p class="text-brand font-xs">Ship on time</p>
                                            <h4 class="mb-0">100%</h4>
                                        </div>
                                        <div>
                                            <p class="text-brand font-xs">Chat response</p>
                                            <h4 class="mb-0">89%</h4>
                                        </div> --}}
                                    </div>
                                    {{-- <p>Noodles & Company is an American fast-casual restaurant that offers international and American noodle dishes and pasta in addition to soups and salads. Noodles & Company was founded in 1995 by Aaron Kennedy and is headquartered in Broomfield, Colorado. The company went public in 2013 and recorded a $457 million revenue in 2017.In late 2018, there were 460 Noodles & Company locations across 29 states and Washington, D.C.</p> --}}
                                </div>
                                <div class="tab-pane fade" id="Reviews">
                                    <!--Comments-->
                                    <div class="comments-area">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h4 class="mb-30">Customer questions & answers</h4>
                                                <div class="comment-list">
                                                    @foreach($product->review as $row)
                                                    <div class="single-comment justify-content-between d-flex mb-30">
                                                        <div class="user justify-content-between d-flex">
                                                            <div class="thumb text-center" style="width: 20%;">
                                                                <img src="{{@$row->customer->image}}}" alt="{{@$row->customer->name}}" onerror="this.onerror=null;this.src='{{ asset('default_user.png') }}';"  />
                                                                <a href="#" class="font-heading text-brand">{{@$row->customer->name}}</a>
                                                            </div>
                                                            <div class="desc">
                                                                <div class="d-flex justify-content-between mb-10">
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="font-xs text-muted">{{$row->updated_at}}</span>
                                                                    </div>
                                                                    <div class="product-rate d-inline-block">
                                                                        <div class="product-rating" style="width: {{($row->rate/5)*100}}%"></div>
                                                                    </div>
                                                                </div>
                                                                <p class="mb-10 ">{!! $row->note ?? 'No Comment' !!}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                 @endforeach
                                                </div>
                                            </div>
                                            {{-- <div class="col-lg-4">
                                                <h4 class="mb-30">Customer reviews</h4>
                                                <div class="d-flex mb-30">
                                                    <div class="product-rate d-inline-block mr-15">
                                                        <div class="product-rating" style="width: 90%"></div>
                                                    </div>
                                                    <h6>4.8 out of 5</h6>
                                                </div>
                                                <div class="progress">
                                                    <span>5 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                                                </div>
                                                <div class="progress">
                                                    <span>4 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                                </div>
                                                <div class="progress">
                                                    <span>3 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%</div>
                                                </div>
                                                <div class="progress">
                                                    <span>2 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">65%</div>
                                                </div>
                                                <div class="progress mb-30">
                                                    <span>1 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
                                                </div>
                                                <a href="#" class="font-xs text-muted">How are ratings calculated?</a>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <!--comment form-->
                                    <div class="comment-form">
                                        <h4 class="mb-15">Add a review</h4>
                                        <div class="product-rate d-inline-block mb-30"></div>
                                        <div class="row">
                                            <div class="col-lg-8 col-md-12">
                                                <form class="form-contact comment_form" action="#" id="commentForm">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <input class="form-control" name="name" id="name" type="text" placeholder="Name" />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <input class="form-control" name="email" id="email" type="email" placeholder="Email" />
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <input class="form-control" name="website" id="website" type="text" placeholder="Website" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="button button-contactForm">Submit Review</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-60">
                        <div class="col-12">
                            <h2 class="section-title style-1 mb-30">Related products</h2>
                        </div>
                        <div class="col-12">
                            <div class="row related-products">
                                @foreach($relatedProducts as $row)
                                <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                    <div class="product-cart-wrap hover-up">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{route('product.details',$row->slug)}}" tabindex="0">
                                                    <img class="default-img" src="{{$row->main_image}}" alt="" onerror="this.onerror=null;this.src='{{ asset('default_product.png') }}';" />
                                                    {{-- <img class="hover-img" src="assets/imgs/shop/product-2-2.jpg" alt="" /> --}}
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
                                            <h2><a href="{{route('product.details',$row->slug)}}" tabindex="0">{{$row->title}}</a></h2>
                                            <div class="rating-result" title=" @if($row->review->count('rate')==0){{0}}@else{{(number_format($row->review->sum('rate')/$row->review->count('rate'),1)/5)*100}}@endif%">
                                                <span> </span>
                                            </div>
                                            <div class="product-price">
                                                <span>${{$row->MinPrice}} </span>
                                                {{-- <span class="old-price">$245.8</span> --}}
                                            </div>
                                        </div>
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
</main>



{{-- <script>
    $(document).ready(function() {

        $('.addcart').on('click', function(e) {
            e.preventDefault();
            var product_id = $(this).data('product');
            // var price_id = $(this).data('product');
            var price_id = $('#ProductPriceId').data('priceid');
            var itemcount = $('#itemcount').val();


            $.ajax({
                url: "{{ route('cart.add') }}",
                type: 'POST',
                data: {
                    item_id: product_id,
                    count: itemcount, // You can customize this as needed
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // alert(response.message); // Show a success message
                //   element.text(response.message);
                showCartAddModal(response.message);
                // alert( response.cartCount); // Show a success message
                $('#cartCount').text(response.cartCount);
                // response.cartCount
                // $('#cartalert').show();
                },
                error: function(response) {
                    if (response.status === 403) {
                        // alert(response.responseJSON.error); // Show an error message
                        showCartAddModal(response.responseJSON.error);

                    }
                }
            });
        });
    });


    function showCartAddModal(message) {
    // Update the modal content with the success message
    $('#cartAddMessage').html(message);

    // Show the modal
    $('#cartAddModal').modal('show');
}
//     function showCartAddModalError(error) {
//     // Update the modal content with the success message
//     $('#cartAddMessageError').html(error);

//     // Show the modal
//     $('#cartAddModalError').modal('show');
// }

</script> --}}


<script>
$(document).ready(function() {
    $('.size-link').click(function(e) {
        e.preventDefault(); // Prevent the default link behavior

        // Remove the "active" class from all size links
        $('.size-link').removeClass('active');

        // Add the "active" class to the clicked size link
        $(this).addClass('active');

        // Here, you can perform any additional actions based on the selected size
        // For example, you can retrieve the size from $(this).attr('id') and use it in your JavaScript code.
        var price = $(this).attr('data-price');
        $('#price_val').text("$"+price);
        // console.log('Selected size: ' + price);
    });
});
</script>

@endsection
