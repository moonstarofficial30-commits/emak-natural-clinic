<?php

namespace App\Http\Controllers;

use App\Models\Career;

class CareerController extends Controller
{
    public function index()
    {
        $careers = Career::open()->latest()->get();

        return view('careers', compact('careers'));
    }
}
