<section class="relative py-16 md:py-20 overflow-hidden">
  {{-- Fondo suave + brillos --}}
  <div class="absolute inset-0 -z-10">
    <div class="absolute inset-0 bg-gradient-to-b from-white via-slate-50/60 to-white"></div>
    <div class="absolute top-24 right-10 h-40 w-40 rounded-full bg-primary/10 blur-3xl"></div>
    <div class="absolute -bottom-10 left-10 h-40 w-40 rounded-full bg-secondary/10 blur-3xl"></div>
  </div>

  <div class="container mx-auto max-w-7xl px-4 md:px-6">
    {{-- Título + descripción --}}
    <div class="text-center max-w-3xl mx-auto mb-12 md:mb-16">
      <h2 class="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl bg-gradient-to-r from-primary via-secondary to-purple-600 bg-clip-text text-transparent">
        Nuestra Propuesta de Valor
      </h2>
      <p class="mt-4 text-slate-600 md:text-lg">
        Se basa en métodos de presentación conceptual llamados; Consultoría
        Integral Colaborativa (CIC), Método de Interacción (MI), integrando
        técnicas y herramientas didácticas, pedagógicas, lúdicas, estudio de
        casos, así como de inteligencia artificial.
      </p>
    </div>

    {{-- Tarjetas --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 md:gap-6">
      {{-- Card 1 --}}
      <div class="group relative">
        <div class="absolute -top-4 -right-4 h-24 w-24 rounded-full bg-primary/5"></div>
        <div class="relative h-full rounded-2xl border border-slate-200 bg-white p-6 shadow-sm hover:shadow-md transition">
          <div class="p-4 bg-primary/10 rounded-xl mb-6 w-16 h-16 flex items-center justify-center group-hover:bg-primary/20 transition-colors duration-300 transform group-hover:scale-110 group-hover:rotate-3">
            {{-- icono foco --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path d="M9 18h6M10 22h4"/>
              <path d="M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A6 6 0 0 0 6 8c0 1 .2 2.2 1.5 3.5.7.7 1.3 1.5 1.5 2.5"/>
            </svg>
          </div>
          <h3 class="text-lg font-bold mb-3 group-hover:text-primary transition-colors duration-300 relative">Enfoque Integral</h3>
          <p class="mt-2 text-slate-600 text-sm leading-relaxed">
            Los cursos y consultorías tienen un pilar y la diferenciación que es el
            enfoque integral, debido a que, del grupo emerge la energía creativa,
            nuevas alternativas y soluciones que hace que se convierta en más de
            la suma de sus integrantes, ya que puede elaborar ideas, alternativa y
            soluciones que no se le ocurrirían a sus miembros por separado:
            SINERGIA".
          </p>
          <ul class="mt-4 space-y-2 text-sm">
            <li class="flex items-start">
              @includeWhen(true,'partials._check', ['class' => 'text-primary'])
              <span>Enfoque multidimensional</span>
            </li>
            <li class="flex items-start">
              @includeWhen(true,'partials._check', ['class' => 'text-primary'])
              <span>Desarrollo personalizado</span>
            </li>
          </ul>
        </div>
      </div>

      {{-- Card 2 --}}
      <div class="group relative">
        <div class="absolute -top-4 -right-4 h-24 w-24 rounded-full bg-secondary/5"></div>
        <div class="relative h-full rounded-2xl border border-slate-200 bg-white p-6 shadow-sm hover:shadow-md transition">
          <div class="p-4 bg-secondary/10 rounded-xl mb-6 w-16 h-16 flex items-center justify-center group-hover:bg-secondary/20 transition-colors duration-300 transform group-hover:scale-110 group-hover:rotate-3">
            {{-- icono usuario círculo --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="8" r="3.5"/>
              <path d="M6 19a6 6 0 0 1 12 0"/>
            </svg>
          </div>
          <h3 class="text-lg font-bold mb-3 group-hover:text-secondary transition-colors duration-300 relative">Enfoque Colaborativo</h3>
          <p class="mt-2 text-slate-600 text-sm leading-relaxed">
            Aplicando metodologías que parten de una realidad integral y dinámica
            donde interactúan todos los elementos que la componen: personales,
            culturales, económicos, sociales, productivos, ideológicos y otros.
          </p>
          <ul class="mt-4 space-y-2 text-sm">
            <li class="flex items-start">
              @includeWhen(true,'partials._check', ['class' => 'text-secondary'])
              <span>Aprendizaje participativo</span>
            </li>
            <li class="flex items-start">
              @includeWhen(true,'partials._check', ['class' => 'text-secondary'])
              <span>Construcción conjunta</span>
            </li>
          </ul>
        </div>
      </div>

      {{-- Card 3 --}}
      <div class="group relative">
        <div class="absolute -top-4 -right-4 h-24 w-24 rounded-full bg-primary/5"></div>
        <div class="relative h-full rounded-2xl border border-slate-200 bg-white p-6 shadow-sm hover:shadow-md transition">
          <div class="p-4 bg-primary/10 rounded-xl mb-6 w-16 h-16 flex items-center justify-center group-hover:bg-primary/20 transition-colors duration-300 transform group-hover:scale-110 group-hover:rotate-3">
            {{-- icono espiral/target simple --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="9"/>
              <circle cx="12" cy="12" r="5"/>
              <circle cx="12" cy="12" r="1.8"/>
            </svg>
          </div>
          <h3 class="text-lg font-bold mb-3 group-hover:text-primary transition-colors duration-300 relative">Descubrimiento de Potencialidades</h3>
          <p class="mt-2 text-slate-600 text-sm leading-relaxed">
            Las metodologías contribuyen al descubrimiento de las potencialidades
            humanas, estas son inmensas. Nuestro principio es el reconocimiento y
            valoración de las experiencias y conocimientos adquiridos, como la
            forma de despertar el interés y motivación necesarios para el
            aprendizaje constante, útil y práctico.
          </p>
          <ul class="mt-4 space-y-2 text-sm">
            <li class="flex items-start">
              @includeWhen(true,'partials._check', ['class' => 'text-primary'])
              <span>Autoconocimiento profundo</span>
            </li>
            <li class="flex items-start">
              @includeWhen(true,'partials._check', ['class' => 'text-primary'])
              <span>Desarrollo de talentos</span>
            </li>
          </ul>
        </div>
      </div>

      {{-- Card 4 --}}
      <div class="group relative">
        <div class="absolute -top-4 -right-4 h-24 w-24 rounded-full bg-secondary/5"></div>
        <div class="relative h-full rounded-2xl border border-slate-200 bg-white p-6 shadow-sm hover:shadow-md transition">
          <div class="p-4 bg-secondary/10 rounded-xl mb-6 w-16 h-16 flex items-center justify-center group-hover:bg-secondary/20 transition-colors duration-300 transform group-hover:scale-110 group-hover:rotate-3">
            {{-- icono corazón --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path d="M20.8 8.5c0 2.3-1.5 4.1-3 5.5l-5.8 5.8a1 1 0 0 1-1.4 0L4.8 14C3.3 12.6 1.8 10.8 1.8 8.5A5.5 5.5 0 0 1 7.3 3c1.8 0 3 .5 4.5 2 1.5-1.5 2.7-2 4.5-2a5.5 5.5 0 0 1 4.5 5.5z"/>
            </svg>
          </div>
          <h3 class="text-lg font-bold mb-3 group-hover:text-secondary transition-colors duration-300 relative">Desarrollo de Habilidades Socioemocionales</h3>
          <p class="mt-2 text-slate-600 text-sm leading-relaxed">
            Dentro de las metodologías que nos hacen diferente es que iniciamos con
            la identificación de las habilidades Socioemocionales, debido a que,
            son la base del bienestar individual y colectivo, pues comprender las
            emociones propias y las de los demás, se ha vuelto esencial para
            construir relaciones saludables.
          </p>
          <ul class="mt-4 space-y-2 text-sm">
            <li class="flex items-start">
              @includeWhen(true,'partials._check', ['class' => 'text-secondary'])
              <span>Crecimiento integral</span>
            </li>
            <li class="flex items-start">
              @includeWhen(true,'partials._check', ['class' => 'text-secondary'])
              <span>Transformación personal</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
