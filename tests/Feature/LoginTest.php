<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function after_login_user_can_not_access_home_page_until_verified()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->get('/dashboard')->assertRedirect('/');
    }
    /** @test */
    public function after_login_user_can_access_home_page_if_verified()
    {
        $user = User::factory()->create(['isVerified' => 1]);
        $this->actingAs($user);
        $this->get('/dashboard')->assertStatus(200);
    }
}
