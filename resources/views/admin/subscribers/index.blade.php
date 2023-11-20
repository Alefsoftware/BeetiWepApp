
@extends('admin.layouts.main')

@section('content')
@include('admin.includes.messages')
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script> --}}

<h2 class="intro-y text-lg font-medium mt-10">
    {{__('Subscribers')}}
</h2>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">


        <div style="display:inherit!important;" class="hidden md:block mx-auto text-slate-500">
            <div class="col-span-12 sm:col-span-6 2xl:col-span-3 intro-y mr-5">
                <div class="box p-5 zoom-in">
                    <div class="flex items-center">
                        <div class="w-2/4 flex-none">
                            <div style="min-width: 250px;" class="text-lg font-medium truncate">{{__('Total Subscribers')}}</div>
                            <div class="text-slate-500 mt-1">{{count($rows)}}</div>
                        </div>
                        <div class="flex-none ml-auto relative">

{{--                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="user" data-lucide="user" class="lucide lucide-user report-box__icon text-success"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-6 2xl:col-span-3 intro-y"></div>

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
                <th class="whitespace-nowrap">#</th>
                <th class="whitespace-nowrap">email</th>
                <th class="text-center whitespace-nowrap">ACTIONS</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rows as $key=> $row)
            <tr class="intro-x">

                <td>
                    <a href="" class="font-medium">{{$key+1}}</a>

                </td>
                <td>
                    <a href="" class="font-medium whitespace">{{$row->email}}</a>

                </td>



                <td class="table-report__action w-56">
                    <div class="flex justify-center items-center">
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
                    <form action="{{route('subscribers.destroy',$row->id)}}" method="post" id='delform' style="display: inline-block">
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
            {{ $rows->links('pagination::bootstrap-4') }}
        </nav>
    </div>
    <!-- END: Pagination -->
</div>



@endsection

