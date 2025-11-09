<?php

namespace App\Http\Controllers\Srf;

use App\Http\Controllers\Controller;
use App\Http\Requests\Srf\HealthRecordRequest;
use App\Models\BasicMedicalForm;
use App\Models\PrimaryMedicalForm;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class HealthRecordController extends Controller
{
    protected PrimaryMedicalForm $primaryMedicalFormInstance;
    protected BasicMedicalForm $basicMedicalFormInstance;
    public function __construct(PrimaryMedicalForm $primaryMedicalFormInstance, BasicMedicalForm $basicMedicalFormInstance) {
        $this->primaryMedicalFormInstance = $primaryMedicalFormInstance;
        $this->basicMedicalFormInstance = $basicMedicalFormInstance;
    }

    public function index($id): Response
    {
        $primaryMedicalForms = [];
        $secondaryMedicalForms = [];
        $healthRecords = $this->basicMedicalFormInstance->basicMedicalFormById($id);
        if(isset($healthRecords->items()[0]->primaryMedicalForms)) {
            $primaryMedicalForms = $healthRecords->items()[0]->primaryMedicalForms;
        }
        if(isset($healthRecords->items()[0]->secondaryMedicalForms)) {
            $secondaryMedicalForms = $healthRecords->items()[0]->secondaryMedicalForms;
        }

        return Inertia::render('healthRecord.HeHealthRecords', [
            'primaryMedicalForms' => $primaryMedicalForms,
            'secondaryMedicalForms' => $secondaryMedicalForms,
        ]);
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
