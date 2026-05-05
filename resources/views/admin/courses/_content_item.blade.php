<li class="relative">
  @php
    $depth = $depth ?? 0;
    // Indentación visual según profundidad
    $marginLeft = $depth > 0 ? 'ml-8' : '';
    $borderColor = $depth === 0 ? 'border-slate-200 shadow-sm' : 'border-slate-100 bg-slate-50/50';
  @endphp

  @if($depth > 0)
    <!-- Línea conectora para hijos -->
    <div class="absolute left-[-20px] top-6 w-5 h-[2px] bg-slate-200"></div>
    <div class="absolute left-[-20px] top-[-10px] w-[2px] h-[34px] bg-slate-200"></div>
  @endif

  <div class="{{ $marginLeft }} rounded-2xl border {{ $borderColor }} bg-white p-5 transition-all hover:shadow-md">
    <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
      
      {{-- Información principal --}}
      <div class="flex-1 min-w-0 flex items-start gap-3">
        <div class="mt-1 flex-shrink-0">
          @if($item->type === 'section')
            <div class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-sm" title="Sección">S</div>
          @elseif($item->type === 'unit')
            <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-sm" title="Unidad">U</div>
          @elseif($item->type === 'exercise')
            <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center font-bold text-sm" title="Ejercicio">E</div>
          @else
            <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-sm" title="Tema">T</div>
          @endif
        </div>
        <div>
          <div class="flex items-center gap-2">
            <h4 class="font-bold text-slate-800 text-base">{{ $item->numbering ?? '' }} {{ $item->title }}</h4>
            <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-500 text-xs font-medium">{{ $types[$item->type] ?? ucfirst($item->type) }}</span>
          </div>
          @if($item->summary)
            <p class="mt-1 text-sm text-slate-500 leading-relaxed">{{ $item->summary }}</p>
          @endif
        </div>
      </div>

      {{-- Acciones (Botones) --}}
      <div class="flex items-center gap-1.5 shrink-0 bg-slate-50 p-1.5 rounded-xl border border-slate-100">
        {{-- Reordenar --}}
        @php
          $siblings = ($item->parent_id)
            ? $item->parent->children->sortBy('sort_order')->values()
            : $course->rootContents->sortBy('sort_order')->values();
          $ids = $siblings->pluck('id')->all();
          $idx = $siblings->search(fn($c) => $c->id === $item->id);
          $idsUp   = $ids; if ($idx > 0) { [$idsUp[$idx-1], $idsUp[$idx]] = [$idsUp[$idx], $idsUp[$idx-1]]; }
          $idsDown = $ids; if ($idx < count($ids)-1) { [$idsDown[$idx+1], $idsDown[$idx]] = [$idsDown[$idx], $idsDown[$idx+1]]; }
        @endphp
        
        <form action="{{ route('admin.courses.contents.reorder', $course) }}" method="POST" class="inline">
          @csrf <input type="hidden" name="parent_id" value="{{ $item->parent_id }}">
          @if($idx > 0)
            @foreach($idsUp as $id) <input type="hidden" name="items[]" value="{{ $id }}"> @endforeach
            <button class="p-1.5 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-white transition-colors" title="Subir">
              <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" /></svg>
            </button>
          @else
            <div class="w-7"></div>
          @endif
        </form>

        <form action="{{ route('admin.courses.contents.reorder', $course) }}" method="POST" class="inline">
          @csrf <input type="hidden" name="parent_id" value="{{ $item->parent_id }}">
          @if($idx < count($ids)-1)
            @foreach($idsDown as $id) <input type="hidden" name="items[]" value="{{ $id }}"> @endforeach
            <button class="p-1.5 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-white transition-colors" title="Bajar">
              <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7 7" /></svg>
            </button>
          @else
            <div class="w-7"></div>
          @endif
        </form>

        <div class="w-px h-4 bg-slate-200 mx-1"></div>

        {{-- Editar (modal) --}}
        <button
          type="button"
          class="p-1.5 rounded-lg text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 transition-colors"
          title="Editar"
          data-modal="edit"
          data-payload='{{ json_encode([
            "action" => route("admin.courses.contents.update", [$course, $item]),
            "title" => $item->title,
            "type" => $item->type,
            "parent_id" => $item->parent_id,
            "summary" => $item->summary,
            "body" => $item->body,
            "label" => trim(($item->numbering ?? "")." ".$item->title),
          ], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) }}'
        >
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
        </button>

        {{-- Agregar sub-contenido (modal) --}}
        <button
          type="button"
          class="p-1.5 rounded-lg text-slate-500 hover:text-emerald-600 hover:bg-emerald-50 transition-colors"
          title="Añadir Sub-contenido"
          data-modal="add"
          data-payload='{{ json_encode([
            "action" => route("admin.courses.contents.store", $course),
            "parent_id" => $item->id,
            "parent_title" => $item->title,
          ], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) }}'
        >
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
        </button>

        <div class="w-px h-4 bg-slate-200 mx-1"></div>

        {{-- Eliminar --}}
        <form action="{{ route('admin.courses.contents.destroy', [$course, $item]) }}" method="POST"
              onsubmit="return confirm('¿Estás seguro de que deseas eliminar este ítem y todo su contenido interno?')" class="inline">
          @csrf @method('DELETE')
          <button class="p-1.5 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition-colors" title="Eliminar">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
          </button>
        </form>

      </div>
    </div>
  </div>

  {{-- Hijos (1 nivel más) --}}
  @if($item->children->isNotEmpty())
    <div class="relative mt-3">
      <!-- Línea vertical conectora principal -->
      <div class="absolute left-4 top-0 w-[2px] h-full bg-slate-200 -z-10"></div>
      <ol class="space-y-3 relative z-0">
        @foreach($item->children as $child)
          @include('admin.courses._content_item', ['item' => $child, 'course' => $course, 'types' => $types, 'depth' => $depth + 1])
        @endforeach
      </ol>
    </div>
  @endif
</li>
