<?php

use App\Models\User;
use App\Models\Patient;
use App\Models\Activity;
use App\Models\PatientActivity;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

function rootUser()
{
    Role::create(['name' => 'root']);
    $user = User::factory()->rootUser()->create()->assignRole('root');
    return $user;
}

test('El EndPoint patient-activities/{codigo} retorna un json válido', function () {
    $user = rootUser();
    $patient = Patient::factory()->create();
    $activity = Activity::factory()->create();
    PatientActivity::factory()->create([
        'user_id' => $user->id,
        'patient_id' => $patient->id,
        'activity_id' => $activity->id,
    ]);
    $response = $this->get("/api/patient-activities/$patient->codigo");
    $response->assertStatus(200);
    $response->assertJsonStructure([
        'patient' => [
            'nombres',
            'apellidos',
            'nacimiento',
            'sexo',
            'telefono',
        ],
        'activities' => [
            '*' => [
                'activity_id',
                'activity_name',
                'activity_description',
                'activity_thumbnail',
                'description',
                'reasons',
                'goals',
                'indicators',
            ],
        ],
    ]);
});
