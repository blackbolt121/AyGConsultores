<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AccountTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_update_name_without_password(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('password'),
        ]);

        $this->actingAs($user)
            ->put(route('account.profile.update'), [
                'name' => 'Nuevo Nombre',
                'email' => $user->email,
            ])
            ->assertRedirect(route('account.edit'));

        $user->refresh();
        $this->assertSame('Nuevo Nombre', $user->name);
    }

    public function test_user_email_change_requires_current_password(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('password'),
        ]);

        $this->actingAs($user)
            ->put(route('account.profile.update'), [
                'name' => $user->name,
                'email' => 'new-email@example.com',
            ])
            ->assertSessionHasErrors(['current_password']);

        $this->actingAs($user)
            ->put(route('account.profile.update'), [
                'name' => $user->name,
                'email' => 'new-email@example.com',
                'current_password' => 'password',
            ])
            ->assertRedirect(route('account.edit'));

        $this->assertSame('new-email@example.com', $user->refresh()->email);
    }

    public function test_user_can_update_password_and_clears_force_flag(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('temp-pass'),
            'must_change_password' => true,
        ]);

        $this->actingAs($user)
            ->put(route('account.password.update'), [
                'password' => 'new-password-123',
                'password_confirmation' => 'new-password-123',
            ])
            ->assertRedirect();

        $user->refresh();
        $this->assertFalse($user->must_change_password);
        $this->assertTrue(Hash::check('new-password-123', $user->password));
    }

    public function test_user_password_change_requires_current_password_when_not_forced(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('password'),
            'must_change_password' => false,
        ]);

        $this->actingAs($user)
            ->put(route('account.password.update'), [
                'password' => 'new-password-123',
                'password_confirmation' => 'new-password-123',
            ])
            ->assertSessionHasErrors(['current_password']);
    }

    public function test_user_is_blocked_from_dashboard_until_password_change(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('temp-pass'),
            'must_change_password' => true,
        ]);

        $this->actingAs($user)
            ->get(route('dashboard.index'))
            ->assertStatus(200);
    }
}
