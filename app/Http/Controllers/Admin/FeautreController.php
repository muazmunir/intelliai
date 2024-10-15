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
        $pageTitle = 'Add Feature';

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

    public function edit($id): View
    {
        $feature = $this->featureRepository->getFeature($id);  // Retrieve the feature by ID
        $pageTitle = 'Edit Feature';

        return view('admin.features.form', compact('pageTitle', 'feature'));
    }

    public function update(FeatureRequest $request, $id)
    {
        $this->featureRepository->updateFeature($request, $id);

        return redirect()->route('features.index')->with([
            'message' => 'Feature Updated Successfully',
            'alert-type' => 'success',
        ]);
    }

    public function destroy($id)
    {
        try {
            // Call repository method to delete the feature
            $this->featureRepository->deleteFeature($id);

            return response()->json([
                'message' => 'Feature deleted successfully',
                'status' => 'success',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting feature',
                'status' => 'error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
