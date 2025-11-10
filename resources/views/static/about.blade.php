@extends('layouts.app')

@section('content')
    <section class="relative py-20 bg-gradient-to-b from-primary/10 to-secondary/10">
        <div class="container mx-auto px-4 md:px-6 max-w-7xl">
            <div class="flex flex-col items-center space-y-4 text-center">
                <h1 class="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl text-primary">Sobre Nosotros</h1>
                <p class="max-w-[700px] text-gray-600 md:text-xl">Contribuimos en la búsqueda constante de la esencia del
                    desarrollo humano</p>
            </div>
        </div>
    </section>
    <section class="relative py-16 overflow-hidden">
        <div class="absolute inset-0 -z-10">
            <div class="absolute inset-0 bg-gradient-to-b from-primary/5 to-secondary/5"></div>
        </div>
        <div class="container mx-auto px-4 md:px-6 max-w-7xl">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1" style="opacity: 1; transform: none;">
                    <h2
                        class="text-3xl font-bold tracking-tighter sm:text-4xl bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent mb-6">
                        Nuestra Presencia Global</h2>
                    <p class="text-gray-600 text-lg mb-6">En A&amp;G Consultores, nos enorgullece haber impactado
                        positivamente en el desarrollo humano de profesionales y organizaciones en diferentes partes del
                        mundo. Nuestra metodología única y enfoque colaborativo nos ha permitido trascender fronteras y
                        contribuir al crecimiento personal y profesional de miles de personas.</p>
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-white p-4 rounded-lg shadow-sm">
                            <div class="text-2xl font-bold text-primary mb-1">15+</div>
                            <div class="text-sm text-gray-600">Países con presencia</div>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-sm">
                            <div class="text-2xl font-bold text-secondary mb-1">50+</div>
                            <div class="text-sm text-gray-600">Alianzas internacionales</div>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-sm">
                            <div class="text-2xl font-bold text-primary mb-1">200+</div>
                            <div class="text-sm text-gray-600">Eventos globales</div>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-sm">
                            <div class="text-2xl font-bold text-secondary mb-1">5000+</div>
                            <div class="text-sm text-gray-600">Profesionales capacitados</div>
                        </div>
                    </div>
                </div>
                <div class="order-1 lg:order-2 relative h-[400px] rounded-lg overflow-hidden"
                    style="opacity: 1; transform: none;">
                    <img alt="Presencia global" loading="lazy" decoding="async"
                        data-nimg="fill" class="object-cover" src="/images/presencia-global.jpg"
                        style="rounded-xl">
                    <div class="absolute inset-0 bg-gradient-to-tr from-secondary/20 to-transparent"></div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-16">
        <div class="container mx-auto px-4 md:px-6 max-w-7xl">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-2xl font-bold mb-4 text-primary">Nuestra Misión</h2>
                    <p class="text-gray-600 mb-6">Contribuir en la búsqueda constante de la esencia del desarrollo humano, a
                        través de capacitación y consultoría integral y colaborativa que ayude a las personas a descubrir
                        sus potencialidades.</p>
                    <h2 class="text-2xl font-bold mb-4 text-primary">Nuestra Visión</h2>
                    <p class="text-gray-600 mb-6">Ser reconocidos como una organización líder en el desarrollo humano
                        integral, que transforma vidas y organizaciones a través de metodologías innovadoras y un enfoque
                        centrado en la persona.</p>
                    <h2 class="text-2xl font-bold mb-4 text-primary">Nuestros Valores</h2>
                    <ul class="space-y-2">
                        <li class="flex items-start"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-circle-check-big h-5 w-5 mr-2 text-primary mt-0.5">
                                <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                                <path d="m9 11 3 3L22 4"></path>
                            </svg><span><strong>Integridad:</strong> Actuamos con honestidad y coherencia en todo lo que
                                hacemos.</span></li>
                        <li class="flex items-start"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-circle-check-big h-5 w-5 mr-2 text-primary mt-0.5">
                                <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                                <path d="m9 11 3 3L22 4"></path>
                            </svg><span><strong>Colaboración:</strong> Creemos en el poder del trabajo conjunto para lograr
                                resultados extraordinarios.</span></li>
                        <li class="flex items-start"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-circle-check-big h-5 w-5 mr-2 text-primary mt-0.5">
                                <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                                <path d="m9 11 3 3L22 4"></path>
                            </svg><span><strong>Respeto:</strong> Valoramos la dignidad y unicidad de cada persona.</span>
                        </li>
                        <li class="flex items-start"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-circle-check-big h-5 w-5 mr-2 text-primary mt-0.5">
                                <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                                <path d="m9 11 3 3L22 4"></path>
                            </svg><span><strong>Excelencia:</strong> Buscamos la mejora continua en todos nuestros procesos
                                y servicios.</span></li>
                    </ul>
                </div>
                <div class="relative h-[400px] rounded-lg overflow-hidden"><img alt="Nuestro equipo" loading="lazy"
                        decoding="async" data-nimg="fill" class="object-cover" src="/images/presencia-global.jpg"
                        style=""></div>
            </div>
        </div>
    </section>
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 md:px-6 max-w-7xl">
            <div class="flex flex-col items-center space-y-4 text-center mb-12">
                <h2 class="text-3xl font-bold tracking-tighter sm:text-4xl text-primary">Lo Que Nos Hace Diferentes</h2>
                <p class="max-w-[700px] text-gray-600 md:text-xl">Nuestra propuesta de valor es atípica debido a su enfoque
                    integral y colaborativo</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center">
                        <div class="p-3 bg-primary/10 rounded-full inline-flex mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-award h-8 w-8 text-primary">
                                <path
                                    d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526">
                                </path>
                                <circle cx="12" cy="8" r="6"></circle>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2 px-5">Enfoque Integral</h3>
                    </div>
                    <p class="text-gray-600">Abordamos todas las dimensiones del ser humano: física, emocional, mental y
                        espiritual, para un desarrollo verdaderamente completo.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center">
                        <div class="p-3 bg-secondary/10 rounded-full inline-flex mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-users h-8 w-8 text-secondary">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2 px-5">Metodología Colaborativa</h3>
                    </div>
                    <p class="text-gray-600">Creemos en la co-creación del conocimiento, donde facilitadores y
                        participantes construyen juntos el aprendizaje.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center">
                        <div class="p-3 bg-primary/10 rounded-full inline-flex mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-heart h-8 w-8 text-primary">
                            <path
                                d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z">
                            </path>
                        </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2 px-2">Descubrimiento de Potencialidades</h3>
                    </div>
                    <p class="text-gray-600">Nos enfocamos en ayudar a las personas a reconocer y desarrollar sus
                        capacidades únicas, más allá de la simple adquisición de conocimientos.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-16">
  <div class="container mx-auto px-4 md:px-6 max-w-7xl">
    <div class="flex flex-col items-center space-y-4 text-center mb-12">
      <h2 class="text-3xl font-bold tracking-tighter sm:text-4xl text-primary">Nuestro Equipo</h2>
      <p class="max-w-[700px] text-gray-600 md:text-xl">
        Profesionales comprometidos con el desarrollo humano integral
      </p>
    </div>

    <div class="grid xs:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
      {{-- Card 1 --}}
      <div class="flex flex-col items-center text-center">
        {{-- Avatar circular con background-image --}}
        <div
          role="img"
          aria-label="Retrato de María de los Ángeles Aguiñaga Villaseñor"
          class="w-40 h-40 rounded-full bg-center bg-cover bg-no-repeat shrink-0 ring-1 ring-gray-200 shadow-sm mb-4"
          style="background-image: url('{{ asset('images/professional-woman-portrait.png') }}');">
        </div>

        <h3 class="text-xl font-bold">María de los Ángeles Aguiñaga Villaseñor</h3>
        <p class="text-primary mb-2">Investigadora/Profesora/Capacitadora</p>
        <p class="text-gray-600">
          Doctora en Educación, Cédula profesional 13921929. Candidata al Doctorado en
          Ciencias Administrativas, por la ESCA IPN.
        </p>
      </div>

      {{-- Card 2 --}}
      <div class="flex flex-col items-center text-center">
        <div
          role="img"
          aria-label="Retrato de David Guerrero"
          class="w-40 h-40 rounded-full bg-center bg-cover bg-no-repeat shrink-0 ring-1 ring-gray-200 shadow-sm mb-4"
          style="background-image: url('{{ asset('images/david-guerrero.jpeg') }}');">
        </div>

        <h3 class="text-xl font-bold">David Guerrero</h3>
        <p class="text-primary mb-2">Director de Capacitación</p>
        <p class="text-gray-600">Executive Máster in Business Administration — Rennes School of Business.</p>
      </div>

      {{-- ...agrega más cards igual... --}}

    </div>
  </div>
</section>
@endsection
