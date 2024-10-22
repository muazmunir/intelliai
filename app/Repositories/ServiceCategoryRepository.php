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
        // Fetch the categories with necessary fields
        $categories = $this->serviceCategory->select('id', 'name')->get();

        return $this->datatables->of($categories)
            ->addColumn('action', function ($category) {
                // Create the action buttons (Edit and Delete) for each category
                $action = '<ul class="action">';
                // $action .= '<li class="edit"><a href="' . route('service-categories.edit', $category->id) . '"><i class="icon-pencil-alt"></i></a></li>';
                $action .= '<li class="delete"><a href="javascript:void(0);" data-id="' . $category->id . '" id="deleteCategory"><i class="icon-trash"></i></a></li>';
                $action .= '</ul>';

                return $action;
            })
            ->editColumn('id', function ($category) {
                // Increment and display the ID as a sequential number
                static $i = 0;
                $i++;

                return $i;
            })
            ->rawColumns(['action']) // Specify the raw columns
            ->toJson(); // Return as JSON for DataTables
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
        $serviceCategory->delete();
    }    
}
