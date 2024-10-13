<?php

namespace App\Repositories;

use App\Interfaces\TestimonialInterface;
use App\Models\Testimonial;
use Yajra\Datatables\Datatables;

class TestimonialRepository implements TestimonialInterface
{
    private $testimonial;

    private $datatables;

    public function __construct()
    {
        $this->testimonial = new Testimonial();
        $this->datatables = new Datatables;
    }

    public function getDataTable()
    {
        $services = $this->testimonial->query();

        return $this->datatables->of($services)
            ->addColumn('action', function ($testimonial) {
                $action = '<ul class="action">';
                $action .= '<li class="edit"><a href="'.route('testimonials.edit', $testimonial->id).'"><i class="icon-pencil-alt"></i></a></li>';
                $action .= '<li class="delete"><a href="#"><i class="icon-trash"></i></a></li>';
                $action .= '</ul>';

                return $action;
            })
            ->editColumn('id', function () {
                static $i = 0;
                $i++;

                return $i;
            })
            ->addColumn('name', function ($testimonial) {
                return $testimonial->user->full_name;
            })
            ->rawColumns(['action', 'name'])
            ->toJson();
    }

    public function saveTestimonial($request)
    {
        $input = $request->all();
        $this->testimonial->create($input);
    }

    public function getTestimonial($id)
    {
        return $this->testimonial->find($id);
    }

    public function updateTestimonial($request, $id)
    {
        $testimonial = $this->testimonial->find($id);
        $input = $request->all();
        $testimonial->update($input);
    }
}
