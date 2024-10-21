<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            [
                'key' => 'stripe_secret_key',
                'value' => null,
            ],
            [
                'key' => 'paypal_secret_key',
                'value' => null ,
            ],
            [
                'key' => 'file_types',
                'value' => '["png","jpg","svg"]',
            ], 
            [
                'key' => 'fb_link',
                'value' => null,
            ],
            [
                'key' => 'twitter_link',
                'value' => null,
            ],
            [
                'key' => 'pinterest_link',
                'value' => null,
            ],
            [
                'key' => 'header_logo',
                'value' => null,
            ],
            [
                'key' => 'footer_logo',
                'value' => null,
            ],
            [
                'key' => 'header_btn_1',
                'value' => null,
            ],
            [
                'key' => 'header_btn_2',
                'value' => null,
            ]
        ]);
    }
}
