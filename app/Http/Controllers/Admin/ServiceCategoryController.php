<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceCategoryRequest;
use App\Interfaces\ServiceCategoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class ServiceCategoryController extends Controller
{
    private $serviceCategoryRepository;

    public function __construct(ServiceCategoryInterface $serviceCategoryInterface)
    {
        $this->serviceCategoryRepository = $serviceCategoryInterface;
    }

    public function index(): View
    {
        return view('admin.services.category.index');
    }

    public function dataTable(): JsonResponse
    {
        return $this->serviceCategoryRepository->getDataTable();
    }

    public function store(ServiceCategoryRequest $request): RedirectResponse
    {
        $this->serviceCategoryRepository->saveServiceCategory($request);

        return redirect()->back()->with([
            'message' => 'Service Category Created Successfully',
            'alert-type' => 'success',
        ]);
    }

    public function edit($id): JsonResponse
    {
        $serviceCategory = $this->serviceCategoryRepository->getServiceCategoryById($id);

        return jsonResponse(['category' => $serviceCategory]);
    }

    public function update(ServiceCategoryRequest $request, $id): JsonResponse
    {
        return $this->serviceCategoryRepository->updateServiceCategory($request, $id);
    }

    public function destroy($id): JsonResponse
    {
        try {
            $this->serviceCategoryRepository->deleteServiceCategory($id);

            return response()->json([
                'message' => 'Service Category deleted successfully',
                'status' => 'success',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting Service Category',
                'status' => 'error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
