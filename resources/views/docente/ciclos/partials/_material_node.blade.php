@php
  $material = $materials[$node->id] ?? null;
  $isLeaf = !$node->children || $node->children->isEmpty();
@endphp

<div class="border rounded-2xl border-gray-200 p-5">
  <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
    <div>
      <p class="font-semibold text-gray-900">
        @if(method_exists($node, 'getNumberingAttribute'))
          {{ $node->numbering }}.
        @endif
        {{ $node->title }}
      </p>
      @if($node->summary)
        <p class="text-sm text-gray-500 mt-1">{{ $node->summary }}</p>
      @endif
    </div>

    @if($isLeaf)
      <div class="w-full md:max-w-xl">
        <form method="POST" action="{{ route('docente.ciclos.material.actualizar', ['ciclo' => $cycle->id, 'contenido' => $node->id]) }}" enctype="multipart/form-data" class="space-y-3">
          @csrf
          @method('PUT')

          <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-semibold text-gray-600 mb-1">Tipo de material</label>
              <select name="content_type" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm">
                <option value="" @selected(!$material?->content_type)>Sin definir</option>
                <option value="text" @selected(($material?->content_type) === 'text')>Texto</option>
                <option value="pdf" @selected(($material?->content_type) === 'pdf')>PDF</option>
              </select>
            </div>
            <div>
              <label class="block text-xs font-semibold text-gray-600 mb-1">PDF (opcional)</label>
              <input type="file" name="file" accept="application/pdf" class="block w-full text-sm" />
              @if($material?->file_path)
                <p class="text-xs text-gray-500 mt-1">Archivo cargado.</p>
              @endif
            </div>
          </div>

          <div>
            <label class="block text-xs font-semibold text-gray-600 mb-1">Contenido (texto)</label>
            <textarea name="body" rows="3" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm">{{ old('body', $material?->body) }}</textarea>
          </div>

          <div class="flex justify-end">
            <button type="submit" class="inline-flex items-center rounded-xl bg-primary px-4 py-2 text-sm font-medium text-white hover:bg-primary/90">
              Guardar
            </button>
          </div>
        </form>
      </div>
    @endif
  </div>

  @if($node->children && $node->children->isNotEmpty())
    <div class="mt-4 pl-4 space-y-4">
      @foreach($node->children as $child)
        @include('docente.ciclos.partials._material_node', ['node' => $child, 'cycle' => $cycle, 'materials' => $materials])
      @endforeach
    </div>
  @endif
</div>
