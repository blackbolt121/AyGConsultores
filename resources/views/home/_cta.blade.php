<section class="relative py-20 overflow-hidden">
  <div class="absolute inset-0 -z-10">
    <div class="absolute inset-0 bg-gradient-to-r from-primary/10 to-secondary/10"></div>
    <div class="absolute inset-0 bg-[url('{{ asset('images/abstract-geometric-pattern.png') }}')] bg-repeat opacity-5"></div>
    <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white to-transparent"></div>
    <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white to-transparent"></div>
  </div>

  <div class="container mx-auto px-4 md:px-6 max-w-7xl">
    <div class="relative bg-white rounded-2xl shadow-xl overflow-hidden group">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8 md:p-12">
        {{-- Texto + formulario --}}
        <div class="flex flex-col justify-center">
          <h2 class="text-3xl font-bold tracking-tighter sm:text-4xl mb-4 bg-gradient-to-r from-primary to-secondary bg-clip-text">
            ¿Listo para transformar tu potencial?
          </h2>
          <p class="text-gray-600 mb-6 md:text-lg">
            Únete a nuestra comunidad y recibe información exclusiva sobre cursos, eventos y recursos gratuitos.
          </p>

          <form method="POST" action="{{ route('newsletter.subscribe') }}" class="flex flex-col sm:flex-row gap-4 mb-4">
            @csrf
            <div class="relative flex-grow">
              <input
                type="email"
                name="email"
                required
                placeholder="Tu correo electrónico"
                class="flex w-full rounded-md border bg-background px-3 py-2 text-base h-12 border-gray-200 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/30"
              />
            </div>
            <button class="inline-flex items-center justify-center rounded-md text-sm font-medium h-12 px-6 bg-primary text-white hover:bg-primary/90">
              Suscribirme
            </button>
          </form>

          @if ($errors->any())
            <p class="text-sm text-red-600">{{ $errors->first('email') }}</p>
          @endif
          @if (session('ok'))
            <p class="text-sm text-green-600">{{ session('ok') }}</p>
          @endif

          <p class="text-sm text-gray-500">Respetamos tu privacidad. Nunca compartiremos tu información.</p>
        </div>

        {{-- Bullets de valor --}}
        <div class="flex flex-col justify-center space-y-6">
          <div class="p-3 rounded-lg bg-primary/5 flex gap-2 items-center">
            @includeWhen(true,'partials._check', ['class' => 'text-primary'])
            <div>
              <h3 class="font-semibold text-lg mb-1 text-primary">Contenido Exclusivo</h3>
              <p class="text-gray-600">Accede a recursos y materiales únicos.</p>
            </div>
          </div>
          <div class="p-3 rounded-lg bg-secondary/5 flex gap-2 items-center">
            @includeWhen(true,'partials._check', ['class' => 'text-secondary'])
            <div>
              <h3 class="font-semibold text-lg mb-1 text-secondary">Descuentos Especiales</h3>
              <p class="text-gray-600">Ofertas exclusivas en cursos y programas.</p>
            </div>
          </div>
          <div class="p-3 rounded-lg bg-primary/5 flex gap-2 items-center">
            @includeWhen(true,'partials._check', ['class' => 'text-primary'])
            <div>
              <h3 class="font-semibold text-lg mb-1 text-primary">Eventos y Webinars</h3>
              <p class="text-gray-600">Invitaciones a eventos en vivo y sesiones interactivas.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
