<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PricesContent extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('prices_contents')->insert([
            [
                'key' => 'title',
                'value' => 'Precios',
            ],
            [
                'key' => 'background_image',
                'value' => null,
            ], 
            [
                'key' => 'banner_title',
                'value' => 'Precios',
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
                'key' => 'document_heading',
                'value' => null,
            ],
            [
                'key' => 'description_heading',
                'value' => null,
            ],
            [
                'key' => 'price_heading',
                'value' => null,
            ]
        ]);
    }
}
