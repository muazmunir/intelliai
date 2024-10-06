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
        $this->serviceCategory = new ServiceCategory();
        $this->datatables = new Datatables;
    }

    public function getDataTable()
    {
        $categories = $this->serviceCategory->select('id', 'name')->get();

        return $this->datatables->of($categories)
            ->addColumn('action', function ($category) {
                $action = '<div>';
                $action .= '<a class="btn btn-primary edit-category-button" data-category-id="'.$category->id.'"><i class="fas fa-edit"></i></a> ';
                $action .= '<button class="btn btn-danger" onclick="confirmDelete('.$category->id.')"><i class="fas fa-trash"></i></button>';
                $action .= '</div>';

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
