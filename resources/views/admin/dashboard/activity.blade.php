
@extends('admin.layouts.main')
@section('content')
@include('admin.includes.messages')
<div class="col-span-12 2xl:col-span-3 mt-5">
    <div class="2xl:border-l -mb-10 pb-10">

@foreach($rows['activities'] as $row)
@if($row->subject_type == "App\Models\Product")
    @php ($color='secondary-soft')
    <a class="m-link"  href="{{url('admin/products/edit',$row->subject_id)}}">
    @elseif($row->subject_type == "App\Models\Provider")
    @php ($color='secondary-soft')
    <a class="m-link"  href="{{url('admin/providers/edit',$row->subject_id)}}">
   @endif


{{-- <div class="alert alert-warning-soft show flex items-center mb-2" role="alert"> <i data-lucide="alert-circle" class="w-6 h-6 mr-2"></i> Awesome alert with icon </div> --}}

<div class="alert alert-{{$color}} show flex items-center mb-5" role="alert"> <i data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i> {{$row->description}}  AT {{$row->created_at}}</div>
 {{-- <div class="alert alert-success-soft show flex items-center mb-2" role="alert"> <i data-lucide="alert-triangle" class="w-6 h-6 mr-2"></i> Awesome alert with icon </div>
 <div class="alert alert-warning-soft show flex items-center mb-2" role="alert"> <i data-lucide="alert-circle" class="w-6 h-6 mr-2"></i> Awesome alert with icon </div>
 <div class="alert alert-pending-soft show flex items-center mb-2" role="alert"> <i data-lucide="alert-triangle" class="w-6 h-6 mr-2"></i> Awesome alert with icon </div>
 <div class="alert alert-danger-soft show flex items-center mb-2" role="alert"> <i data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i> Awesome alert with icon </div>
 <div class="alert alert-dark-soft show flex items-center mb-2" role="alert"> <i data-lucide="alert-triangle" class="w-6 h-6 mr-2"></i> Awesome alert with icon </div> --}}
@endforeach
    </div>

    </div>
    <div class="col-12 d-flex" style='text-align:center'>
        {{ $rows['activities']->links('pagination::bootstrap-4') }}
    </div>
 @endsection
