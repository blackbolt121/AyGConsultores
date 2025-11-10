<section class="py-20 relative overflow-hidden">
  <div class="absolute inset-0 bg-cover bg-center transition-all duration-1000"
       style="background-image:linear-gradient(rgba(0,0,0,.7), rgba(0,0,0,.7)), url('{{ asset('images/senor-landscape.png') }}'); background-size:120% auto;">
  </div>

  <div class="container mx-auto px-4 md:px-6 max-w-7xl relative z-10">
    <div class="text-center mb-16">
      <span class="inline-block py-1 px-3 text-sm font-medium bg-white/20 text-white rounded-full mb-4">Nuestro Enfoque</span>
      <h2 class="text-3xl md:text-5xl font-bold mb-4 text-white">Metodología Transformadora</h2>
      <p class="text-gray-200 max-w-2xl mx-auto">Un proceso probado que garantiza resultados excepcionales y un impacto duradero.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 background-image:linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('senor-landscape.png');background-size:120% auto">
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
            <div class="flex-shrink-0 w-16 h-16 rounded-full bg-white/10 flex items-center justify-center backdrop-blur-sm">
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
      <div class="relative h-[500px] rounded-xl overflow-hidden shadow-2xl">
        <img src="{{ asset('images/bird-moon.png') }}" alt="Metodología transformadora" class="object-cover w-full h-full">
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
        <div class="absolute bottom-0 left-0 right-0 p-6 bg-black/30 backdrop-blur-sm">
          <h4 class="text-lg font-bold text-white mb-3">Beneficios de nuestra metodología</h4>
          <ul class="space-y-2 text-sm text-gray-200">
            <li class="flex items-center gap-2">@includeWhen(true,'partials._check', ['class' => 'text-green-600']) Enfoque personalizado para cada organización</li>
            <li class="flex items-center gap-2">@includeWhen(true,'partials._check', ['class' => 'text-green-600']) Basado en investigación y mejores prácticas</li>
            <li class="flex items-center gap-2">@includeWhen(true,'partials._check', ['class' => 'text-green-600']) Orientado a resultados medibles y sostenibles</li>
            <li class="flex items-center gap-2">@includeWhen(true,'partials._check', ['class' => 'text-green-600']) Integración de tecnología e innovación</li>
            <li class="flex items-center gap-2">@includeWhen(true,'partials._check', ['class' => 'text-green-600']) Desarrollo de capacidades internas</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
