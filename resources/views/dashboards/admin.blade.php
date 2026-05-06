@extends('layouts.app')

@section('content')
<section class="py-10 container mx-auto max-w-7xl px-4">
    <div class="mb-8 flex flex-col md:flex-row md:items-end md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold bg-gradient-to-r from-primary via-secondary to-purple-600 bg-clip-text text-transparent">
                Dashboard (Admin)
            </h1>
            <p class="text-gray-500 mt-2">Gestiona la plataforma y utiliza el modo "Ver como" para revisar otras vistas.</p>
            @if($modo)
                <p class="mt-2 text-sm text-amber-700 bg-amber-50 border border-amber-200 inline-flex px-3 py-1.5 rounded-lg">
                    Modo activo: viendo como <strong class="ml-1">{{ ucfirst($modo) }}</strong>
                </p>
            @endif
        </div>

        <form method="GET" action="{{ route('dashboard.index') }}" class="bg-white rounded-2xl border border-gray-200 p-4 shadow-sm flex items-center gap-3">
            <label class="text-sm font-medium text-gray-700">Ver como</label>
            <select name="como" class="rounded-xl border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm">
                <option value="admin" @selected(request('como') === 'admin')>Admin</option>
                <option value="docente" @selected(request('como') === 'docente')>Docente</option>
                <option value="alumno" @selected(request('como') === 'alumno')>Alumno</option>
            </select>
            <button type="submit" class="inline-flex items-center rounded-xl bg-primary px-4 py-2 text-sm font-medium text-white hover:bg-primary/90">
                Aplicar
            </button>
            <a href="{{ route('dashboard.index') }}" class="text-sm text-gray-500 hover:text-primary">Salir</a>
        </form>
    </div>

    <div class="mt-8">
        @include('admin._dashboard_cards')
    </div>
</section>
@endsection
