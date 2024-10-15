<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestimonialRequest;
use App\Interfaces\TestimonialInterface;
use App\Interfaces\UserInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class TestimonialController extends Controller
{
    private $testimonialRepository;

    private $userRepository;

    public function __construct(TestimonialInterface $feautreInterface, UserInterface $userInterface)
    {
        $this->testimonialRepository = $feautreInterface;
        $this->userRepository = $userInterface;
    }

    public function index(): View
    {
        $pageTitle = 'Testimonials';

        return view('admin.testimonials.index', compact('pageTitle'));
    }

    public function dataTable(): JsonResponse
    {
        return $this->testimonialRepository->getDataTable();
    }

    public function create(): View
    {
        $pageTitle = 'Add Testimonial';

        $users = $this->userRepository->getUsers();        

        return view('admin.testimonials.form', compact('pageTitle', 'users'));
    }

    public function store(TestimonialRequest $request)
    {
        $this->testimonialRepository->saveTestimonial($request);

        return redirect()->route('testimonials.index')->with([
            'message' => 'Testimonial Created Successfully',
            'alert-type' => 'success',
        ]);
    }

    public function edit($id): View
    {
        $testimonial = $this->testimonialRepository->getTestimonial($id);

        $pageTitle = 'Edit Testimonial';

        $users = $this->userRepository->getUsers(); 

        return view('admin.testimonials.form', compact('pageTitle', 'testimonial', 'users'));
    }

    public function update(TestimonialRequest $request, $id)
    {
        $this->testimonialRepository->updateTestimonial($request, $id);

        return redirect()->route('testimonials.index')->with([
            'message' => 'Testimonial Updated Successfully',
            'alert-type' => 'success',
        ]);
    }

    public function destroy($id)
    {
        try {
            // Call repository method to delete the testimonial
            $this->testimonialRepository->deleteTestimonial($id);

            return response()->json([
                'message' => 'Testimonial deleted successfully',
                'status' => 'success',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting testimonial',
                'status' => 'error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    
}
