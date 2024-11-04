<?php

namespace App\Http\Controllers;

use App\Models\Feature;

class HomeController extends Controller
{
    public function index()
    {
        $features = Feature::all();

        return view('frontend.index', compact('features'));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function services()
    {
        return view('frontend.services');
    }

    public function contact()
    {
        return view('frontend.contact');
    }
}
