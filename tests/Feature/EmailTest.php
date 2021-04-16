<?php

namespace Tests\Feature;

use App\Mail\OPTMail;
use App\Mail\OTPMail;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class EmailTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function an_opt_email_is_send_when_user_is_logged_in()
    {

        Mail::fake();
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $res = $this->post('/login', ['email' => $user->email, 'password' => 'secret']);
        Mail::assertSent(OTPMail::class);

    }

    /** @test */
    public function an_opt_email_is_not_send_when_credentials_is_incorrect()
    {
        Mail::fake();
        $user = User::factory()->create();
        $res = $this->post('/login', ['email' => $user->email, 'password' => '233232']);
        Mail::assertNotSent(OTPMail::class);

    }


    /** @test */
    public function an_opt_email_is_not_send_when_credentials_is_correct_in_cache()
    {

        $user = User::factory()->create();
        $res = $this->post('/login', ['email' => $user->email, 'password' => 'secret']);
        $this->assertNotNull(Cache::get('OTP'));
    }

}
