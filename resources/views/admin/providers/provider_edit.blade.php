@extends('admin.layouts.main')

@section('content')

    <h2 class="intro-y text-lg font-medium mt-10">
        Productive Family
    </h2>
    <div class="intro-y col-span-12 lg:col-span-6 mt-5">
        <!-- BEGIN: Vertical Form -->
        <div class="intro-y box">
            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">
                    Edit Family
                </h2>

                <form class="todo-modal needs-validation" method="post" action="{{ url('admin/providers/edit/'.$provider->id) }}" id="upload_form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

            </div>
            {{--@dd($errors->has('title'));--}}
            <div id="vertical-form" class="p-5">
                <div class="preview">
                    <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                        <div class="action-tags">
                            {{-- <div class="media mb-2">
                                <img src="{{@$provider->images[0]->image_name}}" alt="{{__('users avatar')}}" class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer img-container img-thumbnail" height="90" width="200" />
                                <div class="media-body mt-50">
                                    <div class="col-12 d-flex mt-1 px-0">
                                        <label class="btn btn-primary mr-75 mb-0" for="change-picture">
                                            <span class="d-none d-sm-block">{{__('Add Extra image')}}</span>
                                            <input class="form-control" type="file" name="profile_img" multiple  id="change-picture" hidden accept="image/png, image/jpeg, image/jpg"  />
                                            <span class="d-block d-sm-none">
                                                <i class="mr-0" data-feather="plus-square"></i>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div> --}}
{{--
                            @if($provider->images)
                            <div class="row">
                                @foreach($provider->images as $key=>$value)
                                @php
                                $suffix="";
                                    $suffix.='<div class="col-xs-4 col-sm-4 col-md-3">';
                                    $suffix.='<p class="image_preview">';
                                    $suffix.='<img class="cropped_preview" src="'.$value->image_name.'" width="80">';
                        //                    $suffix.='<p><a class="btn btn-danger" href="https://productivefamiliesservices.alefsoftware.com/administration/products/delete-image/' . $value->id . '" ><i class="fa fa-trash-o"></i> </a></p>';
                                    $suffix.='<p><a class="delete_image btn btn-danger" href="https://productivefamiliesservices.alefsoftware.com/administration/products/delete-image/' . $value->id . '"><i class="fa fa-trash-o"></i></a></p>';
                                    $suffix.='</p>';
                                    $suffix.='</div>';
                                    echo $suffix;
                                @endphp
                                @endforeach
                            </div>
                            @endif --}}


                            <div class="row d-flex align-items-end">
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="title" class="form-label">{{__('Family Name')}}</label>
                                        <input type="text" id="title" name="name" class="new-todo-item-title form-control" placeholder="{{__('Title')}}" value="{{$provider->name}}" />
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="title_ar" class="form-label">{{__('Mobile')}}</label>
                                        <input type="text" id="title_ar" name="mobile" class="new-todo-item-title form-control" placeholder="{{__('Title')}}" value="{{$provider->mobile}}" />
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group position-relative">
                                        @php
                                        $countries = \App\Models\Countries::get();
                                        @endphp
                                        <label for="category_id" class="form-label d-block">{{__('Country')}}</label>
                                        <select class="select2 form-control" id="country" name="country">
                                            {{-- <option hidden>{{ __('Choose Category') }}</option> --}}
                                            @foreach ($countries as $item)
                                            <option data-img="" value="{{ $item->id }}" {{ $item->id == $provider->country ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                            </div>
                            <div class="row d-flex align-items-end">

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="prepare_time" class="form-label">{{__('High KM price')}}</label>
                                        <input type="text" id="prepare_time" name="highKMPrice" class="new-todo-item-title form-control" placeholder="20" value="{{$provider->highKMPrice}}" />
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="prepare_time" class="form-label">{{__('Low KM price')}}</label>
                                        <input type="text" id="prepare_time" name="lowKMPrice" class="new-todo-item-title form-control" placeholder="10" value="{{$provider->lowKMPrice}}" />
                                    </div>
                                </div>
                            </div>



                                            {{-- test --}}

<div class="intro-y box p-5">
    <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
        <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="chevron-down" data-lucide="chevron-down" class="lucide lucide-chevron-down w-4 h-4 mr-2"><polyline points="6 9 12 15 18 9"></polyline></svg> Upload Photos </div>
        <div class="mt-5">
            <div class="flex items-center text-slate-500">
                <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="lightbulb" data-lucide="lightbulb" class="lucide lucide-lightbulb w-5 h-5 text-warning"><line x1="9" y1="18" x2="15" y2="18"></line><line x1="10" y1="22" x2="14" y2="22"></line><path d="M15.09 14c.18-.98.65-1.74 1.41-2.5A4.65 4.65 0 0018 8 6 6 0 006 8c0 1 .23 2.23 1.5 3.5A4.61 4.61 0 018.91 14"></path></svg></span>
                <div id="previewContainer" class="image-preview-container"></div>

            </div>
            <div class="form-inline items-start flex-col xl:flex-row mt-10">
                <div class="form-label w-full xl:w-64 xl:!mr-10">
                    <div class="text-left">
                        <div class="flex items-center">
                            <div class="font-medium">Provider Photos</div>
                            <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                        </div>
                        <div class="leading-relaxed text-slate-500 text-xs mt-3">
                            <div>The image format is .jpg .jpeg .png and a minimum size of 300 x 300 pixels (For optimal images use a minimum size of 700 x 700 pixels).</div>
                            <div class="mt-2">Select product photos or drag and drop up to 5 photos at once here. Include min. 3 attractive photos to make the product more attractive to buyers.</div>
                        </div>
                    </div>
                </div>
                <div class="w-full mt-3 xl:mt-0 flex-1 border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                    <div class="grid grid-cols-10 gap-5 pl-4 pr-5">
                        @foreach($provider->images as $key=>$value)
                        <div class="col-span-5 md:col-span-2 h-28 relative image-fit cursor-pointer zoom-in">
                            <img class="rounded-md" alt="Midone - HTML Admin Template" src="{{$value->image_name}}">
                            <a href="{{url("admin/products/delete-image",$value->id)}}"><div class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="x" data-lucide="x" class="lucide lucide-x w-4 h-4"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> </div></a>
                        </div>
                        @endforeach

                    </div>
                    <div class="px-4 pb-4 mt-5 flex items-center justify-center cursor-pointer relative">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="image" data-lucide="image" class="lucide lucide-image w-4 h-4 mr-2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg> <span class="text-primary mr-1">Upload a file</span> or drag and drop
                        <input id="horizontal-form-1" type="file"    name="profile_img" multiple
                         accept="image/png, image/jpeg, image/jpg"    class="w-full h-full top-0 left-0 absolute opacity-0">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- end test --}}


                        </div>
                    </div>
                        <button class="btn btn-primary mt-5">{{__('Submit')}}</button>
                    </div>
                    <div class="source-code hidden">
                        <button data-target="#copy-vertical-form" class="copy-code btn py-1 px-2 btn-outline-secondary"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="file" data-lucide="file" class="lucide lucide-file w-4 h-4 mr-2"><path d="M14.5 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V7.5L14.5 2z"></path><polyline points="14 2 14 8 20 8"></polyline></svg> Copy example code </button>
                        <div class="overflow-y-auto mt-3 rounded-md">
                                            <pre id="copy-vertical-form" class="source-preview"> <code class="html hljs xml"> <span class="hljs-tag">&lt;<span class="hljs-name">div</span>&gt;</span> <span class="hljs-tag">&lt;<span class="hljs-name">label</span> <span class="hljs-attr">for</span>=<span class="hljs-string">"vertical-form-1"</span> <span class="hljs-attr">class</span>=<span class="hljs-string">"form-label"</span>&gt;</span>Email<span class="hljs-tag">&lt;/<span class="hljs-name">label</span>&gt;</span> <span class="hljs-tag">&lt;<span class="hljs-name">input</span> <span class="hljs-attr">id</span>=<span class="hljs-string">"vertical-form-1"</span> <span class="hljs-attr">type</span>=<span class="hljs-string">"text"</span> <span class="hljs-attr">class</span>=<span class="hljs-string">"form-control"</span> <span class="hljs-attr">placeholder</span>=<span class="hljs-string">"example@gmail.com"</span>&gt;</span> <span class="hljs-tag">&lt;/<span class="hljs-name">div</span>&gt;</span>
 <span class="hljs-tag">&lt;<span class="hljs-name">div</span> <span class="hljs-attr">class</span>=<span class="hljs-string">"mt-3"</span>&gt;</span> <span class="hljs-tag">&lt;<span class="hljs-name">label</span> <span class="hljs-attr">for</span>=<span class="hljs-string">"vertical-form-2"</span> <span class="hljs-attr">class</span>=<span class="hljs-string">"form-label"</span>&gt;</span>Password<span class="hljs-tag">&lt;/<span class="hljs-name">label</span>&gt;</span> <span class="hljs-tag">&lt;<span class="hljs-name">input</span> <span class="hljs-attr">id</span>=<span class="hljs-string">"vertical-form-2"</span> <span class="hljs-attr">type</span>=<span class="hljs-string">"text"</span> <span class="hljs-attr">class</span>=<span class="hljs-string">"form-control"</span> <span class="hljs-attr">placeholder</span>=<span class="hljs-string">"secret"</span>&gt;</span> <span class="hljs-tag">&lt;/<span class="hljs-name">div</span>&gt;</span>
 <span class="hljs-tag">&lt;<span class="hljs-name">div</span> <span class="hljs-attr">class</span>=<span class="hljs-string">"form-check mt-5"</span>&gt;</span> <span class="hljs-tag">&lt;<span class="hljs-name">input</span> <span class="hljs-attr">id</span>=<span class="hljs-string">"vertical-form-3"</span> <span class="hljs-attr">class</span>=<span class="hljs-string">"form-check-input"</span> <span class="hljs-attr">type</span>=<span class="hljs-string">"checkbox"</span> <span class="hljs-attr">value</span>=<span class="hljs-string">""</span>&gt;</span> <span class="hljs-tag">&lt;<span class="hljs-name">label</span> <span class="hljs-attr">class</span>=<span class="hljs-string">"form-check-label"</span> <span class="hljs-attr">for</span>=<span class="hljs-string">"vertical-form-3"</span>&gt;</span>Remember me<span class="hljs-tag">&lt;/<span class="hljs-name">label</span>&gt;</span> <span class="hljs-tag">&lt;/<span class="hljs-name">div</span>&gt;</span> <span class="hljs-tag">&lt;<span class="hljs-name">button</span> <span class="hljs-attr">class</span>=<span class="hljs-string">"btn btn-primary mt-5"</span>&gt;</span>Login<span class="hljs-tag">&lt;/<span class="hljs-name">button</span>&gt;</span></code> <textarea class="absolute w-0 h-0 p-0"></textarea></pre>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Vertical Form -->




        </div>



@endsection

