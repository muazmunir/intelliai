<?php

namespace App\Repositories;

use App\Interfaces\ServiceCategoryInterface;
use App\Models\ServiceCategory;
use Yajra\Datatables\Datatables;

class ServiceCategoryRepository implements ServiceCategoryInterface
{
    private $serviceCategory;

    private $datatables;

    public function __construct()
    {
        $this->serviceCategory = new ServiceCategory;
        $this->datatables = new Datatables;
    }

    public function getDataTable()
    {
        $categories = $this->serviceCategory->select('id', 'name')->get();

        return $this->datatables->of($categories)
            ->addColumn('action', function ($user) {
                $action = '<ul class="action">';
                $action .= '<li class="edit"><a href="#"><i class="icon-pencil-alt"></i></a></li>';
                $action .= '<li class="delete"><a href="#"><i class="icon-trash"></i></a></li>';
                $action .= '</ul>';

                return $action;
            })
            ->editColumn('id', function () {
                static $i = 0;
                $i++;

                return $i;
            })
            ->rawColumns(['checkbox', 'action'])
            ->toJson();
    }

    public function saveServiceCategory($request)
    {
        $this->serviceCategory->create($request->all());
    }

    public function getServiceCategoryById(int $id)
    {
        return $this->serviceCategory->findOrFail($id);
    }

    public function updateServiceCategory($request, int $id)
    {
        $this->serviceCategory->find($id)->update($request->all());

        return jsonResponse(['message' => 'service Category Updated Successfully']);
    }

    public function deleteServiceCategory(int $id)
    {
        $serviceCategory = $this->serviceCategory->find($id);
        if ($serviceCategory->services()->count() > 0) {
            return jsonResponse(['title' => 'Error', 'message' => 'Cannot delete the category because it has associated experiences'], 403);
        }
        $serviceCategory->delete();

        return jsonResponse(['message' => 'service Category Deleted Successfully']);
    }
}
