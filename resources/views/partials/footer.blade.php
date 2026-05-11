<footer class="bg-primary text-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
    <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
      <div>
        <div class="mb-4">
          @include('partials.brand', [
            'textClass' => 'text-white',
            'hoverTextClass' => 'group-hover:text-white/90',
            // The SVG is dark; invert it on dark footer background.
            'imgClass' => 'transition-transform duration-500 group-hover:rotate-12 filter brightness-0 invert',
          ])
        </div>
        <p class="text-white/75 mb-4 max-w-xs">
          Contribuimos en la búsqueda constante de la esencia del desarrollo humano a través de capacitación y consultoría integral y colaborativa.
        </p>
      </div>

      <div>
        <h3 class="text-lg font-semibold mb-4">Enlaces Rápidos</h3>
        <ul class="space-y-2 text-white/75">
          <li><a href="{{ route('home') }}" class="hover:text-white transition">Inicio</a></li>
          <li><a href="{{ route('courses.index') }}" class="hover:text-white transition">Cursos</a></li>
          <li><a href="{{ route('about') }}" class="hover:text-white transition">Nosotros</a></li>
          <li><a href="{{ route('contacto.contacto') }}" class="hover:text-white transition">Contacto</a></li>
        </ul>
      </div>

      <div>
        <h3 class="text-lg font-semibold mb-4">Cursos</h3>
        <ul class="space-y-2 text-white/75">
          <li><a href="{{ route('courses.category','desarrollo-personal') }}" class="hover:text-white transition">Desarrollo Personal</a></li>
          <li><a href="{{ route('courses.category','liderazgo') }}" class="hover:text-white transition">Liderazgo</a></li>
          <li><a href="{{ route('courses.category','inteligencia-emocional') }}" class="hover:text-white transition">Inteligencia Emocional</a></li>
          <li><a href="{{ route('courses.category','comunicacion') }}" class="hover:text-white transition">Comunicación Efectiva</a></li>
          <li><a href="{{ route('courses.category','coaching') }}" class="hover:text-white transition">Coaching</a></li>
        </ul>
      </div>

      <div>
        <h3 class="text-lg font-semibold mb-4">Contacto</h3>
        <ul class="space-y-4 text-white/75">
          <li class="flex items-center">
            <!-- Ícono mail -->
            <svg xmlns="http://www.w3.org/2000/svg" 
                 fill="none" viewBox="0 0 24 24" 
                 stroke-width="2" stroke="currentColor" 
                 class="w-5 h-5 mr-2 text-white/90">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M4 4h16c.6 0 1 .4 1 1v14c0 .6-.4 1-1 1H4c-.6 0-1-.4-1-1V5c0-.6.4-1 1-1z"/>
              <path stroke-linecap="round" stroke-linejoin="round"
                d="m3 6 9 7 9-7"/>
            </svg>
            contacto@aygconsultores.com.mx
          </li>
        </ul>
      </div>
    </div>

    <div class="mt-12 border-t border-white/15 pt-8 text-center text-sm text-white/70">
      <p>© {{ now()->year }} A&amp;G Consultoría. Todos los derechos reservados.</p>
    </div>
  </div>
</footer>
