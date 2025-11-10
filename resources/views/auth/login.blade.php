@extends('layouts.app')

@section('title', 'Iniciar sesión')
@section('subtitle', 'Accede a tu cuenta para continuar.')

@section('content')

<section class="container mx-auto px-4 min-h-screen">
    <div class="w-full md:w-2/3 lg:w-1/2 xl:w-2/5 mx-auto">
        <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-3">
            @csrf
            <div class="space-y-2">
                <label for="email" class="text-sm font-medium text-gray-700">Correo electrónico</label>
                <input
                id="email" name="email" type="email" value="{{ old('email') }}" required
                class="block w-full h-11 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm
                        placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent
                        @error('email') ring-2 ring-red-400 focus:ring-red-400 @enderror"
                placeholder="tucorreo@ejemplo.com">
                @error('email')
                <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="password" class="text-sm font-medium text-gray-700">Contraseña</label>
                <input
                id="password" name="password" type="password" required
                class="block w-full h-11 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm
                        placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent
                        @error('password') ring-2 ring-red-400 focus:ring-red-400 @enderror"
                placeholder="••••••••">
                @error('password')
                <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <label class="inline-flex items-center gap-2 text-sm text-gray-600">
                <input type="checkbox" name="remember" class="rounded border-gray-300 text-primary focus:ring-primary">
                Recordarme
                </label>
                {{-- Si luego implementas reset password, cambia # por route("password.request") --}}
                <a href="#" class="text-sm font-medium text-primary hover:underline">¿Olvidaste tu contraseña?</a>
            </div>

            <button
                type="submit"
                class="inline-flex w-full items-center justify-center gap-2 h-11 rounded-lg bg-primary text-white text-sm font-semibold
                    transition hover:brightness-95 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                {{-- Icono enviar --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M14.752 11.168l-9.193 3.837a.75.75 0 00-.06 1.37l9.193 3.837a.75.75 0 001.025-.69v-3.126l3.75 1.566a.75.75 0 001.03-.69V9.427a.75.75 0 00-1.03-.69l-3.75 1.566V7.177a.75.75 0 00-1.025-.69z" />
                </svg>
                Ingresar
            </button>

            <p class="text-center text-sm text-gray-600">
                ¿No tienes cuenta?
                <a href="{{ route('register.form') }}" class="font-semibold text-primary hover:underline">Crea una</a>.
            </p>
        </form>
    </div>
</section>
@endsection
