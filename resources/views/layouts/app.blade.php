<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>@yield('title','Plataforma de Cursos - A&G Consultoría')</title>
  <meta name="description" content="@yield('meta_description','Descubre tus potencialidades a través de nuestra capacitación y consultoría integral y colaborativa.')">
  <meta property="og:site_name" content="AyG Consultoria">
  <link rel="icon" href="{{ asset('logo.svg') }}">
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50/30 text-slate-900">
  <div class="flex flex-col min-h-screen">
    {{-- Header/Nav --}}
    @include('partials.navbar')

    <main class="flex-1 w-full mx-auto pt-2 pb-5">
      @yield('content')
    </main>

    @auth
      @if (Auth::user()->requiresPasswordChange())
        <div id="force-password-modal" class="fixed inset-0 z-[9999] hidden">
          <div class="absolute inset-0 bg-black/60"></div>
          <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="w-full max-w-lg rounded-2xl bg-white shadow-xl border border-gray-100">
              <div class="p-6 border-b border-gray-100">
                <h2 class="text-xl font-semibold text-gray-900">Actualiza tu contrasena</h2>
                <p class="mt-1 text-sm text-gray-600">Por seguridad, debes cambiar tu contrasena para continuar.</p>
              </div>

              <div class="p-6">
                @if (session('status'))
                  <div class="mb-4 rounded-lg border border-amber-200 bg-amber-50 p-3 text-amber-900 text-sm">
                    {{ session('status') }}
                  </div>
                @endif

                <form action="{{ route('account.password.update') }}" method="POST" class="space-y-4">
                  @csrf
                  @method('PUT')

                  @if (!Auth::user()->requiresPasswordChange())
                    <div>
                      <label for="fp_current_password" class="block text-sm font-medium text-gray-700 mb-1">Contrasena actual</label>
                      <input id="fp_current_password" name="current_password" type="password" autocomplete="current-password" required
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 transition">
                      @error('current_password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                      @enderror
                    </div>
                  @endif

                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                      <label for="fp_password" class="block text-sm font-medium text-gray-700 mb-1">Nueva contrasena</label>
                      <input id="fp_password" name="password" type="password" autocomplete="new-password" required
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 transition">
                      @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                      @enderror
                    </div>
                    <div>
                      <label for="fp_password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmar</label>
                      <input id="fp_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 transition">
                    </div>
                  </div>

                  <div class="pt-2 flex items-center justify-between gap-4">
                    <button type="button" data-force-logout class="text-sm font-medium text-gray-700 hover:text-gray-900 underline">
                      Cerrar sesion
                    </button>

                    <button type="submit" class="px-5 py-2 rounded-md bg-primary text-white font-medium hover:bg-primary/90 transition shadow-sm">
                      Guardar nueva contrasena
                    </button>
                  </div>
                </form>

                <form id="force-logout-form" method="POST" action="{{ route('logout', absolute: false) }}" class="hidden">
                  @csrf
                </form>
              </div>
            </div>
          </div>
        </div>
        <script>
          document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('force-password-modal');
            if (!modal) return;
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
            const current = document.getElementById('fp_current_password');
            const next = document.getElementById('fp_password');
            if (current) current.focus();
            else if (next) next.focus();

            const logoutBtn = modal.querySelector('[data-force-logout]');
            const logoutForm = document.getElementById('force-logout-form');
            if (logoutBtn && logoutForm) {
              logoutBtn.addEventListener('click', () => logoutForm.submit());
            }
          });
        </script>
      @endif
    @endauth

    {{-- Footer --}}
    @include('partials.footer')
    @stack('scripts')
  </div>
</body>
</html>
