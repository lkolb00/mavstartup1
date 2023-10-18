<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

/**
 * Along with form based authentication, Laravel also provides a simple, convenient way to authenticate with OAuth providers using Laravel Socialite.
 * Socialite currently supports authentication via Facebook, Twitter, LinkedIn, Google, GitHub, GitLab, Bitbucket, and Slack.
 * The $provider parameter can be one of [gitHub, google, facebook, twitter, linkedIn, gitLab, bitbucket, and slack]
 * We have currently tested support for [gitHub, google]
 */
class AuthSocialController extends Controller
{
    /**
     * @param $provider
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Illuminate\Http\RedirectResponse
     */
    public function handleRedirect($provider): \Symfony\Component\HttpFoundation\RedirectResponse|\Illuminate\Http\RedirectResponse
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * OAuth 1.0 providers return token, tokenSecret
     * OAuth 2.0 providers return token, refreshToken, expiresIn
     * OAuth 1.0 and 2.0 providers always return id, name, email, nickname, avatar
     * @param $provider
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handleCallback($provider): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $socialUser = Socialite::driver($provider)->user();

            $user = User::updateOrCreate([
                'provider_id' => $socialUser->id,
            ], [
                'name' => $socialUser->name,
                'email' => $socialUser->email,
                'password' => Hash::make(Str::random(40)),
                'provider' => $provider,
                'provider_token' => $socialUser->token,
                'provider_token_secret' => $socialUser->tokenSecret,
                'provider_refresh_token' => $socialUser->refreshToken,
                'provider_expires_in' => $socialUser->expiresIn,
                'profile_photo_path' => $socialUser->avatar,
            ]);

            Auth::login($user, true);

            return redirect('/dashboard');
        } catch (\Exception $e) {
            return redirect('/login');
        }
    }
}
