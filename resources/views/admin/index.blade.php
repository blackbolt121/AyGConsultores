@extends('layouts.app')

@section('content')
<section class="py-8 md:py-12">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8 space-y-2">
      <h1 class="text-3xl md:text-4xl font-bold tracking-tight bg-gradient-to-r from-primary via-secondary to-secondary bg-clip-text text-transparent">
        Panel de Administracion
      </h1>
      <p class="text-slate-600">Selecciona un modulo para gestionar la plataforma.</p>
    </div>

    @include('admin._dashboard_cards')
  </div>
</section>
@endsection
