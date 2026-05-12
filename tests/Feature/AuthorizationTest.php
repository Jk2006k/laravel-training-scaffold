<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_is_redirected_to_login_when_visiting_projects()
    {
        // TODO Day 12: $this->get('/projects')->assertRedirect('/login');
        $response = $this->get('/projects');
        $response->assertRedirect('/login');
    }

    /** @test */
    public function admin_can_access_admin_routes()
    {
        // TODO Day 12: actingAs($admin)->get('/admin/...')->assertOk();
        $admin = User::factory()->create(['role' => 'admin']);
        
        $response = $this->actingAs($admin)->get('/admin/users');
        $response->assertOk();
    }
}