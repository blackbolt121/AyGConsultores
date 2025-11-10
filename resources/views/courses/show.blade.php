@extends('layouts.app')

@section('content')
<section class="flex justify-center">
  <div class="py-10 text-center">
    <h1 class="text-3xl font-bold sm:text-4xl bg-gradient-to-r from-primary via-secondary to-purple-600 bg-clip-text text-transparent">
      {{ $course->title }}
    </h1>
    <p class="max-w-[700px] mx-auto text-gray-600 mt-2">
      {{ $course->category_label }} • {{ $course->hours }} h
    </p>
  </div>
</section>

<section class="overflow-hidden">
  <div class="container mx-auto px-4 md:px-6 max-w-5xl">
    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
      @if($course->image)
        <img src="{{ asset($course->image) }}" alt="{{ $course->title }}"
             class="mb-6 w-full max-h-[360px] object-cover rounded-xl ring-1 ring-gray-200" />
      @endif

      @if($course->excerpt)
        <p class="text-gray-700 text-lg mb-4">{{ $course->excerpt }}</p>
      @endif

      @if($course->description)
        <article class="prose max-w-none prose-headings:scroll-mt-20">
          {!! nl2br(e($course->description)) !!}
        </article>
      @else
        <p class="text-gray-500">Este curso aún no tiene una descripción detallada.</p>
      @endif

      <div class="mt-8 flex items-center gap-3">
        <a href="{{ route('courses.index') }}"
           class="inline-flex items-center rounded-lg border border-gray-300 px-5 py-2.5 text-gray-700 hover:bg-gray-50">
          Volver al catálogo
        </a>
        @auth
          <a href="{{ route('admin.courses.edit', $course) }}"
             class="inline-flex items-center rounded-lg bg-primary px-5 py-2.5 text-white hover:bg-primary/90">
            Editar
          </a>
        @endauth
      </div>
    </div>
  </div>
</section>
@endsection
