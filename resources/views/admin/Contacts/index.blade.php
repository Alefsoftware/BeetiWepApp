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
                                    {{__('Contacts')}}
                                </h2>
                                <div class="col-auto d-flex w-sm-100">
                                   <!-- <button type="button" class="btn btn-primary btn-set-task w-sm-100" data-bs-toggle="modal" data-bs-target="#expadd"><i class="icofont-plus-circle me-2 fs-6"></i>{{__('Add Provider')}}</button> !-->
                                </div>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <div class="row clearfix g-3">
                        <div class="col-lg-12">

                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class='intro-y col-span-12 overflow-auto lg:overflow-visible'>
                                    <table id="myDataTable"class="table table-report -mt-2" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>{{__('#')}}</th>
                                                <th>{{__("Name")}}</th>
                                                <th>{{__('Email')}}</th>
                                                <th>{{__('mobile')}}</th>
                                                <th>{{__('type')}}</th>
                                                <th>{{__('Message')}}</th>
                                                <th>{{__('Created At')}}</th>
                                                <th class="w-100">{{__('Action')}}</th>

                                                {{-- <th>{{__('Action')}}</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($rows as $index=>$r)
                <tr>

                                        <td><strong>#{{$index+1}}</strong></td>

                                        <td>{{$r->name}}</td>
                                        <td>{{$r->email}}</td>
                                        <td>{{$r->mobile}}</td>
                                        <td>{{$r->type}}</td>
                                        <td>{!! $r->message !!}</td>
                                        <td>{!! $r->created_at !!}</td>

                                        <td style="width:170px;">
                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                <a href="{{route('contacts.show',$r->id)}}" class="btn btn-outline-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="eye" data-lucide="eye" class="lucide lucide-eye block mx-auto"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a>
                                                <form action="{{ route('contacts.destroy', $r->id) }}" method="post" id='delform' style="display: inline-block">
                                                    @csrf
                                                    @method('delete')
                                                <button type="submit" class="btn btn-outline-secondary deleterow" onclick="return confirm('Are you sure?')"><i data-lucide="trash-2" class="w-4 h-4 mr-1"></i></button>
                                                 </form>

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
