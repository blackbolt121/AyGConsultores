<header class="sticky top-0 z-50 w-full border-b bg-white/95 backdrop-blur-sm">
  <div class="container mx-auto max-w-7xl flex h-16 items-center justify-between px-4 md:px-6">
    <a href="{{ route('home') }}" class="flex items-center gap-2 group">
      <div class="relative w-10 h-10 overflow-hidden transform transition-transform duration-300 group-hover:scale-110">
        <img src="{{ asset('logo.svg') }}" alt="Logo" class="transition-transform duration-500 group-hover:rotate-12" width="40" height="40">
      </div>
      <span class="text-xl font-bold text-primary group-hover:text-primary/80 transition-colors">A&amp;G Consultores</span>
    </a>

    <nav class="hidden md:flex gap-6">
      <a href="{{ route('home') }}" class="text-sm font-medium relative group">
        <span class="relative z-10 text-gray-700 group-hover:text-primary transition-colors">Inicio</span>
        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary group-hover:w-full transition-all"></span>
      </a>
      <a href="{{ route('courses.index') }}" class="text-sm font-medium relative group">
        <span class="relative z-10 text-gray-700 group-hover:text-primary transition-colors">Cursos</span>
        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary group-hover:w-full transition-all"></span>
      </a>
      <a href="{{ route('about') }}" class="text-sm font-medium relative group">
        <span class="relative z-10 text-gray-700 group-hover:text-primary transition-colors">Nosotros</span>
        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary group-hover:w-full transition-all"></span>
      </a>
      <a href="{{ route('contacto.contacto') }}" class="text-sm font-medium relative group">
        <span class="relative z-10 text-gray-700 group-hover:text-primary transition-colors">Contacto</span>
        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary group-hover:w-full transition-all"></span>
      </a>
    </nav>

    <div class="flex items-center gap-4">
      @auth
        <form
         method ="POST"
         action ="{{ route('logout', absolute: false) }}"
         class="hidden md:flex items-center h-10 px-4 text-sm font-medium rounded-md border hover:bg-slate-50 transition">
         @csrf
        <svg xmlns="http://www.w3.org/2000/svg"
             fill="none"
             viewBox="0 0 24 24"
             stroke-width="2"
             stroke="currentColor"
             class="w-5 h-5 mr-2">
          <path d="M12 12c2.2 0 4-1.8 4-4s-1.8-4-4-4-4 1.8-4 4 1.8 4 4 4z"/>
          <path d="M4 20c0-2.2 3.6-4 8-4s8 1.8 8 4v1H4v-1z"/>
        </svg>
        <button type="submit">Cerrar Sesión</button>
      </form>
      @endauth
      @guest
        <a 
         href ="{{ route('login.form') }}"
         class="hidden md:flex items-center h-10 px-4 text-sm font-medium rounded-md border hover:bg-slate-50 transition">
        <svg xmlns="http://www.w3.org/2000/svg"
             fill="none"
             viewBox="0 0 24 24"
             stroke-width="2"
             stroke="currentColor"
             class="w-5 h-5 mr-2">
            <path d="M12 12c2.2 0 4-1.8 4-4s-1.8-4-4-4-4 1.8-4 4 1.8 4 4 4z"/>
            <path d="M4 20c0-2.2 3.6-4 8-4s8 1.8 8 4v1H4v-1z"/>
          </svg>
          Iniciar Sesión
        </a>
      @endguest
      <button class="md:hidden inline-flex items-center justify-center h-10 w-10 rounded-md border"
              aria-label="Abrir menú" type="button">
        <!-- Ícono menú (Lucide "menu" en SVG inline) -->
        <svg xmlns="http://www.w3.org/2000/svg"
             viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor"
             stroke-width="2"
             stroke-linecap="round"
             stroke-linejoin="round"
             class="w-5 h-5">
          <line x1="4" y1="6" x2="20" y2="6"></line>
          <line x1="4" y1="12" x2="20" y2="12"></line>
          <line x1="4" y1="18" x2="20" y2="18"></line>
        </svg>
      </button>
    </div>
  </div>
</header>
