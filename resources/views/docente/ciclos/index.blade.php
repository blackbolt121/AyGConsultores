@extends('layouts.app')

@section('content')
<section class="py-10 container mx-auto max-w-7xl px-4">
    <div class="mb-8 flex justify-between items-end">
        <div>
            <a href="{{ route('dashboard.index') }}" class="text-sm text-gray-500 hover:text-primary mb-2 inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Volver al Dashboard
            </a>
            <h1 class="text-3xl font-bold bg-gradient-to-r from-primary via-secondary to-secondary bg-clip-text text-transparent">
                Mis Ciclos
            </h1>
            <p class="text-gray-500 mt-2">Ciclos asignados para gestionar material y acreditaciones.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-200 bg-gray-50/50 flex justify-between items-center">
            <h3 class="text-base font-semibold text-gray-900">Listado</h3>
        </div>

        @if($cycles->isEmpty())
            <div class="p-8 text-center text-gray-500">No tienes ciclos asignados.</div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-500 bg-gray-50/50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 font-medium">Curso</th>
                            <th class="px-6 py-3 font-medium">Ciclo</th>
                            <th class="px-6 py-3 font-medium">Estado</th>
                            <th class="px-6 py-3 font-medium text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($cycles as $cycle)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $cycle->course->title }}</td>
                                <td class="px-6 py-4">{{ $cycle->name }}</td>
                                <td class="px-6 py-4 text-xs text-gray-500">{{ $cycle->status }}</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="inline-flex gap-2">
                                        <a class="inline-flex items-center rounded-xl border border-gray-200 bg-white px-3 py-2 text-xs text-gray-700 hover:bg-gray-50" href="{{ route('docente.ciclos.material', $cycle) }}">Material</a>
                                        <a class="inline-flex items-center rounded-xl bg-primary px-3 py-2 text-xs font-medium text-white hover:bg-primary/90" href="{{ route('docente.ciclos.alumnos', $cycle) }}">Alumnos</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $cycles->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
