<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>@yield('title','Plataforma de Cursos - A&G Consultores')</title>
  <meta name="description" content="@yield('meta_description','Descubre tus potencialidades a través de nuestra capacitación y consultoría integral y colaborativa.')">
  <link rel="icon" href="{{ asset('logo.svg') }}">
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-screen bg-white text-slate-900">
  <div class="flex flex-col min-h-screen">
    {{-- Header/Nav --}}
    @include('partials.navbar')

    <main class="flex-1 w-full mx-auto pt-2 pb-5">
      @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')
    @stack('scripts')
  </div>
</body>
</html>
