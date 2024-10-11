<?php

use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

function uploadImage($file, $height, $width, $folder)
{
    $extension = $file->getClientOriginalExtension();

    // Generate a unique image name using the current timestamp
    $imageName = time() . '.' . $extension;

    // Define the destination path
    $destinationPath = public_path('uploads/' . $folder);

    // Create the directory if it doesn't exist
    if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0777, true);
    }

    // Get the real path of the file
    $imagePath = $file->getRealPath();

    // Load the image based on its type
    switch (strtolower($extension)) {
        case 'jpeg':
        case 'jpg':
            $image = imagecreatefromjpeg($imagePath);
            break;
        case 'png':
            $image = imagecreatefrompng($imagePath);
            break;
        case 'gif':
            $image = imagecreatefromgif($imagePath);
            break;
        default:
            return null; // Unsupported image type
    }

    // Get the original image dimensions
    $originalWidth = imagesx($image);
    $originalHeight = imagesy($image);

    // Calculate the aspect ratio
    $aspectRatio = $originalWidth / $originalHeight;

    // Resize the image to the given width and height, keeping the aspect ratio
    if ($width / $height > $aspectRatio) {
        $newWidth = $height * $aspectRatio;
        $newHeight = $height;
    } else {
        $newHeight = $width / $aspectRatio;
        $newWidth = $width;
    }

    // Create a blank canvas for the resized image
    $resizedImage = imagecreatetruecolor($newWidth, $newHeight);

    // Resize the original image into the blank canvas
    imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);

    // Save the resized image based on its type
    switch (strtolower($extension)) {
        case 'jpeg':
        case 'jpg':
            imagejpeg($resizedImage, $destinationPath . '/' . $imageName);
            break;
        case 'png':
            imagepng($resizedImage, $destinationPath . '/' . $imageName);
            break;
        case 'gif':
            imagegif($resizedImage, $destinationPath . '/' . $imageName);
            break;
    }

    // Free up memory
    imagedestroy($image);
    imagedestroy($resizedImage);

    // Return the image name
    return $imageName;
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
