<?php

namespace App\Repositories;

use App\Interfaces\ServiceInterface;
use App\Models\Service;
use App\Models\ServiceCategory;
use Yajra\Datatables\Datatables;

class ServiceRepository implements ServiceInterface
{
    private $service;

    private $serviceCategory;

    private $datatables;

    public function __construct()
    {
        $this->service = new Service;
        $this->serviceCategory = new ServiceCategory;
        $this->datatables = new Datatables;
    }

    public function getDataTable()
    {
        $services = $this->service->with('category:id,name')->get();

        return $this->datatables->of($services)
            ->addColumn('category_name', function ($services) {
                return $services->category->name;
            })
            ->editColumn('id', function () {
                static $i = 0;
                $i++;

                return $i;
            })
            ->toJson();
    }
}
