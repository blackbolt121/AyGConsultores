@extends('layouts.app')

@section('content')
<section class="py-10 container mx-auto max-w-5xl px-4">
    <div class="mb-8">
        <a href="{{ route('admin.courses.cycles.index', $ciclo->course) }}" class="text-sm text-gray-500 hover:text-primary mb-2 inline-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Volver
        </a>
        <h1 class="text-3xl font-bold bg-gradient-to-r from-primary via-secondary to-secondary bg-clip-text text-transparent">Inscripciones del Ciclo</h1>
        <p class="text-gray-500 mt-2"><strong>{{ $ciclo->course->title }}</strong> · {{ $ciclo->name }}</p>
    </div>

    @if (session('status'))
        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">{{ session('status') }}</div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="md:col-span-1">
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Inscribir Alumno</h2>
                <form action="{{ route('admin.cycles.enrollments.store', $ciclo) }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Alumno</label>
                        <select name="user_id" required class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm">
                            <option value="" disabled selected>Elige un alumno...</option>
                            @foreach($availableUsers as $u)
                                <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
                            @endforeach
                        </select>
                        @error('user_id')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Inicio</label>
                        <input type="date" name="enrolled_at" value="{{ old('enrolled_at', now()->format('Y-m-d')) }}" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm" />
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Expiracion (opcional)</label>
                        <input type="date" name="expires_at" value="{{ old('expires_at') }}" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm" />
                    </div>

                    <button class="w-full inline-flex justify-center items-center rounded-xl bg-primary px-4 py-2 text-sm font-medium text-white hover:bg-primary/90" type="submit">Inscribir</button>
                </form>
            </div>
        </div>

        <div class="md:col-span-2">
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 bg-gray-50/50">
                    <h3 class="text-base font-semibold text-gray-900">Inscritos ({{ $enrollments->count() }})</h3>
                </div>
                @if($enrollments->isEmpty())
                    <div class="p-8 text-center text-gray-500">No hay alumnos inscritos.</div>
                @else
                    <ul class="divide-y divide-gray-200">
                        @foreach($enrollments as $enrollment)
                            <li class="p-6 flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">{{ $enrollment->user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $enrollment->user->email }}</p>
                                </div>
                                <form method="POST" action="{{ route('admin.cycles.enrollments.destroy', [$ciclo, $enrollment]) }}" onsubmit="return confirm('¿Eliminar inscripcion?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded-lg">Eliminar</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
