<?php

namespace App\Http\Controllers\Srf;

use App\Http\Controllers\Controller;
use App\Http\Requests\Srf\BasicMedicalFormRequest;
use App\Models\BasicMedicalForm;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class MedicalFormsController extends Controller
{
    protected BasicMedicalForm $basicMedicalFormInstance;

    public function __construct(BasicMedicalForm $basicMedicalFormInstance) {
        $this->basicMedicalFormInstance = $basicMedicalFormInstance;
    }
    public function index(): Response
    {
        $search = request()->input('search') ?? '';
        return Inertia::render('Dashboard', [
            'medicalForms' => $this->basicMedicalFormInstance->basicMedicalForms($search),
            'searchParam' => $search
        ]);
    }

    public function store(BasicMedicalFormRequest $request): Response|RedirectResponse
    {
        $basicMedicalForm = $this->basicMedicalFormInstance->create($request->validated());
        return $basicMedicalForm
            ? to_route('home')->with('success', 'Atendimento cadastrado.')
            : back()->with('erro', 'Dados do atendimento não puderam ser salvos.');
    }
}
