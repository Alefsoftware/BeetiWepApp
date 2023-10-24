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
                {{ __('Order Details') }}
            </h2>
        </div>
        <!-- BEGIN: Profile Info -->
        <div class="intro-y box px-5 pt-5 mt-5">
            <div class="flex flex-col lg:flex-row border-b border-slate-200/60 dark:border-darkmode-400 pb-5 -mx-5">
                <div class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 dark:border-darkmode-400 border-t lg:border-t-0 pt-5 lg:pt-0">
                    <div class="font-medium text-center lg:text-left lg:mt-3">{{__('Order Information')}}</div>
                    <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                        <div class="truncate sm:whitespace-normal flex items-center"> <i data-lucide="hash" class="w-4 h-4 mr-2"></i> {{ $row->order_num }}</div>
                        <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-lucide="calender" class="w-4 h-4 mr-2"></i> {{ $row->created_at }}</div>
                        {{-- <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-lucide="twitter" class="w-4 h-4 mr-2"></i> Twitter Al Pacino </div> --}}
                    </div>
                </div>

                <div class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 dark:border-darkmode-400 border-t lg:border-t-0 pt-5 lg:pt-0">
                    <div class="font-medium text-center lg:text-left lg:mt-3">{{__('Client')}}</div>
                    <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                        <div class="truncate sm:whitespace-normal flex items-center"> <i data-lucide="user" class="w-4 h-4 mr-2"></i> {{ @$row->customer->name }}</div>
                        <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-lucide="phone" class="w-4 h-4 mr-2"></i> {{ @$row->customer->mobile }}</div>
                        <p id='client'><strong>{{ __('location') }}:</strong> <i class="icofont-location-pin fs-5"></i></p>
                            <div id="mapclient" style="height: 400px;">   <iframe
                                width="300"
                                height="300"
                                frameborder="0" style="border:0"
                                src="https://www.google.com/maps/embed/v1/place?q={{@$row->customer->address[0]->lat}}%2C+{{@$row->customer->address[0]->lng}}&key=AIzaSyCPdJEEMbL34FbOOYkpMzQOOcX1d7tQ6FQ" allowfullscreen>
                              </iframe>   </div>
                    </div>
                </div>


                <div class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 dark:border-darkmode-400 border-t lg:border-t-0 pt-5 lg:pt-0">
                    <div class="font-medium text-center lg:text-left lg:mt-3">{{__('Family')}}</div>
                    <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                        <div class="truncate sm:whitespace-normal flex items-center"> <i data-lucide="user" class="w-4 h-4 mr-2"></i> {{ @$row->provider->name }}</div>
                        <div class="truncate sm:whitespace-normal flex items-center mt-3"> <i data-lucide="phone" class="w-4 h-4 mr-2"></i> {{  @$row->provider->mobile }}</div>
                        <p id='provider'><strong>{{ __('location') }}:</strong> <i class="icofont-location-pin fs-5"></i></p>
                            <div id="mapprovider" style="height: 400px;">   <iframe
                                width="300"
                                height="300"
                                frameborder="0" style="border:0"
                                src="https://www.google.com/maps/embed/v1/place?q={{@$row->provider->address[0]->lat}}%2C+{{@$row->provider->address[0]->lng}}&key=AIzaSyCPdJEEMbL34FbOOYkpMzQOOcX1d7tQ6FQ" allowfullscreen>
                              </iframe>   </div>
                    </div>
                </div>

                </div>






            </div>


        <!-- END: Profile Info -->
        <div class="tab-content mt-5">
            <div id="profile" class="tab-pane active" role="tabpanel" aria-labelledby="profile-tab">
                <div class="grid grid-cols-12 gap-6">



                                           <!-- BEGIN: New Products -->
                                           <div class="intro-y box col-span-12">
                                            <div class="flex items-center px-5 py-3 border-b border-slate-200/60 dark:border-darkmode-400">
                                                <h2 class="font-medium text-base mr-auto">
                                                    {{__('Items')}}
                                                </h2>

                                            </div>
                                            <div id="new-products" class="tiny-slider py-5">
                                                <div class="px-5">
                                                    <div class='intro-y col-span-12 overflow-auto lg:overflow-visible'>
                                                        <table id="myProjectTable" class="table table-report -mt-2" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>{{ __('Product') }}</th>
                                                                    <th>{{ __('Price') }}</th>
                                                                    <th>{{ __('Quantity') }}</th>
                                                                    <th>{{ __('Subtotal') }}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($row->orderProducts as $item)
                                                                    <tr>
                                                                    <td>{{ $item->product->title }}</td>
                                                                    <td>{{ @$item->amount }}</td>
                                                                    <td>{{ $item->count }}</td>
                                                                    <td>{{ $item->total_amount }}</td>
                                                                    </tr>
                                                                @endforeach


                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                  <td colspan="3"></td>
                                                                  <td><strong>{{ __('Total') }}:</strong> {{ $row->total_amount }}</td>
                                                                </tr>
                                                              </tfoot>
                                                        </table>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                        <!-- END: New Products -->



                    <!-- BEGIN: Latest Uploads -->
                    <div class="intro-y box col-span-12 lg:col-span-6">
                        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-slate-200/60 dark:border-darkmode-400">
                            <h2 class="font-medium text-base mr-auto">
                                {{__('Details')}}
                            </h2>
                            {{-- <div class="dropdown ml-auto sm:hidden">
                                <a  aria-expanded="false" data-tw-toggle="dropdown"> <i data-lucide="more-horizontal" class="w-5 h-5 text-slate-500"></i> </a>
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
                                    <p><strong>{{ __('Preparnig Start Time') }}:</strong></p>
                                </div>
                                <div class="dropdown ml-auto" >
                                    <a  aria-expanded="false" data-tw-toggle="dropdown"><div class="text-slate-500 text-xs mt-0.5" >{{Carbon\Carbon::parse($row->preparing_start_time)->format('h:i A')}}</div></a>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="file"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="trello" data-lucide="trello" class="lucide lucide-trello"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><rect x="7" y="7" width="3" height="9"></rect><rect x="14" y="7" width="3" height="5"></rect></svg> </div>
                                <div class="ml-4">
                                    <p><strong>{{ __('Pickup Time') }}:</strong></p>
                                </div>
                                <div class="dropdown ml-auto">
                                    <a  aria-expanded="false" data-tw-toggle="dropdown"><div class="text-slate-500 text-xs mt-0.5">{{ @$row->pickup_time }}</div></a>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div class="file"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="trello" data-lucide="trello" class="lucide lucide-trello"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><rect x="7" y="7" width="3" height="9"></rect><rect x="14" y="7" width="3" height="5"></rect></svg> </div>
                                <div class="ml-4">
                                    <p><strong>{{ __('Payment Method') }}:</strong></p>
                                </div>
                                <div class="dropdown ml-auto">
                                    <a  aria-expanded="false" data-tw-toggle="dropdown"><div class="text-slate-500 text-xs mt-0.5">{{ @$row->payment->title }}</div></a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- END: Latest Uploads -->
                    <!-- BEGIN: Latest Uploads -->
                    <div class="intro-y box col-span-12 lg:col-span-6">
                        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-slate-200/60 dark:border-darkmode-400">
                            <h2 class="font-medium text-base mr-auto">
                                {{ __('Fees') }}
                            </h2>
                        </div>
                        <div class="p-5">
                            <div class="flex items-center mt-4">
                                <div class="file"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="trello" data-lucide="trello" class="lucide lucide-trello"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><rect x="7" y="7" width="3" height="9"></rect><rect x="14" y="7" width="3" height="5"></rect></svg> </div>
                                <div class="ml-4">
                                    <p><strong>{{ __('Provider Fees') }} :</strong></p>
                                </div>
                                <div class="dropdown ml-auto">
                                    <a  aria-expanded="false" data-tw-toggle="dropdown"><div class="text-slate-500 text-xs mt-0.5">{{ $row->provider_fees}}</div></a>
                                </div>
                            </div>
                            <div class="flex items-center mt-4">
                                <div class="file"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="trello" data-lucide="trello" class="lucide lucide-trello"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><rect x="7" y="7" width="3" height="9"></rect><rect x="14" y="7" width="3" height="5"></rect></svg> </div>
                                <div class="ml-4">
                                    <p><strong>{{ __('Company Fees') }} :</strong></p>
                                </div>
                                <div class="dropdown ml-auto">
                                    <a  aria-expanded="false" data-tw-toggle="dropdown"><div class="text-slate-500 text-xs mt-0.5">{{ $row->company_fees}}</div></a>
                                </div>
                            </div>




                        </div>
                    </div>
                    <!-- END: Latest Uploads -->


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




  <script>
    $('#mapclient,#mapprovider').hide();
$('#client').click(function(){
   $('#mapclient').toggle();

});
$('#provider').click(function(){
   $('#mapprovider').toggle();

});

   // function initMap() {
     // Create a new map object centered on the desired location
   //   var map_client = new google.maps.Map(document.getElementById('mapclient'), {
   //     center: {lat: {{@$row->customer->address[0]->lat}}, lng: {{@$row->customer->address[0]->lng}} },
   //     zoom: 12
   //   });
   //   var map_provider = new google.maps.Map(document.getElementById('mapprovider'), {
   //     center: {lat: {{@$row->provider->address[0]->lat}}, lng: {{@$row->provider->address[0]->lng}} },
   //     zoom: 12
   //   });

   //   // Add a marker to the desired location
   //   var marker = new google.maps.Marker({
   //     position: {lat: {{@$row->customer->address[0]->lat}}, lng: {{@$row->customer->address[0]->lng}} },
   //     map: map_client,
   //     title: 'Client Location'
   //   });
   //   // Add a marker to the desired location
   //   var marker = new google.maps.Marker({
   //     position: {lat: {{@$row->provider->address[0]->lng}}, lng: {{@$row->provider->address[0]->lng}} },
   //     map: map_provider,
   //     title: 'Family Location'
   //   });
   // }


   function initMap() {
 var latLng = {lat: {{$row->customer->address[0]->lat}}, lng: {{$row->customer->address[0]->lng}}}; // set the latitude and longitude
 var map = new google.maps.Map(document.getElementById('mapclient'), {
   zoom: 8, // set the zoom level
   center: latLng, // set the center of the map to the specified latitude and longitude
 });
 var marker = new google.maps.Marker({
   position: latLng,
   map: map,
 });
}
 </script>
 <script async defer onload="initMap()"></script>
 {{-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0qEvGL429gokwoE2PYynkguNyPSPrIlk&callback=initMap"></script> --}}


@stop



