@props([
    // Texto superior tipo “pill”
    'badge' => 'Transformando potencial en excelencia',

    // Título principal
    'title' => 'A&G Consultoría',

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

<section class="bg-gradient-to-br from-primary/5 via-secondary/5 to-secondary/5 py-16 md:py-24 flex items-center">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 gap-10 lg:grid-cols-2 lg:items-center">
      {{-- Columna izquierda --}}
      <div class="space-y-6">
        {{-- Pill / badge --}}
        <div class="inline-flex gap-2 items-center rounded-full border border-primary/30 bg-gradient-to-r from-primary/10 to-secondary/10 px-4 py-2 text-sm text-primary backdrop-blur-sm" style="opacity: 1; transform: none;">
          <!-- SVG del ícono de "sparkles" (destellos) -->
          <x-shared.icons.sparkles class="w-5 h-5 text-primary"/>
          <!-- Texto del componente -->
          <span class="font-medium text-sm text-secondary">
              {{ $badge }}
          </span>
        </div>
        

        {{-- Título con gradiente --}}
        <h1 class="text-4xl md:text-6xl font-bold tracking-tight leading-tight">
          <span class="bg-gradient-to-r from-primary via-secondary to-secondary bg-clip-text text-transparent">
            {{ $title }}
          </span>
        </h1>

        {{-- Subtítulo --}}
        <p class="max-w-2xl text-slate-600 text-base sm:text-lg leading-relaxed">
          {{ $subtitle }}
        </p>

        {{-- Botones --}}
        <div class="flex flex-col sm:flex-row sm:flex-wrap items-stretch sm:items-center gap-3 text-white">
          <a href="{{ $primary['href'] }}"
             class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-xl px-6 py-3 text-sm font-medium bg-gradient-to-r from-primary to-secondary text-white shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/30">
            <span>{{ $primary['label'] }}</span>
            <x-icon name="lucide-arrow-right" class="h-4 w-4" />
          </a>

          <a href="{{ $secondary['href'] }}"
             class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-6 py-3 text-sm font-medium text-slate-700 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5">
            {{ $secondary['label'] }}
          </a>
        </div>

        {{-- Chips de beneficios --}}
        <div class="flex flex-wrap gap-6 pt-2">
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
