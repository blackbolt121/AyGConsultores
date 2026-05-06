@extends('layouts.app')

@section('content')
<section class="py-10 container mx-auto max-w-7xl px-4">
    <div class="mb-8">
        <h1 class="text-3xl font-bold bg-gradient-to-r from-primary via-secondary to-purple-600 bg-clip-text text-transparent">
            Dashboard (Docente)
        </h1>
        <p class="text-gray-500 mt-2">Aquí encontrarás los ciclos en los que estás asignado y las herramientas para gestionar material y acreditaciones.</p>
        @if($modo)
            <p class="mt-2 text-sm text-amber-700 bg-amber-50 border border-amber-200 inline-flex px-3 py-1.5 rounded-lg">
                Modo activo (admin): viendo como <strong class="ml-1">{{ ucfirst($modo) }}</strong>
            </p>
        @endif
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-200 bg-gray-50/50 flex justify-between items-center">
            <h3 class="text-base font-semibold text-gray-900">Mis Ciclos ({{ $cycles->count() }})</h3>
            <a href="{{ route('docente.ciclos.index') }}" class="text-sm text-primary hover:underline">Ver todo</a>
        </div>

        @if($cycles->isEmpty())
            <div class="p-8 text-center text-gray-500">Aún no tienes ciclos asignados.</div>
        @else
            <div class="divide-y divide-gray-100">
                @foreach($cycles as $cycle)
                    <div class="p-6 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                        <div>
                            <p class="font-semibold text-gray-900">{{ $cycle->course->title }} <span class="text-gray-400 font-normal">•</span> {{ $cycle->name }}</p>
                            <p class="text-xs text-gray-500 mt-1">Estado: {{ $cycle->status }}</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <a class="inline-flex items-center rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm text-gray-700 hover:bg-gray-50" href="{{ route('docente.ciclos.material', $cycle) }}">Material</a>
                            <a class="inline-flex items-center rounded-xl bg-primary px-4 py-2 text-sm font-medium text-white hover:bg-primary/90" href="{{ route('docente.ciclos.alumnos', $cycle) }}">Alumnos</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
