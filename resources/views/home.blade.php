@extends('layouts.app')



@section('content')
  <x-hero-agc
      :badge="'Transformando potencial en excelencia'"
      :title="'A&G Consultoría'"
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
  {{--
  <section class="py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="max-w-5xl mx-auto bg-white p-4 sm:p-6 rounded-3xl shadow-sm">
        <img
          src="{{ asset('images/flyer-2.png') }}"
          alt="Descripción de la imagen"
          class="w-full rounded-2xl shadow-lg border border-slate-200 object-contain"
          width="1250"
          height="350"
        >
      </div>
    </div>
  </section>
  --}}
  
  {{-- Nuestra Propuesta de Valor (secciones con tarjetas) --}}
  @include('home._propuesta')

  {{-- Características Clave --}}
  @include('home._caracteristicas')

  @include('home.impact')

  {{-- Cursos Destacados (dinámico con modelo Course) --}}
  <section class="relative py-16 md:py-24 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center space-y-4 mb-12 md:mb-16">
        <div class="inline-flex items-center gap-2 rounded-full border border-primary/20 bg-primary/5 px-3 py-1 text-sm font-medium text-primary hover:bg-primary/10 hover:border-primary/30 transition-colors duration-300">
          <x-icon name="lucide-book-open" class="h-4 w-4" />
          <span>Programas destacados</span>
        </div>
        <h2 class="text-3xl md:text-4xl font-bold tracking-tight bg-gradient-to-r from-primary via-secondary to-secondary bg-clip-text text-transparent">Cursos Destacados</h2>
        <p class="max-w-2xl mx-auto text-slate-600 md:text-lg">Explora nuestra selección de cursos diseñados para potenciar tu desarrollo humano</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
        @foreach($featuredCourses as $course)
          <x-course-card :course="$course"/>
        @endforeach
      </div>

      <div class="flex justify-center mt-12">
        <a href="{{ route('courses.index') }}" class="inline-flex w-full md:w-auto items-center justify-center gap-2 rounded-xl px-6 py-3 bg-gradient-to-r from-primary to-secondary text-white shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1">
          <span>Ver Todos los Cursos</span>
          <x-icon name="lucide-arrow-right" class="h-4 w-4" />
        </a>
      </div>
    </div>
  </section>

  {{-- Metodología Transformadora --}}
  @include('home._metodologia')

  {{-- CTA Suscripción --}}
  @include('home._cta')

@endsection
