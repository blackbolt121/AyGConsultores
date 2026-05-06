@php
  $isEdit = isset($course) && $course;
@endphp

{{-- Errores --}}
@if ($errors->any())
  <div class="mb-8 rounded-2xl border border-red-200 bg-red-50 p-5 text-red-700 flex items-start gap-4">
    <svg class="w-6 h-6 shrink-0 text-red-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
    </svg>
    <div>
        <div class="font-semibold mb-2">Por favor, corrige los siguientes errores:</div>
        <ul class="list-disc ml-5 space-y-1 text-sm opacity-90">
            @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
        </ul>
    </div>
  </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
  <div class="space-y-2">
    <label class="block text-sm font-semibold text-slate-700">Título del Curso <span class="text-red-500">*</span></label>
    <input type="text" name="title" required
      value="{{ old('title', $isEdit ? $course->title : '') }}"
      class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors outline-none text-slate-800 placeholder:text-slate-400" placeholder="Ej. Liderazgo Efectivo" />
  </div>

  <div class="space-y-2">
    <label class="block text-sm font-semibold text-slate-700">Slug (URL amigable)</label>
    <input type="text" name="slug"
      value="{{ old('slug', $isEdit ? $course->slug : '') }}"
      placeholder="Se genera automáticamente si se deja vacío"
      class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors outline-none text-slate-800 placeholder:text-slate-400" />
  </div>

  <div class="space-y-2">
    <label class="block text-sm font-semibold text-slate-700">Categoría <span class="text-red-500">*</span></label>
    <div class="relative">
      <select name="category" required
        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors outline-none text-slate-800 appearance-none">
        <option value="" disabled {{ old('category', $isEdit ? $course->category : '')==='' ? 'selected' : '' }}>Elige una categoría…</option>
        @foreach($categories as $val => $label)
          <option value="{{ $val }}" {{ old('category', $isEdit ? $course->category : '') === $val ? 'selected' : '' }}>
            {{ $label }}
          </option>
        @endforeach
      </select>
      <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
          <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
      </div>
    </div>
  </div>

  <div class="space-y-2">
    <label class="block text-sm font-semibold text-slate-700">Duración (Horas) <span class="text-red-500">*</span></label>
    <input type="number" name="hours" min="0" step="1" required
      value="{{ old('hours', $isEdit ? $course->hours : 0) }}"
      class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors outline-none text-slate-800" />
  </div>

  <div class="md:col-span-2 space-y-2">
    <label class="block text-sm font-semibold text-slate-700">Imagen de Portada (JPG/PNG/WEBP, máx 2MB)</label>
    <div class="relative flex items-center w-full px-4 py-3 rounded-xl border border-dashed border-slate-300 bg-slate-50 hover:bg-slate-100 transition-colors">
      <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp"
        class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 cursor-pointer" />
    </div>
    @if($isEdit && $course->image)
      <div class="mt-4 p-4 rounded-xl border border-slate-100 bg-white flex items-center justify-between gap-4">
        <div class="flex items-center gap-4">
          <img src="{{ asset($course->image) }}" alt="Imagen actual" class="h-16 w-16 object-cover rounded-lg shadow-sm" />
          <span class="text-sm font-medium text-slate-600">Imagen actual</span>
        </div>
        <label class="inline-flex items-center gap-2 text-sm text-red-600 hover:text-red-700 cursor-pointer bg-red-50 px-3 py-2 rounded-lg transition-colors">
          <input type="checkbox" name="remove_image" value="1"
            class="rounded border-red-300 text-red-600 focus:ring-red-500 cursor-pointer">
          <span class="font-medium">Eliminar</span>
        </label>
      </div>
    @endif
  </div>

  <div class="md:col-span-2 space-y-2">
    <label class="block text-sm font-semibold text-slate-700">Resumen Corto</label>
    <textarea name="excerpt" rows="2"
      class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors outline-none text-slate-800 placeholder:text-slate-400" placeholder="Una breve descripción que aparecerá en las tarjetas del curso...">{{ old('excerpt', $isEdit ? $course->excerpt : '') }}</textarea>
  </div>

  <div class="md:col-span-2 space-y-2">
    <label class="block text-sm font-semibold text-slate-700">Descripción Completa</label>
    <textarea name="description" rows="6"
      class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors outline-none text-slate-800 placeholder:text-slate-400" placeholder="Escribe todos los detalles del curso aquí...">{{ old('description', $isEdit ? $course->description : '') }}</textarea>
  </div>

  <div class="md:col-span-2 pt-2">
    <input type="hidden" name="featured" value="0">
    <label class="inline-flex items-center cursor-pointer bg-slate-50 border border-slate-200 p-4 rounded-xl hover:bg-slate-100 transition-colors w-full sm:w-auto">
      <div class="relative flex items-center">
        <input type="checkbox" name="featured" id="featured" value="1"
          {{ old('featured', $isEdit ? (int)$course->featured : 0) ? 'checked' : '' }}
          class="sr-only peer">
        <div class="w-11 h-6 bg-slate-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
      </div>
      <div class="ml-4 flex flex-col">
          <span class="text-sm font-semibold text-slate-900">Marcar como Destacado</span>
          <span class="text-xs text-slate-500">El curso aparecerá resaltado en el inicio.</span>
      </div>
    </label>
  </div>
</div>
