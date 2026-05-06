@php
  // Cargar árbol básico (ajusta profundidad si quieres)
  $course->loadMissing(['rootContents.children' /* , 'rootContents.children.children' */ ]);
  $types = [
    'section'  => 'Sección',
    'unit'     => 'Unidad',
    'topic'    => 'Tema',
    'exercise' => 'Ejercicio',
    'appendix' => 'Apéndice',
  ];
@endphp

<div class="mt-12 bg-white rounded-3xl border border-slate-100 p-8 md:p-10 shadow-[0_8px_30px_rgb(0,0,0,0.04)] relative overflow-hidden">
  <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-primary to-secondary"></div>
  
  <div class="flex items-center justify-between mb-8">
      <div>
          <h3 class="text-2xl font-bold text-slate-900">Temario del Curso</h3>
          <p class="text-slate-500 text-sm mt-1">Organiza las secciones, unidades y materiales.</p>
      </div>
  </div>

  {{-- Crear raíz --}}
  <details class="mb-8 group">
    <summary class="cursor-pointer list-none">
        <div class="inline-flex items-center justify-center rounded-xl bg-secondary/10 text-secondary px-5 py-3 text-sm font-semibold hover:bg-secondary/15 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            Agregar Sección Principal
        </div>
    </summary>
    <div class="mt-4 p-6 rounded-2xl border border-slate-200 bg-slate-50">
        <h4 class="text-sm font-semibold text-slate-800 mb-4">Nueva Sección</h4>
        <form action="{{ route('admin.courses.contents.store', $course) }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-5">
        @csrf
        <input type="hidden" name="parent_id" value="">
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-slate-700 mb-1">Título *</label>
            <input type="text" name="title" required class="block w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-secondary/20 focus:border-secondary text-sm outline-none transition-colors placeholder:text-slate-400" placeholder="Ej. Introducción al curso">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Tipo</label>
            <div class="relative">
                <select name="type" class="block w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-secondary/20 focus:border-secondary text-sm outline-none transition-colors appearance-none">
                @foreach($types as $val => $label)
                    <option value="{{ $val }}">{{ $label }}</option>
                @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                </div>
            </div>
        </div>
        <div class="md:col-span-3">
            <label class="block text-sm font-medium text-slate-700 mb-1">Resumen (Opcional)</label>
            <textarea name="summary" rows="2" class="block w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-secondary/20 focus:border-secondary text-sm outline-none transition-colors placeholder:text-slate-400" placeholder="Breve descripción de la sección..."></textarea>
        </div>
        <div class="md:col-span-3 flex justify-end">
            <button type="submit" class="inline-flex items-center rounded-xl bg-gradient-to-r from-primary to-secondary px-6 py-2.5 text-sm font-medium text-white hover:opacity-95 focus:ring-4 focus:ring-secondary/20 transition-all shadow-sm">
                Guardar Sección
            </button>
        </div>
        </form>
    </div>
  </details>

  {{-- Árbol --}}
  @if($course->rootContents->isEmpty())
    <div class="text-center py-12 px-4 rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50">
        <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
        <p class="text-slate-500 font-medium">Aún no hay contenido en este curso.</p>
        <p class="text-slate-400 text-sm mt-1">Haz clic en "Agregar Sección Principal" para comenzar a construir el temario.</p>
    </div>
  @else
    <ol class="space-y-4">
      @foreach($course->rootContents as $root)
        @include('admin.courses._content_item', ['item' => $root, 'course' => $course, 'types' => $types, 'depth' => 0])
      @endforeach
    </ol>
  @endif
</div>

