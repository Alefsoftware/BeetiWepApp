
@extends('admin.layouts.main')

@section('content')
@include('admin.includes.messages')
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script> --}}

<h2 class="intro-y text-lg font-medium mt-10">
    Ads
</h2>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
        <a href='{{route("advertising.create")}}' class="btn btn-primary shadow-md mr-2">{{__('Add New Ad')}}</a>
        {{-- <div class="dropdown">
            <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i> </span>
            </button>
            <div class="dropdown-menu w-40">
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
            </div>
        </div> --}}
        <div style="display:inherit!important;" class="hidden md:block mx-auto text-slate-500">
            <div class="col-span-12 sm:col-span-6 2xl:col-span-3 intro-y mr-5">
                <div class="box p-5 zoom-in">
                    <div class="flex items-center">
                        <div class="w-2/4 flex-none">
                            <div style="min-width: 250px;" class="text-lg font-medium truncate">{{__('Total Ads')}}</div>
                            <div class="text-slate-500 mt-1">{{count($ads)}}</div>
                        </div>
                        <div class="flex-none ml-auto relative">

{{--                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="user" data-lucide="user" class="lucide lucide-user report-box__icon text-success"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-6 2xl:col-span-3 intro-y"></div>

            <div class="box p-5 zoom-in">
                <div class="flex items-center">
                    <div class="w-2/4 flex-none">
                        <div style="min-width: 250px;" class="text-lg font-medium truncate">{{__('Advertises To Be Approved')}}</div>
                        <div class="text-slate-500 mt-1">{{$approved_ads}}</div>
                    </div>
                    <div class="flex-none ml-auto relative">

{{--                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="user" data-lucide="user" class="lucide lucide-user report-box__icon text-success"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>--}}
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
            <div class="w-56 relative text-slate-500">
                <input type="text" class="form-control w-56 box pr-10" placeholder="Search...">
                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
            </div>
        </div> --}}
    </div>
    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        <table class="table table-report -mt-2">
            <thead>
            <tr>
                <th class="whitespace-nowrap">Title</th>
                <th class="whitespace-nowrap">Description</th>
                <th class="whitespace-nowrap">Image</th>
                <th class="whitespace-nowrap">Expiry Date</th>
                <th class="whitespace-nowrap">Provider</th>
                <th class="text-center whitespace-nowrap">STATUS</th>
                <th class="text-center whitespace-nowrap">ACTIONS</th>
            </tr>
            </thead>
            <tbody>
            @foreach($ads as $row)
            <tr class="intro-x">

                <td>
                    <a href="" class="font-medium whitespace-nowrap">{{$row->title_field}}</a>

                </td>
                <td>
                    <a href="" class="font-medium whitespace-nowrap">{{$row->des_field}}</a>

                </td>
                <td class="w-40">
                    <div class="flex">
                        <div class="w-10 h-10 image-fit zoom-in">
                            <img alt="{{$row->title}}" class="tooltip rounded-full" src="{{$row->image}}" title="{{$row->title}}">
                        </div>
                    </div>
                </td>
                <td>
                    {{ \Carbon\Carbon::parse($row->expiry_date)->format('j M Y') }}
                </td>
                <td>
                    {{$row->provider->name??' - '}}
                </td>
                <td class="w-40">
                    <div class="form-check form-switch w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                        <form id='status{{$row->id}}' action='{{route('advertising.changeStatus',$row->id)}}' method='post'>
                            @csrf
                        <input id="isActive{{$row->id}}" onclick='status{{$row->id}}.submit()' class="show-code form-check-input mr-0 ml-3" type="checkbox" @if($row->is_active==1) {{'checked'}}@endif value="{{$row->is_active}}" name="is_active" data-is-active="{{$row->id}}">
                        </form>
                        {{-- <script>

                            $(document).ready(function() {

                                $(alert('hi'));
                                $(alert('yse'{{$row->id}}));
                                $('#is_active{{$row->id}}').click(function() {
                                        $('#status{{$row->id}}').submit();
                                });
                            });
                        </script> --}}
                    </div>
                </td>

                {{-- <script>
                    //   change status of Ads
                                $("#isActive{{$row->id}}").change(function(){
                            var id={{$row->id}};
                            console.log(id);
                            $.ajax({
                            url: 'admin/advertising/edit/' + id ,
                            type: 'PUT',

                            dataType: 'json',
                            success: function(data) {

                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.error(textStatus, errorThrown);
                            }
                            });


                            });




                //     $(document).ready(function() {
                //         $('#isActive{{$row->id}}').change(function() {
                //            var statusId = {{$row->id}};
                //            $(alert(statusId));
                //            var statusValue = $(this).val();
                //            // Send an AJAX request to update the status
                //            $.ajax({
                //                url: route('advertising.update',statusId),
                //                type: 'PUT',
                //                data: {
                //                    status: statusValue
                //                },
                //                success: function(response) {
                //                    console.log(response.message);
                //                    // Handle success response
                //                    flashMessage('success', 'Updated Successfully');
                //                },
                //                error: function(error) {
                //                    console.log(error);
                //                    // Handle error response
                //                }
                //            });
                //        });
                //    });
                </script> --}}


                <td class="table-report__action w-56">
                    <div class="flex justify-center items-center">
                        <a class="flex items-center mr-3" href="{{route('advertising.edit',$row->id)}}"> <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                        <a class="flex items-center text-danger" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal{{$row->id}}"> <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                    </div>
                </td>
            </tr>



            <!-- BEGIN: Delete Confirmation Modal -->
<div id="delete-confirmation-modal{{$row->id}}" class="modal" tabindex="-1" aria-hidden="true">
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
                    <form action="{{route('advertising.delete',$row->id)}}" method="post" id='delform' style="display: inline-block">
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
    <!-- END: Data List -->
    <!-- BEGIN: Pagination -->
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
        <nav class="w-full sm:w-auto sm:mr-auto">
            {{ $ads->links('pagination::bootstrap-4') }}
        </nav>
    </div>
    <!-- END: Pagination -->
</div>



@endsection

