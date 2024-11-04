@extends('layouts.admin')

@section('title', $pageTitle)

@section('content')
<div class="container">
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
                    <!-- Display Validation Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <!-- Form Start -->
                    <form action="{{ isset($service) ? route('services.update', $service->id) : route('services.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($service))
                            @method('PUT') <!-- For update, use PUT method -->
                        @endif
                        
                        <!-- Category -->
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                <option value="" selected disabled>Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ (old('category_id') ?? ($service->category_id ?? '')) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" 
                                value="{{ old('title', $service->title ?? '') }}" required>
                            @error('title')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Icon Upload -->
                        <div class="mb-3">
                            <label for="icon" class="form-label">Service Icon</label>
                            <input type="file" name="icon" id="icon" class="form-control @error('icon') is-invalid @enderror" accept="image/*">
                            @error('icon')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror

                            <!-- Preview Image -->
                            <div class="mt-2">
                                <img id="icon-preview" src="{{ isset($service) ? $service->icon_url : 'https://via.placeholder.com/400x600.png/?text=No+Image' }}" alt="Icon Preview" class="img-fluid" style="max-width: 200px; display: {{ isset($service) ? 'block' : 'none' }};">
                            </div>
                        </div>

                        <!-- Short Description -->
                        <div class="mb-3">
                            <label for="short_description" class="form-label">Short Description</label>
                            <textarea name="short_description" id="short_description" class="form-control @error('short_description') is-invalid @enderror" rows="3" required>{{ old('short_description', $service->short_description ?? '') }}</textarea>
                            @error('short_description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Long Description -->
                        <div class="mb-3">
                            <label for="long_description" class="form-label">Long Description</label>
                            <textarea name="long_description" id="long_description" class="form-control @error('long_description') is-invalid @enderror" rows="5" required>{{ old('long_description', $service->long_description ?? '') }}</textarea>
                            @error('long_description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Featured Checkbox -->
                        <div class="form-check mb-3">
                            <input type="hidden" name="is_featured" value="0"> <!-- hidden input to handle unchecked state -->
                            <input type="checkbox" name="is_featured" id="is_featured" class="form-check-input" value="1"
                                <?php echo ($isFeaturedChecked || (!isset($_POST['is_featured']) && $service['is_featured'])) ? 'checked' : ''; ?>>
                            <label for="is_featured" class="form-check-label">Is Featured</label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">
                            {{ isset($service) ? 'Update Service' : 'Create Service' }}
                        </button>
                    </form>
                    <!-- Form End -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.getElementById('icon').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('icon-preview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block'; // Show the preview
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = 'https://via.placeholder.com/400x600.png/?text=No+Image';
            preview.style.display = 'none'; // Hide the preview if no file is selected
        }
    });
</script>
@endpush
