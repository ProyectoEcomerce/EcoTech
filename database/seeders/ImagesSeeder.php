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
            'product_photo'=>'img/almacen-dia.png',
            'product_id'=>'1'
        ]);
        Image::create([
            'product_photo'=>'img/fabrica-noche.png',
            'product_id'=>'2'
        ]);
        Image::create([
            'product_photo'=>'img/oficina-dia.png',
            'product_id'=>'3'
        ]);
        Image::create([
            'product_photo'=>'img/fabrica-noche.png',
            'product_id'=>'4'
        ]);
        Image::create([
            'product_photo'=>'img/oficina-dia.png',
            'product_id'=>'5'
        ]);
        Image::create([
            'product_photo'=>'img/fabrica-noche.png',
            'product_id'=>'6'
        ]);

    }
}
