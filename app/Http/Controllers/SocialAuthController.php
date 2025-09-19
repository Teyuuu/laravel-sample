<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SocialAuthController extends Controller
{
    // GOOGLE LOGIN
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'password' => bcrypt(str()->random(16)),
                'provider' => 'google',
                'provider_id' => $googleUser->getId(),
                'google_id' => $googleUser->getId(),
            ]
        );

        Auth::login($user);

        return redirect('/'); // Redirect to landing page
    }

    // FACEBOOK LOGIN
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        $fbUser = Socialite::driver('facebook')->user();

        $user = User::firstOrCreate(
            ['email' => $fbUser->getEmail()],
            [
                'name' => $fbUser->getName(),
                'password' => bcrypt(str()->random(16)),
                'provider' => 'facebook',
                'provider_id' => $fbUser->getId(),
                'facebook_id' => $fbUser->getId(),
            ]
        );

        Auth::login($user);

        return redirect('/'); // Redirect to landing page
    }
}
