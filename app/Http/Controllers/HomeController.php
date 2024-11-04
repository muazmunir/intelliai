<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\Service;

class HomeController extends Controller
{
    public function index()
    {
        $features = Feature::all();

        $services = Service::all();

        return view('frontend.index', compact('features', 'services'));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function services()
    {
        $services = Service::all();

        $featuredServices = Service::where('is_featured', true)->get();

        return view('frontend.services', compact('services', 'featuredServices'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }
}
