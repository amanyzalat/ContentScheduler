@extends('admin.layouts.master')
@section('title') Create
@endsection
@section('css')
<link href="{{URL::asset('assets/libs/chartist/chartist.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('body')

<body data-sidebar="dark"> @endsection
    @section('content')
    @component('admin.components.breadcrumb')
    @slot('page_title') Create @endslot
    @slot('subtitle') Post @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create Post</h4>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form class="row g-3 needs-validation" method="POST" action="{{ route('posts.store') }}" novalidate>
                        @csrf
                        <!-- end col -->

                        <div class="col-md-12">
                            <label for="validationCustom01" class="form-label">Title </label>
                            <input type="text" class="form-control" name="title" id="validationCustom01"
                                value="{{ !empty($item) ? $item->title : old('title') }}"
                                placeholder="Name" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-md-12">
                            <label for="validationCustom01" class="form-label">Content </label>
                            <textarea id="elm1" name="content" required>{{ !empty($item) ? $item->content : old('content') }}</textarea>
                            <div id="char-count">0 characters</div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please Enter Content.
                            </div>
                        </div>

                        <!-- Image Upload -->
                        <div>
                            <label>Image (optional)</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <div class="col-md-12">
                            <label for="validationCustom01" class="form-label">Selecte Platforms </label>

                            @foreach ($platforms as $platform)
                            <div>
                                <input type="checkbox" name="platforms[]" value="{{ $platform->id }}" id="platform-{{ $platform->id }}">
                                <label for="platform-{{ $platform->id }}">{{ ucfirst($platform->name) }} ({{ $platform->type }})</label>
                            </div>
                            @endforeach


                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please select Platforms.
                            </div>
                        </div>

                        <!-- Date/Time Picker -->
                        <div>
                            <label>Schedule Time</label>
                            <input type="datetime-local" class="form-control" name="scheduled_time" value="{{ old('scheduled_time') }}">
                        </div>


                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Submit </button>
                        </div>
                        <!-- end col -->
                    </form><!-- end form -->
                </div><!-- end cardbody -->
            </div><!-- end card -->
        </div>

    </div>
    <!-- end row -->



    @endsection
    @section('scripts')
    <script src="{{URL::asset('assets/libs/select2/select2.min.js')}}"></script>
    <script src="{{URL::asset('assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.js')}}"></script>
    <script src="{{URL::asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
    <script src="{{URL::asset('assets/libs/parsleyjs/parsleyjs.min.js')}}"></script>

    <script src="{{URL::asset('assets/js/pages/form-validation.init.js')}}"></script>
    <!--tinymce js-->
    <script src="{{URL::asset('assets/libs/tinymce/tinymce.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/pages/form-advanced.init.js')}}"></script>
    <!-- init js -->
    <script src="{{URL::asset('assets/js/pages/form-editor.init.js')}}"></script>

    <script src="{{URL::asset('assets/js/app.js')}}"></script>
    <script>
        function updateCharCount() {
            const content = document.getElementById('elm1').value;
            document.getElementById('char-count').innerText = `${content.length} characters`;
        }
    </script>

    @endsection