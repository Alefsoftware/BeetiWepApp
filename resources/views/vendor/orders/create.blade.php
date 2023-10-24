@extends('admin.layouts.master')
@section('content')
@include('admin.includes.messages')




<!-- Body: Body -->
<div class="body d-flex py-3">
    <div class="container-xxl">
<div class="row align-items-center">
<div class="border-0 mb-4">
    <form class="todo-modal needs-validation" method="post" action="{{ route('category.store') }}"
    enctype="multipart/form-data">
<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
    <h3 class="fw-bold mb-0">{{__('Category')}} {{__('Add')}}</h3>
    <button type="submit" class="btn btn-primary btn-set-task w-sm-100 py-2 px-5 text-uppercase">{{__('Save')}}</button>
</div>
</div>
</div> <!-- Row end  -->
<div class="row g-3 mb-3">
{{-- <div class="col-xl-4 col-lg-4">
<div class="sticky-lg-top">

    <div class="card mb-3">
        <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
            <h6 class="m-0 fw-bold">Visibility Status</h6>
        </div>
        <div class="card-body">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="couponsstatus" checked>
                <label class="form-check-label">
                    Published
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="couponsstatus">
                <label class="form-check-label">
                    Scheduled
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="couponsstatus">
                <label class="form-check-label">
                    Hidden
                </label>
            </div>
        </div>
    </div>

</div>
</div> --}}
<div class="col-xl-12 col-lg-12">
<div class="card mb-3">
    <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
        <h6 class="mb-0 fw-bold ">{{__('Basic information')}}</h6>
    </div>
    <div class="card-body">

        @csrf
            <div class="row g-3 align-items-center">
                <div class="col-md-6">
                    <label class="form-label">{{__('Title')}}  {{__('En')}}</label>
                    <input type="text" name='title' {{old('title')}} class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{__('Title')}}  {{__('Ar')}}</label>
                    <input type="text" name='title_ar' value="{{old('title_ar')}}" class="form-control" required>
                </div>


                <div class="col-md-6">
                    <label class="form-label">{{__('Description')}} {{__("En")}}</label>
                    <textarea class=" form-control" name="description" required>{{old('description')}}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{__('Description')}} {{__("Ar")}}</label>
                    <textarea class=" form-control" name="description_ar" required> {{old('description_ar')}}</textarea>
                </div>


                <div class="col-md-6">
                    <label class="form-label">{{__('Country')}}</label>
                    @foreach($countries as $c)
						<input class="form-check-input" value="{{$c->id}}" name='country[]' type="checkbox">
						<label class="form-check-label" for="Eaten-switch2">{{$c->name}}</label>
                @endforeach
                    </div>
                <div class="col-md-6">
                    <label class="form-label">{{__('Logo')}}</label>
                    <input type="file" name='logo' class="form-control" accept="image/*" required>
                </div>

                    </div>
            </div>



            </div>
        </form>
    </div>
</div>



</div>
</div><!-- Row end  -->
</div>
</div>


@stop
