<?php

namespace App\Http\Controllers;

use App\Models\CourseCycle;
use App\Models\CourseContent;
use App\Models\CourseCycleMaterial;
use App\Models\CourseCycleContentProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;

class CourseMaterialController extends Controller
{
    /**
     * Muestra la vista del visor (por ejemplo para PDFs).
     */
    public function show(CourseCycle $ciclo, CourseContent $contenido)
    {
        abort_unless($contenido->course_id === $ciclo->course_id, 404);

        $user = request()->user();
        abort_unless($user, 403);

        $material = CourseCycleMaterial::query()
            ->where('course_cycle_id', $ciclo->id)
            ->where('course_content_id', $contenido->id)
            ->first();

        $type = $material?->content_type;
        $hasPdf = $type === 'pdf' && (bool) $material?->file_path;
        $hasText = $type === 'text' && is_string($material?->body) && trim($material->body) !== '';

        if (!$material || (!$hasPdf && !$hasText)) {
            abort(404, 'Material no disponible.');
        }

        $progress = CourseCycleContentProgress::firstOrCreate([
            'user_id' => $user->id,
            'course_cycle_id' => $ciclo->id,
            'course_content_id' => $contenido->id,
        ]);

        $isCompleted = (bool) $progress->completed_at;

        $heartbeatUrl = route('ciclos.material.progreso.heartbeat', [
            'ciclo' => $ciclo->id,
            'contenido' => $contenido->id,
        ]);

        if ($hasPdf) {
            // Generar URL firmada temporalmente por 60 minutos
            $signedUrl = URL::temporarySignedRoute('ciclos.material.descargar', now()->addMinutes(60), [
                'ciclo' => $ciclo->id,
                'contenido' => $contenido->id,
            ]);

            return view('courses.viewer', [
                'cycle' => $ciclo,
                'content' => $contenido,
                'signedUrl' => $signedUrl,
                'heartbeatUrl' => $heartbeatUrl,
                'initialActiveSeconds' => (int) $progress->active_seconds,
                'initialReachedLastPage' => (bool) $progress->pdf_reached_last_page_at,
                'isCompleted' => $isCompleted,
            ]);
        }

        return view('courses.text_viewer', [
            'cycle' => $ciclo,
            'content' => $contenido,
            'body' => $material->body,
            'heartbeatUrl' => $heartbeatUrl,
            'initialActiveSeconds' => (int) $progress->active_seconds,
            'isCompleted' => $isCompleted,
        ]);
    }

    public function heartbeat(Request $request, CourseCycle $ciclo, CourseContent $contenido)
    {
        $user = $request->user();
        abort_unless($user, 403);
        abort_unless($contenido->course_id === $ciclo->course_id, 404);

        $material = CourseCycleMaterial::query()
            ->where('course_cycle_id', $ciclo->id)
            ->where('course_content_id', $contenido->id)
            ->first();

        $type = $material?->content_type;
        $isPdf = $type === 'pdf' && (bool) $material?->file_path;
        $isText = $type === 'text' && is_string($material?->body) && trim($material->body) !== '';
        abort_unless($material && ($isPdf || $isText), 404);

        $data = $request->validate([
            'delta_seconds' => ['required', 'integer', 'min:0', 'max:7'],
            'reached_last_page' => ['nullable', 'boolean'],
            'pdf_total_pages' => ['nullable', 'integer', 'min:1', 'max:5000'],
        ]);

        $progress = CourseCycleContentProgress::firstOrCreate([
            'user_id' => $user->id,
            'course_cycle_id' => $ciclo->id,
            'course_content_id' => $contenido->id,
        ]);

        if ($progress->completed_at) {
            return response()->json([
                'completed' => true,
                'active_seconds' => (int) $progress->active_seconds,
                'reached_last_page' => (bool) $progress->pdf_reached_last_page_at,
            ]);
        }

        $now = now();
        $delta = (int) $data['delta_seconds'];

        if ($progress->last_heartbeat_at) {
            $gapSeconds = $progress->last_heartbeat_at->diffInSeconds($now);
            if ($gapSeconds > 20) {
                // Too much time passed (tab hidden / background / stopped). Do not count this delta.
                $delta = 0;
            }
        }

        if ($delta > 0) {
            $progress->active_seconds = (int) $progress->active_seconds + $delta;
        }
        $progress->last_heartbeat_at = $now;

        if ($isPdf) {
            if (array_key_exists('pdf_total_pages', $data) && $data['pdf_total_pages']) {
                $progress->pdf_total_pages = (int) $data['pdf_total_pages'];
            }
            if (!empty($data['reached_last_page']) && !$progress->pdf_reached_last_page_at) {
                $progress->pdf_reached_last_page_at = $now;
            }
        }

        $reachedLastPage = (bool) $progress->pdf_reached_last_page_at;
        $shouldComplete = $progress->active_seconds >= 30 && ($isText || ($isPdf && $reachedLastPage));
        if ($shouldComplete) {
            $progress->completed_at = $now;
        }

        $progress->save();

        return response()->json([
            'completed' => (bool) $progress->completed_at,
            'active_seconds' => (int) $progress->active_seconds,
            'reached_last_page' => $reachedLastPage,
        ]);
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
