<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            [
                'title' => 'Title',
                'key' => 'title',
                'value_ar' => 'بوينت جو',
                'value_en' => 'Points Go',
                'type' => 'text'
            ],
            [
                'title' => 'Description',
                'key' => 'description',
                'value_ar' => 'بوينت جو',
                'value_en' => 'Points Go',
                'type' => 'text'
            ],
            [
                'title' => 'Keywords',
                'key' => 'keywords',
                'value_ar' => 'بوينت جو',
                'value_en' => 'Points Go',
                'type' => 'text'
            ],
            [
                'title' => 'Dark Logo',
                'key' => 'dark_logo',
                'value_ar' => null,
                'value_en' => 'dark_logo.png',
                'type' => 'image'
            ],
            [
                'title' => 'White Logo',
                'key' => 'white_logo',
                'value_ar' => null,
                'value_en' => 'white_logo.png',
                'type' => 'image'
            ],
            [
                'title' => 'Default Logo',
                'key' => 'default_logo',
                'value_ar' => null,
                'value_en' => 'default_logo.png',
                'type' => 'image'
            ],
            [
                'title' => 'favicon',
                'key' => 'favicon',
                'value_ar' => null,
                'value_en' => 'favicon.png',
                'type' => 'image'
            ],
            [
                'title' => 'Default Image',
                'key' => 'default_image',
                'value_ar' => null,
                'value_en' => 'default_image.png',
                'type' => 'image'
            ]
        ];
            Setting::insert($settings);

    }
}
