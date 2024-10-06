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
    });
</script>
 <!-- Scripts -->
 
   
<script>
    var categoryId;
    $(document).on('click', '.edit-category-button', function() {
        categoryId = $(this).data('category-id');
        $.ajax({
            url: '/admin/service-categories/' + categoryId + '/edit',
            method: 'GET',
            success: function(response) {
                $('#edit-category-form input[name="name"]').val(response.category.name);
                $('#editCategoryModal').modal('show');
            }
        });
    });

    $('#edit-category-form').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();        
        $.ajax({
            url: '/admin/service-categories/' + categoryId,
            method: 'PUT',
            data: formData,
            success: function(response) {
                $("#category_datatable").DataTable().ajax.reload();
                Swal.fire('Success', response.message, 'success');
                $('#editCategoryModal').modal('hide');
            },
         });
    });
</script> 
<script>
    function confirmDelete(categoryId) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this category!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`/admin/service-categories/${categoryId}`)
                    .then(response => {
                        if (response.status === 200) {
                            if (response.data.title && response.data.title === 'Error') {
                                Swal.fire('Error', response.data.message, 'error');
                            } else {
                                Swal.fire('Success', response.data.message, 'success').then(() => {
                                    $('#category_datatable').DataTable().ajax.reload();
                                });
                            }
                        }
                    })
                    .catch(error => {
                        Swal.fire('Error', 'An error occurred while deleting the category.', 'error');
                    });
            }
        });
    }
</script>
 
@endpush