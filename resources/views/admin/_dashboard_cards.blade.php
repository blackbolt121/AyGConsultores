<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <a href="{{ route('admin.courses.index') }}" class="block group">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 h-full flex flex-col justify-between">
            <div>
                <div class="w-12 h-12 rounded-2xl bg-primary/10 flex items-center justify-center mb-4 text-primary group-hover:bg-primary/15 transition-colors duration-300">
                    <x-icon name="lucide-book-open" class="h-6 w-6" />
                </div>
                <h3 class="text-xl font-semibold text-slate-900 mb-2">Cursos</h3>
                <p class="text-slate-600 text-sm">Gestiona el catalogo de cursos, modulos, clases y el contenido general.</p>
            </div>
            <div class="mt-4 inline-flex items-center gap-1.5 text-primary font-medium text-sm">
                Administrar Cursos
                <x-icon name="lucide-arrow-right" class="h-4 w-4 group-hover:translate-x-0.5 transition-transform" />
            </div>
        </div>
    </a>

    <a href="{{ route('admin.contact.index') }}" class="block group">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 h-full flex flex-col justify-between">
            <div>
                <div class="w-12 h-12 rounded-2xl bg-secondary/10 flex items-center justify-center mb-4 text-secondary group-hover:bg-secondary/15 transition-colors duration-300">
                    <x-icon name="lucide-mail" class="h-6 w-6" />
                </div>
                <h3 class="text-xl font-semibold text-slate-900 mb-2">Mensajes de Contacto</h3>
                <p class="text-slate-600 text-sm">Revisa los mensajes enviados a traves del formulario de contacto.</p>
            </div>
            <div class="mt-4 inline-flex items-center gap-1.5 text-secondary font-medium text-sm">
                Ver Mensajes
                <x-icon name="lucide-arrow-right" class="h-4 w-4 group-hover:translate-x-0.5 transition-transform" />
            </div>
        </div>
    </a>

    <a href="{{ route('admin.users.index') }}" class="block group">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 h-full flex flex-col justify-between">
            <div>
                <div class="w-12 h-12 rounded-2xl bg-secondary/10 flex items-center justify-center mb-4 text-secondary group-hover:bg-secondary/15 transition-colors duration-300">
                    <x-icon name="lucide-users" class="h-6 w-6" />
                </div>
                <h3 class="text-xl font-semibold text-slate-900 mb-2">Usuarios</h3>
                <p class="text-slate-600 text-sm">Administra los usuarios registrados en la plataforma y sus roles.</p>
            </div>
            <div class="mt-4 inline-flex items-center gap-1.5 text-secondary font-medium text-sm">
                Administrar Usuarios
                <x-icon name="lucide-arrow-right" class="h-4 w-4 group-hover:translate-x-0.5 transition-transform" />
            </div>
        </div>
    </a>

    <a href="{{ route('admin.enrollments.index') }}" class="block group">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 h-full flex flex-col justify-between">
            <div>
                <div class="w-12 h-12 rounded-2xl bg-primary/10 flex items-center justify-center mb-4 text-primary group-hover:bg-primary/15 transition-colors duration-300">
                    <x-icon name="lucide-key" class="h-6 w-6" />
                </div>
                <h3 class="text-xl font-semibold text-slate-900 mb-2">Inscripciones</h3>
                <p class="text-slate-600 text-sm">Gestiona el acceso de todos los usuarios a cualquier ciclo.</p>
            </div>
            <div class="mt-4 inline-flex items-center gap-1.5 text-primary font-medium text-sm">
                Gestionar Accesos
                <x-icon name="lucide-arrow-right" class="h-4 w-4 group-hover:translate-x-0.5 transition-transform" />
            </div>
        </div>
    </a>

    <a href="{{ route('admin.cycles.index') }}" class="block group">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-1 h-full flex flex-col justify-between">
            <div>
                <div class="w-12 h-12 rounded-2xl bg-primary/10 flex items-center justify-center mb-4 text-primary group-hover:bg-primary/15 transition-colors duration-300">
                    <x-icon name="lucide-calendar" class="h-6 w-6" />
                </div>
                <h3 class="text-xl font-semibold text-slate-900 mb-2">Ciclos</h3>
                <p class="text-slate-600 text-sm">Lista global de ciclos con filtros por curso, estado y fechas.</p>
            </div>
            <div class="mt-4 inline-flex items-center gap-1.5 text-primary font-medium text-sm">
                Ver Ciclos
                <x-icon name="lucide-arrow-right" class="h-4 w-4 group-hover:translate-x-0.5 transition-transform" />
            </div>
        </div>
    </a>
</div>
