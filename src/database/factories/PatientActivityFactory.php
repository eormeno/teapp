<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Patient;
use App\Models\Activity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PatientActivity>
 */
class PatientActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::all();
        $patients = Patient::all();
        $activities = Activity::all();

        return [
            'user_id' => $users->random()->id,
            'patient_id' => $patients->random()->id,
            'activity_id' => $activities->random()->id,
            'active' => $this->faker->boolean,
            'date' => $this->faker->date,
            'repetitions' => $this->faker->numberBetween(1, 10),
            'reasons' => $this->faker->text,
            'goals' => $this->faker->text,
            'indicators' => $this->faker->text,
        ];
    }
}
