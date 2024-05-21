<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/welcome'; 

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function redirectTo()
    {
        return $this->redirectTo;
    }
    public function login(Request $request)
{
    $this->validate($request, [
        'email' => 'required|string',
        'password' => 'required|string',
    ]);

    $credentials = $request->only('email', 'password');
    $user = User::where('email', $request->email)->first();

    if ($user) {
        if (!is_null($user->password) && Auth::attempt($credentials)) {
            return redirect()->intended($this->redirectTo());
        } else {
           
            return redirect()->back()->withErrors(['password' => 'Invalid credentials. Please sign in using the appropriate provider or reset your password.']);
        }
    }

    return $this->sendFailedLoginResponse($request);
}

    
    
    public function logout(Request $request)
    {
        Auth::logout(); 

        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 
        return redirect('/welcome'); }

    public function showLoginForm()
    {
        $user = auth()->user();

        if ($user) {
            return view('already_authenticated', ['user' => $user]); 
        }

        return view('auth.login'); 
    }
}
