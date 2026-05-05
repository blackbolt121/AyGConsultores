@extends('layouts.app')

@section('title', $course->title.' - '.$cycle->name)

@section('content')
<main class="flex-1 w-full mx-auto">
  <div class="min-h-screen py-12">
    <div class="container mx-auto px-4 md:px-6 max-w-7xl">

      <div class="mb-6">
        <a href="{{ route('dashboard.index') }}" class="text-sm text-gray-500 hover:text-primary inline-flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
          </svg>
          Volver al dashboard
        </a>
      </div>

      <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
          <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">{{ $course->title }}</h1>
            <p class="text-gray-500 mt-1">Ciclo: <strong>{{ $cycle->name }}</strong> · Estado: {{ $cycle->status }}</p>
            <p class="text-xs text-gray-500 mt-2">
              @if($cycle->starts_at)
                Inicio: {{ $cycle->starts_at->format('d/m/Y') }}
              @endif
              @if($cycle->ends_at)
                <span class="ml-2">Fin: {{ $cycle->ends_at->format('d/m/Y') }}</span>
              @endif
            </p>
          </div>

          <div class="text-sm text-gray-600">
            <p class="font-medium text-gray-900 mb-1">Docentes</p>
            @if($cycle->teachers->isEmpty())
              <p class="text-gray-500">Por asignar</p>
            @else
              <ul class="space-y-1">
                @foreach($cycle->teachers as $teacher)
                  <li>{{ $teacher->name }}</li>
                @endforeach
              </ul>
            @endif
          </div>
        </div>

        <div class="mt-8">
          <h2 class="text-xl font-bold mb-4">Temario</h2>

          @php
            $roots = $course->relationLoaded('rootContents') ? $course->rootContents : $course->rootContents()->get();
          @endphp

          @if($roots->isNotEmpty())
            <div class="space-y-6">
              @include('partials._cycle-content-tree', ['nodes' => $roots, 'cycle' => $cycle, 'materials' => $materials])
            </div>
          @else
            <p class="text-gray-500">Aun no hay temario publicado para este curso.</p>
          @endif
        </div>
      </div>

    </div>
  </div>
</main>
@endsection
