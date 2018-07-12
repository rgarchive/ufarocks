<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Hash;
use Socialite;

class SocialiteController extends Controller
{
    public function redirectToProvider($provider)
    {
		if ($provider == 'vkontakte') {
			return Socialite::with($provider)
				->setScopes(['email', 'groups', 'manage'])
				->redirect();
		} else {
			// return Socialite::driver($provider)->redirect();
			return Socialite::driver($provider)
				->setScopes(['email', 'user_managed_groups', 'user_posts', 'user_photos'])
				->redirect();
		}
    }

    public function handleProviderCallback($provider)
    {
		try	{
			if ($provider == 'vkontakte') {
				$providerUser = Socialite::with($provider)->user();
			} else {
				$providerUser = Socialite::driver($provider)->user();
			}

			$user = User::where(['vk_id' => $providerUser->getId()])->first();

			if ($user) {
				Auth::loginUsingId($user->id);
				return redirect('home');
			} else {
				$newUser = new User;
				$newUser->name = $providerUser->getName();
				$newUser->password = Hash::make('secret');
				$newUser->remember_token = str_random(64);
				$newUser->image = $providerUser->getAvatar();
				$newUser->vk_id = $providerUser->getId();
				$newUser->save();

				// Assign a user role to newly registered users
				$newUser->assignRole('user');

				Auth::loginUsingId($newUser->id);

				return redirect('home');
			}
		} catch (\Exception $e) {
			return redirect('auth/vkontakte/callback');
		}
    }
}
