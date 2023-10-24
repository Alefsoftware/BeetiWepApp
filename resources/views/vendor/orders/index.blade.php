@extends('admin.layouts.main')
@section('content')
@include('admin.includes.messages')
            <!-- Body: Body -->
            <div class="body d-flex py-lg-3 py-md-2">
                <div class="container-xxl">
                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                {{-- <h3 class="fw-bold mb-0">{{__('Providers Information')}}</h3> --}}
                                <h2 class="intro-y text-lg font-medium mt-10">
                                    {{__('Orders')}}
                                </h2>
                                <div class="col-auto d-flex w-sm-100">
                                   <!-- <button type="button" class="btn btn-primary btn-set-task w-sm-100" data-bs-toggle="modal" data-bs-target="#expadd"><i class="icofont-plus-circle me-2 fs-6"></i>{{__('Add Provider')}}</button> !-->
                                </div>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <div class="row clearfix g-3">
                        <div class="col-lg-12">

                            <form method="get" action="{{url('provider/orders')}}">
                                @csrf

                                <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-2">
                                    <div class="flex w-full sm:w-auto">


                                <div class="form-group col-md-2">
                                  <label for="status-filter">{{__('Status')}}:</label>
                                  <select name='status' class="form-select mr-3" id="status-filter">
                                    <option value="">{{__('All')}}</option>
                                    @foreach($status as $s)
                                    <option value="{{$s->id}}">{{$s->title}}</option>
                                    @endforeach
                                  </select>
                                </div>


                                <div class="form-group col-md-2">
                                  <label for="status-filter">{{__('Gov')}}:</label>
                                  <select name='gov' class="form-control" id="gov-select">
                                    <option value="">{{__('All')}}</option>
                                    @foreach($all_gov as $g)
                                    <option value="{{$g->id}}">{{$g->title}}</option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="form-group col-md-2">
                                  <label for="status-filter">{{__('Zone')}}:</label>
                                  <select name='zone' class="form-control" id="zone-select">
                                    <option value="">{{__('All')}}</option>
                                    {{-- @foreach($all_zones as $z)
                                    <option value="{{$z->id}}">{{$z->name}}</option>
                                    @endforeach --}}
                                  </select>
                                </div>
                                <div class="form-group col-md-4 mt-5">
                                <button type='submit' class="btn btn-primary  add-todo-item ml-1">{{__('search')}}</button>
                                </div>


                                    </div>
                                    </div>

                              </form>


                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class='intro-y col-span-12 overflow-auto lg:overflow-visible'>
                                    <table id="myDataTable"class="table table-report -mt-2" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>{{__('#')}}</th>
                                                <th>{{__("Provider")}}</th>
                                                {{-- <th>{{__('Order Number')}}</th> --}}
                                                <th>{{__('Type')}}</th>

                                                <th>{{__('phone')}}</th>
                                                <th>{{__('Date')}}</th>
                                                <th>{{__('Status')}}</th>
                                                <th>{{__('Price')}}</th>
                                                <th>{{__('Action')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($rows as $index=>$r)
                                            <tr>

                                                <td><strong>#{{$index+1}}</strong></td>
                                           <td>
                                            <a href="{{url('provider/orders/view',$r->id)}}" target="_blank">  <img class="w120 rounded img-fluid" src="{{$r->provider->profile_img}}" alt=""> </a>
                                                    <h6 class="mb-3 fw-bold">{{$r->provider->name}} <span class="text-muted small fw-light d-block">{{$r->order_num}}</span></h6>

                                                </td>
                                                <td>@if($r->order_type_id == 1)<span class="">{{__('Delivery')}}</span> @else<span class=""> {{__("Pickup")}}@endif</span></td>

                                                <td>{{$r->provider->mobile}}</td>
                                                <td>{{$r->created_at}} </td>
                                                <td>{{$r->status->title}}</td>
                                                <td>{{$r->total_amount}}</td>

                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                        <a href="{{url('provider/orders/view',$r->id)}}" target="_blank" class="btn btn-outline-secondary"> <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="eye" data-lucide="eye" class="lucide lucide-eye block mx-auto"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a>
                                                        {{-- <form action="{{ route('category.destroy', $r->id) }}" method="post" id='delform' style="display: inline-block">
                                                            @csrf
                                                            @method('delete')
                                                        <button type="submit" class="btn btn-outline-secondary deleterow" onclick="return confirm('Are you sure?')"><i class="icofont-ui-delete text-danger"></i></button>
                                                         </form> --}}

                                                    </div>
                                                </td>
                                            </tr>
                                          @endforeach
                                        </tbody>
                                    </table>

                                </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- Row End -->
                </div>
            </div>

            <div class="col-12 d-flex justify-content-center">
                {{ $rows->links('pagination::bootstrap-4') }}
            </div>

        </div>

    </div>

  @stop
