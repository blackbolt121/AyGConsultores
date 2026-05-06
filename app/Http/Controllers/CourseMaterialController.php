<?php

namespace App\Http\Controllers;

use App\Models\CourseCycle;
use App\Models\CourseContent;
use App\Models\CourseCycleMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class CourseMaterialController extends Controller
{
    /**
     * Muestra la vista del visor (por ejemplo para PDFs).
     */
    public function show(CourseCycle $ciclo, CourseContent $contenido)
    {
        abort_unless($contenido->course_id === $ciclo->course_id, 404);

        $material = CourseCycleMaterial::query()
            ->where('course_cycle_id', $ciclo->id)
            ->where('course_content_id', $contenido->id)
            ->first();

        if (!$material || $material->content_type !== 'pdf' || !$material->file_path) {
            abort(404, 'Material no disponible.');
        }

        // Generar URL firmada temporalmente por 60 minutos
        $signedUrl = URL::temporarySignedRoute('ciclos.material.descargar', now()->addMinutes(60), [
            'ciclo' => $ciclo->id,
            'contenido' => $contenido->id,
        ]);

        return view('courses.viewer', ['content' => $contenido, 'signedUrl' => $signedUrl]);
    }

    /**
     * Sirve el archivo real solo si la firma es válida.
     */
    public function download(Request $request, CourseCycle $ciclo, CourseContent $contenido)
    {
        if (!$request->hasValidSignature()) {
            abort(401, 'URL expirada o inválida.');
        }

        abort_unless($contenido->course_id === $ciclo->course_id, 404);

        $material = CourseCycleMaterial::query()
            ->where('course_cycle_id', $ciclo->id)
            ->where('course_content_id', $contenido->id)
            ->first();

        if (!$material || $material->content_type !== 'pdf' || !$material->file_path) {
            abort(404, 'Material no disponible.');
        }

        if (!Storage::disk('local')->exists($material->file_path)) {
            abort(404, 'Archivo no encontrado.');
        }

        return response()->file(storage_path('app/' . $material->file_path));
    }
}
