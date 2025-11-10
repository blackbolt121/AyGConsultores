@props(['course'])

<!-- <div class="rounded-lg bg-white shadow-sm flex flex-col items-center">
   <img src="{{ $course->image_url }}" alt="{{ $course->title }}">
   <div class="mt-2">
      <h3 class="font-bold">{{ $course->title }}</h3>
      <p class="mb-3">{{ $course->excerpt }}</p>
      <a href="{{ route('courses.show', $course->slug) }}" class="text-white hover:cursor-pointer inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 bg-primary text-primary-foreground hover:bg-primary/90 h-11 rounded-md px-2 bg-gradient-to-r from-primary to-secondary">Ver Detalles</a>
   </div>
</div> -->


<div class="rounded-lg bg-card text-card-foreground shadow-sm group overflow-hidden border border-gray-200/50 transition-all duration-300 hover:shadow-xl hover:border-primary/20 hover:-translate-y-1">
   <div class="relative h-80 w-full overflow-hidden">
      <img alt="{{ $course->title }}" loading="lazy" decoding="async" data-nimg="fill" class="object-cover transition-transform duration-500 group-hover:scale-110" src="{{ $course->image }}" style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;">
      <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
      <div class="absolute bottom-0 left-0 right-0 p-4 text-white transform translate-y-full group-hover:translate-y-0 transition-transform duration-300 flex items-center justify-between">
         <p class="text-sm font-medium">Ver detalles del curso</p><div class="bg-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right h-4 w-4 text-primary"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
         </div>
      </div>
   </div>
   <div class="flex flex-col space-y-1.5 p-6 group-hover:bg-gray-50/50 transition-colors duration-300">
      <div class="flex justify-between items-start">
         <div class="font-semibold tracking-tight text-xl line-clamp-2 group-hover:text-primary transition-colors duration-300">{{ $course->title }}</div>
         <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 bg-secondary/10 text-secondary group-hover:bg-secondary/20 transition-colors duration-300">Liderazgo</div>
      </div>
   </div>
   <div class="p-6 pt-0 group-hover:bg-gray-50/50 transition-colors duration-300">
      <p class="text-gray-600 mb-4 line-clamp-3">{{ $course->excerpt }}</p>
      <div class="flex items-center gap-4 text-sm text-gray-500 flex-grow">
         <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock h-4 w-4 mr-1"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>20 horas
         </div>
      </div>
      </div>
      <div class="flex items-center p-6 pt-0 group-hover:bg-gray-50/50 transition-colors duration-300 text-white">
         <a class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 text-primary-foreground h-10 px-4 py-2 w-full bg-primary hover:bg-primary-dark group relative overflow-hidden flex items-center justify-center" href="/curso/{{ $course->id }}">
            <span class="relative z-10 flex items-center">Ver Detalles
               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right ml-2 h-4 w-4 transition-transform group-hover:translate-x-1"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
            </span>
            <span class="absolute inset-0 bg-gradient-to-r from-primary-dark to-primary scale-x-0 group-hover:scale-x-100 origin-left transition-transform duration-300"></span>
         </a>
      </div>
   </div>