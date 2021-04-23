<?php

namespace App\Models;

use App\Mail\OTPMail;
use App\Notifications\OTPNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'isVerified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function OTP()
    {
        return Cache::get('opt');
    }

    public function cacheTheOTP()
    {
        $otp = rand(1000, 9000);
        Cache::put(['OTP' => $otp], 15);
        return $otp;
    }

    public function sendOTP($via = 'email')
    {
        $OTP = $this->cacheTheOTP();
        if ($via === 'via_sms') {
            dd('send sms ');
            //.....
        } else {
            $email = $this->email;
            $this->notify((new OTPNotification($via, $OTP, $email))->delay(5));
        }

    }

}
