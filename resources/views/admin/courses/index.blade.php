@extends('layouts.app')

@section('content')
<section class="py-8 md:py-12">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <h1 class="text-3xl font-bold bg-gradient-to-r from-primary via-secondary to-secondary bg-clip-text text-transparent">
      Administrar Cursos
    </h1>
    <a href="{{ route('admin.courses.create') }}"
       class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-primary to-secondary px-4 py-2 text-white shadow-sm hover:shadow-md transition-all duration-300">
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
    <div class="sm:hidden md:block overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
      <div class="max-h-[60vh] overflow-auto">
        <table class="min-w-full text-sm">
          <thead class="bg-slate-50 sticky top-0 z-10">
            <tr class="text-left text-[13px] font-semibold text-gray-600 uppercase tracking-wide">
              <th class="px-5 py-3 w-[40%]">Título</th>
              <th class="px-5 py-3">Categoría</th>
              <th class="px-5 py-3 text-right">Horas</th>
              <th class="px-5 py-3 text-center">Destacado</th>
              <th class="px-5 py-3 text-right">Acciones</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            @foreach($courses as $course)
              <tr class="hover:bg-slate-50 transition-colors">
                <td class="px-5 py-4">
                  <div class="font-medium text-gray-900 line-clamp-2">{{ $course->title }}</div>
                  @if($course->slug)
                    <div class="text-xs text-gray-500 mt-0.5">/{{ $course->slug }}</div>
                  @endif
                </td>
                <td class="px-5 py-4">
                  <span class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-1 text-xs text-slate-700">
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
                    <span class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-600">
                      No
                    </span>
                  @endif
                </td>
                <td class="px-5 py-4">
                  <div class="flex items-center justify-end gap-2">
                    <a href="{{ route('admin.courses.edit', $course) }}"
                       class="px-3 py-1.5 rounded-xl border border-slate-200 bg-white text-slate-700 shadow-sm hover:shadow-md hover:bg-slate-50 transition-all duration-300">
                      Editar
                    </a>
                    <form action="{{ route('admin.courses.destroy', $course) }}" method="POST"
                          onsubmit="return confirm('¿Eliminar este curso? Esta acción no se puede deshacer.')">
                      @csrf @method('DELETE')
                    <button type="submit"
                            class="px-3 py-1.5 rounded-xl bg-red-600 text-white shadow-sm hover:shadow-md hover:bg-red-700 transition-all duration-300">
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
        <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
          <div class="flex items-start justify-between gap-3">
            <div class="min-w-0">
              <h3 class="font-semibold text-gray-900">{{ $course->title }}</h3>
              <div class="mt-1 flex flex-wrap items-center gap-2">
                <span class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-0.5 text-xs text-slate-700">
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
               class="inline-flex items-center rounded-xl border border-slate-200 bg-white px-3 py-1.5 text-slate-700 shadow-sm hover:shadow-md hover:bg-slate-50 transition-all duration-300">
              Editar
            </a>
            <form action="{{ route('admin.courses.destroy', $course) }}" method="POST"
                  onsubmit="return confirm('¿Eliminar este curso?')">
              @csrf @method('DELETE')
                <button
                    class="inline-flex items-center rounded-xl bg-red-600 px-3 py-1.5 text-white shadow-sm hover:shadow-md hover:bg-red-700 transition-all duration-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-red-300">
                    Eliminar
                </button>
            </form>
          </div>
        </div>
      @endforeach
    </div>

    <div class="mt-6">{{ $courses->links() }}</div>
  @else
    <div class="rounded-2xl border border-dashed border-slate-300 p-12 text-center bg-white/60">
      <h3 class="text-lg font-semibold text-gray-700">No hay cursos aún</h3>
      <p class="text-gray-500 mt-1">Crea tu primer curso para verlo aquí.</p>
      <a href="{{ route('admin.courses.create') }}"
         class="mt-4 inline-flex items-center rounded-xl bg-gradient-to-r from-primary to-secondary px-4 py-2 text-white shadow-sm hover:shadow-md transition-all duration-300">
        + Nuevo Curso
      </a>
    </div>
  @endif
</div>
</section>
@endsection
