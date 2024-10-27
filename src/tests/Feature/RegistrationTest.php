<?php

use Laravel\Fortify\Features;
use Laravel\Jetstream\Jetstream;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
})->skip(function () {
    return !Features::enabled(Features::registration());
}, 'Registration support is not enabled.');

test('registration screen cannot be rendered if support is disabled', function () {
    $response = $this->get('/register');

    $response->assertStatus(404);
})->skip(function () {
    return Features::enabled(Features::registration());
}, 'Registration support is enabled.');

test('new users can register', function () {
    $PANEL_PERMISSION = 'see-panel';
    Permission::create(['name' => $PANEL_PERMISSION]);
    $registered_role = Role::create(['name' => 'registered']);
    $registered_role->givePermissionTo($PANEL_PERMISSION);
    $new_user_password = "12345678";

    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => $new_user_password,
        'password_confirmation' => $new_user_password,
        'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature(),
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
})->skip(function () {
    return !Features::enabled(Features::registration());
}, 'Registration support is not enabled.');
