@php
  $isEdit = isset($course) && $course;
@endphp

{{-- Errores --}}
@if ($errors->any())
  <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-red-700">
    <div class="font-semibold mb-2">Corrige los siguientes errores:</div>
    <ul class="list-disc ml-5 space-y-1 text-sm">
      @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
    </ul>
  </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
  <div>
    <label class="block text-sm font-medium text-gray-700">Título *</label>
    <input type="text" name="title" required
      value="{{ old('title', $isEdit ? $course->title : '') }}"
      class="mt-1 block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary" />
  </div>

  <div>
    <label class="block text-sm font-medium text-gray-700">Slug (opcional)</label>
    <input type="text" name="slug"
      value="{{ old('slug', $isEdit ? $course->slug : '') }}"
      placeholder="se-generará desde el título si lo dejas vacío"
      class="mt-1 block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary" />
  </div>

  <div>
    <label class="block text-sm font-medium text-gray-700">Categoría *</label>
    <select name="category" required
      class="mt-1 block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary">
      <option value="" disabled {{ old('category', $isEdit ? $course->category : '')==='' ? 'selected' : '' }}>Elige…</option>
      @foreach($categories as $val => $label)
        <option value="{{ $val }}" {{ old('category', $isEdit ? $course->category : '') === $val ? 'selected' : '' }}>
          {{ $label }}
        </option>
      @endforeach
    </select>
  </div>

  <div>
    <label class="block text-sm font-medium text-gray-700">Horas *</label>
    <input type="number" name="hours" min="0" step="1" required
      value="{{ old('hours', $isEdit ? $course->hours : 0) }}"
      class="mt-1 block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary" />
  </div>

  <div class="md:col-span-2">
    <label class="block text-sm font-medium text-gray-700">Imagen (JPG/PNG/WEBP, máx 2MB)</label>
    <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp"
      class="mt-1 block w-full rounded-lg border-gray-300 file:mr-4 file:rounded-md file:border-0 file:bg-primary file:px-4 file:py-2 file:text-white hover:file:bg-primary/90" />
    @if($isEdit && $course->image)
      <div class="mt-3 flex items-center gap-4">
        <img src="{{ asset($course->image) }}" alt="Imagen actual" class="h-24 w-auto rounded-lg ring-1 ring-gray-200" />
        <label class="inline-flex items-center gap-2 text-sm">
          <input type="checkbox" name="remove_image" value="1"
            class="rounded border-gray-300 text-primary focus:ring-primary">
          <span>Eliminar imagen actual</span>
        </label>
      </div>
    @endif
  </div>

  <div class="md:col-span-2">
    <label class="block text-sm font-medium text-gray-700">Resumen (excerpt)</label>
    <textarea name="excerpt" rows="3"
      class="mt-1 block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary">{{ old('excerpt', $isEdit ? $course->excerpt : '') }}</textarea>
  </div>

  <div class="md:col-span-2">
    <label class="block text-sm font-medium text-gray-700">Descripción (larga)</label>
    <textarea name="description" rows="6"
      class="mt-1 block w-full rounded-lg border-gray-300 focus:border-primary focus:ring-primary">{{ old('description', $isEdit ? $course->description : '') }}</textarea>
  </div>

  <div class="md:col-span-2">
    <input type="hidden" name="featured" value="0">
    <label class="relative inline-flex items-center cursor-pointer">
      <input
        type="checkbox"
        name="featured"
        id="featured"
        value="1"
        {{ old('featured', $isEdit ? (int)$course->featured : 0) ? 'checked' : '' }}
        class="sr-only peer"
      >
      <div class="w-11 h-6 bg-gray-200 rounded-full peer-checked:bg-primary transition"></div>
      <span class="ml-3 text-sm text-gray-700">Destacado</span>
    </label>
  </div>
</div>
