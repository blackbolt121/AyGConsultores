@props([
    // Texto superior tipo “pill”
    'badge' => 'Transformando potencial en excelencia',

    // Título principal
    'title' => 'A&G Consultores',

    // Párrafo debajo del título
    'subtitle' => 'Capacitación y consultoría integral que coadyuva a descubrir el potencial humano a través de metodología integral colaborativa.',

    // Botones principales
    'primary' => ['href' => '#', 'label' => 'Explorar Cursos'],
    'secondary' => ['href' => '#', 'label' => 'Conocer Más'],

    // Chips inferiores
    'features' => [
        ['icon' => 'brain', 'label' => 'Desarrollo Integral'],
        ['icon' => 'target',   'label' => 'Enfoque Personalizado'],
    ],

    // Imagen grande de la derecha
    'image' => asset('images/misty-forest.png'),

    // Tarjetas flotantes de iconitos alrededor de la imagen
    'floaters' => [
        ['icon' => 'brain',  'class' => 'top-[-18px] left-[-18px]'],
        ['icon' => 'target', 'class' => 'top-[-20px] right-[-18px]'],
        ['icon' => 'users',  'class' => 'bottom-[-18px] left-[-18px]'],
        ['icon' => 'badge',  'class' => 'bottom-[-18px] right-[-18px]'],
    ],
])

<section class="bg-gradient-to-br from-primary/5 via-secondary/5 to-purple-50 md:py-20 flex items-center">
  <div class="mx-auto max-w-7xl px-4 py-14 md:px-6 md:py-20">
    <div class="grid grid-cols-1 gap-10 lg:grid-cols-2 lg:items-center">
      {{-- Columna izquierda --}}
      <div>
        {{-- Pill / badge --}}
        <div class="inline-flex gap-2 items-center rounded-full border border-primary/30 bg-gradient-to-r from-primary/10 to-secondary/10 px-4 py-2 text-sm text-primary backdrop-blur-sm" style="opacity: 1; transform: none;">
          <!-- SVG del ícono de "sparkles" (destellos) -->
          <x-shared.icons.sparkles class="w-5 h-5 text-primary"/>
          <!-- Texto del componente -->
          <span class="font-medium text-sm text-indigo-800">
              {{ $badge }}
          </span>
        </div>
        

        {{-- Título con gradiente --}}
        <h1 class="mt-5 text-4xl font-extrabold leading-tight tracking-tight sm:text-5xl md:text-6xl">
          <span class="bg-gradient-to-r from-primary via-secondary to-purple-600 bg-clip-text text-transparent">
            {{ $title }}
          </span>
        </h1>

        {{-- Subtítulo --}}
        <p class="mt-5 max-w-2xl text-slate-600">
          {{ $subtitle }}
        </p>

        {{-- Botones --}}
        <div class="mt-8 flex flex-wrap items-center gap-4 text-white">
          <a href="{{ $primary['href'] }}"
             class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 bg-primary text-primary-foreground hover:bg-primary/90 h-11 rounded-md px-8 bg-gradient-to-r from-primary to-secondary">
            <span>{{ $primary['label'] }}</span>
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
          </a>

          <a href="{{ $secondary['href'] }}"
             class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3 text-slate-700 shadow-sm transition hover:shadow-md">
            {{ $secondary['label'] }}
          </a>
        </div>

        {{-- Chips de beneficios --}}
        <div class="mt-8 flex flex-wrap gap-6">
          @foreach ($features as $f)
            <div class="flex items-center gap-3">
              <div class="flex h-9 w-9 items-center justify-center rounded-full bg-primary/10">
                @include('components.shared.icons.' . $f['icon'], ['class' => 'h-5 w-5 text-primary'])
              </div>
              
              <span class="text-sm font-medium text-slate-700">{{ $f['label'] }}</span>
            </div>
          @endforeach
        </div>
      </div>

      {{-- Columna derecha: imagen con bordes y flotantes --}}
      <div class="relative mx-auto w-full max-w-xl">
        <div class="rounded-3xl border border-slate-200 bg-white p-2 shadow-xl">
          <img src="{{ $image }}" alt="AGC Cover"
               class="h-[360px] w-full rounded-2xl object-cover md:h-[420px]">
        </div>

        {{-- Íconos flotantes --}}
        @foreach ($floaters as $fl)
          <div class="absolute {{ $fl['class'] }}">
            <div class="rounded-2xl bg-white p-3 shadow-lg ring-1 ring-slate-200 animate-slide-up">
              @include('components.shared.icons.' . $fl['icon'], ['class' => 'h-5 w-5 text[#5272FF]'])
            </div>
          </div>
        @endforeach

        {{-- Partículas sutiles (opcionales) --}}
        <div class="pointer-events-none absolute inset-0 -z-10">
          <div class="absolute left-1/4 top-1/4 h-2 w-2 rounded-full bg[#5272FF]/10"></div>
          <div class="absolute right-1/3 top-10 h-1.5 w-1.5 rounded-full bg[#1C9AEA]/10"></div>
        </div>
      </div>
    </div>
  </div>
</section>
