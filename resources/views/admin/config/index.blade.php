@extends('admin.layouts.main')
@section('content')
@include('admin.includes.messages')



     <!-- BEGIN: Content -->
     <div class="content">
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                {{ __('Site Settings') }}
            </h2>
        </div>
        <!-- BEGIN: Profile Info -->
        <div class="intro-y box px-5 pt-5 mt-5">
            <div class="flex flex-col lg:flex-row border-b border-slate-200/60 dark:border-darkmode-400 pb-5 -mx-5">
                <div class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 dark:border-darkmode-400 border-t lg:border-t-0 pt-5 lg:pt-0">



                    <div class="font-medium text-center lg:text-left lg:mt-3">{{__('configs content')}}</div>
                    {{-- <div class="flex flex-col justify-center items-center lg:items-start mt-4"> --}}
                        <form method="post" action="{{route('config.update')}}">
                            @csrf
                            @method('PUT')
                            @foreach ( $configs  as $r )

                            <div class="mt-3">

                                <div class="sm:grid grid-cols-3 gap-4">
                                            <input type='hidden' value="{{$r->id}}" name="ids[]">
                                            <div class="input-group">
                                                <label class="form-label"> {{$r->field_name}} En</label>
                                            <input type="text" name='value[]' value="{{$r->value}}" class="form-control" >
                                            </div>

                                            <div class="input-group">
                                                <label class="form-label"> {{$r->field_name}} Ar</label>
                                            <input type="text" name='value_ar[]' value="{{$r->value_ar}}" class="form-control" >
                                            </div>
                                            {{-- <div class="input-group">
                                            <label class="form-label">{{__('force update')}}</label>
                                            <input class="form-check-input" @if($r->is_forced == '1') checked @endif value="1" name='is_forced[{{$r->id}}]' type="checkbox">
                                            </div> --}}
                            </div>



                            </div>



                                            @endforeach
                                     <div class="input-group">
                                         <button class="btn btn-primary mt-8" >save</button>
                                     </div>
                                </div>
                                </div>

                            </form>

                    {{-- </div> --}}
                </div>





                </div>






            </div>












@stop



