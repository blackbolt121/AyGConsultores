<section class="py-16 md:py-24 relative overflow-hidden">
  <div class="absolute inset-0 bg-cover bg-center transition-all duration-1000"
       style="background-image:linear-gradient(rgba(0,0,0,.7), rgba(0,0,0,.7)), url('{{ asset('images/senor-landscape.png') }}'); background-size:120% auto;">
  </div>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
    <div class="text-center mb-12 md:mb-16 space-y-4">
      <span class="inline-flex items-center rounded-full border border-white/15 bg-white/10 px-3 py-1 text-sm font-medium text-white/90">Nuestro Enfoque</span>
      <h2 class="text-3xl md:text-5xl font-bold tracking-tight text-white">Metodología Transformadora</h2>
      <p class="text-gray-200 max-w-2xl mx-auto">Un proceso probado que garantiza resultados excepcionales y un impacto duradero.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-12 items-start">
      {{-- Pasos --}}
      <div>
        <div class="space-y-12">
          @php
            $steps = [
              ['n'=>'01','t'=>'Diagnóstico','d'=>'Analizamos a fondo la situación para identificar oportunidades de mejora.'],
              ['n'=>'02','t'=>'Diseño','d'=>'Creamos soluciones personalizadas alineadas a tus objetivos.'],
              ['n'=>'03','t'=>'Implementación','d'=>'Ejecución práctica con acompañamiento constante.'],
              ['n'=>'04','t'=>'Seguimiento','d'=>'Evaluación de resultados y ajustes para impacto sostenible.'],
            ];
          @endphp

          @foreach($steps as $s)
          <div class="flex gap-6">
            <div class="flex-shrink-0 w-16 h-16 rounded-2xl bg-white/10 flex items-center justify-center backdrop-blur-sm ring-1 ring-white/10">
              <span class="text-2xl font-bold text-white">{{ $s['n'] }}</span>
            </div>
            <div>
              <h3 class="text-xl font-bold text-white mb-2">{{ $s['t'] }}</h3>
              <p class="text-gray-300">{{ $s['d'] }}</p>
            </div>
          </div>
          @endforeach
        </div>
      </div>

      {{-- Imagen + beneficios --}}
      <div class="relative h-[500px] rounded-2xl overflow-hidden shadow-2xl ring-1 ring-white/10">
        <img src="{{ asset('images/bird-moon.png') }}" alt="Metodología transformadora" class="object-cover w-full h-full">
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
        <div class="absolute bottom-0 left-0 right-0 p-6 bg-black/30 backdrop-blur-sm">
          <h4 class="text-lg font-bold text-white mb-3">Beneficios de nuestra metodología</h4>
          <ul class="space-y-2 text-sm text-gray-200">
            <li class="flex items-center gap-2">@includeWhen(true,'partials._check', ['class' => 'text-tertiary']) Enfoque personalizado para cada organización</li>
            <li class="flex items-center gap-2">@includeWhen(true,'partials._check', ['class' => 'text-tertiary']) Basado en investigación y mejores prácticas</li>
            <li class="flex items-center gap-2">@includeWhen(true,'partials._check', ['class' => 'text-tertiary']) Orientado a resultados medibles y sostenibles</li>
            <li class="flex items-center gap-2">@includeWhen(true,'partials._check', ['class' => 'text-tertiary']) Integración de tecnología e innovación</li>
            <li class="flex items-center gap-2">@includeWhen(true,'partials._check', ['class' => 'text-tertiary']) Desarrollo de capacidades internas</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
