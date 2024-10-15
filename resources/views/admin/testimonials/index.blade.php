@extends('layouts.admin')

@section('title', $pageTitle)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-primary pt-2 pb-2 d-flex justify-content-between align-items-center">
                    <h4 class="text-white mb-0">{{ $pageTitle }}</h4>
                    <a href="{{ route('testimonials.create') }}" class="text-white"><i class="icofont icofont-ui-add"></i> Add New</a>
                </div>
                <div class="card-body">
                @if (session('success') || session('message'))
                    <div class="alert alert-{{ session('alert-type', 'success') }} alert-dismissible fade show" role="alert">
                        {{ session('success') ?? session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                    <div class="table-responsive custom-scrollbar">
                        <table class="display" id="testimonial_datatable">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>{{ __('Name') }}</th>
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
            $("#testimonial_datatable").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('testimonials.dataTable') }}",
                columns: [
                    { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'action', searchable: false, orderable: false }
                ],
            });

            $(document).on('click', '#deleteTestimonial', function() {
    var testimonialId = $(this).data('id'); // Get the testimonial ID from the data-id attribute

    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this testimonial!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: '/admin/testimonials/' + testimonialId, // Use the delete route with the testimonial ID
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                },
                success: function(response) {
                    swal(response.message, {
                        icon: "success",
                    });
                    // Reload DataTable to reflect changes
                    $('#testimonial_datatable').DataTable().ajax.reload();
                },
                error: function(xhr) {
                    swal("Error deleting testimonial!", {
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