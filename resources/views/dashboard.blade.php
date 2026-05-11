@extends('layouts.app')

@section('content')
    {{-- Hero --}}
    <section class="relative py-8 md:py-12 bg-gradient-to-b from-primary/10 to-secondary/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col items-center space-y-3 text-center">
                <h1 class="text-3xl md:text-4xl font-bold tracking-tight text-primary">
                    Mis Solicitudes de Contacto
                </h1>
                <p class="max-w-2xl text-slate-600 md:text-lg">
                    Estas son las solicitudes de contacto que has enviado con el correo
                    <span class="font-semibold text-primary">{{ $user->email }}</span>.
                </p>
            </div>
        </div>
    </section>

    {{-- Listado --}}
    <section class="py-8 md:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($contacts->count() === 0)
                <div class="flex flex-col items-center justify-center py-16">
                    <div
                        class="w-16 h-16 rounded-2xl bg-white shadow-sm border border-slate-200 flex items-center justify-center mb-4 text-primary">
                        {{-- Icono --}}
                        <x-icon name="lucide-mail" class="w-8 h-8" />
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">
                        No has enviado solicitudes aún
                    </h2>
                    <p class="text-gray-600 max-w-md text-center">
                        Cuando envíes un mensaje a través del formulario de contacto, podrás ver su historial aquí.
                    </p>
                </div>
            @else
                <div class="space-y-6">
                    {{-- Resumen superior --}}
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">
                                Historial de solicitudes
                            </h2>
                            <p class="text-sm text-gray-500">
                                Mostrando {{ $contacts->firstItem() }}–{{ $contacts->lastItem() }}
                                de {{ $contacts->total() }} solicitudes.
                            </p>
                        </div>
                    </div>

                    {{-- Grid de tarjetas --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach ($contacts as $contact)
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

                            <article class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 flex flex-col h-full transition-all duration-300 hover:shadow-md hover:-translate-y-0.5">
                                <div class="flex items-start justify-between gap-3 mb-3">
                                    <div>
                                        <h3 class="text-sm font-semibold text-gray-900 line-clamp-2">
                                            {{ $contact->subject }}
                                        </h3>
                                        <p class="text-xs text-gray-500 mt-1">
                                            Enviado el {{ $contact->created_at->format('d/m/Y \a \l\a\s H:i') }}
                                        </p>
                                    </div>
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-medium ring-1 {{ $badgeClasses }}">
                                        <span class="w-1.5 h-1.5 rounded-full bg-current mr-1"></span>
                                        {{ $label }}
                                    </span>
                                </div>

                                <div class="text-sm text-gray-700 mb-4">
                                    <p class="font-medium text-gray-800 mb-1">
                                        Mensaje:
                                    </p>
                                    <p class="text-gray-700 text-sm whitespace-pre-wrap line-clamp-4">
                                        {{ $contact->message }}
                                    </p>
                                </div>

                                <div class="mt-auto flex items-center justify-between pt-3 border-t border-slate-200">
                                    <span class="text-xs text-gray-500">
                                        ID #{{ $contact->id }}
                                    </span>
                                    {{-- Si quieres que solo sea lectura, deja este botón como "Ver más" sin ruta admin --}}
                                    <a href="{{ route('dashboard.show', $contact) }}"
                                       class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-full bg-gradient-to-r from-primary to-secondary text-white shadow-sm hover:shadow-md transition-all duration-300">
                                        Ver detalle completo
                                        <x-icon name="lucide-chevron-right" class="w-3.5 h-3.5" />
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    {{-- Paginación --}}
                    <div class="flex items-center justify-between pt-4 border-t border-slate-200">
                        <div class="text-xs text-gray-500">
                            Página {{ $contacts->currentPage() }} de {{ $contacts->lastPage() }}
                        </div>
                        <div>
                            {{ $contacts->onEachSide(1)->links() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
