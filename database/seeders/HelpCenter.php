<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HelpCenter extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('help_centers')->insert([
            [
                'key' => 'title',
                'value' => 'Centro de Ayuda',
            ],
            [
                'key' => 'background_image',
                'value' => null,
            ],
            [
                'key' => 'banner_title',
                'value' => null,
            ],
            [
                'key' => 'banner_placeholder',
                'value' => null,
            ],
            [
                'key' => 'banner_image',
                'value' => null,
            ],
            [
                'key' => 'main_title',
                'value' => null,
            ],
            [
                'key' => 'sub_title',
                'value' => null,
            ],
            [
                'key' => 'faq_heading',
                'value' => null,
            ],
            [
                'key' => 'faq_description',
                'value' => null,
            ],
            [
                'key' => 'bottom_banner_image',
                'value' => null,
            ],
            [
                'key' => 'banner_heading',
                'value' => null,
            ],
            [
                'key' => 'banner_description',
                'value' => null,
            ],
            [
                'key' => 'button_text',
                'value' => null,
            ],
        ]);
    }
}
