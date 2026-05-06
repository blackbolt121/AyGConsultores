@extends('layouts.app')

@section('content')
<section class="py-10 container mx-auto max-w-7xl px-4">
    <div class="mb-8 flex justify-between items-end">
        <div>
            <a href="{{ route('admin.courses.edit', $course) }}" class="text-sm text-gray-500 hover:text-primary mb-2 inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Volver al curso
            </a>
            <h1 class="text-3xl font-bold bg-gradient-to-r from-primary via-secondary to-secondary bg-clip-text text-transparent">
                Ciclos
            </h1>
            <p class="text-gray-500 mt-2">Gestiona los ciclos de <strong>{{ $course->title }}</strong> (v{{ $course->major_version }}).</p>
        </div>
    </div>

    @if (session('status'))
        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">
            {{ session('status') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm sticky top-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Nuevo Ciclo</h2>
                <form action="{{ route('admin.courses.cycles.store', $course) }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input name="name" required class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm" placeholder="Ej. Ciclo Mayo 2026" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Estado</label>
                            <select name="status" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm">
                                @foreach(['draft','open','active','closed','archived'] as $st)
                                    <option value="{{ $st }}">{{ $st }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Cupo (0 = sin limite)</label>
                            <input name="capacity" type="number" min="0" value="0" required class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm" />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Inicio</label>
                            <input name="starts_at" type="date" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm" />
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Fin</label>
                            <input name="ends_at" type="date" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm" />
                        </div>
                    </div>

                    <button type="submit" class="w-full inline-flex justify-center items-center rounded-xl bg-primary px-4 py-3 text-sm font-medium text-white shadow-sm hover:bg-primary/90">
                        Crear Ciclo
                    </button>
                </form>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 bg-gray-50/50">
                    <h3 class="text-base font-semibold text-gray-900">Ciclos ({{ $cycles->count() }})</h3>
                </div>
                @if($cycles->isEmpty())
                    <div class="p-8 text-center text-gray-500">No hay ciclos creados.</div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs text-gray-500 bg-gray-50/50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-3 font-medium">Ciclo</th>
                                    <th class="px-6 py-3 font-medium">Estado</th>
                                    <th class="px-6 py-3 font-medium">Cupo</th>
                                    <th class="px-6 py-3 font-medium text-right">Accion</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($cycles as $ciclo)
                                    <tr class="hover:bg-gray-50/50 transition-colors">
                                        <td class="px-6 py-4">
                                            <p class="font-medium text-gray-900">{{ $ciclo->name }}</p>
                                            <p class="text-xs text-gray-500">Inscritos: {{ $ciclo->enrollments_count }}</p>
                                        </td>
                                        <td class="px-6 py-4 text-xs text-gray-500">{{ $ciclo->status }}</td>
                                        <td class="px-6 py-4 text-xs text-gray-500">{{ $ciclo->capacity }}</td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="inline-flex gap-2">
                                                <a class="inline-flex items-center rounded-xl border border-gray-200 bg-white px-3 py-2 text-xs text-gray-700 hover:bg-gray-50" href="{{ route('admin.courses.cycles.edit', [$course, $ciclo]) }}">Editar</a>
                                                <a class="inline-flex items-center rounded-xl bg-primary px-3 py-2 text-xs font-medium text-white hover:bg-primary/90" href="{{ route('admin.cycles.enrollments.index', $ciclo) }}">Inscripciones</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
