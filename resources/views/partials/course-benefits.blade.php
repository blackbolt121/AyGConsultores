@php
$benefits = [
  'Capacidad para crear equipos de trabajo altamente efectivos',
  'Herramientas para establecer una cultura de alto rendimiento',
  'Metodologías para el enriquecimiento del trabajo',
  'Estrategias personalizadas para tu entorno laboral',
  'Certificado de participación',
];
@endphp

<ul class="space-y-2">
  @foreach($benefits as $b)
    <li class="flex items-start">
      <svg xmlns="http://www.w3.org/2000/svg"
           class="h-4 w-4 mr-2 text-primary mt-1"
           viewBox="0 0 24 24" fill="none"
           stroke="currentColor" stroke-width="2"
           stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10"></circle>
        <polyline points="9 12 12 15 17 9"></polyline>
      </svg>
      <span>{{ $b }}</span>
    </li>
  @endforeach
</ul>
