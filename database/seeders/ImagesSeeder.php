<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Image;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Image::create([
            'product_photo'=>'img/placaPremium.webp',
            'product_id'=>'1'
        ]);
        Image::create([
            'product_photo'=>'img/placaPequeña.webp',
            'product_id'=>'2'
        ]);
        Image::create([
            'product_photo'=>'img/dronCompacto.webp',
            'product_id'=>'3'
        ]);
        Image::create([
            'product_photo'=>'img/placaSimple.webp',
            'product_id'=>'4'
        ]);
        Image::create([
            'product_photo'=>'img/dronPotente.webp',
            'product_id'=>'5'
        ]);
        Image::create([
            'product_photo'=>'img/dronMediano.webp',
            'product_id'=>'6'
        ]);

    }
}
