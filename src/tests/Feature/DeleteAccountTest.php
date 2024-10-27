<?php

use App\Models\User;
use Livewire\Livewire;
use Laravel\Jetstream\Features;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Laravel\Jetstream\Http\Livewire\DeleteUserForm;

test('user accounts can be deleted', function () {
    Role::create(['name' => 'root']);
    $this->actingAs($user = User::factory()->rootUser()->create()->assignRole('root'));
    $env_root_password = env('ADMIN_PASSWORD');

    $component = Livewire::test(DeleteUserForm::class)
        ->set('password', $env_root_password)
        ->call('deleteUser');

    expect($user->fresh())->toBeNull();
})->skip(function () {
    return !Features::hasAccountDeletionFeatures();
}, 'Account deletion is not enabled.');

test('correct password must be provided before account can be deleted', function () {
    $this->actingAs($user = User::factory()->create());

    Livewire::test(DeleteUserForm::class)
        ->set('password', 'wrong-password')
        ->call('deleteUser')
        ->assertHasErrors(['password']);

    expect($user->fresh())->not->toBeNull();
})->skip(function () {
    return !Features::hasAccountDeletionFeatures();
}, 'Account deletion is not enabled.');
