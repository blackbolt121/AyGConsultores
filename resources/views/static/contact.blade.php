@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 relative overflow-hidden">
    {{-- Background Decoration --}}
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <div class="absolute -top-[20%] -right-[10%] w-[50%] h-[50%] rounded-full bg-primary/5 blur-3xl opacity-70"></div>
        <div class="absolute top-[40%] -left-[10%] w-[40%] h-[40%] rounded-full bg-secondary/5 blur-3xl opacity-50"></div>
    </div>

    <div class="container mx-auto px-4 py-16 md:py-24 relative z-10">
        {{-- Header Section --}}
        <div class="max-w-3xl mx-auto text-center mb-16 space-y-4">
            <span class="inline-block py-1 px-3 rounded-full bg-primary/10 text-primary text-sm font-semibold tracking-wider uppercase mb-2">Contacto</span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-slate-900 tracking-tight">
                Hablemos sobre tu <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-secondary">desarrollo</span>
            </h1>
            <p class="text-lg md:text-xl text-slate-600 max-w-2xl mx-auto leading-relaxed">
                Estamos aquí para responder tus preguntas y ayudarte a potenciar el crecimiento de tu equipo y tu empresa.
            </p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8 lg:gap-12 max-w-7xl mx-auto">
            
            {{-- Form Column --}}
            <div class="w-full lg:w-7/12 flex flex-col">
                <div class="bg-white rounded-3xl p-8 md:p-10 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 relative overflow-hidden group flex-1">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-primary to-secondary transform origin-left transition-transform duration-500"></div>
                    
                    <h2 class="text-2xl font-bold text-slate-900 mb-8">Envíanos un mensaje</h2>

                    @if (session('success'))
                        <div class="mb-8 p-4 rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-800 flex items-start gap-3 animate-fade-in-down">
                            <svg class="w-6 h-6 text-emerald-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h3 class="font-semibold">¡Mensaje enviado con éxito!</h3>
                                <p class="text-sm mt-1 opacity-90">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-8 p-4 rounded-2xl bg-red-50 border border-red-100 text-red-800 flex items-start gap-3">
                            <svg class="w-6 h-6 text-red-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <div>
                                <h3 class="font-semibold">Hay algunos errores</h3>
                                <ul class="list-disc list-inside text-sm mt-1 space-y-1 opacity-90">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contacto.store') }}" class="space-y-6">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="name" class="block text-sm font-medium text-slate-700">Nombre completo</label>
                                <input type="text" name="name" id="name" required value="{{ old('name') }}"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors outline-none text-slate-800 placeholder:text-slate-400"
                                    placeholder="Ej. Juan Pérez">
                            </div>
                            <div class="space-y-2">
                                <label for="email" class="block text-sm font-medium text-slate-700">Correo electrónico</label>
                                <input type="email" name="email" id="email" required value="{{ old('email') }}"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors outline-none text-slate-800 placeholder:text-slate-400"
                                    placeholder="tu@correo.com">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="phone" class="block text-sm font-medium text-slate-700">Teléfono</label>
                                <input type="tel" name="phone" id="phone" required value="{{ old('phone') }}"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors outline-none text-slate-800 placeholder:text-slate-400"
                                    placeholder="+52 123 456 7890">
                            </div>
                            <div class="space-y-2">
                                <label for="subject" class="block text-sm font-medium text-slate-700">Asunto</label>
                                <select name="subject" id="subject" required
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors outline-none text-slate-800 appearance-none">
                                    <option value="" disabled {{ old('subject') ? '' : 'selected' }}>Selecciona un asunto...</option>
                                    <option value="info" {{ old('subject')==='info' ? 'selected' : '' }}>Información general</option>
                                    <option value="courses" {{ old('subject')==='courses' ? 'selected' : '' }}>Información sobre cursos</option>
                                    <option value="consulting" {{ old('subject')==='consulting' ? 'selected' : '' }}>Consultoría</option>
                                    <option value="other" {{ old('subject')==='other' ? 'selected' : '' }}>Otro</option>
                                </select>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="message" class="block text-sm font-medium text-slate-700">Mensaje</label>
                            <textarea name="message" id="message" rows="5" required
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors outline-none text-slate-800 placeholder:text-slate-400 resize-y min-h-[120px]"
                                placeholder="¿En qué te podemos ayudar? Escribe tu mensaje aquí...">{{ old('message') }}</textarea>
                        </div>

                        <div class="pt-4 px-3 flex justify-start">
                            <button type="submit"
                                class="inline-flex w-auto px-10 py-4 bg-primary text-white font-medium text-lg rounded-2xl hover:bg-primary/90 focus:ring-4 focus:ring-primary/20 transition-all shadow-lg shadow-primary/30 items-center justify-center gap-3 group">
                                <span>Enviar mensaje</span>
                                <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Info & Schedule Cards --}}
            <div class="w-full lg:w-5/12 flex flex-col sm:flex-row lg:flex-col gap-8">
                
                {{-- Contact Info Card --}}
                <div class="flex-1 bg-gradient-to-br from-primary to-indigo-700 rounded-3xl p-8 text-white shadow-xl shadow-primary/20 relative overflow-hidden flex flex-col justify-center">
                    <div class="absolute top-0 right-0 p-8 opacity-10 pointer-events-none">
                        <svg class="w-32 h-32 transform rotate-12" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zM11 7h2v6h-2zm0 8h2v2h-2z"/></svg>
                    </div>

                    <h2 class="text-2xl font-bold mb-8 relative z-10">Información de contacto</h2>
                    
                    <div class="space-y-8 relative z-10">
                        <div class="flex items-start gap-4 group">
                            <div class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center shrink-0 group-hover:bg-white/20 transition-colors backdrop-blur-sm">
                                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-medium text-white/90 text-sm tracking-wide uppercase mb-1">Dirección</h3>
                                <p class="text-white font-medium leading-relaxed">Monte Sinaí #144-B, col. Vista Hermosa<br>Santiago de Querétaro, México, CP 73063</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 group">
                            <div class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center shrink-0 group-hover:bg-white/20 transition-colors backdrop-blur-sm">
                                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-medium text-white/90 text-sm tracking-wide uppercase mb-1">Correo electrónico</h3>
                                <a href="mailto:info@agconsultores.com" class="text-white font-medium hover:text-white/80 transition-colors break-all">info@agconsultores.com</a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Schedule Card --}}
                <div class="flex-1 bg-white rounded-3xl p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 group hover:border-slate-200 transition-colors flex flex-col justify-center">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-600 group-hover:text-primary transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-slate-900">Horario de atención</h2>
                    </div>

                    <ul class="space-y-4">
                        <li class="flex justify-between items-center py-2 border-b border-slate-100">
                            <span class="font-medium text-slate-700">Lunes - Viernes</span>
                            <span class="text-slate-600 font-semibold bg-slate-100 px-3 py-1 rounded-lg text-sm">9:00 AM - 6:00 PM</span>
                        </li>
                        <li class="flex justify-between items-center py-2 border-b border-slate-100">
                            <span class="font-medium text-slate-700">Sábado</span>
                            <span class="text-slate-600 font-semibold bg-slate-100 px-3 py-1 rounded-lg text-sm">10:00 AM - 2:00 PM</span>
                        </li>
                        <li class="flex justify-between items-center py-2">
                            <span class="font-medium text-slate-700">Domingo</span>
                            <span class="text-red-500 font-semibold bg-red-50 px-3 py-1 rounded-lg text-sm">Cerrado</span>
                        </li>
                    </ul>
                </div>
            </div>
            
        </div>
    </div>
</div>

<style>
    .animate-fade-in-down {
        animation: fadeInDown 0.4s ease-out forwards;
    }
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
