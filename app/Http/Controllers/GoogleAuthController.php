<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use PhpParser\Node\Stmt\TryCatch;

class GoogleAuthController extends Controller
{
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }
    public function callbackGoogle(){
        try {
            $google_user = Socialite::driver('google')->user();
            $user = User::where('google_id', $google_user->getId())->first();
    
            if (!$user) {
                // Check if a user with the same email exists
                $existingUser = User::where('email', $google_user->getEmail())->first();
    
                if ($existingUser) {
                    // Handle the case where the user already exists with the same email
                    // You may want to log in the user here or redirect with an error message
                    Auth::login($existingUser);
                    return redirect()->intended('/');
                }
    
                // Create a new user
                $new_user = User::create([
                    'nom' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    'google_id' => $google_user->getId()
                ]);
    
                // Log in the new user
                Auth::login($new_user);
                return redirect()->intended('/');
            }
            else {
                // Log in the existing user
                Auth::login($user);
                return redirect()->intended('/');
            }
        } catch (\Throwable $th) {
           dd('Something went wrong: ' . $th->getMessage());
        }
    }
    
    
}
