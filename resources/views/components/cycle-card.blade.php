@props([
    'course',
    'cycle',
    'href' => null,
    'accessible' => true,
    'badge' => null,
    'meta' => null,
])

@php
    $title = $course?->title ?? 'Curso';
    $cycleName = $cycle?->name ?? 'Ciclo';

    // Prefer the same image field used by the landing card; fall back to image_url if present.
    $img = null;
    if ($course) {
        $img = $course->image ?? null;
        if (!$img && isset($course->image_url)) {
            $img = $course->image_url;
        }
    }
    $img = $img ?: asset('images/placeholder.png');

    $isDisabled = !$accessible || !$href;

    $chipText = null;
    $chipClasses = null;
    if (is_string($badge) && $badge !== '') {
        if ($badge === 'Sin acceso') {
            $chipText = $badge;
            $chipClasses = 'bg-red-50 text-red-700 ring-red-700/10';
        } elseif (str_starts_with($badge, 'Estado: ')) {
            $raw = trim(substr($badge, strlen('Estado: ')));
            $chipText = 'Estado: '.$raw;

            // Color uses the backend key when possible; if label is already translated, fall back to neutral.
            $st = $raw;
            $labelToKey = [
                'Activo' => 'active',
                'Abierto' => 'open',
                'Borrador' => 'draft',
                'Cerrado' => 'closed',
                'Archivado' => 'archived',
            ];
            if (isset($labelToKey[$st])) {
                $st = $labelToKey[$st];
            }
            $chipClasses = match ($st) {
                'active' => 'bg-emerald-50 text-emerald-700 ring-emerald-700/10',
                'open' => 'bg-blue-50 text-blue-700 ring-blue-700/10',
                'draft' => 'bg-gray-50 text-gray-700 ring-gray-700/10',
                'closed' => 'bg-amber-50 text-amber-700 ring-amber-700/10',
                'archived' => 'bg-slate-100 text-slate-700 ring-slate-700/10',
                default => 'bg-gray-50 text-gray-700 ring-gray-700/10',
            };
        } else {
            $chipText = $badge;
            $chipClasses = 'bg-gray-50 text-gray-700 ring-gray-700/10';
        }
    }
@endphp

<div class="rounded-2xl bg-card text-card-foreground shadow-sm group overflow-hidden border border-gray-200/50 transition-all duration-300 hover:shadow-xl hover:border-primary/20 hover:-translate-y-1">
    <div class="relative h-56 w-full overflow-hidden">
        <img alt="{{ $title }}" loading="lazy" decoding="async" class="object-cover transition-transform duration-500 group-hover:scale-110" src="{{ $img }}" style="position:absolute;height:100%;width:100%;inset:0;color:transparent;" />
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
    </div>

    <div class="p-6 group-hover:bg-gray-50/50 transition-colors duration-300">
        <div class="flex items-start justify-between gap-3">
            <div class="min-w-0">
                <p class="font-semibold tracking-tight text-lg line-clamp-2 group-hover:text-primary transition-colors duration-300">{{ $title }}</p>
                <p class="text-sm text-gray-600 mt-1">{{ $cycleName }}</p>
            </div>

            @if($chipText)
                <span class="shrink-0 inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $chipClasses }}">
                    {{ $chipText }}
                </span>
            @endif
        </div>

        @if($meta)
            <p class="text-xs text-gray-500 mt-3">{{ $meta }}</p>
        @endif
    </div>

    <div class="p-6 pt-0 group-hover:bg-gray-50/50 transition-colors duration-300">
        @if($isDisabled)
            <button type="button" aria-disabled="true" class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-gray-200 px-4 py-2 text-sm font-medium text-gray-600 cursor-not-allowed">
                Entrar
            </button>
        @else
            <a class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-primary px-4 py-2 text-sm font-medium text-white hover:bg-primary/90" href="{{ $href }}">
                Entrar
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        @endif
    </div>
</div>
