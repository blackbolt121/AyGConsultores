@extends('layouts.app')

@section('content')
<section class="py-10 container mx-auto max-w-7xl px-4">
    <div class="mb-8 flex justify-between items-end gap-4">
        <div>
            <a href="{{ route('admin.index') }}" class="text-sm text-gray-500 hover:text-primary mb-2 inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Volver al Panel
            </a>
            <h1 class="text-3xl font-bold bg-gradient-to-r from-primary via-secondary to-purple-600 bg-clip-text text-transparent">
                Ciclos (Global)
            </h1>
            <p class="text-gray-500 mt-2">Lista y filtra todos los ciclos por curso, estado y fechas.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-200 bg-gray-50/50">
            <form method="GET" action="{{ route('admin.cycles.index') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-3 items-end">
                <div class="lg:col-span-2">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Curso</label>
                    <select name="course_id" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm">
                        <option value="">Todos</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" @selected(($filters['course_id'] ?? null) == $course->id)>
                                {{ $course->title }} (v{{ $course->major_version }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Estado</label>
                    <select name="status" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm">
                        <option value="">Todos</option>
                        @foreach($statuses as $st)
                            <option value="{{ $st }}" @selected(($filters['status'] ?? null) === $st)>{{ $st }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Inicio desde</label>
                    <input type="date" name="starts_from" value="{{ $filters['starts_from'] ?? '' }}" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm" />
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Inicio hasta</label>
                    <input type="date" name="starts_to" value="{{ $filters['starts_to'] ?? '' }}" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm" />
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Fin desde</label>
                    <input type="date" name="ends_from" value="{{ $filters['ends_from'] ?? '' }}" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm" />
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Fin hasta</label>
                    <input type="date" name="ends_to" value="{{ $filters['ends_to'] ?? '' }}" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm" />
                </div>

                <div class="lg:col-span-6 flex items-center justify-between gap-3 pt-2">
                    <div class="text-xs text-gray-500">
                        Mostrando {{ $cycles->total() }} ciclo(s)
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.cycles.index') }}" class="inline-flex items-center rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Limpiar</a>
                        <button type="submit" class="inline-flex items-center rounded-xl bg-primary px-4 py-2 text-sm font-medium text-white hover:bg-primary/90">Filtrar</button>
                    </div>
                </div>
            </form>
        </div>

        @if($cycles->isEmpty())
            <div class="p-8 text-center text-gray-500">No hay ciclos con esos filtros.</div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-500 bg-gray-50/50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 font-medium">Ciclo</th>
                            <th class="px-6 py-3 font-medium">Curso</th>
                            <th class="px-6 py-3 font-medium">Estado</th>
                            <th class="px-6 py-3 font-medium">Fechas</th>
                            <th class="px-6 py-3 font-medium">Cupo</th>
                            <th class="px-6 py-3 font-medium">Inscritos</th>
                            <th class="px-6 py-3 font-medium text-right">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($cycles as $ciclo)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <p class="font-medium text-gray-900">{{ $ciclo->name }}</p>
                                    <p class="text-xs text-gray-500">ID: {{ $ciclo->id }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-gray-900">{{ $ciclo->course?->title ?? 'Curso' }}</p>
                                    @if($ciclo->course)
                                        <p class="text-xs text-gray-500">v{{ $ciclo->course->major_version }}</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-xs text-gray-700">
                                    <span class="inline-flex items-center rounded-md bg-slate-50 px-2 py-1 text-xs font-medium text-slate-700 ring-1 ring-inset ring-slate-700/10">{{ $ciclo->status }}</span>
                                </td>
                                <td class="px-6 py-4 text-xs text-gray-500 whitespace-nowrap">
                                    <div class="flex flex-col gap-1">
                                        <span><strong class="text-gray-700">Inicio:</strong> {{ $ciclo->starts_at ? $ciclo->starts_at->format('d/m/Y') : 'N/A' }}</span>
                                        <span><strong class="text-gray-700">Fin:</strong> {{ $ciclo->ends_at ? $ciclo->ends_at->format('d/m/Y') : 'N/A' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-xs text-gray-500">{{ $ciclo->capacity }}</td>
                                <td class="px-6 py-4 text-xs text-gray-500">{{ $ciclo->enrollments_count }}</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="inline-flex gap-2">
                                        @if($ciclo->course)
                                            <a class="inline-flex items-center rounded-xl border border-gray-200 bg-white px-3 py-2 text-xs text-gray-700 hover:bg-gray-50" href="{{ route('admin.courses.cycles.edit', [$ciclo->course, $ciclo]) }}">Editar</a>
                                        @endif
                                        <a class="inline-flex items-center rounded-xl bg-primary px-3 py-2 text-xs font-medium text-white hover:bg-primary/90" href="{{ route('admin.cycles.enrollments.index', $ciclo) }}">Inscripciones</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($cycles->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $cycles->links() }}
                </div>
            @endif
        @endif
    </div>
</section>
@endsection
