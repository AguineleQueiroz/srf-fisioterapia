<?php

namespace App\Http\Controllers\Srf;

use App\Http\Controllers\Controller;
use App\Http\Requests\Srf\BasicMedicalFormRequest;
use App\Models\BasicMedicalForm;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
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

    public function store(BasicMedicalFormRequest $request): Response|RedirectResponse|array
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $basicMedicalForm = $this->basicMedicalFormInstance->create($data);
        return $basicMedicalForm
            ? to_route('home')->with('success', 'Atendimento cadastrado.')
            : to_route('medical-form')->with('error', 'Dados do atendimento não puderam ser salvos.');
    }

    public function myBasicMedicalForms($userId): LengthAwarePaginator
    {
        return $this->basicMedicalFormInstance->basicMedicalFormsByUserId($userId);
    }

    public function allBasicMedicalForms(): LengthAwarePaginator
    {
        return $this->basicMedicalFormInstance->basicMedicalForms();
    }
}
