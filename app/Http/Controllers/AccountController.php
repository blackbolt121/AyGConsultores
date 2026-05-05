<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function edit(Request $request)
    {
        return view('account.edit', [
            'user' => $request->user(),
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'current_password' => ['nullable', 'string'],
        ]);

        $emailIsChanging = $validated['email'] !== $user->email;
        if ($emailIsChanging) {
            $request->validate([
                'current_password' => ['required', 'current_password'],
            ]);
        }

        $user->forceFill([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ])->save();

        return redirect()
            ->route('account.edit')
            ->with('status', 'Tu cuenta se actualizo correctamente.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = $request->user();
        $user->forceFill([
            'password' => Hash::make($request->string('password')),
            'must_change_password' => false,
            'temporary_password_set_at' => null,
            'temporary_password_set_by' => null,
        ])->save();

        return redirect()
            ->intended(route('dashboard.index'))
            ->with('status', 'Contrasena actualizada.');
    }
}
