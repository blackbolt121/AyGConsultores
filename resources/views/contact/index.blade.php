@extends('layouts.app')

@section('content')
    {{-- Hero / Encabezado --}}
    <section class="relative py-16 bg-gradient-to-b from-primary/10 to-secondary/10">
        <div class="container mx-auto px-4 md:px-6 max-w-7xl">
            <div class="flex flex-col items-center space-y-3 text-center">
                <h1 class="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl text-primary">
                    Solicitudes de Contacto
                </h1>
                <p class="max-w-[700px] text-gray-600 md:text-lg">
                    Revisa y gestiona los mensajes enviados desde el formulario de contacto del sitio.
                </p>
            </div>
        </div>
    </section>

    {{-- Listado --}}
    <section class="py-12 bg-gradient-to-b from-white to-gray-50">
        <div class="container mx-auto px-4 md:px-6 max-w-7xl">
            @if ($contacts->count() === 0)
                <div class="flex flex-col items-center justify-center py-16">
                    <div
                        class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center mb-4 text-primary">
                        {{-- Icono de inbox vacío --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="20" height="14" x="2" y="5" rx="2" />
                            <path d="M2 13h4l2 3h8l2-3h4" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">
                        No hay solicitudes de contacto
                    </h2>
                    <p class="text-gray-600 max-w-md text-center">
                        Cuando los usuarios envíen mensajes desde el formulario de contacto, aparecerán aquí para que puedas darles seguimiento.
                    </p>
                </div>
            @else
                <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
                    <div class="px-4 sm:px-6 py-4 border-b border-gray-100 flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">
                                Bandeja de solicitudes
                            </h2>
                            <p class="text-sm text-gray-500">
                                Mostrando {{ $contacts->firstItem() }}–{{ $contacts->lastItem() }} de {{ $contacts->total() }} registros
                            </p>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left text-sm text-gray-700">
                            <thead class="bg-gray-50 border-b border-gray-100">
                                <tr>
                                    <th class="px-4 sm:px-6 py-3 font-semibold text-xs text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-4 sm:px-6 py-3 font-semibold text-xs text-gray-500 uppercase tracking-wider">Nombre</th>
                                    <th class="px-4 sm:px-6 py-3 font-semibold text-xs text-gray-500 uppercase tracking-wider hidden md:table-cell">Email</th>
                                    <th class="px-4 sm:px-6 py-3 font-semibold text-xs text-gray-500 uppercase tracking-wider hidden lg:table-cell">Teléfono</th>
                                    <th class="px-4 sm:px-6 py-3 font-semibold text-xs text-gray-500 uppercase tracking-wider">Asunto</th>
                                    <th class="px-4 sm:px-6 py-3 font-semibold text-xs text-gray-500 uppercase tracking-wider">Estado</th>
                                    <th class="px-4 sm:px-6 py-3 font-semibold text-xs text-gray-500 uppercase tracking-wider hidden md:table-cell">Recibido</th>
                                    <th class="px-4 sm:px-6 py-3"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($contacts as $contact)
                                    <tr class="hover:bg-gray-50/60 transition-colors">
                                        <td class="px-4 sm:px-6 py-3 text-xs text-gray-500">
                                            #{{ $contact->id }}
                                        </td>
                                        <td class="px-4 sm:px-6 py-3 text-sm font-medium text-gray-900">
                                            {{ $contact->name }}
                                            <div class="md:hidden text-xs text-gray-500">
                                                {{ $contact->email }}
                                            </div>
                                        </td>
                                        <td class="px-4 sm:px-6 py-3 text-sm text-gray-600 hidden md:table-cell">
                                            {{ $contact->email }}
                                        </td>
                                        <td class="px-4 sm:px-6 py-3 text-sm text-gray-600 hidden lg:table-cell">
                                            {{ $contact->phone }}
                                        </td>
                                        <td class="px-4 sm:px-6 py-3 text-sm text-gray-700">
                                            <span class="line-clamp-1">
                                                {{ $contact->subject }}
                                            </span>
                                        </td>
                                        <td class="px-4 sm:px-6 py-3">
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
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium ring-1 {{ $badgeClasses }}">
                                                <span class="w-1.5 h-1.5 rounded-full bg-current mr-1"></span>
                                                {{ $label }}
                                            </span>
                                        </td>
                                        <td class="px-4 sm:px-6 py-3 text-xs text-gray-500 hidden md:table-cell">
                                            {{ $contact->created_at->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="px-4 sm:px-6 py-3 text-right">
                                            <a href="{{ route('admin.contact.show', $contact) }}"
                                               class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-full bg-primary text-white hover:bg-primary/90 transition">
                                                Ver detalle
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 ml-1"
                                                     viewBox="0 0 24 24" fill="none"
                                                     stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                     stroke-linejoin="round">
                                                    <path d="m9 18 6-6-6-6" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Paginación --}}
                    <div class="px-4 sm:px-6 py-4 border-t border-gray-100 bg-gray-50">
                        <div class="flex items-center justify-between">
                            <div class="text-xs text-gray-500">
                                Página {{ $contacts->currentPage() }} de {{ $contacts->lastPage() }}
                            </div>
                            <div>
                                {{ $contacts->onEachSide(1)->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
