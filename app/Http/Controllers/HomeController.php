<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Service;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::active()->take(6)->get();
        $doctors = Doctor::active()->take(3)->get();

        return view('home', compact('services', 'doctors'));
    }
}
