@extends('layouts.app')

@section('title', 'Mi cuenta')

@section('content')
<div class="container mx-auto max-w-3xl px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Mi cuenta</h1>
        <p class="text-gray-600">Actualiza tus datos y la seguridad de tu cuenta.</p>
    </div>

    @if (session('status'))
        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-green-800">
            {{ session('status') }}
        </div>
    @endif

    @if ($user && $user->requiresPasswordChange())
        <div class="mb-6 rounded-lg border border-amber-200 bg-amber-50 p-4 text-amber-900">
            <p class="font-semibold">Debes actualizar tu contrasena para continuar.</p>
            <p class="text-sm opacity-90">Por seguridad, tu acceso estara limitado hasta que cambies tu contrasena.</p>
        </div>
    @endif

    <div class="space-y-8">
        <section class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Datos de la cuenta</h2>

            <form action="{{ route('account.profile.update') }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 transition">
                    @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo electronico</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 transition">
                    @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Contrasena (solo si cambias el correo)</label>
                    <input type="password" id="current_password" name="current_password" autocomplete="current-password"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 transition"
                        placeholder="Confirma con tu contrasena">
                    @error('current_password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 rounded-md bg-primary text-white font-medium hover:bg-primary/90 transition shadow-sm">
                        Guardar cambios
                    </button>
                </div>
            </form>
        </section>

        <section class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Seguridad</h2>

            <form action="{{ route('account.password.update') }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="current_password_pw" class="block text-sm font-medium text-gray-700 mb-1">Contrasena actual</label>
                    <input type="password" id="current_password_pw" name="current_password" autocomplete="current-password" required
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 transition"
                        placeholder="Tu contrasena actual">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Nueva contrasena</label>
                        <input type="password" id="password" name="password" autocomplete="new-password" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 transition"
                            placeholder="Minimo 8 caracteres">
                        @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmar nueva contrasena</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 transition">
                    </div>
                </div>

                @error('current_password')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror

                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 rounded-md bg-primary text-white font-medium hover:bg-primary/90 transition shadow-sm">
                        Actualizar contrasena
                    </button>
                </div>
            </form>
        </section>
    </div>
</div>
@endsection
