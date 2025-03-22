<?php

namespace App\Http\Controllers\Srf;

use App\Http\Controllers\Controller;
use App\Models\MedicalForm;
use Inertia\Inertia;
use Inertia\Response;

class MedicalFormsController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Dashboard', [
            'medicalForms' => (new MedicalForm)->medicalForms(),
        ]);
    }
}
