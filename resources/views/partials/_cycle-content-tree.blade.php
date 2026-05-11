@foreach($nodes as $node)
  @php
    $material = $materials[$node->id] ?? null;
    $hasPdf = $material && $material->content_type === 'pdf' && $material->file_path;
    $hasText = $material && $material->content_type === 'text' && is_string($material->body) && trim($material->body) !== '';
    $hasMaterial = $hasPdf || $hasText;
    $hasChildren = $node->children && $node->children->isNotEmpty();
    $childrenId = 'cycle-children-'.$node->id;
    $isCompleted = !empty(($completedContentIds ?? [])[$node->id]);
  @endphp
  <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm">
    <div class="flex items-start justify-between gap-4">
      <div class="min-w-0 flex items-start gap-3">
        @if($hasChildren)
          <button
            type="button"
            class="mt-0.5 inline-flex h-8 w-8 items-center justify-center rounded-lg border border-gray-200 bg-white text-gray-600 hover:bg-gray-50"
            data-acc-toggle="{{ $childrenId }}"
            aria-controls="{{ $childrenId }}"
            aria-expanded="false"
            title="Expandir/Colapsar"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="cycle-chevron h-4 w-4 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
            </svg>
          </button>
        @else
          <div class="mt-0.5 h-8 w-8" aria-hidden="true"></div>
        @endif

        <div class="min-w-0">
          <h4 class="font-semibold text-gray-900">
            @if(method_exists($node, 'getNumberingAttribute'))
              <span class="text-gray-500">{{ $node->numbering }}.</span>
            @endif
            {{ $node->title }}
          </h4>

          @if($node->summary)
            <p class="text-sm text-gray-600 mt-1">{{ $node->summary }}</p>
          @endif
        </div>
      </div>

      <div class="shrink-0 flex items-center gap-2">
        @if($isCompleted)
          <span class="hidden sm:inline-flex items-center rounded-md bg-emerald-50 px-2 py-1 text-xs font-medium text-emerald-700 ring-1 ring-inset ring-emerald-700/10">
            <svg class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M16.704 5.29a1 1 0 0 1 .006 1.414l-7.5 7.57a1 1 0 0 1-1.42.003L3.296 9.7a1 1 0 1 1 1.408-1.418l3.09 3.065 6.79-6.857a1 1 0 0 1 1.42-.001Z" clip-rule="evenodd"/></svg>
            Completado
          </span>
        @endif

        @if($hasMaterial)
          <span class="hidden sm:inline-flex items-center rounded-md bg-slate-50 px-2 py-1 text-xs font-medium text-slate-700 ring-1 ring-inset ring-slate-700/10">{{ $hasPdf ? 'PDF' : 'Texto' }}</span>
          <a href="{{ route('ciclos.material.mostrar', ['ciclo' => $cycle->id, 'contenido' => $node->id]) }}"
             class="inline-flex items-center rounded-xl bg-primary px-3 py-2 text-xs font-medium text-white hover:bg-primary/90">
            Ver material
          </a>
        @endif
      </div>
    </div>

    @if($hasChildren)
      <div id="{{ $childrenId }}" class="hidden pl-6 mt-3 border-l border-gray-200">
        <div class="space-y-3">
          @include('partials._cycle-content-tree', ['nodes' => $node->children, 'cycle' => $cycle, 'materials' => $materials, 'completedContentIds' => ($completedContentIds ?? [])])
        </div>
      </div>
    @endif
  </div>
@endforeach
