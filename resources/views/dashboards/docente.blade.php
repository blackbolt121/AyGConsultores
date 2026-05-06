@extends('layouts.app')

@section('content')
<section class="py-8 md:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-3xl md:text-4xl font-bold tracking-tight bg-gradient-to-r from-primary via-secondary to-secondary bg-clip-text text-transparent">
            Dashboard (Docente)
        </h1>
        <p class="text-gray-500 mt-2">Aquí encontrarás los ciclos en los que estás asignado y las herramientas para gestionar material y acreditaciones.</p>
        @if($modo)
            <p class="mt-3 text-sm text-amber-800 bg-amber-50 border border-amber-200 inline-flex px-3 py-1.5 rounded-full">
                Modo activo (admin): viendo como <strong class="ml-1">{{ ucfirst($modo) }}</strong>
            </p>
        @endif
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-200 bg-slate-50/50 flex justify-between items-center">
            <h3 class="text-base font-semibold text-gray-900">Mis Ciclos ({{ $cycles->count() }})</h3>
            <a href="{{ route('docente.ciclos.index') }}" class="text-sm text-primary hover:underline">Ver todo</a>
        </div>

        @if($cycles->isEmpty())
            <div class="p-8 text-center text-gray-500">Aún no tienes ciclos asignados.</div>
        @else
            <div class="divide-y divide-slate-100">
                @foreach($cycles as $cycle)
                    <div class="p-6 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                        <div>
                            <p class="font-semibold text-gray-900">{{ $cycle->course->title }} <span class="text-gray-400 font-normal">•</span> {{ $cycle->name }}</p>
                            <p class="text-xs text-gray-500 mt-1">Estado: {{ $cycle->status }}</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <a class="inline-flex items-center rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm hover:shadow-md hover:bg-slate-50 transition-all duration-300" href="{{ route('docente.ciclos.material', $cycle) }}">Material</a>
                            <a class="inline-flex items-center rounded-xl bg-gradient-to-r from-primary to-secondary px-4 py-2 text-sm font-medium text-white shadow-sm hover:shadow-md transition-all duration-300" href="{{ route('docente.ciclos.alumnos', $cycle) }}">Alumnos</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    </div>
</section>
@endsection