{{-- Modal global (Editar / Agregar) --}}
<div id="content-modal" class="hidden fixed inset-0 z-50">
  <div id="content-modal-overlay" class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>
  <div class="relative w-full h-full flex items-center justify-center p-4">
    <div class="w-full max-w-2xl rounded-2xl bg-white shadow-xl border border-slate-100 max-h-[85vh] overflow-auto">
      <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
        <div>
          <h3 id="content-modal-title" class="text-lg font-semibold text-slate-900">Contenido</h3>
          <p id="content-modal-subtitle" class="text-xs text-slate-500 mt-1 hidden"></p>
        </div>
        <button id="content-modal-close" type="button" class="p-2 rounded-lg text-slate-500 hover:text-slate-900 hover:bg-slate-100" aria-label="Cerrar">
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
      </div>

      {{-- Editar --}}
      <div id="content-modal-edit" class="px-6 py-5">
        <form id="content-modal-edit-form" method="POST" class="grid grid-cols-1 gap-4">
          @csrf
          @method('PUT')

          <div>
            <label class="block text-xs font-semibold text-slate-600 mb-1">Titulo *</label>
            <input id="content-modal-edit-title" type="text" name="title" class="block w-full px-3 py-2 rounded-lg border border-slate-200 focus:ring-2 focus:ring-secondary/20 focus:border-secondary text-sm outline-none" required>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-xs font-semibold text-slate-600 mb-1">Tipo</label>
              <select id="content-modal-edit-type" name="type" class="block w-full px-3 py-2 rounded-lg border border-slate-200 focus:ring-2 focus:ring-secondary/20 focus:border-secondary text-sm outline-none">
                @foreach($types as $val => $label)
                  <option value="{{ $val }}">{{ $label }}</option>
                @endforeach
              </select>
            </div>
            <div>
              <label class="block text-xs font-semibold text-slate-600 mb-1">Mover a</label>
              <select id="content-modal-edit-parent" name="parent_id" class="block w-full px-3 py-2 rounded-lg border border-slate-200 focus:ring-2 focus:ring-secondary/20 focus:border-secondary text-sm outline-none">
                <option value="">Raiz</option>
                @foreach($course->rootContents as $rootOption)
                  <option value="{{ $rootOption->id }}">{{ $rootOption->title }}</option>
                @endforeach
              </select>
              <p class="text-[11px] text-slate-400 mt-1">Por ahora solo puedes mover a la raiz o a una seccion principal.</p>
            </div>
          </div>

          <div>
            <label class="block text-xs font-semibold text-slate-600 mb-1">Resumen Corto</label>
            <textarea id="content-modal-edit-summary" name="summary" rows="2" class="block w-full px-3 py-2 rounded-lg border border-slate-200 focus:ring-2 focus:ring-secondary/20 focus:border-secondary text-sm outline-none"></textarea>
          </div>
          <div>
            <label class="block text-xs font-semibold text-slate-600 mb-1">Contenido HTML / Text</label>
            <textarea id="content-modal-edit-body" name="body" rows="6" class="block w-full px-3 py-2 rounded-lg border border-slate-200 focus:ring-2 focus:ring-secondary/20 focus:border-secondary text-sm outline-none font-mono text-xs"></textarea>
          </div>

          <div class="flex items-center justify-end gap-3 pt-2">
            <button type="button" class="content-modal-cancel inline-flex items-center rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Cancelar</button>
            <button type="submit" class="inline-flex items-center rounded-lg bg-gradient-to-r from-primary to-secondary px-4 py-2 text-white text-sm font-medium hover:opacity-95">Guardar</button>
          </div>
        </form>
      </div>

      {{-- Agregar --}}
      <div id="content-modal-add" class="px-6 py-5 hidden">
        <form id="content-modal-add-form" method="POST" class="grid grid-cols-1 gap-4">
          @csrf
          <input id="content-modal-add-parent-id" type="hidden" name="parent_id" value="">

          <div class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700">
            Agregar dentro de: <strong id="content-modal-add-parent-title">(sin padre)</strong>
          </div>

          <div>
            <label class="block text-xs font-semibold text-slate-600 mb-1">Titulo *</label>
            <input id="content-modal-add-title" type="text" name="title" class="block w-full px-3 py-2 rounded-lg border border-slate-200 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-sm outline-none" required>
          </div>

          <div>
            <label class="block text-xs font-semibold text-slate-600 mb-1">Tipo</label>
            <select id="content-modal-add-type" name="type" class="block w-full px-3 py-2 rounded-lg border border-slate-200 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-sm outline-none">
              @foreach($types as $val => $label)
                <option value="{{ $val }}">{{ $label }}</option>
              @endforeach
            </select>
          </div>

          <div>
            <label class="block text-xs font-semibold text-slate-600 mb-1">Resumen (Opcional)</label>
            <textarea id="content-modal-add-summary" name="summary" rows="2" class="block w-full px-3 py-2 rounded-lg border border-slate-200 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-sm outline-none"></textarea>
          </div>

          <div class="flex items-center justify-end gap-3 pt-2">
            <button type="button" class="content-modal-cancel inline-flex items-center rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Cancelar</button>
            <button type="submit" class="inline-flex items-center rounded-lg bg-emerald-600 px-4 py-2 text-white text-sm font-medium hover:bg-emerald-700">Agregar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('content-modal');
    const overlay = document.getElementById('content-modal-overlay');
    const closeBtn = document.getElementById('content-modal-close');

    const titleEl = document.getElementById('content-modal-title');
    const subtitleEl = document.getElementById('content-modal-subtitle');

    const editWrap = document.getElementById('content-modal-edit');
    const addWrap = document.getElementById('content-modal-add');

    const editForm = document.getElementById('content-modal-edit-form');
    const editTitle = document.getElementById('content-modal-edit-title');
    const editType = document.getElementById('content-modal-edit-type');
    const editParent = document.getElementById('content-modal-edit-parent');
    const editSummary = document.getElementById('content-modal-edit-summary');
    const editBody = document.getElementById('content-modal-edit-body');

    const addForm = document.getElementById('content-modal-add-form');
    const addParentId = document.getElementById('content-modal-add-parent-id');
    const addParentTitle = document.getElementById('content-modal-add-parent-title');
    const addTitle = document.getElementById('content-modal-add-title');
    const addType = document.getElementById('content-modal-add-type');
    const addSummary = document.getElementById('content-modal-add-summary');

    const openModal = (mode, payload) => {
      modal.classList.remove('hidden');

      subtitleEl.classList.add('hidden');
      subtitleEl.textContent = '';

      if (mode === 'edit') {
        titleEl.textContent = 'Editar contenido';
        if (payload.label) {
          subtitleEl.textContent = payload.label;
          subtitleEl.classList.remove('hidden');
        }

        editWrap.classList.remove('hidden');
        addWrap.classList.add('hidden');

        editForm.action = payload.action;
        editTitle.value = payload.title ?? '';
        editType.value = payload.type ?? 'section';
        editParent.value = payload.parent_id ?? '';
        editSummary.value = payload.summary ?? '';
        editBody.value = payload.body ?? '';

        setTimeout(() => editTitle.focus(), 0);
        return;
      }

      titleEl.textContent = 'Agregar sub-contenido';
      editWrap.classList.add('hidden');
      addWrap.classList.remove('hidden');

      addForm.action = payload.action;
      addParentId.value = payload.parent_id;
      addParentTitle.textContent = payload.parent_title ?? 'Elemento';
      addTitle.value = '';
      addType.value = 'topic';
      addSummary.value = '';

      setTimeout(() => addTitle.focus(), 0);
    };

    const closeModal = () => {
      modal.classList.add('hidden');
    };

    document.addEventListener('click', (e) => {
      const btn = e.target.closest('[data-modal]');
      if (!btn) return;
      const mode = btn.getAttribute('data-modal');
      const raw = btn.getAttribute('data-payload');
      if (!raw) return;
      try {
        const payload = JSON.parse(raw);
        openModal(mode, payload);
      } catch (err) {
        console.error('Payload invalido para modal', err);
      }
    });

    overlay.addEventListener('click', closeModal);
    closeBtn.addEventListener('click', closeModal);
    document.querySelectorAll('.content-modal-cancel').forEach((b) => b.addEventListener('click', closeModal));

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
        closeModal();
      }
    });
  });
</script>
@endpush
