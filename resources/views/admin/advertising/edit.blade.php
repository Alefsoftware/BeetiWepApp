@extends('admin.layouts.main')

@section('content')

    <h2 class="intro-y text-lg font-medium mt-10">
        Advertising
    </h2>
    <div class="intro-y col-span-12 lg:col-span-6 mt-5">
        <!-- BEGIN: Vertical Form -->
        <div class="intro-y box">
            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">
                    Edit Advertising
                </h2>

                <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{route('advertising.update',['id' => $id])}}" enctype="multipart/form-data">
                @method('PUT')

                @csrf

            </div>
            {{--@dd($errors->has('title'));--}}
            <div id="vertical-form" class="p-5">
                <div class="preview">
                    <div>
                        <label for="vertical-form-1" class="form-label">Title</label>
                        <input id="vertical-form-1" type="text" class="form-control" name="title" value="{{ $row->title }}">
                    </div>
                    @error('title')
                    <div class="error text-danger">{{ $message }}</div>
                    @enderror
                    <div class="mt-3">
                        <label for="vertical-form-1" class="form-label">Title Ar</label>
                        <input id="vertical-form-1" type="text" class="form-control" name="title_ar" value="{{$row->title_ar}}">
                    </div>
                    @error('title_ar')
                    <div class="error text-danger">{{ $message }}</div>
                    @enderror
                    <div class="mt-3">
                        <label for="vertical-form-1" class="form-label">Link</label>
                        <input id="vertical-form-1" type="text" class="form-control" name="link" value="{{$row->link}}">
                    </div>
                    @error('link')
                    <div class="error text-danger">{{ $message }}</div>
                    @enderror
                    <div class="mt-3">
                        <label for="vertical-form-2" class="form-label">Description</label>
                        <textarea id="vertical-form-2" class="form-control" name="description">{{$row->description}}</textarea>
                    </div>

                    <div class="mt-3">
                        <label for="vertical-form-2" class="form-label">Description Ar</label>
                        <textarea id="vertical-form-2" class="form-control" name="description_ar">{{$row->description_ar}}</textarea>
                    </div>

                    <div class="mt-3">
                        <label for="vertical-form-2" class="form-label">Image</label>
                        <input id="vertical-form-2" class="form-control" type="file" name="image" >
                    </div>
                    <div>
                        <label>Provider</label>
                        <div class="mt-2">
                            <select data-placeholder="Select Provider" class="tom-select w-full tomselected" id="tomselect-1" tabindex="-1" hidden="hidden" name="provider_id">
                                <option value="" disabled="true">Select Provider</option>

                                @foreach($providers as $val)
                               <option value="{{$val->id}}"@if(($val->id) == $row->provider_id )selected @endif >{{$val->name}}</option>
                               @endforeach
                            </select>

                    </div>
                        @error('provider_id')
                        <div class="error text-danger">{{ $message }}</div>
                        @enderror

                        <label>{{__('Position')}}</label>
                        <div class="mt-2">
                            <select data-placeholder="{{__('position')}}" class="tom-select w-full tomselected" id="tomselect-1" tabindex="-1" hidden="hidden" name="position">
                                <option value="" >{{__('Select')}}</option>

                               <option value="Top" @if($row->position == 'Top'  )selected @endif>{{__("Top")}}</option>
                               <option value="Side" @if($row->position == 'Side'  )selected @endif>{{__("Side")}}</option>

                            </select>

                    </div>
                        @error('position')
                        <div class="error text-danger">{{ $message }}</div>
                        @enderror


                        <div class="mt-3">
                            <label for="vertical-form-1" class="form-label">Expiry Date</label>
                            <input id="datepicker" type="text" class="form-control" name="expiry_date" value="{{\Carbon\Carbon::parse($row->expiry_date)->format('Y-m-d')}}">
                        </div>
                        @error('expiry_date')
                        <div class="error text-danger">{{ $message }}</div>
                        @enderror

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

