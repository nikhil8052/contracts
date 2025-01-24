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
                'name' => 'Stripe Secret Key',
                'key' => 'stripe_secret_key',
                'value' => null,
            ],
            [
                'name' => 'Paypal Secret Key',
                'key' => 'paypal_secret_key',
                'value' => null ,
            ],
            [
                'name' => 'File Types',
                'key' => 'file_types',
                'value' => '["png","jpg","svg"]',
            ], 
            [
                'name' => 'Facebook link',
                'key' => 'fb_link',
                'value' => null,
            ],
            [
                'name' => 'Twitter Link',
                'key' => 'twitter_link',
                'value' => null,
            ],
            [
                'name' => 'Pinterest Link',
                'key' => 'pinterest_link',
                'value' => null,
            ],
            [
                'name' => 'Header Logo',
                'key' => 'header_logo',
                'value' => null,
            ],
            [
                'name' => 'Footer Logo',
                'key' => 'footer_logo',
                'value' => null,
            ],
            [
                'name' => 'Header Button 1',
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
