<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SocialAuthController extends Controller
{
    // GOOGLE LOGIN
    public function redirectToGoogle()
    {
        try {
            // Clear any existing Google session
            session()->forget('_token');
            
            // Force account selection by adding logout parameter
            $redirectUrl = Socialite::driver('google')->redirect()->getTargetUrl();
            $redirectUrl .= '&logout=' . urlencode('http://127.0.0.1:8000/login');
            
            return redirect($redirectUrl);
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Unable to redirect to Google. Please try again.');
        }
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            // Log the request for debugging
            Log::info('Google OAuth callback received', [
                'state' => $request->get('state'),
                'code' => $request->get('code'),
                'error' => $request->get('error'),
            ]);

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
        } catch (\Laravel\Socialite\Two\InvalidStateException $e) {
            // Log the error for debugging
            Log::error('InvalidStateException in Google OAuth', [
                'error' => $e->getMessage(),
                'request_data' => $request->all(),
            ]);
            
            // Handle invalid state exception
            return redirect('/login')->with('error', 'Authentication failed. Please try again.');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Exception in Google OAuth', [
                'error' => $e->getMessage(),
                'request_data' => $request->all(),
            ]);
            
            // Handle other exceptions
            return redirect('/login')->with('error', 'An error occurred during authentication.');
        }
    }

    // FACEBOOK LOGIN
    public function redirectToFacebook()
    {
        try {
            return Socialite::driver('facebook')->redirect();
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Unable to redirect to Facebook. Please try again.');
        }
    }

    public function handleFacebookCallback(Request $request)
    {
        try {
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
        } catch (\Laravel\Socialite\Two\InvalidStateException $e) {
            // Handle invalid state exception
            return redirect('/login')->with('error', 'Authentication failed. Please try again.');
        } catch (\Exception $e) {
            // Handle other exceptions
            return redirect('/login')->with('error', 'An error occurred during authentication.');
        }
    }
}
