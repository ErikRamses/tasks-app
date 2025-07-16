<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        $tasks = [
            ['titulo' => 'Tarea 1', 'descripcion' => 'Descripción de la tarea 1', 'completada' => false, 'fecha_limite' => '2025-07-30', 'created_at' => $now, 'updated_at' => $now],
            ['titulo' => 'Tarea 2', 'descripcion' => 'Descripción de la tarea 2', 'completada' => true, 'fecha_limite' => '2025-07-30', 'created_at' => $now, 'updated_at' => $now],
            ['titulo' => 'Tarea 3', 'descripcion' => 'Descripción de la tarea 3', 'completada' => true, 'fecha_limite' => '2025-07-30', 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('tasks')->insert($tasks);
    }
}
