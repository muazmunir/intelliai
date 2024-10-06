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
            ->addColumn('action', function ($user) {
                $action = '<ul class="action">';
                $action .= '<li class="edit"><a href="'.route('services.edit', $user->id).'"><i class="icon-pencil-alt"></i></a></li>';
                $action .= '<li class="delete"><a href="#"><i class="icon-trash"></i></a></li>';
                $action .= '</ul>';

                return $action;
            })
            ->editColumn('id', function () {
                static $i = 0;
                $i++;

                return $i;
            })
            ->rawColumns(['category_name', 'action'])
            ->toJson();
    }

    public function saveService($request)
    {
        $input = $request->all();
        // $this->processIcon($request, $input);
        $this->service->create($input);
    }

    public function getService($id)
    {
        return $this->service->find($id);
    }

    public function updateService($request, int $id)
    {
        $service = $this->service->find($id);
        $input = $request->all();
        $this->processIcon($request, $input, $id);
        $service->update($input);
    }

    public function deleteService(int $id)
    {
        $this->deleteIcon($id);
        $this->service->find($id)->delete();

        return jsonResponse(['message' => 'Service deleted successfully']);
    }

    private function processIcon($request, array &$input, $id = null)
    {
        if ($request->hasFile('icon')) {
            $this->deleteIcon($id);
            $input['icon'] = uploadImage($request->file('icon'), '400', '600', 'services');
        }
    }

    private function deleteIcon($id)
    {
        $service = $this->service->find($id);
        if ($service && $service->icon) {
            deleteFile($service->icon, 'services');
        }
    }
}
