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
            ->rawColumns(['action'])
            ->toJson();
    }

    public function saveFeature($request)
    {
        $input = $request->all();

        $this->feature->create($input);
    }
}
