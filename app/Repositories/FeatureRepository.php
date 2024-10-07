<?php

namespace App\Repositories;

use App\Interfaces\FeautreInterface;
use Yajra\Datatables\Datatables;

class FeatureRepository implements FeautreInterface
{
    private $feature;

    private $datatables;

    public function __construct()
    {
        //
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
}
