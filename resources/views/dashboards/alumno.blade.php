@extends('layouts.app')

@section('content')
<section class="py-10 container mx-auto max-w-7xl px-4">
    <div class="mb-8">
        <h1 class="text-3xl font-bold bg-gradient-to-r from-primary via-secondary to-purple-600 bg-clip-text text-transparent">
            Mis Ciclos
        </h1>
        <p class="text-gray-500 mt-2">Accede a tus cursos por ciclo.</p>
        @if($modo)
            <p class="mt-2 text-sm text-amber-700 bg-amber-50 border border-amber-200 inline-flex px-3 py-1.5 rounded-lg">
                Modo activo (admin): viendo como <strong class="ml-1">{{ ucfirst($modo) }}</strong>
            </p>
        @endif
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-200 bg-gray-50/50">
            <h3 class="text-base font-semibold text-gray-900">Mis Inscripciones ({{ $enrollments->count() }})</h3>
        </div>

        @if($enrollments->isEmpty())
            <div class="p-8 text-center text-gray-500">No tienes inscripciones aún.</div>
        @else
            <div class="divide-y divide-gray-100">
                @foreach($enrollments as $enrollment)
                    @php
                        $cycle = $enrollment->courseCycle;
                        $course = $cycle?->course;
                        $accessible = $enrollment->status === 'active' && (!$enrollment->expires_at || $enrollment->expires_at->isFuture() || $enrollment->expires_at->isToday());
                    @endphp
                    <div class="p-6 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                        <div>
                            <p class="font-semibold text-gray-900">{{ $course?->title ?? 'Curso' }} <span class="text-gray-400 font-normal">•</span> {{ $cycle?->name ?? 'Ciclo' }}</p>
                            <p class="text-xs text-gray-500 mt-1">
                                Estado: {{ $enrollment->status }}
                                @if($enrollment->expires_at)
                                    <span class="ml-2">Expira: {{ $enrollment->expires_at->format('d/m/Y') }}</span>
                                @else
                                    <span class="ml-2 text-emerald-600">Sin expiración</span>
                                @endif
                            </p>
                        </div>
                        <div class="flex items-center gap-2">
                            @if($cycle && $accessible)
                                <a class="inline-flex items-center rounded-xl bg-primary px-4 py-2 text-sm font-medium text-white hover:bg-primary/90" href="{{ route('ciclos.mostrar', $cycle) }}">Entrar</a>
                            @else
                                <span class="text-sm text-gray-400">Sin acceso</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
