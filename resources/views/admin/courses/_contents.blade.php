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

<div class="container">
  <h3 class="text-lg font-semibold mb-4">Contenido del curso</h3>

  {{-- Crear raíz --}}
  <details class="mb-4 rounded-xl border border-gray-200 bg-white p-4">
    <summary class="cursor-pointer font-medium text-gray-800">+ Agregar sección raíz</summary>
    <form action="{{ route('admin.courses.contents.store', $course) }}" method="POST" class="mt-3 grid grid-cols-1 md:grid-cols-3 gap-3">
      @csrf
      <input type="hidden" name="parent_id" value="">
      <div>
        <label class="block text-sm text-gray-700">Título *</label>
        <input type="text" name="title" required class="mt-1 block w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary">
      </div>
      <div>
        <label class="block text-sm text-gray-700">Tipo</label>
        <select name="type" class="mt-1 block w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary">
          @foreach($types as $val => $label)
            <option value="{{ $val }}">{{ $label }}</option>
          @endforeach
        </select>
      </div>
      <div class="md:col-span-3">
        <label class="block text-sm text-gray-700">Resumen</label>
        <textarea name="summary" rows="2" class="mt-1 block w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary"></textarea>
      </div>
      <div class="md:col-span-3">
        <button class="inline-flex items-center rounded-lg bg-primary px-4 py-2 text-white hover:bg-primary/90">Agregar</button>
      </div>
    </form>
  </details>

  {{-- Árbol --}}
  @if($course->rootContents->isEmpty())
    <p class="text-gray-500">Aún no hay contenido. Agrega tu primera sección.</p>
  @else
    <ol class="ml-4 space-y-3">
      @foreach($course->rootContents as $root)
        @include('admin.courses._content_item', ['item' => $root, 'course' => $course, 'types' => $types])
      @endforeach
    </ol>
  @endif
</div>
