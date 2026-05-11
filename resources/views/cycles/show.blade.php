@extends('layouts.app')

@section('title', $course->title.' - '.$cycle->name)

@section('content')
<main class="flex-1 w-full mx-auto">
  <div class="min-h-screen py-12">
    <div class="container mx-auto px-4 md:px-6 max-w-7xl">

      <div class="mb-6">
        <a href="{{ route('dashboard.index') }}" class="text-sm text-gray-500 hover:text-primary inline-flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
          </svg>
          Volver al dashboard
        </a>
      </div>

      @php
        $status = (string) ($cycle->status ?? 'draft');
        $statusClasses = match ($status) {
          'active' => 'bg-emerald-50 text-emerald-700 ring-emerald-700/10',
          'open' => 'bg-blue-50 text-blue-700 ring-blue-700/10',
          'closed' => 'bg-amber-50 text-amber-700 ring-amber-700/10',
          'archived' => 'bg-slate-100 text-slate-700 ring-slate-700/10',
          default => 'bg-gray-50 text-gray-700 ring-gray-700/10',
        };

        $roots = $course->relationLoaded('rootContents') ? $course->rootContents : $course->rootContents()->get();
      @endphp

      <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
          <div class="min-w-0">
            <div class="flex flex-wrap items-center gap-2">
              <h1 class="text-2xl md:text-3xl font-bold text-gray-900 truncate">{{ $course->title }}</h1>
              <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $statusClasses }}">{{ $status }}</span>
            </div>
            <p class="text-gray-500 mt-1">Ciclo: <strong class="text-gray-900">{{ $cycle->name }}</strong></p>

            <div class="mt-4">
              <div class="flex items-center justify-between text-sm">
                <p class="font-medium text-gray-900">Progreso</p>
                <p class="text-gray-600">{{ $progressPercent ?? 0 }}% ({{ $progressCompleted ?? 0 }}/{{ $progressTotal ?? 0 }})</p>
              </div>
              <div class="mt-2 h-2.5 w-full rounded-full bg-slate-100 overflow-hidden">
                <div class="h-full rounded-full bg-gradient-to-r from-primary to-secondary" style="width: {{ $progressPercent ?? 0 }}%"></div>
              </div>
            </div>

            <div class="mt-3 flex flex-wrap items-center gap-2 text-xs">
              <span class="inline-flex items-center rounded-xl border border-gray-200 bg-gray-50 px-3 py-1.5 text-gray-700">
                <strong class="mr-1">Inicio:</strong> {{ $cycle->starts_at ? $cycle->starts_at->format('d/m/Y') : 'N/A' }}
              </span>
              <span class="inline-flex items-center rounded-xl border border-gray-200 bg-gray-50 px-3 py-1.5 text-gray-700">
                <strong class="mr-1">Fin:</strong> {{ $cycle->ends_at ? $cycle->ends_at->format('d/m/Y') : 'N/A' }}
              </span>
            </div>
          </div>
        </div>

        <div class="mt-8 lg:grid lg:grid-cols-3 lg:gap-6">
          <div class="lg:col-span-2">
            <div class="flex items-center justify-between gap-3 mb-4">
              <h2 class="text-xl font-bold text-gray-900">Temario</h2>
              <div class="inline-flex items-center gap-2">
                <button id="cycle-expand-all" type="button" disabled class="inline-flex items-center rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                  Expandir todo
                </button>
                <button id="cycle-collapse-all" type="button" disabled class="inline-flex items-center rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                  Colapsar todo
                </button>
              </div>
            </div>

            @if($roots->isNotEmpty())
              <div class="space-y-3">
                @include('partials._cycle-content-tree', ['nodes' => $roots, 'cycle' => $cycle, 'materials' => $materials, 'completedContentIds' => ($completedContentIds ?? [])])
              </div>
            @else
              <div class="rounded-2xl border border-gray-200 bg-gray-50 p-6 text-gray-600">
                <p class="font-medium text-gray-900">Aún no hay temario publicado</p>
                <p class="text-sm text-gray-500 mt-1">Cuando el curso tenga contenido publicado, lo verás aquí.</p>
              </div>
            @endif
          </div>

          <div class="mt-6 lg:mt-0 lg:col-span-1 lg:sticky lg:top-6">
            <div class="space-y-4">
              <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                <h3 class="text-sm font-semibold text-gray-900">Resumen del ciclo</h3>
                <div class="mt-3 space-y-2 text-sm text-gray-700">
                  <div class="flex items-center justify-between gap-3">
                    <span class="text-gray-500">Estado</span>
                    <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $statusClasses }}">{{ $status }}</span>
                  </div>
                  <div class="flex items-center justify-between gap-3">
                    <span class="text-gray-500">Secciones</span>
                    <span class="font-medium text-gray-900">{{ $roots->count() }}</span>
                  </div>
                  @php
                    $pdfCount = $materials->filter(fn ($m) => $m && $m->content_type === 'pdf' && $m->file_path)->count();
                  @endphp
                  <div class="flex items-center justify-between gap-3">
                    <span class="text-gray-500">Material (PDF)</span>
                    <span class="font-medium text-gray-900">{{ $pdfCount }}</span>
                  </div>
                </div>
              </div>

              <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                <div class="flex items-center justify-between gap-3">
                  <h3 class="text-sm font-semibold text-gray-900">Docentes</h3>
                  <span class="text-xs text-gray-500">{{ $cycle->teachers->count() }}</span>
                </div>

                @if($cycle->teachers->isEmpty())
                  <div class="mt-4 flex items-center gap-3">
                    @for($i = 0; $i < 3; $i++)
                      <div class="h-10 w-10 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path d="M12 12c2.2 0 4-1.8 4-4s-1.8-4-4-4-4 1.8-4 4 1.8 4 4 4z"/>
                          <path d="M4 20c0-2.2 3.6-4 8-4s8 1.8 8 4v1H4v-1z"/>
                        </svg>
                      </div>
                    @endfor
                    <div>
                      <p class="text-sm font-medium text-gray-900">Por asignar</p>
                      <p class="text-xs text-gray-500">Aún no hay docentes asignados a este ciclo.</p>
                    </div>
                  </div>
                @else
                  <div class="mt-4 grid grid-cols-1 gap-3">
                    @foreach($cycle->teachers as $teacher)
                      <div class="flex items-center gap-3 rounded-xl border border-gray-200 bg-white px-3 py-2">
                        <div class="h-10 w-10 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-600 shrink-0">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M12 12c2.2 0 4-1.8 4-4s-1.8-4-4-4-4 1.8-4 4 1.8 4 4 4z"/>
                            <path d="M4 20c0-2.2 3.6-4 8-4s8 1.8 8 4v1H4v-1z"/>
                          </svg>
                        </div>
                        <div class="min-w-0">
                          <p class="text-sm font-medium text-gray-900 truncate">{{ $teacher->name }}</p>
                        </div>
                      </div>
                    @endforeach
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</main>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const expandAllBtn = document.getElementById('cycle-expand-all');
    const collapseAllBtn = document.getElementById('cycle-collapse-all');

    const getToggles = () => Array.from(document.querySelectorAll('[data-acc-toggle]'));
    const getTargets = () => Array.from(document.querySelectorAll('div[id^="cycle-children-"]'));

    const setControlsEnabled = (enabled) => {
      if (expandAllBtn) expandAllBtn.disabled = !enabled;
      if (collapseAllBtn) collapseAllBtn.disabled = !enabled;
    };

    const setChevron = (btn, open) => {
      const chevron = btn.querySelector('.cycle-chevron');
      if (!chevron) return;
      chevron.classList.toggle('rotate-90', open);
    };

    const openTarget = (btn, target) => {
      target.classList.remove('hidden');
      btn.setAttribute('aria-expanded', 'true');
      setChevron(btn, true);
    };

    const closeTarget = (btn, target) => {
      target.classList.add('hidden');
      btn.setAttribute('aria-expanded', 'false');
      setChevron(btn, false);
    };

    // Enable/disable global controls based on existence of toggles.
    const toggles = getToggles();
    setControlsEnabled(toggles.length > 0);

    document.addEventListener('click', (e) => {
      const btn = e.target.closest('[data-acc-toggle]');
      if (!btn) return;
      const targetId = btn.getAttribute('data-acc-toggle');
      if (!targetId) return;
      const target = document.getElementById(targetId);
      if (!target) return;

      const isHidden = target.classList.contains('hidden');
      if (isHidden) openTarget(btn, target);
      else closeTarget(btn, target);
    });

    if (expandAllBtn) {
      expandAllBtn.addEventListener('click', () => {
        getTargets().forEach((target) => {
          const btn = document.querySelector('[aria-controls="' + CSS.escape(target.id) + '"]');
          if (btn) openTarget(btn, target);
          else target.classList.remove('hidden');
        });
      });
    }

    if (collapseAllBtn) {
      collapseAllBtn.addEventListener('click', () => {
        getTargets().forEach((target) => {
          const btn = document.querySelector('[aria-controls="' + CSS.escape(target.id) + '"]');
          if (btn) closeTarget(btn, target);
          else target.classList.add('hidden');
        });
      });
    }
  });
</script>
@endpush
