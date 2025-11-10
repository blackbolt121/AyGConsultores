@extends('layouts.app')

@section('content')
    <section class="flex justify-center">
        <div class="py-10 text-center">
            <h2
                class="text-3xl font-bold sm:text-4xl bg-gradient-to-r from-primary via-secondary to-purple-600 bg-clip-text text-transparent">
                Editar Curso
            </h2>
            <p class="max-w-[700px] mx-auto text-gray-600 xs:text-sm">
                Actualiza la información de tu curso.
            </p>
        </div>
    </section>
    <section class="overflow-hidden">
        <div class="container mx-auto px-4 md:px-6 max-w-5xl">
            @if (session('status'))
                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('admin.courses.destroy', $course) }}" method="POST"
                onsubmit="return confirm('¿Eliminar este curso?')" class="inline">
                @csrf @method('DELETE')
                <button
                    class="inline-flex items-center rounded-lg border border-red-300 px-5 py-2.5 text-red-700 hover:bg-red-50">
                    Eliminar
                </button>
            </form>
            <form action="{{ route('admin.courses.update', $course) }}" method="POST" enctype="multipart/form-data"
                class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                @csrf
                @method('PUT')

                @include('courses._form', ['course' => $course])

                <div class="mt-8 flex flex-wrap items-center gap-3">
                    <button
                        class="inline-flex items-center rounded-lg bg-primary px-5 py-2.5 text-white hover:bg-primary/90">
                        Actualizar
                    </button>
                    <a href="{{ route('admin.courses.index') }}"
                        class="inline-flex items-center rounded-lg border border-gray-300 px-5 py-2.5 text-gray-700 hover:bg-gray-50">
                        Volver
                    </a>
                </div>
            </form>
            {{-- Botón eliminar (opcional) --}}
            
        </div>
        <div class="w-1/2 mx-auto my-0">
            
        </div>
    </section>

    @include('admin.courses._contents', ['course' => $course])
@endsection
