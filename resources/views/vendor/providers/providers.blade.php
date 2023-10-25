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
                                    {{__('Providers Information')}}
                                    <form action="" method="get">
                                        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                                            <div class="w-56 relative text-slate-500">
                                                <input type="text" name="title" class="form-control w-56 box pr-10" placeholder="Provider Name Or Phone">
                                                <button type="submit" class="input-group-text" > <i class="w-4 h-4 absolute mt-3 inset-y-0 mr-3 right-0" data-lucide="search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </h2>
                                <div class="col-auto d-flex w-sm-100">
                                   <!-- <button type="button" class="btn btn-primary btn-set-task w-sm-100" data-bs-toggle="modal" data-bs-target="#expadd"><i class="icofont-plus-circle me-2 fs-6"></i>{{__('Add Provider')}}</button> !-->
                                </div>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <div class="row clearfix g-3">
                        <div class="col-lg-12">

                            <form method="get" action="{{url('admin/providers')}}">
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
                                    <table id="myProjectTable" class="table table-report -mt-2" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>{{__('Image')}}</th>
                                                <th>{{__('Name')}}</th>
                                                <th>{{__('Register Date')}}</th>
                                                <th>{{__('Phone')}}</th>
                                                <th>{{__('Country')}}</th>
                                                <th>{{__('Status')}}</th>
                                                <th>{{__('Total Order')}}</th>
                                                <th>{{__('Actions')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($providers as $provider)
                                            <tr>
                                                <td>
                                                    <div class="flex">
                                                        <a href="{{url('admin/providers/edit/'.$provider->id)}}">
                                                    <div class="w-10 h-10 image-fit zoom-in">
                                                        <img alt="{{$provider->name ?? ''}}" class="tooltip rounded-full" src="{{$provider->profile_img}}" title="{{$provider->name ??''}}">
                                                    </div>
                                                </a>

                                                    </div>
                                                 </td>
                                                <td>
                                                        <a href="{{url('administration/providers/edit/'.$provider->id)}}">
                                                            <span class="fw-bold ms-1">{{@$provider->name}}</span>
                                                        </a>
                                                </td>
                                                <td>
                                                    {{$provider->created_at}}
                                                </td>
                                                <td>{{$provider->country_code}}-{{$provider->mobile}}</td>
                                                <td>{{@$provider->countryObj->name}}</td>
                                                <td>{{@$provider->statusObj->title}}
                                                    <form id="status{{$provider->id}}" method="post" action="{{ route('provider.updateStatus',$provider->id) }}">
                                                        @csrf
                                                        <div class="form-check form-switch">
                                                          <input class="form-check-input" name='status' @if($provider->status == 7) checked @endif type="checkbox" id="providerSwitch{{$provider->id}}" name="providerSwitch" value="1">
                                                          <label class="form-check-label" for="toggleSwitch">{{__('OFF')}} / {{__('ON')}} </label>
                                                        </div>

                                                      </form>
                                                      <script>
                                                        $(document).ready(function() {

                                                          $('#providerSwitch{{$provider->id}}').change(function() {
                                                            $('#status{{$provider->id}}').submit();
                                                          });
                                                        });
                                                      </script>

                                                </td>
                                                <td>{{$provider->orders}}</td>
                                                <td style='width:170px;'>
                                                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                        <a href="{{url('admin/providerwallet/wallet/'.$provider->id)}}"  class="btn btn-outline-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="eye" data-lucide="eye" class="lucide lucide-eye block mx-auto"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a>
                                                        <a href="{{url('admin/providers/edit/'.$provider->id)}}"  class="btn btn-outline-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="edit-2" data-lucide="edit-2" class="lucide lucide-edit-2 block mx-auto"><path d="M17 3a2.828 2.828 0 114 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
                                                        <a class="btn btn-outline-secondary deleterow" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal{{$provider->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="trash" data-lucide="trash" class="lucide lucide-trash block mx-auto"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"></path></svg></a>
                                                    </div>
                                                </td>
                                            </tr>

            <!-- BEGIN: Delete Confirmation Modal -->
            <div id="delete-confirmation-modal{{$provider->id}}" class="modal" tabindex="-1" aria-hidden="true">
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
                                <form action="{{url('admin/providers/delete/'.$provider->id)}}" method="post" id='delform' style="display: inline-block">
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
                {{ $providers->links('pagination::bootstrap-4') }}
            </div>

        </div>

    </div>

  @stop
