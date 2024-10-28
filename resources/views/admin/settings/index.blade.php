@extends('layouts.admin')

@section('title', $pageTitle)

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
        @if (session('success') || session('message'))
    <div class="alert alert-{{ session('alert-type', 'success') }} alert-dismissible fade show" role="alert">
        {{ session('success') ?? session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
            <form method="post" action="{{ route('setting.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header text-center bg-primary">
                        <div class="card-title m-0 text-white">
                            General Setting
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Form Start -->
                            <input name="id" type="hidden" value="1">
                            <div class="form-group col-md-6 mb-3">
                                <label for="title">Site Title <span class="text-primary">*</span></label>
                                <input type="text" class="form-control" name="title" id="title" value="{{ setting()->title }}">
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label for="meta_title">Meta Title <span class="text-primary">*</span></label>
                                <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{ setting()->meta_title }}">
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label for="meta_description">Meta Description: <span class="text-primary">Max length 160 characters</span></label>
                                <textarea class="form-control" name="meta_description" rows="3" id="meta_description">{{ setting()->meta_description }}</textarea>
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label for="meta_keywords">Meta Keywords: <span class="text-primary">Separate Every Keyword by Using (,) Symbol</span></label>
                                <textarea class="form-control" name="meta_keywords" rows="3" id="meta_keywords">{{ setting()->meta_keywords }}</textarea>
                            </div>
                            <!-- <div class="form-group col-md-6 mb-3">
                                <img src="{{ setting()->logo_url }}" class="image-preview" height="80" width="160">
                                <div class="clearfix"></div>
                                <label for="logo">Site Logo: <span class="text-primary">Best Resolution Height- 80 PX, Width- Any PX</span></label>
                                <input type="file" class="form-control image-input" onChange="mainThamUrl(this)" name="logo" id="logo">
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <img src="{{ setting()->favicon_url }}" class="mt-3 image-preview" height="64" width="64">
                                <div class="clearfix"></div>
                                <label for="favicon">Site Favicon: <span class="text-primary">Best Resolution Height- 64 PX, Width- 64 PX</span></label>
                                <input type="file" class="form-control image-input" name="favicon" id="favicon">
                            </div> -->
                            <!-- <div class="form-group col-md-4 mb-3">
                                <label for="time_zone">Time Zone <span class="text-primary">*</span></label>
                                <select class="form-control select2" name="timezone_id" >
                                    <option value="">-- Select One --</option>
                                    @foreach(DB::table('timezones')->get() as $timezone)
                                    <option value="{{ $timezone->id }}" <?php if($timezone->id==setting()->timezone_id){ echo 'selected'; } ?>>{{ $timezone->code }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4 mb-3">
                                <label for="currency">Currency <span class="text-primary">*</span></label>
                                <select class="form-control select2" name="currency_id" id="currency_id" >
                                    <option value="">-- Select One --</option>
                                    @foreach(DB::table('currencies')->get() as $currency)
                                    <option value="{{ $currency->id }}" <?php if($currency->id==setting()->currency_id){ echo 'selected'; } ?>>{{ $currency->name }}</option>
                                    @endforeach
                                </select>
                            </div> -->
                            <!-- <div class="form-group col-md-4 mb-3">
                                <label for="currency">Country <span class="text-primary">*</span></label>
                                <select class="form-control select2" name="country_id" id="country_id" >
                                    <option value="">-- Select One --</option>
                                    @foreach(DB::table('countries')->get() as $country)
                                    <option value="{{ $country->id }}" <?php if($country->id==setting()->country_id){ echo 'selected'; } ?>>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div> -->
                            
                            <div class="form-group col-md-4 mb-3">
                                <label for="meta_title">Phone Number</label>
                                <input type="text" class="form-control" name="phone" id="phone" value="{{ setting()->phone }}">
                            </div>
                            <div class="form-group col-md-4 mb-3">
                                <label for="meta_title">Email Address</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ setting()->email }}">
                            </div>
                            <div class="form-group col-md-4 mb-3">
                                <label for="meta_title">Fax</label>
                                <input type="text" class="form-control" name="fax" id="fax" value="{{ setting()->fax }}">
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <label for="meta_title">Address</label>
                                <textarea name="address" id="address" class="form-control">{{ setting()->address }}</textarea>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <label for="meta_title">Footer Copyright Text</label>
                                <textarea name="copyright_text" id="copyright_text" class="form-control">{{ setting()->copyright_text }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="card">
                    <div class="card-header text-center bg-primary">
                        <div class="card-title m-0 text-white">
                            Social Accounts
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6 mb-3">
                                <label for="meta_title">Facebook </label>
                                <input type="url" class="form-control" name="facebook" id="facebook" value="{{ setting()->facebook }}">
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label for="meta_title">Twitter </label>
                                <input type="url" class="form-control" name="twitter" id="twitter" value="{{ setting()->twitter }}">
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label for="meta_title">Linkedin </label>
                                <input type="url" class="form-control" name="linkedin" id="linkedin" value="{{ setting()->linkedin }}">
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label for="meta_title">Instagram </label>
                                <input type="url" class="form-control" name="instagram" id="instagram" value="{{ setting()->instagram }}">
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label for="meta_title">Github </label>
                                <input type="url" class="form-control" name="github" id="github" value="{{ setting()->github }}">
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary"> Update</button>
            </form>
             
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        // Get all the file inputs
        var fileInputs = document.querySelectorAll('input[type="file"]');        
        // Add an event listener to each file input
        fileInputs.forEach(function(input) {
            input.addEventListener('change', function(e) {
              // Get the selected file
              var file = e.target.files[0];            
              // Create a FileReader object
              var reader = new FileReader();            
              // Set up the FileReader onload event
              reader.onload = function(e) {
                // Get the corresponding preview image element
                var previewImage = input.parentNode.querySelector('.image-preview');           
                // Set the image source to the FileReader result
                previewImage.src = e.target.result;
              }            
              // Read the selected file as a Data URL
              reader.readAsDataURL(file);
            });
        });
    });
</script>
@endpush