@extends('layouts.app')

@section('content')
<section class="py-10 container mx-auto max-w-7xl px-4">
    <div class="mb-8">
        <a href="{{ route('docente.ciclos.index') }}" class="text-sm text-gray-500 hover:text-primary mb-2 inline-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Volver
        </a>
        <h1 class="text-3xl font-bold bg-gradient-to-r from-primary via-secondary to-secondary bg-clip-text text-transparent">
            Alumnos del Ciclo
        </h1>
        <p class="text-gray-500 mt-2">{{ $cycle->name }}</p>
    </div>

    @if (session('status'))
        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">
            {{ session('status') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-200 bg-gray-50/50">
            <h3 class="text-base font-semibold text-gray-900">Inscritos ({{ $enrollments->count() }})</h3>
        </div>

        @if($enrollments->isEmpty())
            <div class="p-8 text-center text-gray-500">No hay alumnos inscritos.</div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-500 bg-gray-50/50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 font-medium">Alumno</th>
                            <th class="px-6 py-3 font-medium">Vigencia</th>
                            <th class="px-6 py-3 font-medium">Acreditacion</th>
                            <th class="px-6 py-3 font-medium text-right">Accion</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($enrollments as $enrollment)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <p class="font-medium text-gray-900">{{ $enrollment->user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $enrollment->user->email }}</p>
                                </td>
                                <td class="px-6 py-4 text-xs text-gray-500">
                                    @if($enrollment->expires_at)
                                        Expira: {{ $enrollment->expires_at->format('d/m/Y') }}
                                    @else
                                        <span class="text-emerald-600">Sin expiracion</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-xs">
                                    @if($enrollment->accredited_at)
                                        <span class="inline-flex items-center rounded-md bg-emerald-50 px-2 py-1 text-xs font-medium text-emerald-700 ring-1 ring-inset ring-emerald-700/10">Acreditado</span>
                                    @else
                                        <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-700 ring-1 ring-inset ring-gray-700/10">Pendiente</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    @if($enrollment->accredited_at)
                                        <form method="POST" action="{{ route('docente.ciclos.alumnos.desacreditar', ['ciclo' => $cycle->id, 'usuario' => $enrollment->user->id]) }}" class="inline">
                                            @csrf
                                            <button class="inline-flex items-center rounded-xl border border-red-200 bg-red-50 px-3 py-2 text-xs font-medium text-red-700 hover:bg-red-100">Desacreditar</button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('docente.ciclos.alumnos.acreditar', ['ciclo' => $cycle->id, 'usuario' => $enrollment->user->id]) }}" class="inline">
                                            @csrf
                                            <button class="inline-flex items-center rounded-xl bg-primary px-3 py-2 text-xs font-medium text-white hover:bg-primary/90">Acreditar</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</section>
@endsection
