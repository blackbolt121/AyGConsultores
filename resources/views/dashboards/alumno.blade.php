@extends('layouts.app')

@section('content')
@php
    $layout = request()->query('layout', 'stack');
    if (!in_array($layout, ['stack', 'cards'], true)) {
        $layout = 'stack';
    }

    $cycleStatusLabels = [
        'draft' => 'Borrador',
        'open' => 'Abierto',
        'active' => 'Activo',
        'closed' => 'Cerrado',
        'archived' => 'Archivado',
    ];
    $cycleStatusClasses = [
        'draft' => 'bg-gray-50 text-gray-700 ring-gray-700/10',
        'open' => 'bg-blue-50 text-blue-700 ring-blue-700/10',
        'active' => 'bg-emerald-50 text-emerald-700 ring-emerald-700/10',
        'closed' => 'bg-amber-50 text-amber-700 ring-amber-700/10',
        'archived' => 'bg-slate-100 text-slate-700 ring-slate-700/10',
    ];

    $enrollmentStatusLabels = [
        'active' => 'Activo',
        'inactive' => 'Inactivo',
        'expired' => 'Expirado',
        'cancelled' => 'Cancelado',
        'pending' => 'Pendiente',
    ];
    $enrollmentStatusClasses = [
        'active' => 'bg-emerald-50 text-emerald-700 ring-emerald-700/10',
        'inactive' => 'bg-gray-50 text-gray-700 ring-gray-700/10',
        'expired' => 'bg-amber-50 text-amber-700 ring-amber-700/10',
        'cancelled' => 'bg-red-50 text-red-700 ring-red-700/10',
        'pending' => 'bg-blue-50 text-blue-700 ring-blue-700/10',
    ];

    $toLabel = function (?string $key, array $map): string {
        $k = (string) ($key ?? '');
        if ($k === '') return 'N/A';
        return $map[$k] ?? ucfirst(str_replace('_', ' ', $k));
    };
    $toChip = function (?string $key, array $classes): string {
        $k = (string) ($key ?? '');
        return $classes[$k] ?? 'bg-gray-50 text-gray-700 ring-gray-700/10';
    };
@endphp
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
        <div class="px-6 py-5 border-b border-gray-200 bg-gray-50/50 flex items-center justify-between gap-3">
            <h3 class="text-base font-semibold text-gray-900">Mis Inscripciones ({{ $enrollments->count() }})</h3>

            <div class="inline-flex rounded-xl border border-gray-200 bg-white p-1" role="tablist" aria-label="Cambiar layout">
                @php
                    $baseParams = request()->query();
                @endphp
                <a
                    data-layout-toggle
                    data-layout="stack"
                    href="{{ request()->fullUrlWithQuery(array_merge($baseParams, ['layout' => 'stack'])) }}"
                    class="px-3 py-1.5 text-sm rounded-lg {{ $layout === 'stack' ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50' }}"
                >
                    Stack
                </a>
                <a
                    data-layout-toggle
                    data-layout="cards"
                    href="{{ request()->fullUrlWithQuery(array_merge($baseParams, ['layout' => 'cards'])) }}"
                    class="px-3 py-1.5 text-sm rounded-lg {{ $layout === 'cards' ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50' }}"
                >
                    Cards
                </a>
            </div>
        </div>

        @if($enrollments->isEmpty())
            <div class="p-8 text-center text-gray-500">No tienes inscripciones aún.</div>
        @else
            @if($layout === 'cards')
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($enrollments as $enrollment)
                            @php
                                $cycle = $enrollment->courseCycle;
                                $course = $cycle?->course;
                                $accessible = $enrollment->status === 'active' && (!$enrollment->expires_at || $enrollment->expires_at->isFuture() || $enrollment->expires_at->isToday());

                                $badge = null;
                                if (!$accessible) {
                                    $badge = 'Sin acceso';
                                } elseif ($cycle) {
                                    $badge = 'Estado: '.$toLabel((string) $cycle->status, $cycleStatusLabels);
                                }

                                $meta = 'Estado de inscripcion: '.$toLabel((string) $enrollment->status, $enrollmentStatusLabels);
                                if ($enrollment->expires_at) {
                                    $meta .= ' · Expira: '.$enrollment->expires_at->format('d/m/Y');
                                } else {
                                    $meta .= ' · Sin expiración';
                                }

                                $href = ($cycle && $accessible) ? route('ciclos.mostrar', $cycle) : null;
                            @endphp

                            @if($course && $cycle)
                                <x-cycle-card :course="$course" :cycle="$cycle" :href="$href" :accessible="$accessible" :badge="$badge" :meta="$meta" />
                            @else
                                <div class="rounded-2xl border border-gray-200 bg-gray-50 p-6 text-gray-600">
                                    <p class="font-medium text-gray-900">Inscripción</p>
                                    <p class="text-sm text-gray-500 mt-1">No se pudo cargar el curso o el ciclo.</p>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
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
                                <div class="mt-2 flex flex-wrap items-center gap-2">
                                    @php
                                        $cycleStatusKey = $cycle?->status ? (string) $cycle->status : null;
                                        $enrollmentStatusKey = (string) $enrollment->status;
                                    @endphp

                                    <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $toChip($cycleStatusKey, $cycleStatusClasses) }}">
                                        Estado del ciclo: {{ $toLabel($cycleStatusKey, $cycleStatusLabels) }}
                                    </span>

                                    <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $toChip($enrollmentStatusKey, $enrollmentStatusClasses) }}">
                                        Estado de inscripcion: {{ $toLabel($enrollmentStatusKey, $enrollmentStatusLabels) }}
                                    </span>

                                    @if($enrollment->expires_at)
                                        <span class="inline-flex items-center rounded-md bg-slate-50 px-2 py-1 text-xs font-medium text-slate-700 ring-1 ring-inset ring-slate-700/10">
                                            Expira: {{ $enrollment->expires_at->format('d/m/Y') }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center rounded-md bg-emerald-50 px-2 py-1 text-xs font-medium text-emerald-700 ring-1 ring-inset ring-emerald-700/10">
                                            Sin expiración
                                        </span>
                                    @endif
                                </div>
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
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
  (() => {
    const KEY = 'studentDashboardLayout';
    const VALID = new Set(['stack', 'cards']);

    const url = new URL(window.location.href);
    const current = url.searchParams.get('layout');

    const safeGet = () => {
      try { return window.localStorage.getItem(KEY); } catch { return null; }
    };
    const safeSet = (v) => {
      try { window.localStorage.setItem(KEY, v); } catch {}
    };

    if (current && VALID.has(current)) {
      safeSet(current);
    } else if (!current) {
      const saved = safeGet();
      if (saved && VALID.has(saved)) {
        url.searchParams.set('layout', saved);
        window.location.replace(url.toString());
        return;
      }
    }

    document.querySelectorAll('[data-layout-toggle]').forEach((a) => {
      a.addEventListener('click', () => {
        const v = a.getAttribute('data-layout');
        if (v && VALID.has(v)) safeSet(v);
      });
    });
  })();
</script>
@endpush
