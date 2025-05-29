@extends('admin/layouts.master')
@section('title') Taks @endsection
@section('css')
<!-- DataTables -->
<link href="{{URL::asset('assets/libs/datatables/dataTables.min.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('body') <body data-sidebar="dark"> @endsection
    @section('content')
    @component('admin/components.breadcrumb')
    @slot('page_title') List @endslot
    @slot('subtitle') Tasks @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Statistics </h4>
                    
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Task Count</th>               
                            </tr>
                        </thead>


                        <tbody>
                        @foreach($statistics as $stat)

                            <tr>
                                <td>{{ $stat->user->name }}</td>
                                <td>{{ $stat->task_count }}</td>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
<!-- Modal -->

    

    @endsection
    @section('scripts')
   
</script>
    <!-- Required datatable js -->
    <script src="{{URL::asset('assets/libs/datatables/dataTables.min.js')}}"></script>

    <!-- Datatable init js -->
    <script src="{{URL::asset('assets/js/pages/datatables.init.js')}}"></script>

    <script src="{{URL::asset('assets/js/app.js')}}"></script>
    <script>
    $(document).ready(function() {
        var table = $('#datatable').DataTable();
        table.order([1, 'desc']).draw(); 
    });
</script>
    @endsection
