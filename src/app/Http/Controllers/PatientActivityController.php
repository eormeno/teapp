<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\PatientActivity;
use App\Http\Requests\StorePatientActivityRequest;
use App\Http\Requests\UpdatePatientActivityRequest;

class PatientActivityController extends Controller
{
    public function index() {
        $patient_id = request()->get('patient_id');
        $patients = Patient::all();
        $patientActivities = PatientActivity::where('patient_id', $patient_id)->paginate(5);
        return view('patient-activities.index', compact('patientActivities', 'patients', 'patient_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatientActivityRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PatientActivity $patientActivity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PatientActivity $patientActivity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatientActivityRequest $request, PatientActivity $patientActivity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PatientActivity $patientActivity)
    {
        //
    }
}
