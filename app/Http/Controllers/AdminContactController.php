<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    // Listar todas las solicitudes
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(20);

        return view('contact.index', [
            'contacts' => $contacts,
        ]);
    }

    // Ver detalle de una solicitud
    public function show(Contact $contact)
    {
        return view('contact.show', [
            'contact' => $contact,
        ]);
    }

    // Actualizar el status (por ejemplo: new, in_progress, done)
    public function updateStatus(Request $request, Contact $contact)
    {
        $request->validate([
            'status' => 'required|string|max:50',
        ]);

        $contact->status = $request->status;
        $contact->save();

        return redirect()
            ->route('admin.contact.show', $contact)
            ->with('status', 'Status actualizado correctamente.');
    }
}
