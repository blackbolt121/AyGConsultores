@extends('layouts.app')

@section('title', $course->title)

@section('content')
<main class="flex-1 w-full mx-auto">
  <div class="min-h-screen py-12">
    <div class="container mx-auto px-4 md:px-6 max-w-7xl">

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        {{-- Columna izquierda (contenido principal) --}}
        <div class="lg:col-span-2">

          {{-- Hero imagen + título sobreimpuesto --}}
          <div class="relative w-full mb-6 rounded-lg overflow-hidden">
            <img src="{{ $course->image }}" alt="{{ $course->title }}"
             class="mb-6 w-full max-h-[360px] object-cover rounded-xl ring-1 ring-gray-200" />

            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-0 left-0 right-0 p-6">
              <h1 class="text-2xl md:text-3xl font-bold text-white">
                {{ $course->title }}
              </h1>
            </div>
          </div>

          {{-- Título + categoría + meta --}}
          <div class="mb-6">
            <div class="flex flex-wrap items-center gap-2 mb-4">
              <h1 class="text-3xl font-bold text-primary mr-2">
                {{ Str::upper($course->title) }}
              </h1>
              @if($course->category_label)
                <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold bg-secondary/10 text-secondary">
                  {{ $course->category_label }}
                </div>
              @endif
            </div>

            <div class="flex flex-wrap gap-4 text-sm text-gray-500 mb-6">
              @if($course->hours)
              <div class="flex items-center">
                {{-- Reloj (SVG inline para evitar dependencias) --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <circle cx="12" cy="12" r="10"></circle>
                  <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                {{ $course->hours }} horas
              </div>
              @endif
            </div>

            @if($course->description ?? $course->excerpt)
              <p class="text-gray-600 mb-6">
                {{ $course->description ?: $course->excerpt }}
              </p>
            @endif
          </div>
          {{-- Tabs: Contenido / Beneficios (con AlpineJS mínimo) --}}
          {{-- Tabs --}}
          <div class="w-full">
            <div class="h-10 grid grid-cols-2 items-center justify-center rounded-md bg-slate-100 p-1 text-slate-600"
                id="course-tabs"
                data-active="contenido">
              <button type="button"
                      class="tab-btn inline-flex items-center justify-center rounded-sm px-3 py-1.5 text-sm font-medium"
                      data-tab="contenido"
                      aria-selected="true">
                Contenido
              </button>

              <button type="button"
                      class="tab-btn inline-flex items-center justify-center rounded-sm px-3 py-1.5 text-sm font-medium"
                      data-tab="beneficios"
                      aria-selected="false">
                Beneficios
              </button>
            </div>

            {{-- Panel: Contenido --}}
            <div class="tab-panel p-4 border rounded-md mt-2" data-tab-panel="contenido">
              <h3 class="text-xl font-bold mb-4">Contenido del Curso</h3>

               @php
                  // Asegura que roots vengan con children cargados
                  $roots = $course->relationLoaded('rootContents') ? $course->rootContents : $course->rootContents()->get();
                @endphp

                @if($roots->isNotEmpty())
                  <div class="space-y-6">
                    @include('partials._content-tree', ['nodes' => $roots])
                  </div>
                @elseif(optional($course->detail)->outline_html)
                  {{-- Fallback si usas CourseDetail con outline_html almacenado (HTML seguro/procesado) --}}
                  <div class="prose max-w-none">
                    {!! $course->detail->outline_html !!}
                  </div>
                @else
                  <p class="text-slate-500">Pronto publicaremos el índice de este curso.</p>
                @endif
            </div>

            {{-- Panel: Beneficios (compartidos) --}}
            <div class="tab-panel p-4 border rounded-md mt-2 hidden" data-tab-panel="beneficios">
              <h3 class="text-xl font-bold mb-4">Beneficios del Curso</h3>
              @include('partials.course-benefits')
            </div>
          </div>

          
        </div>

        {{-- Columna derecha (CTA sticky) --}}
        <div class="lg:col-span-1">
          <div class="sticky top-24 bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-2xl font-bold mb-4">¿Te interesa este curso?</h3>

            <div class="flex items-center justify-between mb-6">
              <span class="text-xl font-bold text-primary">Solicita información</span>
              <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold bg-primary/10 text-primary">
                Disponible
              </div>
            </div>

            <div class="space-y-4 mb-6">
              <div class="flex items-center">
                @include('partials._check', ['class' => 'h-5 w-5 mr-2 text-primary'])
                <span>Información detallada del curso</span>
              </div>
              <div class="flex items-center">
                @include('partials._check', ['class' => 'h-5 w-5 mr-2 text-primary'])
                <span>Fechas y horarios disponibles</span>
              </div>
              <div class="flex items-center">
                @include('partials._check', ['class' => 'h-5 w-5 mr-2 text-primary'])
                <span>Opciones de implementación</span>
              </div>
              <div class="flex items-center">
                @include('partials._check', ['class' => 'h-5 w-5 mr-2 text-primary'])
                <span>Presupuesto personalizado</span>
              </div>
            </div>

            <a href="{{ route('contact') }}"
               class="inline-flex items-center justify-center gap-2 rounded-md text-sm font-medium text-white h-10 px-4 py-2 w-full bg-primary hover:bg-primary/90 mb-4">
              Contactar ahora
            </a>

            <p class="text-sm text-gray-500 mt-4 text-center">
              ¿Tienes preguntas? Escríbenos a <br>
              <span class="font-semibold">info@agconsultores.com</span>
            </p>
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
  const tabsRoot = document.getElementById('course-tabs');
  if (!tabsRoot) return;

  const btns = tabsRoot.querySelectorAll('.tab-btn');
  const panels = document.querySelectorAll('.tab-panel');

  // helpers
  const setActive = (name) => {
    // botones
    btns.forEach(b => {
      const isActive = b.dataset.tab === name;
      b.setAttribute('aria-selected', isActive ? 'true' : 'false');
      b.classList.toggle('bg-white', isActive);
      b.classList.toggle('shadow', isActive);
      b.classList.toggle('text-slate-900', isActive);
      b.classList.toggle('text-slate-600', !isActive);
    });
    // paneles
    panels.forEach(p => {
      const show = p.dataset.tabPanel === name;
      p.classList.toggle('hidden', !show);
    });
    tabsRoot.dataset.active = name;
  };

  // estado inicial (por si cambia desde blade)
  setActive(tabsRoot.dataset.active || 'contenido');

  // eventos
  btns.forEach(b => {
    b.addEventListener('click', () => setActive(b.dataset.tab));
  });
});
</script>
@endpush

