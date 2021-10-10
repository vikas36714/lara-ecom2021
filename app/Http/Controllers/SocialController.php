<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Models\User;
use Validator;
use Exception;
use Auth;
use Illuminate\Support\Facades\Hash;

class SocialController extends Controller
{
	//The above method handles redirect from our site to the OAuth provider
	public function redirect($provider)
    {
     return Socialite::driver($provider)->redirect();
    }

    //The Callback method below will read the incoming request and retrieve the user’s information from the provider.

    public function Callback($provider)
	{
	    try {
            $user =   Socialite::driver($provider)->user();
            $isUser = User::where('provider_id', $user->id)->first();
     
            if($isUser){
                Auth::login($isUser);
                return redirect('/');
            }else{
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'provider_id' => $user->id,
                    'password' => Hash::make('123456')
                ]);
    
                Auth::login($createUser);
                return redirect('/');
            }
    
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
	}
}
