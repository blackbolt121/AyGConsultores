@extends('layouts.app')

@section('content')
  <div class="max-w-5xl mx-auto px-4 py-6">
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm px-4 py-4 sm:px-5 sm:py-5 mb-4">
      <div class="flex items-start justify-between gap-4">
        <div class="min-w-0">
          <div class="mb-2">
            <a href="{{ route('ciclos.mostrar', $cycle) }}" class="inline-flex items-center gap-2 text-xs font-medium text-slate-600 hover:text-slate-900">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
              </svg>
              Volver al ciclo
            </a>
          </div>
          <h1 class="text-2xl font-bold text-slate-900 truncate">{{ $content->title }}</h1>
          <div class="mt-2 flex flex-wrap items-center gap-2">
            <span id="text-time-chip" class="inline-flex items-center rounded-full bg-slate-50 px-3 py-1 text-xs font-medium text-slate-700 ring-1 ring-inset ring-slate-700/10">Tiempo activo: 0/30s</span>
          </div>
          <p class="mt-2 text-xs text-slate-500">Para completar: 30s de lectura activa.</p>
        </div>

        <div class="shrink-0">
          <span
            id="material-status-badge"
            class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $isCompleted ? 'bg-emerald-50 text-emerald-700 ring-emerald-700/10' : 'bg-gray-50 text-gray-700 ring-gray-700/10' }}"
          >
            @if($isCompleted)
              <svg class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M16.704 5.29a1 1 0 0 1 .006 1.414l-7.5 7.57a1 1 0 0 1-1.42.003L3.296 9.7a1 1 0 1 1 1.408-1.418l3.09 3.065 6.79-6.857a1 1 0 0 1 1.42-.001Z" clip-rule="evenodd"/></svg>
              Completado
            @else
              Pendiente
            @endif
          </span>
        </div>
      </div>
    </div>

    <div class="relative rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
      <div class="p-5 prose max-w-none">
        {!! $body !!}
      </div>

      <div id="material-paused-overlay" class="hidden absolute inset-0 bg-white/80 backdrop-blur-[1px]">
        <div class="h-full w-full flex items-center justify-center p-6">
          <div class="max-w-md w-full rounded-2xl border border-slate-200 bg-white shadow-lg p-5">
            <p class="text-sm font-semibold text-slate-900">Pausado</p>
            <p class="mt-1 text-sm text-slate-600">Vuelve y presiona <strong>Reanudar</strong> para continuar el conteo de completado.</p>
            <div class="mt-4 flex items-center justify-end">
              <button id="material-resume-btn" type="button" class="inline-flex items-center rounded-xl bg-primary px-4 py-2 text-sm font-medium text-white hover:bg-primary/90">
                Reanudar
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    window.__materialProgress = {
      kind: 'text',
      heartbeatUrl: @json($heartbeatUrl),
      initialActiveSeconds: @json($initialActiveSeconds),
      initialReachedLastPage: false,
      isCompleted: @json($isCompleted),
    };
  </script>
@endsection
