<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Interfaces\ServiceInterface;
use App\Models\ServiceCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class ServiceController extends Controller
{
    private $serviceRepository;

    public function __construct(ServiceInterface $serviceInterface)
    {
        $this->serviceRepository = $serviceInterface;
    }

    public function index(): View
    {
        $pageTitle = 'Services';

        return view('admin.services.index', compact('pageTitle'));
    }

    public function dataTable(): JsonResponse
    {
        return $this->serviceRepository->getDataTable();
    }

    public function create(): View
    {
        $pageTitle = 'Add user';

        $categories = ServiceCategory::all();

        return view('admin.services.form', compact('pageTitle', 'categories'));
    }

    public function store(ServiceRequest $request)
    {
        $this->serviceRepository->saveService($request);

        return redirect()->route('services.index')->with([
            'message' => 'Services Created Successfully',
            'alert-type' => 'success',
        ]);
    }

    public function edit($id): View
    {
        $pageTitle = 'Edit Servicer';

        $service = $this->serviceRepository->getService($id);

        $categories = ServiceCategory::all();

        return view('admin.services.form', compact('pageTitle', 'service', 'categories'));
    }

    public function update(ServiceRequest $request, $id): RedirectResponse
    {
        $this->serviceRepository->updateService($request, $id);

        return redirect()->route('services.index')->with([
            'message' => 'Service updated successfully',
            'alert-type' => 'success',
        ]);
    }

    public function destroy($id): JsonResponse
    {
        return $this->serviceRepository->deleteService($id);
    }
}
