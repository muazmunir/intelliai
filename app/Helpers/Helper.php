<?php

use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\ImageManager;

function uploadImage($file, $height, $width, $folder)
{
    $image_name = Str::random(10) . '.' . $file->getClientOriginalExtension();
    
    // Define the path to save the image
    $path = public_path("uploads/{$folder}/{$image_name}");

    // Create an image manager instance with the desired driver (Gd or Imagick)
    $manager = new ImageManager(new Intervention\Image\Drivers\Gd\Driver());

    // Resize the image and save it
    $image = $manager->read($file->getPathname());

    // Resize the image and save it
    $image->resize($width, $height, function ($constraint) {
        $constraint->aspectRatio(); // Maintain aspect ratio
        $constraint->upsize(); // Prevent upsizing the image
    })->save($path); // Save the resized image to the specified path

    return $image_name;
}

function uploadFile($file, $folder)
{
    $file_name = $file->getClientOriginalName();
    $file->move(public_path("uploads/{$folder}"), $file_name);

    return $file_name;
}

function deleteFile($file, $folder)
{
    $file_path = public_path('uploads/'.$folder.'/'.$file);
    if (File::isFile($file_path)) {
        File::delete($file_path);
    }

    return true;
}

function getCurrentDateTime()
{
    $timeZone = config('app.timezone');
    $carbon = Carbon::now()->setTimezone($timeZone);

    return $carbon;
}

function isSuperAdmin()
{
    return Gate::allows('isSuperAdmin');
}

function setting()
{
    return Setting::first();
}

function jsonResponse(array $data)
{
    return new JsonResponse($data);
}
