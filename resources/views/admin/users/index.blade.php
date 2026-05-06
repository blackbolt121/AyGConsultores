@extends('layouts.app')

@section('content')
<section class="py-8 md:py-12">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-end gap-4 mb-8">
        <div class="space-y-2">
            <h1 class="text-3xl md:text-4xl font-bold tracking-tight text-slate-900">Gestión de Usuarios</h1>
            <p class="text-slate-600">Administra los accesos y roles de la plataforma.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-primary to-secondary px-4 py-2 text-white font-medium shadow-sm hover:shadow-md transition-all duration-300">
            Nuevo Usuario
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200">
                    <th class="px-6 py-4 text-sm font-semibold text-gray-700 uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-700 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-700 uppercase tracking-wider">Rol</th>
                    <th class="px-6 py-4 text-sm font-semibold text-gray-700 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($users as $user)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-900">{{ $user->name }}</div>
                    </td>
                    <td class="px-6 py-4 text-gray-600">
                        {{ $user->email }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                            @if($user->isAdmin()) bg-red-100 text-red-800 
                            @elseif($user->isTeacher()) bg-blue-100 text-blue-800 
                            @else bg-green-100 text-green-800 @endif">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex items-center rounded-xl border border-slate-200 bg-white px-3 py-1.5 text-sm font-medium text-slate-700 shadow-sm hover:shadow-md hover:bg-slate-50 transition-all duration-300">Editar</a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center rounded-xl bg-red-600 px-3 py-1.5 text-sm font-medium text-white shadow-sm hover:shadow-md hover:bg-red-700 transition-all duration-300">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>
</section>
@endsection
