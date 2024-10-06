@extends('layouts.admin')

@section('title', $pageTitle)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary pt-2 pb-2 d-flex justify-content-between align-items-center">
                    <h4 class="text-white mb-0">Create Service</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Category -->
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" id="category_id" class="form-select" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Icon -->
                        <div class="mb-3">
                            <label for="icon" class="form-label">Service Icon</label>
                            <input type="file" name="icon" id="icon" class="form-control">
                        </div>

                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                        </div>

                        <!-- Short Description -->
                        <div class="mb-3">
                            <label for="short_description" class="form-label">Short Description</label>
                            <textarea name="short_description" id="short_description" class="form-control" rows="3" required>{{ old('short_description') }}</textarea>
                        </div>

                        <!-- Long Description -->
                        <div class="mb-3">
                            <label for="long_description" class="form-label">Long Description</label>
                            <textarea name="long_description" id="long_description" class="form-control" rows="5" required>{{ old('long_description') }}</textarea>
                        </div>

                        <!-- Featured Checkbox -->
                        <div class="form-check mb-3">
                            <input type="checkbox" name="is_featured" id="is_featured" class="form-check-input" {{ old('is_featured') ? 'checked' : '' }}>
                            <label for="is_featured" class="form-check-label">Is Featured</label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Create Service</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection