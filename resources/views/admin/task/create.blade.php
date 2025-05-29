@extends('admin.layouts.master')
@section('title') Create 
 @endsection
@section('css')
<link href="{{URL::asset('assets/libs/chartist/chartist.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('body') <body data-sidebar="dark"> @endsection
    @section('content')
    @component('admin.components.breadcrumb')
    @slot('page_title') Create  @endslot
    @slot('subtitle') Task @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create Task</h4>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="row g-3 needs-validation" method="POST" action="{{ route('tasks.store') }}" novalidate>
                    @csrf
                          <!-- end col -->
                        <div class="col-md-12">
                            <label for="validationCustom01" class="form-label">Selecte Admin Name </label>
                            <select name="assigned_by_id" class="form-control select2" required>
                                @foreach($admins as $admin)
                                    <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                @endforeach
                            </select>

                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please select a Admin.
                            </div>
                        </div>
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
                            <label for="validationCustom01" class="form-label">Description </label>
                            <textarea id="elm1" name="description" required>{{ !empty($item) ? $item->description : old('description') }}</textarea>
                            
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please Enter Description.
                            </div>
                        </div> 

                        <label class="form-label">Select Assigned User</label>
                        <select name="assigned_to_id" class="form-control select2" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please select a User.
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

    @endsection
