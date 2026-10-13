<?php

namespace App\Http\Controllers;

use App\Models\Doctor;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::active()->with('department')->get();

        return view('doctors.index', compact('doctors'));
    }

    public function show(Doctor $doctor)
    {
        $doctor->load('department');

        return view('doctors.show', compact('doctor'));
    }
}
