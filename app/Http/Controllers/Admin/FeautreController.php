<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeatureRequest;
use App\Interfaces\FeautreInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class FeautreController extends Controller
{
    private $featureRepository;

    public function __construct(FeautreInterface $feautreInterface)
    {
        $this->featureRepository = $feautreInterface;
    }

    public function index(): View
    {
        $pageTitle = 'Features';

        return view('admin.features.index', compact('pageTitle'));
    }

    public function dataTable(): JsonResponse
    {
        return $this->featureRepository->getDataTable();
    }

    public function create(): View
    {
        $pageTitle = 'Add user';

        return view('admin.features.form', compact('pageTitle'));
    }

    public function store(FeatureRequest $request)
    {
        $this->featureRepository->saveFeature($request);

        return redirect()->route('features.index')->with([
            'message' => 'Feature Created Successfully',
            'alert-type' => 'success',
        ]);
    }
}
