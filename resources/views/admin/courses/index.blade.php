@extends('layouts.app')

@section('content')
<section class="py-10 container mx-auto max-w-7xl px-4">
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-3xl font-bold bg-gradient-to-r from-primary via-secondary to-purple-600 bg-clip-text text-transparent">
      Administrar Cursos
    </h1>
    <a href="{{ route('admin.courses.create') }}"
       class="inline-flex items-center rounded-xl bg-primary px-4 py-2 text-white shadow-sm hover:bg-primary/90">
      + Nuevo Curso
    </a>
  </div>

  @if(session('status'))
    <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 text-green-700">
      {{ session('status') }}
    </div>
  @endif

  @if($courses->count())

    {{-- Desktop / Tablet --}}
    <div class="sm:hidden md:block overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
      <div class="max-h-[60vh] overflow-auto">
        <table class="min-w-full text-sm">
          <thead class="bg-gray-50 sticky top-0 z-10">
            <tr class="text-left text-[13px] font-semibold text-gray-600 uppercase tracking-wide">
              <th class="px-5 py-3 w-[40%]">Título</th>
              <th class="px-5 py-3">Categoría</th>
              <th class="px-5 py-3 text-right">Horas</th>
              <th class="px-5 py-3 text-center">Destacado</th>
              <th class="px-5 py-3 text-right">Acciones</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100">
            @foreach($courses as $course)
              <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-5 py-4">
                  <div class="font-medium text-gray-900 line-clamp-2">{{ $course->title }}</div>
                  @if($course->slug)
                    <div class="text-xs text-gray-500 mt-0.5">/{{ $course->slug }}</div>
                  @endif
                </td>
                <td class="px-5 py-4">
                  <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-1 text-xs text-gray-700">
                    {{ $course->category_label }}
                  </span>
                </td>
                <td class="px-5 py-4 text-right tabular-nums text-gray-800">
                  {{ $course->hours }}
                </td>
                <td class="px-5 py-4 text-center">
                  @if($course->featured)
                    <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2.5 py-1 text-xs font-medium text-green-700">
                      <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 0 1 0 1.414l-7.25 7.25a1 1 0 0 1-1.414 0l-3-3a1 1 0 1 1 1.414-1.414l2.293 2.293 6.543-6.543a1 1 0 0 1 1.414 0Z" clip-rule="evenodd"/></svg>
                      Sí
                    </span>
                  @else
                    <span class="inline-flex items-center gap-1 rounded-full bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-600">
                      No
                    </span>
                  @endif
                </td>
                <td class="px-5 py-4">
                  <div class="flex items-center justify-end gap-2">
                    <a href="{{ route('admin.courses.edit', $course) }}"
                       class="px-3 py-1.5 bg-primary text-white rounded-lg">
                      Editar
                    </a>
                    <form action="{{ route('admin.courses.destroy', $course) }}" method="POST"
                          onsubmit="return confirm('¿Eliminar este curso? Esta acción no se puede deshacer.')">
                      @csrf @method('DELETE')
                    <button type="submit"
                            class="px-3 py-1.5 bg-red-600 text-white rounded-lg">
                        Eliminar
                    </button>

                    </form>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    {{-- Mobile: tarjetas --}}
    <div class="md:hidden space-y-4">
      @foreach($courses as $course)
        <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm">
          <div class="flex items-start justify-between gap-3">
            <div class="min-w-0">
              <h3 class="font-semibold text-gray-900">{{ $course->title }}</h3>
              <div class="mt-1 flex flex-wrap items-center gap-2">
                <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs text-gray-700">
                  {{ $course->category_label }}
                </span>
                <span class="text-xs text-gray-500 tabular-nums">{{ $course->hours }} h</span>
                @if($course->featured)
                  <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2.5 py-0.5 text-xs text-green-700">
                    ✓ Destacado
                  </span>
                @endif
              </div>
            </div>
          </div>

          <div class="mt-4 flex items-center justify-end gap-2">
            <a href="{{ route('admin.courses.edit', $course) }}"
               class="inline-flex items-center rounded-lg border border-gray-300 px-3 py-1.5 text-gray-800 hover:bg-gray-50">
              Editar
            </a>
            <form action="{{ route('admin.courses.destroy', $course) }}" method="POST"
                  onsubmit="return confirm('¿Eliminar este curso?')">
              @csrf @method('DELETE')
                <button
                    class="inline-flex items-center rounded-lg 
                        border border-red-500 bg-white px-3 py-1.5
                        text-red-600 transition-colors duration-200
                        hover:bg-red-600 hover:text-white
                        focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-red-300
                        active:bg-red-700">
                    Eliminar
                </button>
            </form>
          </div>
        </div>
      @endforeach
    </div>

    <div class="mt-6">{{ $courses->links() }}</div>
  @else
    <div class="rounded-2xl border border-dashed border-gray-300 p-12 text-center">
      <h3 class="text-lg font-semibold text-gray-700">No hay cursos aún</h3>
      <p class="text-gray-500 mt-1">Crea tu primer curso para verlo aquí.</p>
      <a href="{{ route('admin.courses.create') }}"
         class="mt-4 inline-flex items-center rounded-xl bg-primary px-4 py-2 text-white hover:bg-primary/90">
        + Nuevo Curso
      </a>
    </div>
  @endif
</section>
@endsection
