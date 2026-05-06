@extends('layouts.app')

@section('content')
<section class="py-10 container mx-auto max-w-5xl px-4">
    <div class="mb-8 flex items-start justify-between gap-4">
        <div>
        <a href="{{ route('admin.courses.cycles.index', $course) }}" class="text-sm text-gray-500 hover:text-primary mb-2 inline-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Volver a ciclos
        </a>
        <h1 class="text-3xl font-bold bg-gradient-to-r from-primary via-secondary to-purple-600 bg-clip-text text-transparent">
            Editar Ciclo
        </h1>
        <p class="text-gray-500 mt-2">{{ $course->title }} · {{ $ciclo->name }}</p>
        </div>

        <button
            id="cycle-delete-open"
            type="button"
            class="inline-flex items-center gap-2 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-700 hover:bg-red-100"
            aria-haspopup="dialog"
            aria-controls="cycle-delete-modal"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
            Eliminar
        </button>
    </div>

    @if (session('status'))
        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">
            {{ session('status') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
        <form method="POST" action="{{ route('admin.courses.cycles.update', [$course, $ciclo]) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Nombre</label>
                <input name="name" required value="{{ old('name', $ciclo->name) }}" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm" />
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Estado</label>
                    <select name="status" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm">
                        @foreach(['draft','open','active','closed','archived'] as $st)
                            <option value="{{ $st }}" @selected(old('status', $ciclo->status) === $st)>{{ $st }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Cupo (0 = sin limite)</label>
                    <input name="capacity" type="number" min="0" required value="{{ old('capacity', $ciclo->capacity) }}" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm" />
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Inicio</label>
                    <input name="starts_at" type="date" value="{{ old('starts_at', optional($ciclo->starts_at)->format('Y-m-d')) }}" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm" />
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Fin</label>
                    <input name="ends_at" type="date" value="{{ old('ends_at', optional($ciclo->ends_at)->format('Y-m-d')) }}" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm" />
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Docentes asignados</label>
                <select name="teachers[]" multiple class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm h-40">
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}" @selected($ciclo->teachers->contains('id', $teacher->id))>{{ $teacher->name }} ({{ $teacher->email }})</option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500">Seleccion multiple (Ctrl/Cmd + click).</p>
            </div>

            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                <button type="submit" class="inline-flex items-center rounded-xl bg-primary px-6 py-3 text-sm font-medium text-white hover:bg-primary/90">Guardar</button>

                <a href="{{ route('admin.courses.cycles.index', $course) }}" class="inline-flex items-center rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50">Cancelar</a>
            </div>
        </form>
    </div>

    {{-- Modal eliminar ciclo --}}
    <div id="cycle-delete-modal" class="hidden fixed inset-0 z-50" role="dialog" aria-modal="true" aria-labelledby="cycle-delete-title">
        <div id="cycle-delete-overlay" class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>
        <div class="relative mx-auto mt-24 w-[92%] max-w-lg">
            <div class="bg-white rounded-2xl border border-gray-200 shadow-xl overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 bg-gray-50/50 flex items-start justify-between gap-3">
                    <div>
                        <h3 id="cycle-delete-title" class="text-lg font-semibold text-gray-900">Eliminar ciclo</h3>
                        <p class="text-xs text-gray-500 mt-1">Esta acción no se puede deshacer.</p>
                    </div>
                    <button id="cycle-delete-close" type="button" class="p-2 rounded-lg text-gray-500 hover:text-gray-900 hover:bg-gray-100" aria-label="Cerrar">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form id="cycle-delete-form" method="POST" action="{{ route('admin.courses.cycles.destroy', [$course, $ciclo]) }}" class="px-6 py-5 space-y-4">
                    @csrf
                    @method('DELETE')

                    <div class="rounded-xl border border-amber-200 bg-amber-50 p-4 text-amber-900 text-sm">
                        Para confirmar, escribe exactamente: <strong id="cycle-delete-expected">{{ $ciclo->name }}</strong>
                    </div>

                    <div class="space-y-2">
                        <label for="cycle-delete-input" class="block text-sm font-medium text-gray-700">Nombre del ciclo</label>
                        <input id="cycle-delete-input" type="text" autocomplete="off" class="block w-full rounded-xl border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 text-sm" placeholder="{{ $ciclo->name }}" />
                        <p id="cycle-delete-hint" class="text-xs text-gray-500">El botón se habilita cuando coincide.</p>
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-2">
                        <button type="button" class="cycle-delete-cancel inline-flex items-center rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Cancelar</button>
                        <button id="cycle-delete-submit" type="submit" disabled class="inline-flex items-center rounded-xl bg-red-600 px-4 py-2 text-sm font-medium text-white disabled:opacity-50 disabled:cursor-not-allowed hover:bg-red-700">
                            Eliminar definitivamente
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
  (() => {
    const expected = @json($ciclo->name);
    const modal = document.getElementById('cycle-delete-modal');
    const overlay = document.getElementById('cycle-delete-overlay');
    const openBtn = document.getElementById('cycle-delete-open');
    const closeBtn = document.getElementById('cycle-delete-close');
    const cancelBtns = document.querySelectorAll('.cycle-delete-cancel');
    const input = document.getElementById('cycle-delete-input');
    const submit = document.getElementById('cycle-delete-submit');

    if (!modal || !openBtn || !input || !submit || !overlay || !closeBtn) return;

    const open = () => {
      modal.classList.remove('hidden');
      input.value = '';
      submit.disabled = true;
      // focus after paint
      setTimeout(() => input.focus(), 0);
    };

    const close = () => {
      modal.classList.add('hidden');
      openBtn.focus();
    };

    const sync = () => {
      submit.disabled = input.value.trim() !== expected;
    };

    openBtn.addEventListener('click', open);
    closeBtn.addEventListener('click', close);
    overlay.addEventListener('click', close);
    cancelBtns.forEach((b) => b.addEventListener('click', close));
    input.addEventListener('input', sync);
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && !modal.classList.contains('hidden')) close();
    });
  })();
</script>
@endpush
