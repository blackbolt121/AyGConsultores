@extends('layouts.app')

@section('content')
<section class="py-10 container mx-auto max-w-7xl px-4">
    <div class="mb-8 flex justify-between items-end">
        <div>
            <a href="{{ route('admin.index') }}" class="text-sm text-gray-500 hover:text-primary mb-2 inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Volver al Panel
            </a>
            <h1 class="text-3xl font-bold bg-gradient-to-r from-primary via-secondary to-secondary bg-clip-text text-transparent">
                Gestión Global de Inscripciones
            </h1>
            <p class="text-gray-500 mt-2">Inscribe alumnos a cualquier ciclo desde aquí.</p>
        </div>
    </div>

    @if (session('status'))
        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">
            {{ session('status') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- Formulario para inscribir un nuevo usuario --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm sticky top-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Nueva Inscripción</h2>
                
                <form action="{{ route('admin.enrollments.store') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <div class="space-y-2">
                        <label for="course_cycle_id" class="block text-sm font-medium text-gray-700">Ciclo</label>
                        <select name="course_cycle_id" id="course_cycle_id" required
                            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm">
                            <option value="" disabled selected>Elige un ciclo...</option>
                            @foreach($cycles as $cycle)
                                <option value="{{ $cycle->id }}" {{ old('course_cycle_id') == $cycle->id ? 'selected' : '' }}>
                                    {{ $cycle->course->title }} · {{ $cycle->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('course_cycle_id')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="user_id" class="block text-sm font-medium text-gray-700">Alumno</label>
                        <select name="user_id" id="user_id" required {{ $users->isEmpty() ? 'disabled' : '' }}
                            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm">
                            @if($users->isEmpty())
                                <option value="" selected>No hay alumnos registrados</option>
                            @else
                                <option value="" disabled selected>Elige un alumno...</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @if($users->isEmpty())
                            <p class="text-xs text-amber-700">Crea al menos un usuario con rol <strong>student</strong> para poder inscribirlo.</p>
                        @endif
                        @error('user_id')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="enrolled_at" class="block text-sm font-medium text-gray-700">Inicio</label>
                            <input type="date" name="enrolled_at" id="enrolled_at" value="{{ old('enrolled_at', now()->format('Y-m-d')) }}"
                                class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm">
                            @error('enrolled_at')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="expires_at" class="block text-sm font-medium text-gray-700">Expiración (Opc.)</label>
                            <input type="date" name="expires_at" id="expires_at" value="{{ old('expires_at') }}"
                                class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm">
                            @error('expires_at')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full inline-flex justify-center items-center rounded-xl bg-primary mt-4 px-4 py-3 text-sm font-medium text-white shadow-sm hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-colors">
                        Registrar Inscripción
                    </button>
                </form>
            </div>
        </div>

        {{-- Lista de inscritos global --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 bg-gray-50/50 flex justify-between items-center">
                    <h3 class="text-base font-semibold text-gray-900">Últimas Inscripciones</h3>
                </div>
                
                @if($enrollments->isEmpty())
                    <div class="p-8 text-center text-gray-500">
                        No hay usuarios inscritos en ningún curso todavía.
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs text-gray-500 bg-gray-50/50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-3 font-medium">Usuario</th>
                                    <th class="px-6 py-3 font-medium">Curso / Ciclo</th>
                                    <th class="px-6 py-3 font-medium">Fechas</th>
                                    <th class="px-6 py-3 font-medium text-right">Acción</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($enrollments as $enrollment)
                                    <tr class="hover:bg-gray-50/50 transition-colors">
                                        <td class="px-6 py-4">
                                            <p class="font-medium text-gray-900">{{ $enrollment->user->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $enrollment->user->email }}</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">
                                                {{ Str::limit($enrollment->courseCycle?->course?->title ?? 'Curso', 35) }}
                                            </span>
                                            <p class="text-xs text-gray-500 mt-1">{{ $enrollment->courseCycle?->name ?? 'Ciclo' }}</p>
                                        </td>
                                        <td class="px-6 py-4 text-xs text-gray-500 whitespace-nowrap">
                                            <div class="flex flex-col gap-1">
                                                <span><strong class="text-gray-700">Inicio:</strong> {{ $enrollment->enrolled_at ? $enrollment->enrolled_at->format('d/m/Y') : 'N/A' }}</span>
                                                @if($enrollment->expires_at)
                                                    <span class="{{ $enrollment->expires_at->isPast() ? 'text-red-600 font-medium' : 'text-amber-600' }}">
                                                        <strong class="text-gray-700">Exp:</strong> {{ $enrollment->expires_at->format('d/m/Y') }}
                                                    </span>
                                                @else
                                                    <span class="text-emerald-600">Sin límite</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <form action="{{ route('admin.enrollments.destroy', $enrollment) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta inscripción?');" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition-colors" title="Eliminar inscripción">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                      <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($enrollments->hasPages())
                        <div class="px-6 py-4 border-t border-gray-200">
                            {{ $enrollments->links() }}
                        </div>
                    @endif
                @endif
            </div>
        </div>

    </div>
</section>
@endsection
