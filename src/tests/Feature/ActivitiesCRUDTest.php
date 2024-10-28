<?php

namespace Tests\Feature;

use Tests\TestHelpers;
use App\Models\Activity;
use Illuminate\Http\UploadedFile;

test('root user can list activities', function () {
    $root_user = TestHelpers::rootUser();
    $this->actingAs($root_user);

    $activities = Activity::factory()->count(3)->create();

    $response = $this->get(route('activities.index'));

    $response->assertOk();
    // Check if the activities are displayed in the view
    foreach ($activities as $activity) {
        $response->assertSee($activity->name);
    }
});

test('root user can create an activity', function () {
    $root_user = TestHelpers::rootUser();
    $this->actingAs($root_user);
    $response = $this->get(route('activities.create'));
    $response->assertOk();
    $activityData = [
        'name' => 'New Activity Name',
        'description' => 'Activity Description',
        'image' => UploadedFile::fake()->image('activity.jpg'),
    ];
    $response = $this->post(route('activities.store'), $activityData);
    $this->assertDatabaseHas('activities', ['name' => $activityData['name']]);
});

test('root user can update an activity', function () {
    $root_user = TestHelpers::rootUser();
    $this->actingAs($root_user);

    $activity = Activity::factory()->create();
    $updatedData = [
        'name' => 'Updated Activity Name',
        'description' => 'Updated Activity Description',
    ];

    $response = $this->put(route('activities.update', $activity), $updatedData);

    $response->assertRedirect(route('activities.index'));
    $this->assertDatabaseHas('activities', $updatedData);
});

test('root user can delete an activity', function () {
    $root_user = TestHelpers::rootUser();
    $this->actingAs($root_user);

    $activity = Activity::factory()->create();

    $response = $this->delete(route('activities.destroy', $activity));

    $response->assertRedirect(route('activities.index'));
    $this->assertDatabaseMissing('activities', ['id' => $activity->id]);
});
