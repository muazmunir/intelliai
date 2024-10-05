<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\ServiceInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
}
