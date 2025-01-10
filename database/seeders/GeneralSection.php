<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralSection extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('general_sections')->insert([
            [
                'key' => 'guide_heading',
                'value' => 'Obtén tu documento en solo 2 pasos',
            ],
            [
                'key' => 'guide_button',
                'value' => 'Crear documento ahora',
            ],
            [
                'key' => 'valid_in',
                'value' => 'Validez en todo México',
            ],
            [
                'key' => 'related_heading',
                'value' => 'Documentos relacionados',
            ],
            [
                'key' => 'related_description',
                'value' => 'Explora documentos similares, populares entre otros usuarios.',
            ],
            [
                'key' => 'contract_heading',
                'value' => 'Introduce los datos aquí:'
            ]
        ]);
    }
}
