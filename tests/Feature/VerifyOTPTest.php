<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class VerifyOTPTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function a_user_can_submit_OYP_get_verified()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);
        $otp = auth()->user()->OTP();
        $this->post('/verifiedOTP', ['OTP' => $otp])->assertStatus(201);
        $this->assertDatabaseHas('users', ['isVerified' => 1]);

    }

    /** @test */
    public function user_can_see_otp_page_for_verify()
    {
        $this->logInUser();
        $this->get('/verifyOTP')->assertStatus(200);

    }
}
