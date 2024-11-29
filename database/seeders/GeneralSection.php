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
                'value' => null,
            ],
            [
                'key' => 'guide_button',
                'value' => null,
            ],
            [
                'key' => 'valid_in',
                'value' => null,
            ],
            [
                'key' => 'related_heading',
                'value' => null,
            ],
            [
                'key' => 'related_description',
                'value' => null,
            ],
        ]);
    }
}
