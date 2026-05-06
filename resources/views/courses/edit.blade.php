@extends('layouts.app')

@section('content')
    <section class="flex justify-center bg-slate-50 border-b border-slate-200">
        <div class="py-12 text-center">
            <span class="inline-block py-1 px-3 rounded-full bg-primary/10 text-primary text-sm font-semibold tracking-wider uppercase mb-3">Gestión de Catálogo</span>
            <h2 class="text-3xl font-extrabold sm:text-4xl text-slate-900 tracking-tight">
                Editar <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-secondary">Curso</span>
            </h2>
            <p class="max-w-[700px] mx-auto text-slate-500 mt-2 text-lg">
                Actualiza la información, el temario y los recursos de tu curso.
            </p>
        </div>
    </section>

    <section class="overflow-hidden py-10 bg-slate-50 min-h-screen">
        <div class="container mx-auto px-4 md:px-6 max-w-5xl">
            
            <div class="flex justify-between items-end mb-6">
                <div></div>
                <form action="{{ route('admin.courses.destroy', $course) }}" method="POST"
                    onsubmit="return confirm('¿Estás seguro de eliminar este curso completamente? Esta acción no se puede deshacer.')" class="inline">
                    @csrf @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-xl border border-red-200 bg-red-50 px-4 py-2.5 text-sm text-red-600 font-semibold hover:bg-red-100 hover:text-red-700 focus:ring-4 focus:ring-red-500/20 transition-all group">
                        <svg class="w-4 h-4 mr-2 text-red-500 group-hover:text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Eliminar Curso
                    </button>
                </form>
            </div>

            @if (session('status'))
                <div class="mb-8 p-4 rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-800 flex items-start gap-3 animate-fade-in-down">
                    <svg class="w-6 h-6 text-emerald-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <h3 class="font-semibold">¡Actualización Exitosa!</h3>
                        <p class="text-sm mt-1 opacity-90">{{ session('status') }}</p>
                    </div>
                </div>
            @endif

            <form action="{{ route('admin.courses.update', $course) }}" method="POST" enctype="multipart/form-data"
                class="rounded-3xl border border-slate-100 bg-white p-8 md:p-10 shadow-[0_8px_30px_rgb(0,0,0,0.04)] relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-primary to-secondary"></div>

                @csrf
                @method('PUT')

                @include('courses._form', ['course' => $course])

                <div class="mt-8 pt-6 border-t border-slate-100 flex flex-wrap items-center gap-4">
                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-primary px-8 py-3.5 text-white font-medium hover:bg-primary/90 focus:ring-4 focus:ring-primary/20 transition-all shadow-lg shadow-primary/20">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Guardar Cambios
                    </button>
                    <a href="{{ route('admin.courses.cycles.index', $course) }}"
                        class="inline-flex items-center justify-center rounded-xl border border-purple-200 bg-purple-50 px-6 py-3.5 text-purple-700 font-medium hover:bg-purple-100 focus:ring-4 focus:ring-purple-500/20 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Gestionar Ciclos
                    </a>
                    <a href="{{ route('admin.courses.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-6 py-3.5 text-slate-700 font-medium hover:bg-slate-50 hover:text-slate-900 focus:ring-4 focus:ring-slate-200 transition-all">
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
