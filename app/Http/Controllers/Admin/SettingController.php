<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\SettingInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    private $settingRepository;

    public function __construct(SettingInterface $settingInterface)
    {
        $this->settingRepository = $settingInterface;
    }

    public function index(): View
    {
        $pageTitle = 'General Setting';

        return view('admin.settings.index', compact('pageTitle'));
    }

    public function update(Request $request): RedirectResponse
    {
        $this->settingRepository->updateSetting($request);

        $notification = [
            'message' => 'Setting updated successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }
}
