@extends('layouts.app')

@section('content')
    {{-- Hero / Encabezado --}}
    <section class="relative py-16 bg-gradient-to-b from-primary/10 to-secondary/10">
        <div class="container mx-auto px-4 md:px-6 max-w-7xl">
            <div class="flex flex-col space-y-3 md:flex-row md:items-center md:justify-between">
                <div>
                    <p class="text-xs font-medium uppercase tracking-[0.2em] text-primary/70 mb-2">
                        Solicitud #{{ $contact->id }}
                    </p>
                    <h1 class="text-2xl md:text-3xl font-bold tracking-tight text-primary">
                        Detalle de la solicitud de contacto
                    </h1>
                    <p class="text-gray-600 mt-1 text-sm md:text-base">
                        Información completa del mensaje enviado por {{ $contact->name }}.
                    </p>
                </div>

                <div class="mt-4 md:mt-0 flex flex-col items-start md:items-end space-y-2">
                    @php
                        $status = $contact->status;
                        $badgeClasses = match ($status) {
                            'new' => 'bg-blue-50 text-blue-700 ring-blue-200',
                            'in_progress' => 'bg-amber-50 text-amber-700 ring-amber-200',
                            'done' => 'bg-emerald-50 text-emerald-700 ring-emerald-200',
                            default => 'bg-gray-50 text-gray-700 ring-gray-200',
                        };
                        $label = match ($status) {
                            'new' => 'Nuevo',
                            'in_progress' => 'En progreso',
                            'done' => 'Resuelto',
                            default => ucfirst($status),
                        };
                    @endphp

                    <span
                        class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium ring-1 {{ $badgeClasses }}">
                        <span class="w-1.5 h-1.5 rounded-full bg-current mr-1"></span>
                        {{ $label }}
                    </span>

                    <p class="text-xs text-gray-500">
                        Recibido el {{ $contact->created_at->format('d/m/Y \a \l\a\s H:i') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Contenido principal --}}
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4 md:px-6 max-w-7xl space-y-8">
            @if (session('status'))
                <div class="rounded-xl border border-emerald-100 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 flex items-start gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mt-0.5" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10" />
                        <path d="m9 12 2 2 4-4" />
                    </svg>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                {{-- Columna izquierda: datos de contacto --}}
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-gradient-to-b from-white to-gray-50 border border-gray-100 rounded-2xl shadow-sm p-6">
                        <h2 class="text-sm font-semibold text-gray-900 mb-4">
                            Datos del remitente
                        </h2>

                        <dl class="space-y-3 text-sm">
                            <div>
                                <dt class="text-gray-500">Nombre</dt>
                                <dd class="font-medium text-gray-900">
                                    {{ $contact->name }}
                                </dd>
                            </div>

                            <div>
                                <dt class="text-gray-500">Email</dt>
                                <dd>
                                    <a href="mailto:{{ $contact->email }}"
                                       class="font-medium text-primary hover:text-primary/80 underline decoration-primary/30">
                                        {{ $contact->email }}
                                    </a>
                                </dd>
                            </div>

                            <div>
                                <dt class="text-gray-500">Teléfono</dt>
                                <dd class="font-medium text-gray-900">
                                    {{ $contact->phone }}
                                </dd>
                            </div>

                            <div>
                                <dt class="text-gray-500">Asunto</dt>
                                <dd class="font-medium text-gray-900">
                                    {{ $contact->subject }}
                                </dd>
                            </div>

                            <div>
                                <dt class="text-gray-500">Estado actual</dt>
                                <dd>
                                    <span
                                        class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium ring-1 {{ $badgeClasses }}">
                                        <span class="w-1.5 h-1.5 rounded-full bg-current mr-1"></span>
                                        {{ $label }}
                                    </span>
                                </dd>
                            </div>
                        </dl>
                    </div>

                    {{-- Formulario de actualización de estado --}}
                    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6">
                        <h2 class="text-sm font-semibold text-gray-900 mb-4">
                            Actualizar estado
                        </h2>

                        <form method="POST" action="{{ route('admin.contact.updateStatus', $contact) }}" class="space-y-4">
                            @csrf
                            @method('PATCH')

                            <div class="space-y-2">
                                <label for="status" class="block text-xs font-medium uppercase tracking-wide text-gray-500">
                                    Nuevo estado
                                </label>
                                <select id="status" name="status"
                                    class="block w-full rounded-xl border-gray-200 text-sm shadow-sm focus:ring-primary focus:border-primary">
                                    <option value="new" {{ $contact->status === 'new' ? 'selected' : '' }}>Nuevo</option>
                                    <option value="in_progress" {{ $contact->status === 'in_progress' ? 'selected' : '' }}>En progreso</option>
                                    <option value="done" {{ $contact->status === 'done' ? 'selected' : '' }}>Resuelto</option>
                                </select>
                                @error('status')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex flex-wrap gap-3">
                                <button type="submit"
                                    class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold rounded-xl bg-primary text-white hover:bg-primary/90 transition">
                                    Guardar cambios
                                </button>

                                <a href="{{ route('admin.contact.index') }}"
                                   class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold rounded-xl border border-gray-200 text-gray-700 hover:bg-gray-50 transition">
                                    Volver al listado
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Columna derecha: mensaje --}}
                <div class="lg:col-span-2">
                    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6 md:p-8">
                        <h2 class="text-sm font-semibold text-gray-900 mb-4">
                            Mensaje
                        </h2>

                        <div
                            class="relative rounded-2xl border border-dashed border-gray-200 bg-gray-50/60 px-4 py-4 md:px-6 md:py-6">
                            {{-- Comillas decorativas --}}

                            <p class="relative text-sm md:text-base text-gray-700 whitespace-pre-wrap leading-relaxed">
                                {{ $contact->message }}
                            </p>
                        </div>
                    </div>

                    {{-- Info adicional (timestamps) --}}
                    <div class="mt-4 text-xs text-gray-500 flex flex-wrap gap-3">
                        <span>
                            Creado: {{ $contact->created_at->format('d/m/Y H:i') }}
                        </span>
                        @if ($contact->updated_at && !$contact->created_at->equalTo($contact->updated_at))
                            <span class="inline-flex items-center gap-1">
                                <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                                Última actualización: {{ $contact->updated_at->format('d/m/Y H:i') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
