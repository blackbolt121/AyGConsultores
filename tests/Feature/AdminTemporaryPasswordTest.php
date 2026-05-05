<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminTemporaryPasswordTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_generate_temporary_password_and_force_change(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMIN,
            'password' => Hash::make('password'),
        ]);

        $target = User::factory()->create([
            'role' => User::ROLE_STUDENT,
            'password' => Hash::make('old-pass'),
        ]);

        $response = $this->actingAs($admin)
            ->post(route('admin.users.temporary-password', $target));

        $response->assertRedirect(route('admin.users.edit', $target));
        $response->assertSessionHas('temporary_password');

        $target->refresh();
        $this->assertTrue($target->must_change_password);
        $this->assertNotNull($target->temporary_password_set_at);
        $this->assertSame($admin->id, $target->temporary_password_set_by);
    }
}
