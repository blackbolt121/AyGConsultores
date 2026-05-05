@extends('layouts.app')

@section('content')
<section class="py-10 container mx-auto max-w-5xl px-4">
    <div class="mb-8">
        <a href="{{ route('admin.courses.cycles.index', $course) }}" class="text-sm text-gray-500 hover:text-primary mb-2 inline-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Volver a ciclos
        </a>
        <h1 class="text-3xl font-bold bg-gradient-to-r from-primary via-secondary to-purple-600 bg-clip-text text-transparent">
            Editar Ciclo
        </h1>
        <p class="text-gray-500 mt-2">{{ $course->title }} · {{ $ciclo->name }}</p>
    </div>

    @if (session('status'))
        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">
            {{ session('status') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
        <form method="POST" action="{{ route('admin.courses.cycles.update', [$course, $ciclo]) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Nombre</label>
                <input name="name" required value="{{ old('name', $ciclo->name) }}" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm" />
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Estado</label>
                    <select name="status" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm">
                        @foreach(['draft','open','active','closed','archived'] as $st)
                            <option value="{{ $st }}" @selected(old('status', $ciclo->status) === $st)>{{ $st }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Cupo (0 = sin limite)</label>
                    <input name="capacity" type="number" min="0" required value="{{ old('capacity', $ciclo->capacity) }}" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm" />
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Inicio</label>
                    <input name="starts_at" type="date" value="{{ old('starts_at', optional($ciclo->starts_at)->format('Y-m-d')) }}" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm" />
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Fin</label>
                    <input name="ends_at" type="date" value="{{ old('ends_at', optional($ciclo->ends_at)->format('Y-m-d')) }}" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm" />
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Docentes asignados</label>
                <select name="teachers[]" multiple class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm h-40">
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}" @selected($ciclo->teachers->contains('id', $teacher->id))>{{ $teacher->name }} ({{ $teacher->email }})</option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500">Seleccion multiple (Ctrl/Cmd + click).</p>
            </div>

            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                <button type="submit" class="inline-flex items-center rounded-xl bg-primary px-6 py-3 text-sm font-medium text-white hover:bg-primary/90">Guardar</button>

                <form method="POST" action="{{ route('admin.courses.cycles.destroy', [$course, $ciclo]) }}" onsubmit="return confirm('¿Eliminar este ciclo?');">
                    @csrf
                    @method('DELETE')
                    <button class="inline-flex items-center rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-700 hover:bg-red-100">Eliminar</button>
                </form>
            </div>
        </form>
    </div>
</section>
@endsection
