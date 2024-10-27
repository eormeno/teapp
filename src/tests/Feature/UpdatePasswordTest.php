<?php

use App\Models\User;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Laravel\Jetstream\Http\Livewire\UpdatePasswordForm;

test('password can be updated', function () {
    $PANEL_PERMISSION = 'see-panel';
    Permission::create(['name' => $PANEL_PERMISSION]);
    $registered_role = Role::create(['name' => 'registered']);
    $registered_role->givePermissionTo($PANEL_PERMISSION);
    $env_fake_users_password = env('FAKE_USERS_PASSWORD');

    $this->actingAs($user = User::factory()->create()->assignRole('registered'));

    Livewire::test(UpdatePasswordForm::class)
        ->set('state', [
            'current_password' => $env_fake_users_password,
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ])
        ->call('updatePassword');

    expect(Hash::check('new-password', $user->fresh()->password))->toBeTrue();
});

test('current password must be correct', function () {
    $PANEL_PERMISSION = 'see-panel';
    Permission::create(['name' => $PANEL_PERMISSION]);
    $registered_role = Role::create(['name' => 'registered']);
    $registered_role->givePermissionTo($PANEL_PERMISSION);
    $this->actingAs($user = User::factory()->create()->assignRole('registered'));
    $env_fake_users_password = env('FAKE_USERS_PASSWORD');

    Livewire::test(UpdatePasswordForm::class)
        ->set('state', [
            'current_password' => 'wrong-password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ])
        ->call('updatePassword')
        ->assertHasErrors(['current_password']);

    expect(Hash::check($env_fake_users_password, $user->fresh()->password))->toBeTrue();
});

test('new passwords must match', function () {
    $PANEL_PERMISSION = 'see-panel';
    Permission::create(['name' => $PANEL_PERMISSION]);
    $registered_role = Role::create(['name' => 'registered']);
    $registered_role->givePermissionTo($PANEL_PERMISSION);
    $this->actingAs($user = User::factory()->create()->assignRole('registered'));
    $env_fake_users_password = env('FAKE_USERS_PASSWORD');

    Livewire::test(UpdatePasswordForm::class)
        ->set('state', [
            'current_password' => $env_fake_users_password,
            'password' => 'new-password',
            'password_confirmation' => 'wrong-password',
        ])
        ->call('updatePassword')
        ->assertHasErrors(['password']);

    expect(Hash::check($env_fake_users_password, $user->fresh()->password))->toBeTrue();
});
