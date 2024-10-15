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
                        <table class="display" id="feature_datatable">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>{{ __('Title') }}</th>
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
    $(document).ready(function () {
        $("#feature_datatable").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('features.dataTable') }}",
            columns: [
                { data: 'id', name: 'id' },
            { data: 'title', name: 'title' },
            { data: 'action', searchable: false, orderable: false }
            ],
        });
        

        $(document).on('click', '#deleteFeature', function() {
    var featureId = $(this).data('id'); // Get the feature ID from the data-id attribute

    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this feature!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: '/admin/features/' + featureId, // Use the delete route with the feature ID
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                },
                success: function(response) {
                    swal(response.message, {
                        icon: "success",
                    });
                    // Reload DataTable to reflect changes
                    $('#feature_datatable').DataTable().ajax.reload();
                },
                error: function(xhr) {
                    swal("Error deleting feature!", {
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