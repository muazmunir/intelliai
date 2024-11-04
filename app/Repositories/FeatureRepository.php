<?php

namespace App\Repositories;

use App\Interfaces\FeautreInterface;
use App\Models\Feature;
use Yajra\Datatables\Datatables;

class FeatureRepository implements FeautreInterface
{
    private $feature;

    private $datatables;

    public function __construct()
    {
        $this->feature = new Feature();
        $this->datatables = new Datatables;
    }

    public function getDataTable()
    {
        $services = $this->feature->query();

        return $this->datatables->of($services)
            ->addColumn('action', function ($feature) {
                $action = '<ul class="action">';
                $action .= '<li class="edit"><a href="'.route('features.edit', $feature->id).'"><i class="icon-pencil-alt"></i></a></li>';
                $action .= '<li class="delete"><a href="javascript:void(0);" data-id="'.$feature->id.'" id="deleteFeature"><i class="icon-trash"></i></a></li>';
                $action .= '</ul>';

                return $action;
            })
            ->editColumn('id', function () {
                static $i = 0;
                $i++;

                return $i;
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function saveFeature($request)
    {
        $input = $request->all();
        $this->processImage($request, $input);
        $this->feature->create($input);
    }

    public function getFeature($id)
    {
        return $this->feature->find($id);
    }

    public function updateFeature($request, $id)
    {
        $feature = $this->feature->find($id);
        $input = $request->all();
        $this->processImage($request, $input, $id);
        dd($input);
        $feature->update($input);
    }

    private function processImage($request, array &$input, $id = null)
    {
        if ($request->hasFile('image')) {
            $this->deleteImage($id);
            $input['image'] = uploadImage($request->file('image'), '400', '600', 'features');
        }
    }

    private function deleteImage($id)
    {
        $feature = $this->feature->find($id);
        if ($feature && $feature->image) {
            deleteFile($feature->image, 'features');
        }
    }

    public function deleteFeature($id)
    {
        $feature = $this->feature->find($id);
        $feature->delete();
    }
}
