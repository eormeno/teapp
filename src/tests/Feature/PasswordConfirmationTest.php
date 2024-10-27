<?php

use App\Models\User;
use Laravel\Jetstream\Features;
use Spatie\Permission\Models\Role;

test('confirm password screen can be rendered', function () {
    $user = Features::hasTeamFeatures()
                    ? User::factory()->withPersonalTeam()->create()
                    : User::factory()->create();

    $response = $this->actingAs($user)->get('/user/confirm-password');
    $response->assertStatus(200);
});

test('password can be confirmed', function () {
    Role::create(['name' => 'root']);
    $user = User::factory()->rootUser()->create()->assignRole('root');
    $env_root_password = env('ADMIN_PASSWORD');

    $response = $this->actingAs($user)->post('/user/confirm-password', [
        'password' => $env_root_password,
    ]);

    $response->assertRedirect();
    $response->assertSessionHasNoErrors();
});

test('password is not confirmed with invalid password', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/user/confirm-password', [
        'password' => 'wrong-password',
    ]);

    $response->assertSessionHasErrors();
});
