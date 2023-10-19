@extends('admin.layouts.main')
@section('content')
@include('admin.includes.messages')
    @php
    //   dd($row->reviews[0]->customer );
    @endphp







     <!-- BEGIN: Content -->
     <div class="content">
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                {{ __('Customer Details') }}
            </h2>
        </div>
        <!-- BEGIN: Profile Info -->
        <div class="intro-y box px-5 pt-5 mt-5">
            <div class="flex flex-col lg:flex-row border-b border-slate-200/60 dark:border-darkmode-400 pb-5 -mx-5">
                <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                        <img alt="{{ $row->name }}" class="rounded-full" src="{{$r->profile_img ?? url('default_user.jpg')}}">
                    </div>
                    <div class="ml-5">
                        <div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">{{ $row->name }}</div>
                        {{-- <div class="text-slate-500">{{ $row->mobile }}</div> --}}
                    </div>

                </div>

                <div class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 dark:border-darkmode-400 border-t lg:border-t-0 pt-5 lg:pt-0">
                    <div class="font-medium text-center lg:text-left lg:mt-3">{{__('Contact Details')}}</div>
                    <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                        <div class="truncate sm:whitespace-normal flex items-center"> <i data-lucide="mail" class="w-4 h-4 mr-2"></i> {{ $row->email }}</div>
                        <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-lucide="phone" class="w-4 h-4 mr-2"></i> {{ $row->mobile }}</div>
                        {{-- <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-lucide="twitter" class="w-4 h-4 mr-2"></i> Twitter Al Pacino </div> --}}
                    </div>
                </div>
                <div class="mt-6 lg:mt-0 flex-1 flex items-center justify-center px-5 border-t lg:border-0 border-slate-200/60 dark:border-darkmode-400 pt-5 lg:pt-0">
                    <div class="text-center rounded-md w-20 py-3">
                        <div class="font-medium text-primary text-xl">{{count($row->orders)}}</div>
                        <div class="text-slate-500">{{__('Orders')}}</div>
                    </div>
                    <div class="text-center rounded-md w-20 py-3">
                        <div class="font-medium text-primary text-xl"> {{$row->wallet }}</div>
                        <div class="text-slate-500">{{__("wallet")}}</div>
                    </div>


                </div>
            </div>
            {{-- <ul class="nav nav-link-tabs flex-col sm:flex-row justify-center lg:justify-start text-center" role="tablist" >
                <li id="profile-tab" class="nav-item" role="presentation">
                    <a href="javascript:;" class="nav-link py-4 flex items-center active" data-tw-target="#profile" aria-controls="profile" aria-selected="true" role="tab" > <i class="w-4 h-4 mr-2" data-lucide="user"></i> Profile </a>
                </li>
                <li id="account-tab" class="nav-item" role="presentation">
                    <a href="javascript:;" class="nav-link py-4 flex items-center" data-tw-target="#account" aria-selected="false" role="tab" > <i class="w-4 h-4 mr-2" data-lucide="shield"></i> Account </a>
                </li>
                <li id="change-password-tab" class="nav-item" role="presentation">
                    <a href="javascript:;" class="nav-link py-4 flex items-center" data-tw-target="#change-password" aria-selected="false" role="tab" > <i class="w-4 h-4 mr-2" data-lucide="lock"></i> Change Password </a>
                </li>
                <li id="settings-tab" class="nav-item" role="presentation">
                    <a href="javascript:;" class="nav-link py-4 flex items-center" data-tw-target="#settings" aria-selected="false" role="tab" > <i class="w-4 h-4 mr-2" data-lucide="settings"></i> Settings </a>
                </li>
            </ul> --}}
        </div>
        <!-- END: Profile Info -->
        <div class="tab-content mt-5">
            <div id="profile" class="tab-pane active" role="tabpanel" aria-labelledby="profile-tab">
                <div class="grid grid-cols-12 gap-6">




                    <!-- BEGIN: Latest Uploads -->
                    <div class="intro-y box col-span-12 lg:col-span-12">
                        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-slate-200/60 dark:border-darkmode-400">
                            <h2 class="font-medium text-base mr-auto">
                                {{__('Wallet')}}
                            </h2>
                            {{-- <div class="dropdown ml-auto sm:hidden">
                                <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown"> <i data-lucide="more-horizontal" class="w-5 h-5 text-slate-500"></i> </a>
                                <div class="dropdown-menu w-40">
                                    <ul class="dropdown-content">
                                        <li> <a href="javascript:;" class="dropdown-item">All Files</a> </li>
                                    </ul>
                                </div>
                            </div> --}}
                            {{-- <button class="btn btn-outline-secondary hidden sm:flex">All Files</button> --}}
                        </div>
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="file"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="trello" data-lucide="trello" class="lucide lucide-trello"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><rect x="7" y="7" width="3" height="9"></rect><rect x="14" y="7" width="3" height="5"></rect></svg> </div>
                                <div class="ml-4">
                                    <p><strong>{{__('Customer Wallet')}}:</strong></p>
                                </div>
                                <div class="dropdown ml-auto">
                                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown"><div class="text-slate-500 text-xs mt-0.5">{{$row->wallet}}</div></a>
                                </div>
                            </div>

                            <div class="flex items-center mt-5">
                                <div class="file"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="trello" data-lucide="trello" class="lucide lucide-trello"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><rect x="7" y="7" width="3" height="9"></rect><rect x="14" y="7" width="3" height="5"></rect></svg> </div>
                                <div class="ml-4">
                                    <form action='{{route('wallet.update',$row->id)}}' method='post'>
                                        @csrf
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <button class="btn btn-outline-secondary" type="button" onclick="decrement()">-</button>
                                        </div>
                                        {{-- <input type="number" name='wallet' id="counter" class="form-control" value="{{$wallet_value}}" step='.5' min="0" > --}}
                                        <input type="number" name='wallet' id="counter" class="form-control" value="{{$row->wallet}}" step='.5' min="0" >
                                        <div class="input-group-append">
                                          <button class="btn btn-outline-secondary" type="button" onclick="increment()">+</button>
                                        </div>
                                        {{-- <button type="submit" class="btn btn-primary">{{__('Update')}}</button> --}}
                                      </div>

                                      <script>
                                        function increment() {
                                          let counter = document.getElementById('counter');
                                        //   if (counter.value < 10) {
                                            counter.value++;
                                        //   }
                                        }

                                        function decrement() {
                                          let counter = document.getElementById('counter');
                                          if (counter.value > 0) {
                                            counter.value--;
                                          }
                                        }
                                      </script>

                                </div>
                                <div class="dropdown ml-auto">
                                        <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
                                </div>
                            </form>

                            </div>

                        </div>
                    </div>
                    <!-- END: Latest Uploads -->

                                     <!-- BEGIN: New Products -->
                    <div class="intro-y box col-span-12">
                        <div class="flex items-center px-5 py-3 border-b border-slate-200/60 dark:border-darkmode-400">
                            <h2 class="font-medium text-base mr-auto">
                                {{__('Orders')}}
                            </h2>

                        </div>
                        <div id="new-products" class="tiny-slider py-5">
                            <div class="px-5">
                                <div class='intro-y col-span-12 overflow-auto lg:overflow-visible'>
                                    <table id="myProjectTable" class="table table-report -mt-2" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                    <th>{{ __('provider') }}</th>
                                                    <th>{{ __('Type') }}</th>
                                                    <th>{{ __('phone') }}</th>
                                                    <th>{{ __('Date') }}</th>
                                                    <th>{{ __('Status') }}</th>
                                                    <th>{{ __('Price') }}</th>
                                                    <th>{{ __('Show') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($row->orders as $index=> $r)
                                            <tr>
                                                <td>{{ $index+1}}</td>
                                                <td>{{ @$r->provider->name }}</td>
                                                <td>{{ @$r->provider->name }}</td>
                                                <td>{{ @$r->provider->mobile }}</td>
                                                <td>{{@$r->created_at}}</td>
                                                <td>{{@$r->status->title}}</td>
                                                <td>{{@$r->total_amount}}</td>
                                              <td>
                                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                    <a href="{{url('admin/orders/view',$r->id)}}" target="_blank"><i data-lucide="eye"></i></a>
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
                    <!-- END: New Products -->

                </div>
            </div>
        </div>
    </div>
    <!-- END: Content -->







 {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0qEvGL429gokwoE2PYynkguNyPSPrIlk"></script> --}}
  {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> --}}
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> --}}
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>




@stop



