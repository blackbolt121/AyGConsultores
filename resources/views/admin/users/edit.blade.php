@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-2xl px-4 py-8">
    <div class="mb-8">
        <a href="{{ route('admin.users.index') }}" class="text-primary hover:underline flex items-center gap-2 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Volver a la lista
        </a>
        <h1 class="text-3xl font-bold text-gray-900">Editar Usuario</h1>
        <p class="text-gray-600">Modifica los datos de <strong>{{ $user->name }}</strong>.</p>
    </div>

    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre Completo</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 transition">
            @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo Electrónico</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 transition">
            @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Rol en la plataforma</label>
            <select name="role" id="role" required
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 transition">
                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Administrador</option>
                <option value="teacher" {{ old('role', $user->role) === 'teacher' ? 'selected' : '' }}>Docente</option>
                <option value="student" {{ old('role', $user->role) === 'student' ? 'selected' : '' }}>Alumno</option>
            </select>
            @error('role') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="pt-4 border-t border-gray-100">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Seguridad (Opcional)</h3>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Nueva Contraseña</label>
                <input type="password" name="password" id="password" autocomplete="new-password"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 transition"
                    placeholder="Dejar en blanco para no cambiar">
                @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex justify-end gap-4 pt-4">
            <a href="{{ route('admin.users.index') }}" class="px-6 py-2 rounded-md border border-gray-300 font-medium text-gray-700 hover:bg-gray-50 transition">
                Cancelar
            </a>
            <button type="submit" class="px-6 py-2 rounded-md bg-primary text-white font-medium hover:bg-primary/90 transition shadow-sm">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>
@endsection
