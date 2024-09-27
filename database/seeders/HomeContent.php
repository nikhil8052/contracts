<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomeContent extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('home_contents')->insert([
            [
                'key' => 'title',
                'value' => 'Home',
            ],
            [
                'key' => 'background_image',
                'value' => null,
            ], 
            [
                'key' => 'banner_title',
                'value' => 'Crea Contratos y documentos legales en minutos',
            ],
            [
                'key' => 'banner_description',
                'value' => null,
            ],
            [
                'key' => 'banner_image',
                'value' => null,
            ],
            [
                'key' => 'most_popular_title',
                'value' => 'Documentos más populares',
            ],
            [
                'key' => 'most_popular_button_name',
                'value' => null,
            ],
            [
                'key' => 'most_popular_button_link',
                'value' => null,
            ],
            [
                'key' => 'bottom_heading',
                'value' => 'Comienza a crear Documentos Legales Personalizados',
            ],
            [
                'key' => 'bottom_subheading',
                'value' => 'Genera y descarga tus documentos legales en formatos PDF y DOCX (Word) al instante, de manera fácil y rápida.',
            ],
            [
                'key' => 'bottom_button_label',
                'value' => 'Comienza ahora',
            ],
            [
                'key' => 'bottom_button_link',
                'value' => null,
            ],
            [
                'key' => 'bottom_banner_image',
                'value' => null,
            ],
            [
                'key' => 'category_title',
                'value' => 'Categorías principales',
            ]
        ]);
        
    }
}
