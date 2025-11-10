<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Course::insert([
            [
                'title' => 'Construcción de Equipos de Alto Rendimiento',
                'slug' => 'construccion-equipo-alto-rendimiento',
                'category' => 'liderazgo',
                'hours' => 20,
                'image' => 'construccion-equipo-ar.png',
                'excerpt' => 'Aprende a crear y gestionar equipos con ventajas competitivas y alto rendimiento.',
                'featured' => true,
            ],
            [
                'title' => 'Desarrollo de Habilidades Blandas',
                'slug' => 'desarrollo-habilidades-blandas',
                'category' => 'desarrollo-personal',
                'hours' => 15,
                'image' => 'habilidades-blandas.png',
                'excerpt' => 'Potencia habilidades interpersonales, conceptuales y de proceso.',
                'featured' => true,
            ],
        // agrega los otros 2 que tienes en el HTML…
        ]);
    }
}
