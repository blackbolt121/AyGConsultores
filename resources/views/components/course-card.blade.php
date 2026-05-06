@props(['course'])

<!-- <div class="rounded-lg bg-white shadow-sm flex flex-col items-center">
   <img src="{{ $course->image_url }}" alt="{{ $course->title }}">
   <div class="mt-2">
      <h3 class="font-bold">{{ $course->title }}</h3>
      <p class="mb-3">{{ $course->excerpt }}</p>
      <a href="{{ route('courses.show', $course->slug) }}" class="text-white hover:cursor-pointer inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 bg-primary text-primary-foreground hover:bg-primary/90 h-11 rounded-md px-2 bg-gradient-to-r from-primary to-secondary">Ver Detalles</a>
   </div>
</div> -->


<article class="group bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md hover:-translate-y-1">
  <div class="aspect-[16/10] w-full bg-slate-100 overflow-hidden">
    <img
      alt="{{ $course->title }}"
      loading="lazy"
      decoding="async"
      class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
      src="{{ $course->image }}"
    >
  </div>

  <div class="p-6 space-y-4">
    <div class="space-y-2">
      <h3 class="text-lg font-semibold text-slate-900 leading-snug line-clamp-2 group-hover:text-primary transition-colors duration-300">
        {{ $course->title }}
      </h3>
      <p class="text-slate-600 text-sm leading-relaxed line-clamp-3">
        {{ $course->excerpt }}
      </p>
    </div>

    <div class="flex items-center justify-between gap-3">
      <div class="inline-flex items-center gap-1.5 text-sm text-slate-500">
        <x-icon name="lucide-clock" class="h-4 w-4" />
        <span>20 horas</span>
      </div>
      <span class="inline-flex items-center rounded-full border border-secondary/20 bg-secondary/5 px-2.5 py-1 text-xs font-medium text-secondary">
        Liderazgo
      </span>
    </div>

    <a
      class="w-full inline-flex items-center justify-center gap-2 rounded-xl px-4 py-2.5 text-sm font-medium bg-gradient-to-r from-primary to-secondary text-white shadow-sm hover:shadow-md transition-all duration-300"
      href="/curso/{{ $course->id }}"
    >
      <span>Ver Detalles</span>
      <x-icon name="lucide-arrow-right" class="h-4 w-4" />
    </a>
  </div>
</article>
