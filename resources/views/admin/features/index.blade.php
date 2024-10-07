@extends('layouts.admin')

@section('title', $pageTitle)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-primary pt-2 pb-2 d-flex justify-content-between align-items-center">
                    <h4 class="text-white mb-0">{{ $pageTitle }}</h4>
                    <a href="{{ route('features.create') }}" class="text-white"><i class="icofont icofont-ui-add"></i> Add New</a>
                </div>
                <div class="card-body">
                @if (session('success') || session('message'))
    <div class="alert alert-{{ session('alert-type', 'success') }} alert-dismissible fade show" role="alert">
        {{ session('success') ?? session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
                    <div class="table-responsive custom-scrollbar">
                        <table class="display" id="user_datatable">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Category') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script>
    (function ($) {
        $(document).ready(function () {
            $("#user_datatable").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('services.dataTable') }}",
                columns: [
                    { data: 'id', name: 'id' },
                { data: 'title', name: 'title' },
                { data: 'category_name', name: 'category_name' }, 
                { data: 'action', searchable: false, orderable: false }
                ],
            });
        });
        

        $('.action .delete a').on('click', function(event) {
        event.preventDefault(); // Prevent the default anchor behavior

        const userId = $(this).closest('ul.action').data('user-id'); // Get the user ID from data attribute
        const deleteUrl = `/users/${userId}`; // Set the URL for deletion

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Make an AJAX call to delete the user
                $.ajax({
                    url: deleteUrl,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            'Your user has been deleted.',
                            'success'
                        ).then(() => {
                            // Optionally refresh the page or remove the deleted user from the table
                            location.reload(); // Refresh the page
                        });
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error!',
                            'There was an error deleting the user.',
                            'error'
                        );
                    }
                });
            }
        });
    });


    })(jQuery);
</script>

@endpush