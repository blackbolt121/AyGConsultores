@extends('layouts.app')

@section('content')
    <div @class(['flex', 'flex-col', 'items-center', 'space-y-4', 'text-center', 'mb-12'])>
        <h1 @class(['text-3xl', 'font-bold', 'tracking-tighter', 'sm:text-4xl', 'md:text-5xl', 'text-primary'])>Contáctanos</h1>
        <p @class(['max-w-[700px]', 'text-gray-600', 'md:text-xl'])>Estamos aquí para responder tus preguntas y ayudarte en tu camino
            de desarrollo</p>
    </div>
    <div @class(['grid', 'grid-cols-1', 'gap-5', 'lg:grid-cols-2', 'bg-blue-600', 'p-3'])>
        <div class="">
            <div @class(['bg-white', 'p-8', 'rounded-lg', 'shadow-md', 'p-4'])>
                <h2 @class(['text-2xl', 'font-bold', 'mb-6', 'text-primary'])>Envíanos un mensaje</h2>
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">¡Éxito!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
                        <strong class="font-bold">Ups...</strong>
                        <ul class="mt-1 ml-3 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="space-y-6" method="POST" action="{{ route('contacto.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-sm font-medium leading-none" for="name">Nombre completo</label>
                            <input
                                class="flex h-10 w-full rounded-md border px-3 py-2 md:text-sm"
                                name="name" id="name" required
                                value="{{ old('name') }}">
                            @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-medium leading-none" for="email">Correo electrónico</label>
                            <input
                                class="flex h-10 w-full rounded-md border px-3 py-2 md:text-sm"
                                name="email" id="email" type="email" required
                                value="{{ old('email') }}">
                            @error('email') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium leading-none" for="phone">Teléfono</label>
                        <input
                            class="flex h-10 w-full rounded-md border px-3 py-2 md:text-sm"
                            name="phone" id="phone" type="tel" required
                            value="{{ old('phone') }}">
                        @error('phone') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex flex-col space-y-2">
                        <label class="text-sm font-medium leading-none" for="subject">Asunto</label>
                        <select
                            class="flex h-10 w-full rounded-md border px-3 py-2 text-base md:text-sm"
                            id="subject" name="subject" required>
                            <option value="" disabled {{ old('subject') ? '' : 'selected' }}>Selecciona un asunto</option>
                            <option value="info"      {{ old('subject')==='info' ? 'selected' : '' }}>Información general</option>
                            <option value="courses"   {{ old('subject')==='courses' ? 'selected' : '' }}>Información sobre cursos</option>
                            <option value="consulting"{{ old('subject')==='consulting' ? 'selected' : '' }}>Consultoría</option>
                            <option value="other"     {{ old('subject')==='other' ? 'selected' : '' }}>Otro</option>
                        </select>
                        @error('subject') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium leading-none" for="message">Mensaje</label>
                        <textarea
                            class="flex min-h-[80px] w-full rounded-md border px-3 py-2 text-base md:text-sm"
                            id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                        @error('message') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <button
                        class="inline-flex items-center justify-center gap-2 text-white rounded-md text-sm font-medium h-10 px-4 py-2 w-full bg-primary hover:bg-primary-dark"
                        type="submit">
                        Enviar mensaje
                    </button>

                </form>
            </div>
        </div>
        <div @class(['space-y-8', 'flex', 'flex-col', 'gap-2'])>
            <div @class(['bg-white', 'p-8', 'rounded-lg', 'shadow-md'])>
                <h2 @class(['text-2xl', 'font-bold', 'mb-6', 'text-primary'])>Información de contacto</h2>
                <div @class(['space-y-6'])>
                    <div @class(['flex', 'items-start', 'gap-2'])>
                        <div @class(['p-3', 'bg-primary/10', 'rounded-full', 'mr-4'])>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                @class(['lucide', 'lucide-map-pin', 'h-6', 'w-6', 'text-primary'])>
                                <path
                                    d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0">
                                </path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                        </div>
                        <div>
                            <h3 @class(['font-semibold', 'text-lg'])>Dirección</h3>
                            <p @class(['text-gray-600'])>Monte Sinaí #144-B, col. Vista Hermosa<br>Santiago de Querétaro,
                                México, CP 73063</p>
                        </div>
                    </div>
                    <div @class(['flex', 'items-start', 'gap-2'])>
                        <div @class(['p-3', 'bg-primary/10', 'rounded-full', 'mr-4'])><svg xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                @class(['lucide', 'lucide-mail', 'h-6', 'w-6', 'text-primary'])>
                                <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                            </svg></div>
                        <div>
                            <h3 @class(['font-semibold', 'text-lg'])>Correo electrónico</h3>
                            <p @class(['text-gray-600'])>info@agconsultores.com</p>
                        </div>
                    </div>
                </div>
            </div>
            <div @class(['bg-white', 'p-6', 'rounded-lg', 'shadow-md'])>
                <h2 @class(['text-2xl', 'font-bold', 'mb-6', 'text-primary'])>Horario de atención</h2>
                <div>
                    <div @class(['space-y-2'])>
                        <div @class(['flex', 'justify-between'])><span @class(['font-medium'])>Lunes - Viernes</span><span>9:00 AM -
                                6:00 PM</span></div>
                        <div @class(['flex', 'justify-between'])><span @class(['font-medium'])>Sábado</span><span>10:00 AM - 2:00
                                PM</span></div>
                        <div @class(['flex', 'justify-between'])><span @class(['font-medium'])>Domingo</span><span>Cerrado</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
