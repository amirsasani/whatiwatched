<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function redirect($driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    public function callback($driver)
    {
        try {
            $user = Socialite::driver($driver)->user();
        } catch (Exception $e) {
            return redirect()->route('login');
        }

        $newUser = $this->loginOrCreateUser($user->getEmail(), $driver, $user->getId(), $user->getName(), Hash::make(Str::random()), now());

        auth()->login($newUser, true);

        return redirect()->route('index');
    }

    public function login(Request $request, $driver)
    {
        $token = $request->credential;
        $decoded_token = $this->decodeJWT($token);

        $newUser = $this->loginOrCreateUser($decoded_token['email'], $driver, $decoded_token['sub'], $decoded_token['name'], Hash::make(Str::random()), now());

        auth()->login($newUser, true);

        auth()->attempt();

        return redirect()->route('index');
    }

    private function loginOrCreateUser($email, $driver, $provider_id, $name, $password, $email_verified_at)
    {
        $existingUser = User::where('email', $email)->first();

        if ($existingUser) {
            $existingUser->provider_name = $driver;
            $existingUser->provider_id = $provider_id;
            $existingUser->name = $name;
            $existingUser->save();

            return $existingUser;
        } else {
            $newUser = new User();
            $newUser->provider_name = $driver;
            $newUser->provider_id = $provider_id;
            $newUser->name = $name;
            $newUser->email = $email;
            $newUser->password = $password ;
            // we set email_verified_at because the user's email is already verified by social login portal
            $newUser->email_verified_at = $email_verified_at;
            $newUser->save();

            return $newUser;
        }
    }

    private function decodeJWT($token)
    {
        return json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $token)[1]))), true);
    }
}
