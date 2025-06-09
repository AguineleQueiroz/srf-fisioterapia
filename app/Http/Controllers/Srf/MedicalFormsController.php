<?php

namespace App\Http\Controllers\Srf;

use App\Http\Controllers\Controller;
use App\Http\Requests\Srf\BasicMedicalFormRequest;
use App\Http\Requests\Srf\HealthRecordRequest;
use App\Models\BasicMedicalForm;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Nette\NotImplementedException;

class MedicalFormsController extends Controller
{
    protected BasicMedicalForm $basicMedicalFormInstance;

    /**
     * @param BasicMedicalForm $basicMedicalFormInstance
     */
    public function __construct(BasicMedicalForm $basicMedicalFormInstance) {
        $this->basicMedicalFormInstance = $basicMedicalFormInstance;
    }

    /**
     * @return Response
     */
    public function index(): Response
    {
        $search = request()->input('search') ?? '';
        return Inertia::render('Dashboard', [
            'medicalForms' => $this->basicMedicalFormInstance->basicMedicalForms($search),
            'searchParam' => $search
        ]);
    }

    /**
     * @param BasicMedicalFormRequest $request
     * @return Response|RedirectResponse|array
     */
    public function store(BasicMedicalFormRequest $request): Response|RedirectResponse|array
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $basicMedicalForm = $this->basicMedicalFormInstance->create($data);
        return $basicMedicalForm
            ? to_route('dashboard')->with('success', 'Atendimento cadastrado.')
            : to_route('dashboard')->with('error', 'Dados do atendimento não puderam ser salvos.');
    }

    /**
     * @param BasicMedicalFormRequest $request
     * @return Response|RedirectResponse|array
     */
    public function update(BasicMedicalFormRequest $request): Response|RedirectResponse|array
    {
        $data = $request->validated();
        $basicMedicalForm = $this->basicMedicalFormInstance->edit($data);
        return $basicMedicalForm
            ? to_route('dashboard')->with('success', 'Atendimento atualizado com sucesso.')
            : to_route('dashboard')->with('error', 'Dados do atendimento não puderam ser salvos.');
    }

    /**
     * @param HealthRecordRequest $healthRecord
     * @return RedirectResponse
     */
    public function storeHealthRecord(HealthRecordRequest $healthRecord): RedirectResponse {
        throw new NotImplementedException();
    }

    /**
     * @param $userId
     * @return LengthAwarePaginator
     */
    public function myBasicMedicalForms($userId): LengthAwarePaginator
    {
        return $this->basicMedicalFormInstance->basicMedicalFormsByUserId($userId);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function allBasicMedicalForms(): LengthAwarePaginator
    {
        return $this->basicMedicalFormInstance->basicMedicalForms();
    }
}
