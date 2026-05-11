@php
  /** @var string $textClass */
  /** @var string $hoverTextClass */
  /** @var string $imgClass */
  $textClass = $textClass ?? 'text-primary';
  $hoverTextClass = $hoverTextClass ?? '';
  $imgClass = $imgClass ?? 'transition-transform duration-500 group-hover:rotate-12';
@endphp

<a href="{{ route('home') }}" class="flex items-center gap-2 group" aria-label="A&G Consultoría">
  <div class="relative w-10 h-10 overflow-hidden transform transition-transform duration-300 group-hover:scale-110">
    <img
      src="{{ asset('logo.svg') }}"
      alt="A&G Consultoría"
      class="{{ $imgClass }}"
      width="40"
      height="40"
    >
  </div>

  <span class="text-xl font-bold {{ $textClass }} {{ $hoverTextClass }} transition-colors">
    A&G Consultoría
  </span>
</a>
