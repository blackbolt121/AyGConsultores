@php
  // Cargar árbol básico (ajusta profundidad si quieres)
  $course->loadMissing(['rootContents.children' /* , 'rootContents.children.children' */ ]);
  $types = [
    'section'  => 'Sección',
    'unit'     => 'Unidad',
    'topic'    => 'Tema',
    'exercise' => 'Ejercicio',
    'appendix' => 'Apéndice',
  ];
@endphp

<div class="mt-12 bg-white rounded-3xl border border-slate-100 p-8 md:p-10 shadow-[0_8px_30px_rgb(0,0,0,0.04)] relative overflow-hidden">
  <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-400 to-indigo-500"></div>
  
  <div class="flex items-center justify-between mb-8">
      <div>
          <h3 class="text-2xl font-bold text-slate-900">Temario del Curso</h3>
          <p class="text-slate-500 text-sm mt-1">Organiza las secciones, unidades y materiales.</p>
      </div>
  </div>

  {{-- Crear raíz --}}
  <details class="mb-8 group">
    <summary class="cursor-pointer list-none">
        <div class="inline-flex items-center justify-center rounded-xl bg-indigo-50 text-indigo-700 px-5 py-3 text-sm font-semibold hover:bg-indigo-100 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            Agregar Sección Principal
        </div>
    </summary>
    <div class="mt-4 p-6 rounded-2xl border border-slate-200 bg-slate-50">
        <h4 class="text-sm font-semibold text-slate-800 mb-4">Nueva Sección</h4>
        <form action="{{ route('admin.courses.contents.store', $course) }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-5">
        @csrf
        <input type="hidden" name="parent_id" value="">
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-slate-700 mb-1">Título *</label>
            <input type="text" name="title" required class="block w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-sm outline-none transition-colors placeholder:text-slate-400" placeholder="Ej. Introducción al curso">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Tipo</label>
            <div class="relative">
                <select name="type" class="block w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-sm outline-none transition-colors appearance-none">
                @foreach($types as $val => $label)
                    <option value="{{ $val }}">{{ $label }}</option>
                @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                </div>
            </div>
        </div>
        <div class="md:col-span-3">
            <label class="block text-sm font-medium text-slate-700 mb-1">Resumen (Opcional)</label>
            <textarea name="summary" rows="2" class="block w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-sm outline-none transition-colors placeholder:text-slate-400" placeholder="Breve descripción de la sección..."></textarea>
        </div>
        <div class="md:col-span-3 flex justify-end">
            <button type="submit" class="inline-flex items-center rounded-xl bg-indigo-600 px-6 py-2.5 text-sm font-medium text-white hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-500/20 transition-colors shadow-sm">
                Guardar Sección
            </button>
        </div>
        </form>
    </div>
  </details>

  {{-- Árbol --}}
  @if($course->rootContents->isEmpty())
    <div class="text-center py-12 px-4 rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50">
        <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
        <p class="text-slate-500 font-medium">Aún no hay contenido en este curso.</p>
        <p class="text-slate-400 text-sm mt-1">Haz clic en "Agregar Sección Principal" para comenzar a construir el temario.</p>
    </div>
  @else
    <ol class="space-y-4">
      @foreach($course->rootContents as $root)
        @include('admin.courses._content_item', ['item' => $root, 'course' => $course, 'types' => $types, 'depth' => 0])
      @endforeach
    </ol>
  @endif
</div>
