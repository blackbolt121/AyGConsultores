<li class="rounded-xl border border-gray-200 bg-white p-4">
  <div class="flex flex-wrap items-start justify-between gap-3">
    <div class="min-w-0">
      <div class="font-medium text-gray-900">{{ $item->numbering ?? '' }} {{ $item->title }}</div>
      <div class="mt-1 text-xs text-gray-500">{{ ucfirst($item->type) }}</div>
      @if($item->summary)
        <div class="mt-1 text-sm text-gray-700">{{ $item->summary }}</div>
      @endif
    </div>

    <div class="flex items-center gap-2">
      {{-- Botones reordenar (up/down) --}}
      <form action="{{ route('admin.courses.contents.reorder', $course) }}" method="POST" class="inline">
        @csrf
        <input type="hidden" name="parent_id" value="{{ $item->parent_id }}">
        @php
          $siblings = ($item->parent_id)
            ? $item->parent->children->sortBy('sort_order')->values()
            : $course->rootContents->sortBy('sort_order')->values();
          $ids = $siblings->pluck('id')->all();
          $idx = $siblings->search(fn($c) => $c->id === $item->id);
          $idsUp   = $ids; if ($idx > 0) { [$idsUp[$idx-1], $idsUp[$idx]] = [$idsUp[$idx], $idsUp[$idx-1]]; }
          $idsDown = $ids; if ($idx < count($ids)-1) { [$idsDown[$idx+1], $idsDown[$idx]] = [$idsDown[$idx], $idsDown[$idx+1]]; }
        @endphp
        @if($idx > 0)
          @foreach($idsUp as $id) <input type="hidden" name="items[]" value="{{ $id }}"> @endforeach
          <button class="rounded-lg border px-2 py-1 text-sm hover:bg-gray-50" title="Subir">↑</button>
        @endif
      </form>

      <form action="{{ route('admin.courses.contents.reorder', $course) }}" method="POST" class="inline">
        @csrf
        <input type="hidden" name="parent_id" value="{{ $item->parent_id }}">
        @foreach($idsDown as $id) <input type="hidden" name="items[]" value="{{ $id }}"> @endforeach
        @if($idx < count($ids)-1)
          <button class="rounded-lg border px-2 py-1 text-sm hover:bg-gray-50" title="Bajar">↓</button>
        @endif
      </form>

      {{-- Editar toggle --}}
      <details class="inline-block">
        <summary class="cursor-pointer rounded-lg border px-2 py-1 text-sm hover:bg-gray-50">Editar</summary>
        <form action="{{ route('admin.courses.contents.update', [$course, $item]) }}" method="POST" class="mt-2 grid grid-cols-1 md:grid-cols-3 gap-3">
          @csrf @method('PUT')
          <div class="md:col-span-3">
            <label class="block text-sm text-gray-700">Título *</label>
            <input type="text" name="title" value="{{ old('title', $item->title) }}" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary" required>
          </div>
          <div>
            <label class="block text-sm text-gray-700">Tipo</label>
            <select name="type" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary">
              @foreach($types as $val => $label)
                <option value="{{ $val }}" @selected($item->type === $val)>{{ $label }}</option>
              @endforeach
            </select>
          </div>
          <div>
            <label class="block text-sm text-gray-700">Mover a</label>
            <select name="parent_id" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary">
              <option value="" @selected(!$item->parent_id)>Raíz</option>
              @foreach($course->rootContents as $rootOption)
                <option value="{{ $rootOption->id }}" @selected($item->parent_id === $rootOption->id)>
                  {{ $rootOption->title }}
                </option>
              @endforeach
            </select>
          </div>
          <div class="md:col-span-3">
            <label class="block text-sm text-gray-700">Resumen</label>
            <textarea name="summary" rows="2" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary">{{ old('summary', $item->summary) }}</textarea>
          </div>
          <div class="md:col-span-3">
            <label class="block text-sm text-gray-700">Contenido (body)</label>
            <textarea name="body" rows="4" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary">{{ old('body', $item->body) }}</textarea>
          </div>
          <div class="md:col-span-3">
            <button class="rounded-lg bg-primary px-3 py-1.5 text-white hover:bg-primary/90">Guardar cambios</button>
          </div>
        </form>
      </details>

      {{-- Eliminar --}}
      <form action="{{ route('admin.courses.contents.destroy', [$course, $item]) }}" method="POST"
            onsubmit="return confirm('¿Eliminar este ítem y sus hijos?')" class="inline">
        @csrf @method('DELETE')
        <button class="rounded-lg border border-red-500 bg-white px-2 py-1 text-sm text-red-600 hover:bg-red-600 hover:text-white">
          Eliminar
        </button>
      </form>

      {{-- Agregar hijo toggle --}}
      <details class="inline-block">
        <summary class="cursor-pointer rounded-lg border px-2 py-1 text-sm hover:bg-gray-50">+ Hijo</summary>
        <form action="{{ route('admin.courses.contents.store', $course) }}" method="POST" class="mt-2 grid grid-cols-1 md:grid-cols-3 gap-3">
          @csrf
          <input type="hidden" name="parent_id" value="{{ $item->id }}">
          <div class="md:col-span-3">
            <label class="block text-sm text-gray-700">Título *</label>
            <input type="text" name="title" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary" required>
          </div>
          <div>
            <label class="block text-sm text-gray-700">Tipo</label>
            <select name="type" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary">
              @foreach($types as $val => $label)
                <option value="{{ $val }}">{{ $label }}</option>
              @endforeach
            </select>
          </div>
          <div class="md:col-span-3">
            <label class="block text-sm text-gray-700">Resumen</label>
            <textarea name="summary" rows="2" class="mt-1 block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary"></textarea>
          </div>
          <div class="md:col-span-3">
            <button class="rounded-lg bg-primary px-3 py-1.5 text-white hover:bg-primary/90">Agregar hijo</button>
          </div>
        </form>
      </details>
    </div>
  </div>

  {{-- Hijos (1 nivel más) --}}
  @if($item->children->isNotEmpty())
    <ol class="ml-6 mt-3 space-y-3">
      @foreach($item->children as $child)
        @include('admin.courses._content_item', ['item' => $child, 'course' => $course, 'types' => $types])
      @endforeach
    </ol>
  @endif
</li>
