<header class="sticky top-0 z-50 w-full border-b border-slate-200 bg-white/80 backdrop-blur">
  <div class="max-w-7xl mx-auto flex h-16 items-center justify-between px-4 sm:px-6 lg:px-8">
    @include('partials.brand', [
      'textClass' => 'text-primary',
      'hoverTextClass' => 'group-hover:text-primary/80',
    ])

    {{-- MENÚ DESKTOP --}}
    <nav class="hidden md:flex items-center gap-7">
      <a href="{{ route('home') }}" class="text-sm font-medium relative group">
        <span class="relative z-10 text-slate-700 group-hover:text-primary transition-colors">Inicio</span>
        <span class="absolute -bottom-1 left-0 h-0.5 w-0 bg-primary/80 group-hover:w-full transition-all"></span>
      </a>
      <a href="{{ route('courses.index') }}" class="text-sm font-medium relative group">
        <span class="relative z-10 text-slate-700 group-hover:text-primary transition-colors">Cursos</span>
        <span class="absolute -bottom-1 left-0 h-0.5 w-0 bg-primary/80 group-hover:w-full transition-all"></span>
      </a>
      <a href="{{ route('about') }}" class="text-sm font-medium relative group">
        <span class="relative z-10 text-slate-700 group-hover:text-primary transition-colors">Nosotros</span>
        <span class="absolute -bottom-1 left-0 h-0.5 w-0 bg-primary/80 group-hover:w-full transition-all"></span>
      </a>
      <a href="{{ route('contacto.contacto') }}" class="text-sm font-medium relative group">
        <span class="relative z-10 text-slate-700 group-hover:text-primary transition-colors">Contacto</span>
        <span class="absolute -bottom-1 left-0 h-0.5 w-0 bg-primary/80 group-hover:w-full transition-all"></span>
      </a>
    </nav>

    <div class="flex items-center gap-3">
      @auth
        @if(Auth::user()->isAdmin())
          <a href="{{ route('admin.index') }}" class="hidden sm:inline-flex items-center gap-2 rounded-xl border border-red-200 bg-white px-3 py-2 text-sm font-medium text-red-700 shadow-sm hover:bg-red-50 hover:shadow-md transition-all duration-300">
            <x-icon name="lucide-shield" class="h-4 w-4" />
            Panel Admin
          </a>
        @endif

        <a href="{{ route('account.edit') }}" class="hidden sm:inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-700 shadow-sm hover:shadow-md transition-all duration-300">
          <x-icon name="lucide-user" class="h-4 w-4" />
          Mi cuenta
        </a>

        <a href="{{ route('dashboard.index') }}" class="hidden sm:inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-primary to-secondary px-3 py-2 text-sm font-medium text-white shadow-sm hover:shadow-md transition-all duration-300">
          <x-icon name="lucide-layout-dashboard" class="h-4 w-4" />
          Dashboard
        </a>

        <form
          method="POST"
          action="{{ route('logout', absolute: false) }}"
          class="hidden md:inline-flex items-center gap-2 h-10 px-4 text-sm font-medium rounded-xl border border-slate-200 bg-white shadow-sm hover:shadow-md hover:bg-slate-50 transition-all duration-300"
        >
          @csrf
          <x-icon name="lucide-log-out" class="w-5 h-5" />
          <button type="submit">Cerrar Sesión</button>
        </form>
      @endauth

      @guest
        <a 
          href="{{ route('login.form') }}"
          class="hidden md:inline-flex items-center gap-2 h-10 px-4 text-sm font-medium rounded-xl border border-slate-200 bg-white shadow-sm hover:shadow-md hover:bg-slate-50 transition-all duration-300"
        >
          <x-icon name="lucide-log-in" class="w-5 h-5" />
          Iniciar Sesión
        </a>
      @endguest

      {{-- BOTÓN MENÚ MÓVIL --}}
      <button id="mobile-menu-button"
              class="md:hidden inline-flex items-center justify-center h-10 w-10 rounded-xl border border-slate-200 bg-white shadow-sm hover:shadow-md transition-all duration-300"
              aria-label="Abrir menú"
              aria-expanded="false"
              type="button">
        <x-icon name="lucide-menu" class="w-5 h-5 text-slate-700" />
      </button>
    </div>
  </div>

  {{-- MENÚ MÓVIL --}}
  <nav id="mobile-menu" class="md:hidden hidden border-t border-slate-200 bg-white/95 backdrop-blur">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
      <div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-3 space-y-1">
      <a href="{{ route('home') }}" class="block rounded-xl px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-primary transition">
        Inicio
      </a>
      <a href="{{ route('courses.index') }}" class="block rounded-xl px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-primary transition">
        Cursos
      </a>
      <a href="{{ route('about') }}" class="block rounded-xl px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-primary transition">
        Nosotros
      </a>
      <a href="{{ route('contacto.contacto') }}" class="block rounded-xl px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-primary transition">
        Contacto
      </a>

        @auth
          @if(Auth::user()->isAdmin())
          <a href="{{ route('admin.index') }}" class="block rounded-xl px-3 py-2 text-sm font-medium text-red-700 hover:bg-red-50 transition">
            Panel Admin
          </a>
          @endif
        <a href="{{ route('account.edit') }}" class="block rounded-xl px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-primary transition">
          Mi cuenta
        </a>
        <a href="{{ route('dashboard.index') }}" class="block rounded-xl px-3 py-2 text-sm font-medium text-primary hover:bg-primary/5 transition">
          Dashboard
        </a>

        <form
          method="POST"
          action="{{ route('logout', absolute: false) }}"
          class="pt-2"
        >
          @csrf
          <button
            type="submit"
            class="w-full inline-flex items-center justify-center gap-2 h-10 px-4 text-sm font-medium rounded-xl border border-slate-200 bg-white shadow-sm hover:shadow-md hover:bg-slate-50 transition-all duration-300"
          >
            <x-icon name="lucide-log-out" class="h-4 w-4" />
            Cerrar Sesión
          </button>
        </form>
      @endauth

      @guest
        <a
          href="{{ route('login.form') }}"
          class="mt-2 w-full inline-flex items-center justify-center gap-2 h-10 px-4 text-sm font-medium rounded-xl border border-slate-200 bg-white shadow-sm hover:shadow-md hover:bg-slate-50 transition-all duration-300"
        >
          <x-icon name="lucide-log-in" class="h-4 w-4" />
          Iniciar Sesión
        </a>
      @endguest
      </div>
    </div>
  </nav>
</header>

{{-- Script simple para togglear el menú móvil (ponlo al final del layout o de la vista) --}}
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const btn  = document.getElementById('mobile-menu-button');
    const menu = document.getElementById('mobile-menu');

    if (btn && menu) {
      btn.addEventListener('click', () => {
        const isOpen = !menu.classList.contains('hidden');
        menu.classList.toggle('hidden');
        btn.setAttribute('aria-expanded', String(!isOpen));
      });
    }
  });
</script>
