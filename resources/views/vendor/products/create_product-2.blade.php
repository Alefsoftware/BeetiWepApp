@extends('admin.layouts.master')
@section('content')
<div class="card">
                        <h5 class="card-header">Create Product</h5>
                                <div class="card-body">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{url('admin')}}/dashboard">Home</a></li>
                                            <li class="breadcrumb-item"><a href="{{url('admin')}}/products">Products </a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Create Product</li>
                                        </ol>
                                    </nav>
                                </div>
                    </div>

            <div class="body-content-overlay"></div>
            <div class="content-wrapper">
                <div class="col-12">
                    <div class="card">
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
                        <div class="card-body">
                            <form class="todo-modal needs-validation" method="post" action="{{ url('admin/products/create') }}" id="upload_form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                                    <div class="action-tags">
                                        <div class="media mb-2">
                                            <img src="{{ asset('my-assets/app-assets/images/avatars/placeholder.png') }}"
                                                alt="users avatar"
                                                class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer img-container img-thumbnail"
                                                height="90" width="200" />
                                            <div class="media-body mt-50">
                                                <div class="col-12 d-flex mt-1 px-0">
                                                    <label class="btn btn-primary mr-75 mb-0" for="change-picture">
                                                        <span class="d-none d-sm-block">Add</span>
                                                        <input class="form-control" type="file" name="images"  id="change-picture"
                                                            hidden accept="image/png, image/jpeg, image/jpg" />
                                                        <span class="d-block d-sm-none">
                                                            <i class="mr-0" data-feather="plus-square"></i>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row d-flex align-items-end">
                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label for="title" class="form-label">English
                                                        Title</label>
                                                    <input type="text" id="title" name="title"
                                                        class="new-todo-item-title form-control"
                                                        placeholder="Title" />
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label for="title_ar" class="form-label">Arabic
                                                        Title</label>
                                                    <input type="text" id="title_ar" name="title_ar"
                                                        class="new-todo-item-title form-control"
                                                        placeholder="Title" />
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="form-group position-relative">
                                                    @php
                                                        $categories = \App\Models\Category::get();
                                                    @endphp
                                                    <label for="category_id"
                                                        class="form-label d-block">Category</label>
                                                    <select class="select2 form-control" id="category_id"
                                                        name="category_id">
                                                        <option hidden>Choose Category</option>
                                                        @foreach ($categories as $item)
                                                        <option data-img="{{url('')}}{{$item->logo}}" value="{{ $item->id }}">{{ $item->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            {{-- <div class="col-md-4 col-12">
                                                <div class="form-group position-relative">
                                                 <label for="sub_category_id"
                                                        class="form-label d-block">SubCategory</label>
                                                    <select class="select2 form-control" id="sub_category_id"
                                                        name="sub_category_id">
                                                    </select>
                                                </div>
                                            </div> --}}
                                        </div>
                                        <div class="row d-flex align-items-end">
                                            <div class="col-md-4 col-12">
                                                <div class="form-group mb-10" id='price'>
                                                    <label for="exampleFormControlInput1" class="required form-label">@lang('site.Price')</label>
                                                    <input type='number' name="price" class="form-control" value="{{ old('price') }}" />
                                                </div>
                                                <br>
                                                <input type="button" class="btn btn-dark float-md-right bt-sm" id='more' onclick="add_more_field();" value="add more prices +" width="10px">
                                                <br>
                                                 <div id="price_field">

                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label for="prepare_time" class="form-label">
                                                        Prepare Time</label>
                                                    <input type="text" id="prepare_time" name="prepare_time"
                                                        class="new-todo-item-title form-control"
                                                        placeholder="prepare_time" />
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label for="quantity" class="form-label">
                                                        Quantity</label>
                                                    <input type="number" id="quantity" min="0" name="quantity"
                                                        class="new-todo-item-title form-control"
                                                        placeholder="Quantity" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row d-flex align-items-end">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label">English Description</label>
                                                    <textarea name="description"
                                                        id="description"
                                                        class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Arabic Description</label>
                                                    <textarea name="description_ar"
                                                        id="description_ar"
                                                        class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group my-1">
                                    <button type="submit" class="btn btn-primary add-todo-item ml-1">Add</button>
                                    <button type="button" class="btn btn-outline-secondary add-todo-item"
                                        data-dismiss="modal">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Right Sidebar ends -->

<script type = "text/javascript" >
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   $(document).ready(function() {
       $('#category_id').on('change', function(e) {
           var cat_id = e.target.value;
           $.ajax({
               url: "{{ url('admin/products/sub-category') }}",
               type: "POST",
               data: {
                   category_id: cat_id
               },
               success: function(data) {
                $("#sub_category_id").empty();
                $("#sub_category_id").append('<option>Select Sub Category</option>');
                $.each(data,function(key){
                    $("#sub_category_id").append('<option value="'+data[key].id+'">'+data[key].title+'</option>');
                });
               }
           })
       });
   });
</script>
<script>
    var counter=0

    function add_more_field(){

             $('#price').hide();
        counter+=1;
        html='<div class="row" id="row'+counter+'">\
                <div class="col-3">\
                    <label>Size</label>\
                    <input type="text" class="form-control"  name="arr['+counter+'][size]" placeholder="Size">\
                </div>\
                <div class="col-3">\
                    <label>Price</label>\
                    <input type="text" class="form-control" name="arr['+counter+'][extra_price]" placeholder="L.E.">\
                </div>\
    </div>'
        $('#price_field').append(html);

    }
</script>

@endsection
