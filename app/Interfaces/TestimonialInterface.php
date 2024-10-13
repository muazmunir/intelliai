<?php

namespace App\Interfaces;

interface TestimonialInterface
{
    public function getDataTable();

    public function saveTestimonial($request);

    public function getTestimonial($id);

    public function updateTestimonial($request, $id);
}
