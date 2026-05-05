@foreach($nodes as $node)
  @php
    $material = $materials[$node->id] ?? null;
    $hasPdf = $material && $material->content_type === 'pdf' && $material->file_path;
  @endphp
  <div class="border-b pb-4 last:border-0">
    <div class="flex items-start justify-between gap-4">
      <div class="min-w-0">
        <h4 class="font-bold mb-1">
          @if(method_exists($node, 'getNumberingAttribute'))
            {{ $node->numbering }}.
          @endif
          {{ $node->title }}
        </h4>

        @if($node->summary)
          <p class="text-gray-600 mb-2">{{ $node->summary }}</p>
        @endif
      </div>

      @if($hasPdf)
        <a href="{{ route('ciclos.material.mostrar', ['ciclo' => $cycle->id, 'contenido' => $node->id]) }}"
           class="shrink-0 inline-flex items-center rounded-xl bg-primary px-3 py-2 text-xs font-medium text-white hover:bg-primary/90">
          Ver material
        </a>
      @endif
    </div>

    @if($node->children && $node->children->isNotEmpty())
      <div class="pl-4 mt-3">
        @include('partials._cycle-content-tree', ['nodes' => $node->children, 'cycle' => $cycle, 'materials' => $materials])
      </div>
    @endif
  </div>
@endforeach
