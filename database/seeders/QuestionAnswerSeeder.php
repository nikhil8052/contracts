<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('question_answers')->insert([
            [
                'key' => 'title',
                'value' => 'Preguntas',
            ],
            [
                'key' => 'main_title',
                'value' => 'Preguntas frecuentes',
            ], 
            [
                'key' => 'second_banner_heading',
                'value' => 'Empieza a crear tus documentos legales',
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
