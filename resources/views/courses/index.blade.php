@extends('layouts.app')


@section('content')
    <section class="flex justify-center">
        <div class="py-10">
            <h2 class="text-3xl font-bold sm:text-4xl bg-gradient-to-r from-primary via-secondary to-purple-600 bg-clip-text text-transparent">Nuestros Cursos</h2>
            <p class="max-w-[700px] text-gray-600 xs:text-sm">Explora nuestra selección de cursos diseñados para potenciar tu desarrollo humano integral. Cada curso está cuidadosamente estructurado para brindarte las herramientas y conocimientos necesarios para tu crecimiento personal y profesional.</p>
        </div>
    </section>
    <section class="overflow-hidden">
        <div class="container mx-auto px-4 md:px-6 max-w-7xl">
        

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
            @foreach($courses as $course)
            <x-course-card :course="$course"/>
            @endforeach
        </div>
        </div>
    </section>
@endsection