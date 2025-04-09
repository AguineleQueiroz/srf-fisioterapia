<?php

namespace App\Http\Controllers\Srf;

use App\Http\Controllers\Controller;
use App\Models\MedicalForm;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Nette\NotImplementedException;

class MedicalFormsController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Dashboard', [
            'medicalForms' => (new MedicalForm)->medicalForms(),
        ]);
    }

    public function store(Request $request): Response {
        throw new NotImplementedException();
    }
}
