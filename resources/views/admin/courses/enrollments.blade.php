@extends('layouts.app')

@section('content')
<section class="py-10 container mx-auto max-w-5xl px-4">
    <div class="mb-8 flex justify-between items-end">
        <div>
            <a href="{{ route('admin.courses.edit', $course) }}" class="text-sm text-gray-500 hover:text-primary mb-2 inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Volver al curso
            </a>
            <h1 class="text-3xl font-bold bg-gradient-to-r from-primary via-secondary to-purple-600 bg-clip-text text-transparent">
                Inscripciones
            </h1>
            <p class="text-gray-500 mt-2">Gestiona los estudiantes inscritos en el curso <strong>{{ $course->title }}</strong>.</p>
        </div>
    </div>

    @if (session('status'))
        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">
            {{ session('status') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        {{-- Formulario para inscribir un nuevo usuario --}}
        <div class="md:col-span-1">
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Inscribir Usuario</h2>
                
                <form action="{{ route('admin.courses.enrollments.store', $course) }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <div class="space-y-2">
                        <label for="user_id" class="block text-sm font-medium text-gray-700">Seleccionar Usuario</label>
                        <select name="user_id" id="user_id" required
                            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm">
                            <option value="" disabled selected>Elige un usuario...</option>
                            @forelse($availableUsers as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @empty
                                <option value="" disabled>Todos los usuarios están inscritos.</option>
                            @endforelse
                        </select>
                        @error('user_id')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="enrolled_at" class="block text-sm font-medium text-gray-700">Fecha de Inicio</label>
                        <input type="date" name="enrolled_at" id="enrolled_at" value="{{ old('enrolled_at', now()->format('Y-m-d')) }}"
                            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm">
                        <p class="text-xs text-gray-400">El acceso comenzará a partir de este día.</p>
                        @error('enrolled_at')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="expires_at" class="block text-sm font-medium text-gray-700">Fecha de Expiración (Opcional)</label>
                        <input type="date" name="expires_at" id="expires_at" value="{{ old('expires_at') }}"
                            class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm">
                        <p class="text-xs text-gray-400">Si se deja en blanco, el acceso no expirará.</p>
                        @error('expires_at')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full inline-flex justify-center items-center rounded-xl bg-primary px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-colors"
                        {{ $availableUsers->isEmpty() ? 'disabled' : '' }}>
                        Inscribir al curso
                    </button>
                </form>
            </div>
        </div>

        {{-- Lista de inscritos --}}
        <div class="md:col-span-2">
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 bg-gray-50/50">
                    <h3 class="text-base font-semibold text-gray-900">Estudiantes Inscritos ({{ $enrollments->count() }})</h3>
                </div>
                
                @if($enrollments->isEmpty())
                    <div class="p-8 text-center text-gray-500">
                        No hay usuarios inscritos en este curso todavía.
                    </div>
                @else
                    <ul class="divide-y divide-gray-200">
                        @foreach($enrollments as $enrollment)
                            <li class="p-6 flex items-center justify-between hover:bg-gray-50 transition-colors">
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">{{ $enrollment->user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $enrollment->user->email }}</p>
                                    <div class="mt-2 flex items-center gap-3 text-xs text-gray-500">
                                        <span>Inscrito: {{ $enrollment->enrolled_at ? $enrollment->enrolled_at->format('d/m/Y') : 'N/A' }}</span>
                                        @if($enrollment->expires_at)
                                            <span class="inline-flex items-center gap-1 {{ $enrollment->expires_at->isPast() ? 'text-red-600' : 'text-amber-600' }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Expira: {{ $enrollment->expires_at->format('d/m/Y') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <form action="{{ route('admin.courses.enrollments.destroy', [$course, $enrollment]) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta inscripción? El usuario perderá acceso al curso.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition-colors" title="Eliminar inscripción">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

    </div>
</section>
@endsection
