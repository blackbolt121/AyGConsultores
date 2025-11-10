@extends('layouts.app')



@section('content')
  <x-hero-agc
      :badge="'Transformando potencial en excelencia'"
      :title="'A&G Consultores'"
      :subtitle="'Capacitación y consultoría integral que coadyuva a descubrir el potencial humano a través de metodología integral colaborativa.'"
      :primary="['href' => route('courses.index'), 'label' => 'Explorar Cursos']"
      :secondary="['href' => route('about'), 'label' => 'Conocer Más']"
      :features="[
        ['icon'=>'brain','label'=>'Desarrollo Integral'],
        ['icon'=>'target',  'label'=>'Enfoque Personalizado'],
      ]"
      :image="asset('images/misty-forest.png')"
  />

  {{-- Hero con imagen --}}
  <section class="py-20">
    <div class="container mx-auto px-4 max-w-7xl flex justify-center">
      <img src="{{ asset('images/flyer-2.png') }}" alt="Descripción de la imagen" class="object-contain" width="1250" height="350">
    </div>
  </section>
  
  {{-- Nuestra Propuesta de Valor (secciones con tarjetas) --}}
  @include('home._propuesta')

  {{-- Características Clave --}}
  @include('home._caracteristicas')

  @include('home.impact')

  {{-- Cursos Destacados (dinámico con modelo Course) --}}
  <section class="relative py-20 overflow-hidden">
    <div class="container mx-auto px-4 md:px-6 max-w-7xl">
      <div class="text-center mb-12">
        <div class="inline-flex items-center rounded-full border border-primary/20 bg-primary/5 px-3 py-1 text-sm text-primary mb-2 hover:bg-primary/10 hover:border-primary/30 transition-colors duration-300"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-open mr-1 h-3.5 w-3.5"><path d="M12 7v14"></path><path d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z"></path></svg><span>Programas destacados</span></div>
        <h2 class="text-3xl font-bold sm:text-4xl bg-gradient-to-r from-primary via-secondary to-purple-600 bg-clip-text text-transparent">Cursos Destacados</h2>
        <p class="max-w-[700px] mx-auto text-gray-600 md:text-xl">Explora nuestra selección de cursos diseñados para potenciar tu desarrollo humano</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8 mx-auto w-[80%]">
        @foreach($featuredCourses as $course)
          <x-course-card :course="$course"/>
        @endforeach
      </div>

      <div class="flex justify-center mt-12">
        <a href="{{ route('courses.index') }}" class="text-white hover:cursor-pointer inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 bg-primary text-primary-foreground hover:bg-primary/90 h-11 rounded-md px-8 bg-gradient-to-r from-primary to-secondary">
          <span>Ver Todos los Cursos</span>
          <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
        </a>
      </div>
    </div>
  </section>

  {{-- Metodología Transformadora --}}
  @include('home._metodologia')

  {{-- CTA Suscripción --}}
  @include('home._cta')

@endsection
