<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TermsAndCondition extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('how_it_works')->insert([
            [
                'key' => 'title',
                'value' => 'Términos y condiciones',
            ],
            [
                'key' => 'main_heading',
                'value' => 'Términos y condiciones',
            ], 
            [
                'key' => 'sub_heading',
                'value' => 'Contenido',
            ]
        ]);
    }
}
