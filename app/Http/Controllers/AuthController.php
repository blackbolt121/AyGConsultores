<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        // Si ya estás autenticado, no muestres login/register; protege dashboard/logout
        $this->middleware('guest')->only(['showLoginForm', 'showRegisterForm', 'login', 'register']);
        $this->middleware('auth')->only(['logout', 'showDashboard']);
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showDashboard(Request $request)
    {
        $user = $request->user();   // usuario autenticado
        $email = $user->email;      // usamos su correo

        $contacts = Contact::where('email', $email)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('dashboard', [
            'contacts' => $contacts,
            'user'     => $user,
        ]);
            
    }

    public function show(Contact $contact)
    {
        return view('contact.read', [
            'contact' => $contact,
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Auto login tras registrar (opcional, pero práctico)
        Auth::guard('web')->login($user);
        $request->session()->regenerate();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Usuario registrado y autenticado'], 201);
        }

        return redirect()->intended(route('dashboard.index'))
            ->with('status', '¡Bienvenido, ' . $user->name . '!');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::guard('web')->attempt($credentials, $remember)) {
            $request->session()->regenerate();

            if ($request->wantsJson()) {
                return response()->json(['message' => 'Login exitoso']);
            }

            // Redirige a donde el usuario intentaba ir (o al dashboard/home)
            return redirect()->intended(route('dashboard.index'));
        }

        if ($request->wantsJson()) {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }

        return back()
            ->withErrors(['email' => 'Credenciales inválidas'])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Sesión cerrada']);
        }

        return redirect()->route('home');
    }
}
