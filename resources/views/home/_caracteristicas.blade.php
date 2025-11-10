<section class="relative py-20 overflow-hidden">
  <div class="absolute inset-0 -z-10">
    <div class="absolute inset-0 bg-gradient-to-b from-white via-gray-50/50 to-white"></div>
    <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-primary/20 to-transparent"></div>
    <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-secondary/20 to-transparent"></div>
    <div class="absolute top-20 right-10 h-40 w-40 rounded-full bg-primary/5 blur-3xl"></div>
    <div class="absolute bottom-20 left-10 h-40 w-40 rounded-full bg-secondary/5 blur-3xl"></div>
  </div>

  <div class="container mx-auto px-4 md:px-6 max-w-7xl">
    <div class="flex flex-col items-center space-y-4 text-center mb-16">
      <h2 class="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl bg-gradient-to-r from-primary via-secondary to-purple-600 bg-clip-text text-transparent">
        Características Clave
      </h2>
      <p class="max-w-[700px] text-gray-600 md:text-xl">Descubre lo que hace única nuestra metodología empresarial</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      {{-- Desarrollo Cognitivo --}}
      <div class="group">
        <div class="flex flex-col h-full bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-lg hover:border-primary/20 overflow-hidden">
          <div class="h-48 relative overflow-hidden">
            <img src="{{ asset('images/desarrollo-cognitivo.jpg') }}" alt="Desarrollo Cognitivo" class="object-cover w-full h-full group-hover:scale-110 transition-transform">
            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
          </div>
          <div class="p-6 flex-grow flex flex-col">
            <h3 class="text-xl font-bold mb-3 text-primary">Desarrollo Cognitivo</h3>
            <p class="text-gray-600 mb-4">Potenciamos habilidades mentales para mejorar toma de decisiones y resolución de problemas.</p>
            <ul class="space-y-2 text-sm">
              <li class="flex items-start">@includeWhen(true,'partials._check', ['class' => 'text-primary']) Pensamiento crítico y analítico</li>
              <li class="flex items-start">@includeWhen(true,'partials._check', ['class' => 'text-primary']) Creatividad e innovación</li>
              <li class="flex items-start">@includeWhen(true,'partials._check', ['class' => 'text-primary']) Resolución estratégica de problemas</li>
            </ul>
          </div>
        </div>
      </div>

      {{-- Crecimiento Personal (ojo con nombre de archivo) --}}
      <div class="group">
        <div class="flex flex-col h-full bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-lg hover:border-secondary/20 overflow-hidden">
          <div class="h-48 relative overflow-hidden">
            <img src="{{ asset('images/creciemiento-personal.jpg') }}" alt="Crecimiento Personal" class="object-cover w-full h-full group-hover:scale-110 transition-transform">
            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
          </div>
          <div class="p-6 flex-grow flex flex-col">
            <h3 class="text-xl font-bold mb-3 text-secondary">Crecimiento Personal</h3>
            <p class="text-gray-600 mb-4">Facilitamos tu desarrollo integral, ayudándote a descubrir y potenciar tus capacidades únicas.</p>
            <ul class="space-y-2 text-sm">
              <li class="flex items-start">@includeWhen(true,'partials._check', ['class' => 'text-secondary']) Autoconocimiento por inteligencia emocional</li>
              <li class="flex items-start">@includeWhen(true,'partials._check', ['class' => 'text-secondary']) Habilidades socioemocionales</li>
            </ul>
          </div>
        </div>
      </div>

      {{-- Colaboración Efectiva --}}
      <div class="group">
        <div class="flex flex-col h-full bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-lg hover:border-primary/20 overflow-hidden">
          <div class="h-48 relative overflow-hidden">
            <img src="{{ asset('images/colab-efectiva.jpg') }}" alt="Colaboración Efectiva" class="object-cover w-full h-full group-hover:scale-110 transition-transform">
            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
          </div>
          <div class="p-6 flex-grow flex flex-col">
            <h3 class="text-xl font-bold mb-3 text-primary">Consultoría y Capacitación Integral Colaborativa</h3>
            <p class="text-gray-600 mb-4">Desarrolla habilidades para construir relaciones profesionales sólidas y trabajar en equipo.</p>
            <ul class="space-y-2 text-sm">
              <li class="flex items-start">@includeWhen(true,'partials._check', ['class' => 'text-primary']) Comunicación asertiva</li>
              <li class="flex items-start">@includeWhen(true,'partials._check', ['class' => 'text-primary']) Equipos de alto desempeño</li>
              <li class="flex items-start">@includeWhen(true,'partials._check', ['class' => 'text-primary']) Toma de decisiones y solución de problemas</li>
              <li class="flex items-start">@includeWhen(true,'partials._check', ['class' => 'text-primary']) Indicadores de desempeño</li>
            </ul>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
