<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAreaAccessTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        // Seed roles
        $this->artisan('db:seed', ['--class' => 'RoleSeeder']);
    }

    public function test_guest_cannot_access_admin_dashboard(): void
    {
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_non_admin_user_is_forbidden_from_admin_dashboard(): void
    {
        $user = User::factory()->create();
        $user->assignRole('user');

        $response = $this->actingAs($user)->get('/admin/dashboard');
        $response->assertForbidden();
    }

    public function test_admin_can_access_admin_dashboard(): void
    {
        $adminUser = User::factory()->create();
        $adminUser->assignRole('admin');

        $response = $this->actingAs($adminUser)->get('/admin/dashboard');
        $response->assertOk();
    }
}
