<footer class="bg-gray-900 text-white">
  <div class="container mx-auto px-4 py-12 md:px-6 md:py-16 max-w-7xl">
    <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
      <div>
        <a href="{{ route('home') }}" class="flex items-center gap-2 mb-4 group">
          <div class="relative w-10 h-10 overflow-hidden transform transition-transform duration-300 group-hover:scale-110">
            <img src="{{ asset('logo.svg') }}" alt="Logo" width="40" height="40" class="transition-transform duration-500 group-hover:rotate-12">
          </div>
          <span class="text-xl font-bold group-hover:text-primary transition-colors">A&amp;G Consultores</span>
        </a>
        <p class="text-gray-400 mb-4 max-w-xs">
          Contribuimos en la búsqueda constante de la esencia del desarrollo humano a través de capacitación y consultoría integral y colaborativa.
        </p>
      </div>

      <div>
        <h3 class="text-lg font-semibold mb-4">Enlaces Rápidos</h3>
        <ul class="space-y-2 text-gray-400">
          <li><a href="{{ route('home') }}" class="hover:text-white">Inicio</a></li>
          <li><a href="{{ route('courses.index') }}" class="hover:text-white">Cursos</a></li>
          <li><a href="{{ route('about') }}" class="hover:text-white">Nosotros</a></li>
          <li><a href="{{ route('contacto.contacto') }}" class="hover:text-white">Contacto</a></li>
        </ul>
      </div>

      <div>
        <h3 class="text-lg font-semibold mb-4">Cursos</h3>
        <ul class="space-y-2 text-gray-400">
          <li><a href="{{ route('courses.category','desarrollo-personal') }}" class="hover:text-white">Desarrollo Personal</a></li>
          <li><a href="{{ route('courses.category','liderazgo') }}" class="hover:text-white">Liderazgo</a></li>
          <li><a href="{{ route('courses.category','inteligencia-emocional') }}" class="hover:text-white">Inteligencia Emocional</a></li>
          <li><a href="{{ route('courses.category','comunicacion') }}" class="hover:text-white">Comunicación Efectiva</a></li>
          <li><a href="{{ route('courses.category','coaching') }}" class="hover:text-white">Coaching</a></li>
        </ul>
      </div>

      <div>
        <h3 class="text-lg font-semibold mb-4">Contacto</h3>
        <ul class="space-y-4 text-gray-400">
          <li class="flex items-center">
            <!-- Ícono map-pin -->
            <svg xmlns="http://www.w3.org/2000/svg" 
                 fill="none" viewBox="0 0 24 24" 
                 stroke-width="2" stroke="currentColor" 
                 class="w-10 h-10 mr-2 text-primary">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 21c-4-4.5-7-8-7-11a7 7 0 1 1 14 0c0 3-3 6.5-7 11z"/>
              <circle cx="12" cy="10" r="3"/>
            </svg>
            Monte Sinaí #144-B, col. Vista Hermosa, Santiago de Querétaro
          </li>
          <li class="flex items-center">
            <!-- Ícono mail -->
            <svg xmlns="http://www.w3.org/2000/svg" 
                 fill="none" viewBox="0 0 24 24" 
                 stroke-width="2" stroke="currentColor" 
                 class="w-5 h-5 mr-2 text-primary">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M4 4h16c.6 0 1 .4 1 1v14c0 .6-.4 1-1 1H4c-.6 0-1-.4-1-1V5c0-.6.4-1 1-1z"/>
              <path stroke-linecap="round" stroke-linejoin="round"
                d="m3 6 9 7 9-7"/>
            </svg>
            info@agconsultores.com
          </li>
        </ul>
      </div>
    </div>

    <div class="mt-12 border-t border-gray-800 pt-8 text-center text-sm text-gray-400">
      <p>© {{ now()->year }} A&amp;G Consultores. Todos los derechos reservados.</p>
    </div>
  </div>
</footer>
