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

                    <h4 class="card-title">List of Tasks</h4>
                    
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Assigned to</th>
                                <th>Admin</th>
                               <!-- <th>Action</th>-->
                                
                            </tr>
                        </thead>


                        <tbody>
                        @foreach($items as $item)

                            <tr>
                                <td>{!! $item->title !!}</td>
                                <td>{!!  $item->assignedTo->name   !!}</td>
                                <td>{!!  $item->assignedBy->name   !!}</td>
                               <!-- <td> 
                                    <a href="{{ route('tasks.edit', ['id' => $item->id]) }}"
                                                       class="btn-transparent btn-sm text-warning">
                                                        <i class="fa fa-edit"></i>
                                    </a> | 
                                    
                                    <a  class="deleteitem btn-transparent btn-sm text-danger" style="cursor: pointer;"  data-id="{{$item->id}}"
                                    
                                    data-bs-toggle="modal" data-bs-target="#deleteModal">
                                       <i class="far fa-trash-alt"></i>
                                    </a>

                                  </td>-->
                                
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
        $('.deleteitem').click(function(){
            var ID = $(this).data('id');
            $('#confirm-button').data('id', ID); //set the data attribute on the modal button
        });
        $('#confirm-button').click(function(){
            var ID = $(this).data('id');
            $.ajax({
                url:"{{ route('tasks.destroy') }}",
                type: 'get',
                data: { id: ID},
                success: function(response) {
                // Assuming the response confirms the deletion
               $('.modal-backdrop').hide();
                $('#deleteModal').hide();  // Hide the modal
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
