<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared(File::get(base_path() . '/database/seeds/users.sql'));
        DB::unprepared(File::get(base_path() . '/database/seeds/medicos.sql'));
        DB::unprepared(File::get(base_path() . '/database/seeds/pacientes.sql'));
        DB::unprepared(File::get(base_path() . '/database/seeds/responsables.sql'));
        DB::unprepared(File::get(base_path() . '/database/seeds/paciente_responsable.sql'));
        DB::unprepared(File::get(base_path() . '/database/seeds/medicamentos.sql'));
        DB::unprepared(File::get(base_path() . '/database/seeds/sintomas.sql'));
        DB::unprepared(File::get(base_path() . '/database/seeds/tratamientos.sql'));
        DB::unprepared(File::get(base_path() . '/database/seeds/medico_paciente.sql'));
        DB::unprepared(File::get(base_path() . '/database/seeds/formularios.sql'));
        DB::unprepared(File::get(base_path() . '/database/seeds/evaluacions.sql'));
        DB::unprepared(File::get(base_path() . '/database/seeds/evaluacion_formulario.sql'));
        DB::unprepared(File::get(base_path() . '/database/seeds/preguntas.sql'));
        DB::unprepared(File::get(base_path() . '/database/seeds/respuestas.sql'));
    }
}