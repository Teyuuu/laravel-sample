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
            // Ensure we have a fresh session state
            session()->regenerate();
            
            return Socialite::driver('google')->redirect();
        } catch (\Exception $e) {
            Log::error('Google redirect error', ['error' => $e->getMessage()]);
            return redirect('/login')->with('error', 'Unable to redirect to Google. Please try again.');
        }
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            // Check for OAuth errors first
            if ($request->has('error')) {
                Log::error('Google OAuth error', ['error' => $request->get('error')]);
                return redirect('/login')->with('error', 'Authentication was cancelled or failed.');
            }

            // Log the request for debugging
            Log::info('Google OAuth callback received', [
                'state' => $request->get('state'),
                'code' => $request->get('code'),
                'error' => $request->get('error'),
            ]);

            $googleUser = Socialite::driver('google')->user();

            // Validate user data
            if (!$googleUser->getEmail()) {
                Log::error('Google OAuth: No email provided');
                return redirect('/login')->with('error', 'Unable to retrieve email from Google account.');
            }

            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName() ?: 'Google User',
                    'password' => bcrypt(str()->random(16)),
                    'provider' => 'google',
                    'provider_id' => $googleUser->getId(),
                    'google_id' => $googleUser->getId(),
                ]
            );

            // Update existing user if they're logging in with Google
            if ($user->wasRecentlyCreated === false) {
                $user->update([
                    'provider' => 'google',
                    'provider_id' => $googleUser->getId(),
                    'google_id' => $googleUser->getId(),
                ]);
            }

            Auth::login($user, true); // Remember the user

            Log::info('Google OAuth login successful', ['user_id' => $user->id, 'email' => $user->email]);

            return redirect('/')->with('success', 'Successfully logged in with Google!');
        } catch (\Laravel\Socialite\Two\InvalidStateException $e) {
            // Log the error for debugging
            Log::error('InvalidStateException in Google OAuth', [
                'error' => $e->getMessage(),
                'request_data' => $request->all(),
            ]);
            
            // For InvalidStateException, try to redirect to Google again
            // This often happens on first attempt due to session state issues
            return redirect('/auth/google')->with('info', 'Please try logging in again.');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Exception in Google OAuth', [
                'error' => $e->getMessage(),
                'request_data' => $request->all(),
            ]);
            
            // Handle other exceptions
            return redirect('/login')->with('error', 'An error occurred during authentication. Please try again.');
        }
    }

    // FACEBOOK LOGIN
    public function redirectToFacebook()
    {
        try {
            // Ensure we have a fresh session state
            session()->regenerate();
            
            return Socialite::driver('facebook')->redirect();
        } catch (\Exception $e) {
            Log::error('Facebook redirect error', ['error' => $e->getMessage()]);
            return redirect('/login')->with('error', 'Unable to redirect to Facebook. Please try again.');
        }
    }

    public function handleFacebookCallback(Request $request)
    {
        try {
            // Check for OAuth errors first
            if ($request->has('error')) {
                Log::error('Facebook OAuth error', ['error' => $request->get('error')]);
                return redirect('/login')->with('error', 'Authentication was cancelled or failed.');
            }

            Log::info('Facebook OAuth callback received', [
                'state' => $request->get('state'),
                'code' => $request->get('code'),
                'error' => $request->get('error'),
            ]);

            $fbUser = Socialite::driver('facebook')->user();

            // Validate user data
            if (!$fbUser->getEmail()) {
                Log::error('Facebook OAuth: No email provided');
                return redirect('/login')->with('error', 'Unable to retrieve email from Facebook account.');
            }

            $user = User::firstOrCreate(
                ['email' => $fbUser->getEmail()],
                [
                    'name' => $fbUser->getName() ?: 'Facebook User',
                    'password' => bcrypt(str()->random(16)),
                    'provider' => 'facebook',
                    'provider_id' => $fbUser->getId(),
                    'facebook_id' => $fbUser->getId(),
                ]
            );

            // Update existing user if they're logging in with Facebook
            if ($user->wasRecentlyCreated === false) {
                $user->update([
                    'provider' => 'facebook',
                    'provider_id' => $fbUser->getId(),
                    'facebook_id' => $fbUser->getId(),
                ]);
            }

            Auth::login($user, true); // Remember the user

            Log::info('Facebook OAuth login successful', ['user_id' => $user->id, 'email' => $user->email]);

            return redirect('/')->with('success', 'Successfully logged in with Facebook!');
        } catch (\Laravel\Socialite\Two\InvalidStateException $e) {
            Log::error('InvalidStateException in Facebook OAuth', [
                'error' => $e->getMessage(),
                'request_data' => $request->all(),
            ]);
            
            // For InvalidStateException, try to redirect to Facebook again
            // This often happens on first attempt due to session state issues
            return redirect('/auth/facebook')->with('info', 'Please try logging in again.');
        } catch (\Exception $e) {
            Log::error('Exception in Facebook OAuth', [
                'error' => $e->getMessage(),
                'request_data' => $request->all(),
            ]);
            
            // Handle other exceptions
            return redirect('/login')->with('error', 'An error occurred during authentication. Please try again.');
        }
    }
}
