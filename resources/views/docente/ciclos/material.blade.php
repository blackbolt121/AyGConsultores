@extends('layouts.app')

@section('content')
<section class="py-10 container mx-auto max-w-7xl px-4">
    <div class="mb-8">
        <a href="{{ route('docente.ciclos.index') }}" class="text-sm text-gray-500 hover:text-primary mb-2 inline-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Volver
        </a>
        <h1 class="text-3xl font-bold bg-gradient-to-r from-primary via-secondary to-purple-600 bg-clip-text text-transparent">
            Material del Ciclo
        </h1>
        <p class="text-gray-500 mt-2"><strong>{{ $course->title }}</strong> · {{ $cycle->name }}</p>
    </div>

    @if (session('status'))
        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">
            {{ session('status') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-200 bg-gray-50/50">
            <h3 class="text-base font-semibold text-gray-900">Temario (estructura solo lectura)</h3>
        </div>
        <div class="p-6">
            @php $roots = $course->rootContents; @endphp

            @if($roots->isEmpty())
                <p class="text-gray-500">No hay temario cargado en esta version del curso.</p>
            @else
                <div class="space-y-6">
                    @foreach($roots as $root)
                        @include('docente.ciclos.partials._material_node', ['node' => $root, 'cycle' => $cycle, 'materials' => $materials])
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
