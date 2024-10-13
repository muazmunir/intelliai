@extends('layouts.admin')

@section('title', $pageTitle)

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary pt-2 pb-2 d-flex justify-content-between align-items-center">
                    <h4 class="text-white mb-0">{{ isset($feature) ? 'Edit Feature' : 'Create Feature' }}</h4>
                </div>
                <div class="card-body">
                    @if (session('success') || session('message'))
                        <div class="alert alert-{{ session('alert-type', 'success') }} alert-dismissible fade show" role="alert">
                            {{ session('success') ?? session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ isset($feature) ? route('features.update', $feature->id) : route('features.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($feature))
                            @method('PUT')
                        @endif

                        <div class="form-group mb-3">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $feature->title ?? '') }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="3" required>{{ old('description', $feature->description ?? '') }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="list_items">List Items</label>
                            <div id="list-items-wrapper">
                                @if (isset($feature) && $feature->list_items)
                                    @foreach ($feature->list_items as $item)
                                        <div class="input-group mb-2">
                                            <input type="text" name="list_items[]" class="form-control" value="{{ $item }}" required>
                                            <button type="button" class="btn btn-danger remove-item">Remove</button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="input-group mb-2">
                                        <input type="text" name="list_items[]" class="form-control" required>
                                        <button type="button" class="btn btn-danger remove-item">Remove</button>
                                    </div>
                                @endif
                            </div>
                            <button type="button" class="btn btn-secondary" id="add-list-item">Add List Item</button>
                        </div>

                        <div class="form-group mb-3">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image_path" class="form-control" accept="image/*">
                            @if (isset($feature) && $feature->image_path)
                                <div class="mt-2">
                                    <img id="image-preview" src="{{ asset($feature->image_path) }}" alt="Feature Image" class="img-thumbnail" width="200">
                                </div>
                            @else
                                <div class="mt-2">
                                    <img id="image-preview" src="#" alt="Image Preview" class="img-thumbnail d-none" width="200">
                                </div>
                            @endif
                        </div>

                        <div class="form-group mb-3">
                            <label for="order">Order</label>
                            <input type="number" name="order" id="order" class="form-control" value="{{ old('order', $feature->order ?? 0) }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">{{ isset($feature) ? 'Update Feature' : 'Create Feature' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        // Image preview
        $('#image_path').change(function () {
            let reader = new FileReader();
            reader.onload = function (e) {
                $('#image-preview').attr('src', e.target.result).removeClass('d-none');
            }
            reader.readAsDataURL(this.files[0]);
        });

        // Add new list item
        $('#add-list-item').click(function () {
            $('#list-items-wrapper').append(`
                <div class="input-group mb-2">
                    <input type="text" name="list_items[]" class="form-control" required>
                    <button type="button" class="btn btn-danger remove-item">Remove</button>
                </div>
            `);
        });

        // Remove list item
        $(document).on('click', '.remove-item', function () {
            $(this).closest('.input-group').remove();
        });
    });
</script>
@endpush
