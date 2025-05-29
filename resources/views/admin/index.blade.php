@extends('admin.layouts.master')
@section('title') Dashboard @endsection
@section('css')
<link href="{{URL::asset('assets/libs/chartist/chartist.min.css')}}" rel="stylesheet">
@endsection
@section('body') <body data-sidebar="dark"> @endsection
    @section('content')

    <!-- start page title -->
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h6 class="page-title">Dashboard</h6>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Welcome to  Dashboard</li>
                </ol>
            </div>
            
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card mini-stat bg-primary text-white">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="float-start mini-stat-img me-4">
                            <img src="{{URL::asset('assets/images/services-icon/01.png')}}" alt="">
                        </div>
                        <h5 class="font-size-16 text-uppercase text-white-50">Orders</h5>
                        <h4 class="fw-medium font-size-24">1,685 <i class="mdi mdi-arrow-up text-success ms-2"></i></h4>
                        <div class="mini-stat-label bg-success">
                            <p class="mb-0">+ 12%</p>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="float-end"> 
                            <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5 text-white-50"></i></a>
                        </div>

                        <p class="text-white-50 mb-0 mt-1">Since last month</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card mini-stat bg-primary text-white">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="float-start mini-stat-img me-4">
                            <img src="{{URL::asset('assets/images/services-icon/02.png')}}" alt="">
                        </div>
                        <h5 class="font-size-16 text-uppercase text-white-50">Revenue</h5>
                        <h4 class="fw-medium font-size-24">52,368 <i class="mdi mdi-arrow-down text-danger ms-2"></i></h4>
                        <div class="mini-stat-label bg-danger">
                            <p class="mb-0">- 28%</p>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="float-end">
                            <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5 text-white-50"></i></a>
                        </div>

                        <p class="text-white-50 mb-0 mt-1">Since last month</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card mini-stat bg-primary text-white">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="float-start mini-stat-img me-4">
                            <img src="{{URL::asset('assets/images/services-icon/03.png')}}" alt="">
                        </div>
                        <h5 class="font-size-16 text-uppercase text-white-50">Average Price</h5>
                        <h4 class="fw-medium font-size-24">15.8 <i class="mdi mdi-arrow-up text-success ms-2"></i></h4>
                        <div class="mini-stat-label bg-info">
                            <p class="mb-0"> 00%</p>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="float-end">
                            <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5 text-white-50"></i></a>
                        </div>

                        <p class="text-white-50 mb-0 mt-1">Since last month</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card mini-stat bg-primary text-white">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="float-start mini-stat-img me-4">
                            <img src="{{URL::asset('assets/images/services-icon/04.png')}}" alt="">
                        </div>
                        <h5 class="font-size-16 text-uppercase text-white-50">Product Sold</h5>
                        <h4 class="fw-medium font-size-24">2436 <i class="mdi mdi-arrow-up text-success ms-2"></i></h4>
                        <div class="mini-stat-label bg-warning">
                            <p class="mb-0">+ 84%</p>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="float-end">
                            <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5 text-white-50"></i></a>
                        </div>

                        <p class="text-white-50 mb-0 mt-1">Since last month</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    

    

    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Latest Transaction</h4>
                    <div class="table-responsive">
                        <table class="table table-hover table-centered table-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">(#) Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col" colspan="2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">#14256</th>
                                    <td>
                                        <div>
                                            <img src="{{URL::asset('assets/images/users/user-2.jpg')}}" alt="" class="avatar-xs rounded-circle me-2"> Philip Smead
                                        </div>
                                    </td>
                                    <td>15/1/2018</td>
                                    <td>$94</td>
                                    <td><span class="badge bg-success">Delivered</span></td>
                                    <td>
                                        <div>
                                            <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">#14257</th>
                                    <td>
                                        <div>
                                            <img src="{{URL::asset('assets/images/users/user-3.jpg')}}" alt="" class="avatar-xs rounded-circle me-2"> Brent Shipley
                                        </div>
                                    </td>
                                    <td>16/1/2019</td>
                                    <td>$112</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <td>
                                        <div>
                                            <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">#14258</th>
                                    <td>
                                        <div>
                                            <img src="{{URL::asset('assets/images/users/user-4.jpg')}}" alt="" class="avatar-xs rounded-circle me-2"> Robert Sitton
                                        </div>
                                    </td>
                                    <td>17/1/2019</td>
                                    <td>$116</td>
                                    <td><span class="badge bg-success">Delivered</span></td>
                                    <td>
                                        <div>
                                            <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">#14259</th>
                                    <td>
                                        <div>
                                            <img src="{{URL::asset('assets/images/users/user-5.jpg')}}" alt="" class="avatar-xs rounded-circle me-2"> Alberto Jackson
                                        </div>
                                    </td>
                                    <td>18/1/2019</td>
                                    <td>$109</td>
                                    <td><span class="badge bg-danger">Cancel</span></td>
                                    <td>
                                        <div>
                                            <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">#14260</th>
                                    <td>
                                        <div>
                                            <img src="{{URL::asset('assets/images/users/user-6.jpg')}}" alt="" class="avatar-xs rounded-circle me-2"> David Sanchez
                                        </div>
                                    </td>
                                    <td>19/1/2019</td>
                                    <td>$120</td>
                                    <td><span class="badge bg-success">Delivered</span></td>
                                    <td>
                                        <div>
                                            <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">#14261</th>
                                    <td>
                                        <div>
                                            <img src="{{URL::asset('assets/images/users/user-2.jpg')}}" alt="" class="avatar-xs rounded-circle me-2"> Philip Smead
                                        </div>
                                    </td>
                                    <td>15/1/2018</td>
                                    <td>$94</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <td>
                                        <div>
                                            <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <!-- end row -->
    @endsection
    @section('scripts')

    <!-- Peity chart-->
    <script src="{{URL::asset('assets/libs/peity/peity.min.js')}}"></script>

    <!-- Plugin Js-->
    <script src="{{URL::asset('assets/libs/chartist/chartist.min.js')}}"></script>
    <script src="{{URL::asset('assets/libs/chartist-plugin-tooltips/chartist-plugin-tooltips.min.js')}}"></script>

    <script src="{{URL::asset('assets/js/pages/dashboard.init.js')}}"></script>

    <script src="{{URL::asset('assets/js/app.js')}}"></script>

    @endsection
