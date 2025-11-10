@extends('layouts.app')

@section('title', 'Crear cuenta')
@section('subtitle', 'Regístrate para acceder al panel.')

@section('content')
<section class="container mx-auto px-4 min-h-screen">
    <div class="w-full md:w-2/3 lg:w-1/2 xl:w-2/5 mx-auto">
        <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-3">
            @csrf
            <div class="space-y-2">
                <label for="name" class="text-sm font-medium text-gray-700">Nombre completo</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required
                    class="block w-full h-11 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm
                placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent
                @error('name') ring-2 ring-red-400 focus:ring-red-400 @enderror"
                    placeholder="Jane Doe">
                @error('name')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="email" class="text-sm font-medium text-gray-700">Correo electrónico</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                    class="block w-full h-11 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm
                placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent
                @error('email') ring-2 ring-red-400 focus:ring-red-400 @enderror"
                    placeholder="tucorreo@ejemplo.com">
                @error('email')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="password" class="text-sm font-medium text-gray-700">Contraseña</label>
                    <input id="password" name="password" type="password" required
                        class="block w-full h-11 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm
                placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent
                @error('password') ring-2 ring-red-400 focus:ring-red-400 @enderror"
                        placeholder="••••••••">
                    @error('password')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="password_confirmation" class="text-sm font-medium text-gray-700">Confirmar contraseña</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                        class="block w-full h-11 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm
                placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                        placeholder="••••••••">
                </div>
            </div>

            <button type="submit"
                class="inline-flex w-full items-center justify-center gap-2 h-11 rounded-lg bg-primary text-white text-sm font-semibold
            transition hover:brightness-95 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                Crear cuenta
            </button>

            <p class="text-center text-sm text-gray-600">
                ¿Ya tienes cuenta?
                <a href="{{ route('login.form') }}" class="font-semibold text-primary hover:underline">Inicia sesión</a>.
            </p>
        </form>
    </div>
</section>
@endsection
