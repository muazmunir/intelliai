@extends('layouts.admin')

@section('title', $pageTitle)

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary pt-2 pb-2 d-flex justify-content-between align-items-center">
                    <h4 class="text-white mb-0">{{ isset($testimonial) ? 'Edit Testimonial' : 'Create Testimonial' }}</h4>
                </div>
                <div class="card-body">
                    @if (session('success') || session('message'))
                        <div class="alert alert-{{ session('alert-type', 'success') }} alert-dismissible fade show" role="alert">
                            {{ session('success') ?? session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ isset($testimonial) ? route('testimonials.update', $testimonial->id) : route('testimonials.store') }}" method="POST">
                        @csrf
                        @if (isset($testimonial))
                            @method('PUT')
                        @endif

                        <div class="form-group mb-3">
                            <label for="user_id">User</label>
                            <select name="user_id" id="user_id" class="form-control" required>
                                <option value="">-- Select User --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id', $testimonial->user_id ?? '') == $user->id ? 'selected' : '' }}>
                                        {{ $user->full_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="comment">Comment</label>
                            <textarea name="comment" id="comment" class="form-control" rows="3" required>{{ old('comment', $testimonial->comment ?? '') }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="0" {{ old('status', $testimonial->status ?? '') == '0' ? 'selected' : '' }}>Draft</option>
                                <option value="1" {{ old('status', $testimonial->status ?? '') == '1' ? 'selected' : '' }}>Published</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">{{ isset($testimonial) ? 'Update Testimonial' : 'Create Testimonial' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
