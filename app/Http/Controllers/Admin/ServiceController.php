<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\ServiceInterface;
use App\Models\ServiceCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

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
}
