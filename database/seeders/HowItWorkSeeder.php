<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HowItWorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('how_it_works')->insert([
            [
                'key' => 'title',
                'value' => 'Así funciona',
            ],
            [
                'key' => 'main_heading',
                'value' => 'Así funciona',
            ], 
            [
                'key' => 'short_description',
                'value' => 'Descubre una forma sencilla de generar documentos y contratos en Documentos-Legales.mx. Nuestra plataforma te ofrece una amplia selección de documentos legales para cubrir tus necesidades. ¡Comienza a crear tus contratos personalizados hoy mismo!',
            ],
            [
                'key' => 'join_our_community_text',
                'value' => 'En Documentos-Legales.mx, nos esforzamos por hacer que el proceso de generación de documentos y contratos sea sencillo y conveniente. Obtén documentos legales de calidad de manera rápida y eficiente. ¡Únete a nuestra comunidad de usuarios satisfechos y simplifica tus trámites legales!',
            ],
            [
                'key' => 'second_banner_heading',
                'value' => 'Genera tus documentos legales de forma rápida y sencilla',
            ],
            [
                'key' => 'second_banner_sub_heading',
                'value' => 'Nuestro sistema te guía paso a paso, genera tus documentos totalmente personalizados y te permite descargarlos en los formatos PDF y DOCX (Word) de forma inmediata.',
            ],
            [
                'key' => 'button_label',
                'value' => 'Comienza ahora',
            ],
            [
                'key' => 'button_link',
                'value' => 'https://sagmetic.site/2023/laravel/contracts/public/',
            ],
            

        ]);
    }
}
