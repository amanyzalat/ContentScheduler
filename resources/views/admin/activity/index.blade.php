@extends('admin/layouts.master')
@section('title') Activity Log @endsection
@section('css')
<!-- DataTables -->
<link href="{{URL::asset('assets/libs/datatables/dataTables.min.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('body')

<body data-sidebar="dark"> @endsection
    @section('content')
    @component('admin/components.breadcrumb')
    @slot('page_title') List @endslot
    @slot('subtitle') Activity Log @endslot
    @endcomponent


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Activity Log</h4>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Action</th>
                                <th>Description</th>
                                <th>Time</th>


                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($activities as $activity)

                            <tr>
                                <td>{{ $activity->user->name }}</td>
                                <td>{{ $activity->action }}</td>
                                <td>{{ $activity->description }}</td>
                                <td>{{ $activity->created_at->diffForHumans() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Do you want to delete the item?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success " id="confirm-button">Yes</button>
                </div>
            </div>
        </div>
    </div>


    @endsection
    @section('scripts')
    <script>
        $('.deleteitem').click(function() {
            var ID = $(this).data('id');
            $('#confirm-button').data('id', ID); //set the data attribute on the modal button
        });
        $('#confirm-button').click(function() {
            var ID = $(this).data('id');
            $.ajax({
                url: "{{ route('posts.destroy') }}",
                type: 'get',
                data: {
                    id: ID
                },
                success: function(response) {
                    // Assuming the response confirms the deletion
                    $('.modal-backdrop').hide();
                    $('#deleteModal').hide(); // Hide the modal
                    // You may also want to remove the row from the table dynamically:
                    $('a[data-id="' + ID + '"]').closest('tr').remove();
                },
            });
        });
    </script>
    <!-- Required datatable js -->
    <script src="{{URL::asset('assets/libs/datatables/dataTables.min.js')}}"></script>

    <!-- Datatable init js -->
    <script src="{{URL::asset('assets/js/pages/datatables.init.js')}}"></script>

    <script src="{{URL::asset('assets/js/app.js')}}"></script>

    @endsection