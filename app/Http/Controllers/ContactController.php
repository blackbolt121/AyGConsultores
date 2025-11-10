<?php

// app/Http/Controllers/ContactController.php
namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Si esto sale vacío, el form no está enviando los names correctos
        Log::info('CONTACTO payload', $request->all());

        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:320',
            'phone'   => 'required|string|max:32',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            $contact = Contact::create($validated + ['status' => 'new']);
            Log::info('CONTACTO creado', ['id' => $contact->id]);

            return redirect()
                ->route('contacto.contacto')
                ->with('success', 'Tu mensaje ha sido enviado correctamente.');
        } catch (\Throwable $e) {
            Log::error('Error guardando contacto', ['error' => $e->getMessage()]);
            return back()
                ->withErrors('Ocurrió un error al guardar tu mensaje. Inténtalo de nuevo.')
                ->withInput();
        }
    }

    public function index()
    {
        return view('static.contact');
    }
}
