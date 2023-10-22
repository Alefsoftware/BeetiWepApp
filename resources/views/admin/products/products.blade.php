@extends('admin.layouts.main')
@section('content')
@include('admin.includes.messages')
{{-- @dd($products) --}}
       <!-- BEGIN: Content -->
       <div class="content">
        <h2 class="intro-y text-lg font-medium mt-10">
            Product Grid
        </h2>
        <div class="grid grid-cols-12 gap-6 mt-5">


             <!-- BEGIN: General Report -->
             <div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        {{__('Products Report')}}
                    </h2>
                    <a href="" class="ml-auto flex items-center text-primary"> <i data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="user" class="report-box__icon text-success"></i>
                                    <div class="ml-auto">
{{--                                            <div class="report-box__indicator bg-success tooltip cursor-pointer" title="22% Higher than last month"> 22% <i data-lucide="chevron-up" class="w-4 h-4 ml-0.5"></i> </div>--}}
                                    </div>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{$products->total()}}</div>
                                <div style="min-height: 50px;" class="text-base text-slate-500 mt-1">{{__('Total Products')}}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="shopping-cart" class="report-box__icon text-primary"></i>
                                    <div class="ml-auto">
{{--                                            <div class="report-box__indicator bg-success tooltip cursor-pointer" title="33% Higher than last month"> 33% <i data-lucide="chevron-up" class="w-4 h-4 ml-0.5"></i> </div>--}}
                                    </div>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{$pendings->total()}}</div>
                                <div style="min-height: 50px;" class="text-base text-slate-500 mt-1">{{__('Pending Products')}}</div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <!-- END: General Report -->


            <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
                {{-- <button class="btn btn-primary shadow-md mr-2">Add New Product</button> --}}
                <div class="dropdown">
                    {{-- <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                        <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i> </span>
                    </button> --}}
                    <a href='{{route("products.create")}}' class="btn btn-primary shadow-md mr-2">{{__('Add New Product')}}</a>

                    {{-- <div class="dropdown-menu w-40">
                        <ul class="dropdown-content">
                            <li>
                                <a href="" class="dropdown-item"> <i data-lucide="printer" class="w-4 h-4 mr-2"></i> Print </a>
                            </li>
                            <li>
                                <a href="" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export to Excel </a>
                            </li>
                            <li>
                                <a href="" class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export to PDF </a>
                            </li>
                        </ul>
                    </div> --}}
                </div>
                {{-- <div class="hidden md:block mx-auto text-slate-500">Showing 1 to 10 of 150 entries</div> --}}
                <form action="" method="get">
                <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                    <div class="w-56 relative text-slate-500">
                        <input type="text" name="title" class="form-control w-56 box pr-10" placeholder="Product Title">
                        <button type="submit" class="input-group-text" > <i class="w-4 h-4 absolute mt-3 inset-y-0 mr-3 right-0" data-lucide="search"></i></button>
                    </div>
                </div>
            </form>

            </div>

            <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-12">
            <form method="get" action="{{url('admin/products')}}">
                @csrf

                <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-2">
                    <div class="flex w-full sm:w-auto">

                <div class="form-group col-md-2">
                  <label for="status-filter">{{__('Provider')}}:</label>
                  <select name='provider' class="form-select mr-3" id="status-filter">
                    <option value="">{{__('All')}}</option>
                    @foreach($providers as $s)
                    <option value="{{$s->id}}">{{$s->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="status-filter">{{__('Status')}}:</label>
                    <select name='approvement' class="form-select mr-3" id="status-filter">
                      <option value="">{{__('All')}}</option>
                      <option value="1">{{__("Approved")}}</option>
                      <option value="0">{{__(" Not Approved")}}</option>
                    </select>
                  </div>



                <div class="form-group col-md-4 mt-5">
                <button type='submit' class="btn btn-primary  add-todo-item ml-1">{{__('search')}}</button>
                </div>


                    </div>
                    </div>

              </form>


            </div>

            <!-- BEGIN: Users Layout -->
            @foreach( $products as $product)
            <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3">
                <div class="box">
                    <div class="p-5">
                        <div class="h-40 2xl:h-56 image-fit rounded-md overflow-hidden before:block before:absolute before:w-full before:h-full before:top-0 before:left-0 before:z-10 before:bg-gradient-to-t before:from-black before:to-black/10">
                            <img alt="Midone - HTML Admin Template" class="rounded-md" src="{{@$product->main_image}}">
                            {{-- <span class="absolute top-0 bg-pending/80 text-white text-xs m-5 px-2 py-1 rounded z-10">Featured</span> --}}
                            <div class="absolute bottom-0 text-white px-5 pb-6 z-10"> <a href="" class="block font-medium text-base">{{$product->title}}</a> <span class="text-white/90 text-xs mt-3">{{$product->category->title?? '-'}}</span> </div>
                        </div>
                        <div class="text-slate-600 dark:text-slate-500 mt-5">
                            {{-- <div class="flex items-center"> <i data-lucide="link" class="w-4 h-4 mr-2"></i> Price: $37 </div> --}}
                            <div class="flex items-center mt-2"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> Status: @if($product->approved_by_admin == 1) {{__('Active')}} @else{{__("Inactive")}} @endif </div>

                            {{-- <div class="flex items-center mt-2"> <i data-lucide="layers" class="w-4 h-4 mr-2"></i>
                                {{__('Approvment')}} :
                               <form id="status{{$product->id}}" method="post" action="{{route('product.updateStatus',$product->id)}}">
                               @csrf
                               <div class="form-check form-switch">
                                 <input class="form-check-input" name='status' @if($product->approved_by_admin == 1) checked @endif type="checkbox" id="productSwitch{{$product->id}}" name="productSwitch" value="1">
                                 <label class="form-check-label" for="toggleSwitch">{{__('OFF')}} / {{__('ON')}} </label>
                               </div>

                             </form>
                             <script>
                               $(document).ready(function() {

                                 $('#productSwitch{{$product->id}}').change(function() {
                                   $('#status{{$product->id}}').submit();
                                 });
                               });
                             </script>
                             </div> --}}

                        </div>
                    </div>
                    <div class="flex justify-center lg:justify-end items-center p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                        {{-- <a class="flex items-center text-primary mr-auto" href="javascript:;"> <i data-lucide="eye" class="w-4 h-4 mr-1"></i> Preview </a> --}}
                        <div class="flex items-center text-primary mr-auto">
                           <form id="status{{$product->id}}" method="post" action="{{route('product.updateStatus',$product->id)}}">
                           @csrf
                           <div class="form-check form-switch">
                             <input class="form-check-input" name='status' @if($product->approved_by_admin == 1) checked @endif type="checkbox" id="productSwitch{{$product->id}}" name="productSwitch" value="1">
                             {{-- <label class="form-check-label" for="toggleSwitch">{{__('OFF')}} / {{__('ON')}} </label> --}}
                           </div>

                         </form>
                         <script>
                           $(document).ready(function() {

                             $('#productSwitch{{$product->id}}').change(function() {
                               $('#status{{$product->id}}').submit();
                             });
                           });
                         </script>
                         </div>
                        <a class="flex items-center mr-3" href="{{url('admin/products/edit/'.$product->id)}}"> <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                        <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal{{$product->id}}"> <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                    </div>
                </div>
            </div>
             <!-- BEGIN: Delete Confirmation Modal -->
                <div id="delete-confirmation-modal{{$product->id}}" class="modal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="p-5 text-center">
                                    <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                                    <div class="text-3xl mt-5">Are you sure?</div>
                                    <div class="text-slate-500 mt-2">
                                        Do you really want to delete these records?
                                        <br>
                                        This process cannot be undone.
                                    </div>
                                </div>
                                <div class="px-5 pb-8 text-center">
                                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                                    <form action="{{URL('admin/products/delete',$product->id)}}" method="post" id='delform' style="display: inline-block">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger w-24">{{__('Delete')}}</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Delete Confirmation Modal -->
           @endforeach
            <!-- END: Users Layout -->
            <!-- BEGIN: Pagination -->
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">

                <div class="row g-3 mb-3">
                    <div class="col-md-12">
                        <nav class="justify-content-end d-flex">
                    <style>
                    .pagination{
                        place-content: center !important;
                    }
                    </style>
                        {{ $products->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </nav>
                    </div>
                </div>
            </div>
            <!-- END: Pagination -->
        </div>
    </div>
    <!-- END: Content -->

    @stop

