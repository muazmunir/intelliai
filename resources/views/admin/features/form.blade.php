@extends('layouts.admin')

@section('title', $pageTitle)

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary pt-2 pb-2 d-flex justify-content-between align-items-center">
                        <h4 class="text-white mb-0">{{ isset($service) ? 'Edit Service' : 'Create Service' }}</h4>
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
                            @if(isset($feature))
                                @method('PUT')
                            @endif
                            
                            <!-- Feature Title -->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="title" class="form-label">Feature Title</label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title', $feature->title ?? '') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Feature Description -->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="description" class="form-label">Feature Description</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="3" required>{{ old('description', $feature->description ?? '') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Feature Icon -->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="icon" class="form-label">Feature Icon</label>
                                    <input type="text" name="icon" class="form-control @error('icon') is-invalid @enderror" id="icon" value="{{ old('icon', $feature->icon ?? '') }}" required>
                                    @error('icon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Feature Image -->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="image" class="form-label">Feature Image</label>
                                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="image">
                                    @if(isset($feature) && $feature->image)
                                        <img src="{{ asset('storage/' . $feature->image) }}" class="img-thumbnail mt-2" alt="Feature Image" width="150">
                                    @endif
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Feature Items (Dynamic List) -->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="items" class="form-label">Feature Items</label>
                                    <div id="items-container">
                                        @if(isset($feature) && $feature->items)
                                            @foreach($feature->items as $item)
                                                <div class="input-group mb-2">
                                                    <input type="text" name="items[]" class="form-control" value="{{ $item }}" required>
                                                    <button type="button" class="btn btn-danger remove-item">Remove</button>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <button type="button" class="btn btn-secondary mt-2" id="add-item">Add Item</button>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">
                                        {{ isset($feature) ? 'Update Feature' : 'Create Feature' }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    document.getElementById('add-item').addEventListener('click', function () {
        let container = document.getElementById('items-container');
        let inputGroup = document.createElement('div');
        inputGroup.className = 'input-group mb-2';
        inputGroup.innerHTML = `
            <input type="text" name="items[]" class="form-control" required>
            <button type="button" class="btn btn-danger remove-item">Remove</button>
        `;
        container.appendChild(inputGroup);

        inputGroup.querySelector('.remove-item').addEventListener('click', function () {
            inputGroup.remove();
        });
    });

    document.querySelectorAll('.remove-item').forEach(function(button) {
        button.addEventListener('click', function() {
            this.parentElement.remove();
        });
    });
</script>
@endpush