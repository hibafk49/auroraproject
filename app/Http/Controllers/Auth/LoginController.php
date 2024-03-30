<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();

        if ($user->role === 'admin') {
            return '/welcome';
        }

        return '/welcome'; // Vous pouvez changer cette redirection en fonction de vos besoins
    }

    protected function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended($this->redirectTo());
        }

        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Déconnexion de l'utilisateur

        $request->session()->invalidate(); // Invalidité de la session
        $request->session()->regenerateToken(); // Régénérer le jeton de session

        return redirect('/welcome'); // Redirection vers une page après la déconnexion
    }

    public function showLoginForm()
    {
        $user = auth()->user();

        if ($user) {
            return view('already_authenticated', ['user' => $user]);
        }

        return view('auth.login');
    }
}
