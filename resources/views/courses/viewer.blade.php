@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">{{ $content->title }}</h1>
    
    <div class="bg-white rounded-lg shadow-lg overflow-hidden relative" oncontextmenu="return false;">
        <!-- Overlay to prevent right-clicking and easy downloading -->
        <div class="absolute inset-0 z-10 pointer-events-none"></div>
        
        <iframe 
            src="{{ $signedUrl }}#toolbar=0&navpanes=0&scrollbar=0" 
            class="w-full h-[80vh] border-0"
            title="{{ $content->title }}">
        </iframe>
    </div>
</div>
@endsection
