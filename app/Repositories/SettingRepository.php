<?php

namespace App\Repositories;

use App\Interfaces\SettingInterface;

class SettingRepository implements SettingInterface
{
    public function updateSetting($request)
    {
        $input = $request->all();

        $booleanFields = [
            'is_google_analytics',
            'is_facebook_chat',
            'is_recaptcha',
            'is_google_oauth',
            'is_facebook_oauth',
            'is_github_oauth',
        ];

        foreach ($booleanFields as $field) {
            $input[$field] = $request->has($field) ? 1 : 0;
        }

        $this->processImage($request, $input);

        setting()->update($input);
    }

    private function processImage($request, &$input)
    {
        $this->processImageFile($request, 'logo', 'logo_path', '250', '250', $input);
        $this->processImageFile($request, 'favicon', 'favicon_path', '150', '150', $input);
    }

    private function processImageFile($request, $fileKey, $inputKey, $height, $width, &$input)
    {
        if ($request->hasFile($fileKey)) {
            if (setting()->{$inputKey}) {
                deleteFile(setting()->{$inputKey}, 'settings');
            }

            $input[$inputKey] = uploadImage($request->file($fileKey), $height, $width, 'settings');
        }
    }
}
