<?php

namespace App\Http\Controllers;

use App\Interfaces\ServiceInterface;
use Illuminate\Contracts\View\View;
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
        return view('admin.services.index');
    }

}
