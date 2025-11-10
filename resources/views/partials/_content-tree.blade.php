@foreach($nodes as $node)
  <div class="border-b pb-4 last:border-0">
    <h4 class="font-bold mb-2">
      {{-- Si usas $node->numbering del modelo --}}
      @if(method_exists($node, 'getNumberingAttribute'))
        {{ $node->numbering }}.
      @endif
      {{ $node->title }}
    </h4>

    @if($node->summary)
      <p class="text-gray-600 mb-2">{{ $node->summary }}</p>
    @endif

    {{-- Si el item tiene "puntos" (children) --}}
    @if($node->children && $node->children->isNotEmpty())
      <ul class="space-y-1">
        @foreach($node->children as $child)
          <li class="flex items-start">
            @include('partials._check', ['class' => 'h-4 w-4 mr-2 text-primary mt-1'])
            <span>
              {{-- Si quieres numeración en subniveles:
              @if(method_exists($child, 'getNumberingAttribute')) {{ $child->numbering }} @endif --}}
              {{ $child->title }}
            </span>
          </li>

          {{-- Subniveles anidados --}}
          @if($child->children && $child->children->isNotEmpty())
            <div class="pl-4 mt-2">
              @include('partials._content-tree', ['nodes' => $child->children])
            </div>
          @endif
        @endforeach
      </ul>
    @endif
  </div>
@endforeach
