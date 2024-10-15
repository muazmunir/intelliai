@extends('layouts.admin')



@section('content')
<div class="container-fluid">
    <!-- Start page content-wrapper -->
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header text-center bg-primary">
                    <div class="card-title m-0 text-white" > 
                        All Categories 
                    </div>
                </div>
                <div class="card-body">
                @if (session('success') || session('message'))
    <div class="alert alert-{{ session('alert-type', 'success') }} alert-dismissible fade show" role="alert">
        {{ session('success') ?? session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
                    <table id="category_datatable"
                        class="table table-striped table-bordered dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th>{{ __('#') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header text-center bg-primary">
                    <div class="card-title m-0 text-white" > 
                        </i> Add New 
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('service-categories.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="">Name</label>
                            <input type="text" class="form-control" placeholder="Ex: PHP" name="name">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div>
 
@include('admin.services.category.edit') 
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $("#category_datatable").DataTable({
 
            processing: true,
            serverSide: true,
            ajax: "{{ route('service-categories.dataTable') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'action', searchable: false, orderable: false }
    
            ],
            lengthMenu: [
                [5, 10, 50],
                [5, 10, 50],
            ],
            order: [[1, 'asc']],
        });

        $(document).on('click', '#deleteCategory', function(event) {
            event.preventDefault();
            var categoryId = $(this).data('id'); // Get the service category ID

            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this category!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '/admin/service-categories/' + categoryId, // Replace with your delete route
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                        },
                        success: function(response) {
                            swal(response.message, {
                                icon: "success",
                            });
                            // Refresh the DataTable after deletion
                            $('#category_datatable').DataTable().ajax.reload();
                        },
                        error: function(xhr) {
                            swal("Error deleting category!", {
                                icon: "error",
                            });
                        }
                    });
                }
            });
        });

    });
</script> 
@endpush
