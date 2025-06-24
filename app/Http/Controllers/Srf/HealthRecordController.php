<?php

namespace App\Http\Controllers\Srf;

use App\Http\Controllers\Controller;
use App\Http\Requests\Srf\HealthRecordRequest;
use App\Models\PrimaryMedicalForm;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class HealthRecordController extends Controller
{
    protected PrimaryMedicalForm $primaryMedicalFormInstance;
    public function __construct(PrimaryMedicalForm $primaryMedicalFormInstance) {
        $this->primaryMedicalFormInstance = $primaryMedicalFormInstance;
    }

    /**
     * @param HealthRecordRequest $healthRecord
     * @return RedirectResponse
     */
    public function store(HealthRecordRequest $healthRecord): RedirectResponse
    {
        $primaryMedicalForm = $this->primaryMedicalFormInstance->create($healthRecord->toArray());
        return $primaryMedicalForm
            ? to_route('forms.index')->with('success', 'Ficha cadastrada com sucesso.')
            : to_route('forms.index')->with('error', 'Dados da ficha não puderam ser salvos.');
    }
}
