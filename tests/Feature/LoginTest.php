<?php

use App\Livewire\User\Login;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('user can login with mobile and password', function () {

    $user = User::factory()->create([
        'phone' => '7763972896',
        'password' => Hash::make('password'),
        'role' => 'user',
    ]);

    Livewire::test(Login::class)
        ->set('mobile', '7763972896')
        ->set('password', 'password')
        ->call('login')
        ->assertRedirect('/');

    $this->assertAuthenticatedAs($user);
});
