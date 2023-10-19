@extends('admin.layouts.main')

@section('content')
@include('admin.includes.messages')
    <h2 class="intro-y text-lg font-medium mt-10">
        Notifications
    </h2>
    <div class="intro-y col-span-12 lg:col-span-6 mt-5">
        <!-- BEGIN: Vertical Form -->
        <div class="intro-y box">
            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">
                    Add Notification
                </h2>

                <form method="post"  id='notify_form'enctype="multipart/form-data">
                    @csrf

            </div>
            {{--@dd($errors->has('title'));--}}
            <div id="vertical-form" class="p-5">
                <div class="preview">
                    <div>
                        <label for="vertical-form-1" class="form-label">Title En</label>
                        <input id="vertical-form-1" type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                    </div>
                    @error('title')
                    <div class="error text-danger">{{ $message }}</div>
                    @enderror
                    <div class="mt-3">
                        <label for="vertical-form-1" class="form-label">Title Ar</label>
                        <input id="vertical-form-1" type="text" class="form-control" name="title_ar" value="{{ old('title_ar') }}" required>
                    </div>
                    @error('title_ar')
                    <div class="error text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mt-3">
                        <label for="vertical-form-2" class="form-label">{{__('Notify')}} {{__("En")}}</label>
                        <textarea id="vertical-form-2" class="form-control" name="message" required>{{old('message')}}</textarea>
                    </div>

                    <div class="mt-3">
                        <label for="vertical-form-2" class="form-label">{{__('Notify')}} {{__("Ar")}}</label>
                        <textarea id="vertical-form-2" class="form-control" name="message_ar" required>{{old('message_ar')}}</textarea>
                    </div>

                    <div class="mt-3">
                        <label for="vertical-form-1" class="form-label">{{__('Link')}}</label>
                        <input id="vertical-form-1" type="text" class="form-control" name="link" value="{{ old('link') }}">
                    </div>
                    @error('link')
                    <div class="error text-danger">{{ $message }}</div>
                    @enderror
                    <div>
                        <label>{{__('TO')}}</label>
                        <div class="mt-2">
                            <select data-placeholder="Select Provider" class="tom-select w-full tomselected" id="type" tabindex="-1" hidden="hidden" name="type" required>
                                <option value="" disabled="true">Select</option>

                                <option hidden>{{__('Choose Users Type')}}</option>
                                <option value="all providers">{{__('All Providers')}}</option>
                                <option value="all customers">{{__('All Customers')}}</option>
                                <option value="provider">{{__('Select Provider')}}</option>
                                <option value="customer">{{__('Select Customer')}}</option>
                            </select>

                    </div>
                        @error('type')
                        <div class="error text-danger">{{ $message }}</div>
                        @enderror



                        <div class="row mt-5">
                            <div class="col-md-4" id='providers_list' style="display:none;">
                                <div class="card">
                                    <table id="myDataTable"class="table table-report -mt-2" style="width: 100%;">
                                        @foreach($providers as $index => $g)
                                        <tr id='gov-select{{$index}}' data-id='{{$g->id}}'>
                                            <td>{{$g->name}}</td>
                                            <td><input class="form-check-input" type="checkbox" id="" name="providers_ids[]" value="{{$g->id}}"></td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-4 " id='customers_list' style="display:none;">
                                <div class="card">
                                    <table id="myDataTable"class="table table-report -mt-2" style="width: 100%;">
                                        @foreach($customers as $index => $g)
                                        <tr id='gov-select{{$index}}' data-id='{{$g->id}}'>
                                            <td>{{$g->name}}</td>
                                            <td><input class="form-check-input" type="checkbox" id="" name="customers_ids[]" value="{{$g->id}}"></td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
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

