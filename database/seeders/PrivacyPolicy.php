<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrivacyPolicy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('privacy_policies')->insert([
            [
                'key' => 'title',
                'value' => 'Aviso de Privacidad',
            ],
            [
                'key' => 'main_heading',
                'value' => 'Aviso de Privacidad',
            ], 
            [
                'key' => 'sub_heading',
                'value' => 'Contenido',
            ],
            [
                'key' => 'description',
                'value' => 'En cumplimiento al deber de resguardo de información y de datos personales y con confundamento en los dispuesto por los artículos 3 fracción I, 8, 12, 15, 16 y demás relativos de la Ley Federal de Protección de Datos Personales en Posesión de Particulares, quien presta el servicio a saber: LOGOMAX S DE RL DE CV y/o MEXSTAFF RH, S.C., pone a su disposición el presente Aviso de Privacidad.',
            ]
        ]);
    }
}
