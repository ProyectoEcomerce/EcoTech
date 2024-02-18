<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Product::create([
            'name' => 'Placa Solar Premium',
            'description' => 'Lo último en innovación en el mercado. Ofrece un rendimiento excepcional y durabilidad aumentada respecto a la media. Ideal para sistemas residenciales y comerciales que buscan una fuente de energía sostenible. Con un diseño elegante y construcción robusta, esta placa solar es la elección perfecta para aquellos que buscan maximizar la eficiencia energética y reducir su huella ambiental.',
            'price' => 159.99,
            'offerPrice' => 139.99,
            'voltage' => '110V',
            'guarantee' => '3 años',
            'manufacturing_price' => 80.00,
            'weigth' => '24.0 kg',
            'materials' => 'Silicio policristalino',
            'dimensions' => '170x90 cm',
            'battery' => 'No',
            'engine' => 'No',
            'components' => 'Celdas solares, marco de aluminio, vidrio templado',
        ]);

        Product::create([
            'name' => 'Placa Solar Pequeña',
            'description' => 'Una opción económica para la generación de energía solar. Esta placa solar proporciona un rendimiento sin fallas a un precio más asequible. Ideal para instalaciones más pequeñas con proyectos en los que se busca una solución de energía eficiente sin comprometer el presupuesto.',
            'price' => 79.99,
            'offerPrice' => 69.99,
            'voltage' => '5V',
            'guarantee' => '1 año',
            'manufacturing_price' => 35.00,
            'weigth' => '15.5 kg',
            'materials' => 'Silicio amorfo',
            'dimensions' => '140x70 cm',
            'battery' => 'No',
            'engine' => 'No',
            'components' => 'Celdas solares flexibles, carcasa de plástico',
        ]);

        Product::create([
            'name' => 'Dron Compacto',
            'description' => 'Drone compacto diseñado para el riego eficiente de espacios pequeños. Su diseño ligero y materiales resistentes al agua lo hacen perfecto para el riego rápido de espacios más reducidos. Equipado con un sistema de pulverización y sensores de humedad para una irrigación precisa y automatizada.',
            'price' => 149.99,
            'offerPrice' => 129.99,
            'voltage' => '110V',
            'guarantee' => '1 año',
            'manufacturing_price' => 90.00,
            'weigth' => '2.5 kg',
            'materials' => 'Plástico resistente al agua',
            'dimensions' => '15x15x8 cm',
            'battery' => 'Batería recargable de polímero de litio',
            'engine' => 'Motores eléctricos de alta eficiencia',
            'components' => 'Sistema de pulverización, sensores de humedad',
        ]);

        Product::create([
            'name' => 'Placa Solar Estandar',
            'description' => 'Una opción clásica por sus caracteristicas equilibradas. Esta placa solar destaca por su increible relación calidad-precio. Adecuada para aplicaciones residenciales y comerciales con un enfoque en la eficiencia y la sostenibilidad. Su diseño funcional y duradero la convierte en una elección sólida para aquellos que buscan una fuente de energía renovable.',
            'price' => 119.99,
            'offerPrice' => 99.99,
            'voltage' => '110V',
            'guarantee' => '2 años',
            'manufacturing_price' => 60.00,
            'weigth' => '18.0 kg',
            'materials' => 'Silicio monocristalino',
            'dimensions' => '150x80 cm',
            'battery' => 'No',
            'engine' => 'No',
            'components' => 'Celdas solares, marco de aluminio, vidrio templado',
        ]);

        Product::create([
            'name' => 'Dron de Riego Agrícola Potente',
            'description' => 'Este dron de riego agrícola está diseñado para campos agrícolas extensos. Con su estructura robusta de fibra de carbono y aluminio resistente al agua, es capaz de realizar tareas de riego de manera eficiente. Equipado con un sistema de riego avanzado y cámaras de monitoreo para supervisar el estado de los cultivos.',
            'price' => 399.99,
            'offerPrice' => 349.99,
            'voltage' => '220V',
            'guarantee' => '2 años',
            'manufacturing_price' => 200.00,
            'weigth' => '5.0 kg',
            'materials' => 'Fibra de carbono, aluminio resistente al agua',
            'dimensions' => '25x25x10 cm',
            'battery' => 'Batería recargable de ion de litio de alta capacidad',
            'engine' => 'Potentes motores eléctricos',
            'components' => 'Sistema de riego avanzado, cámaras de monitoreo',
        ]);
        Product::create([
            'name' => 'Dron de Riego Agrícola Mediano',
            'description' => 'Este dron de riego agrícola es perfecto para cultivos agrícolas de tamaño mediano. El tamaño de su tanque le permite abarcar todo el territorio con mayor rapidez que sus versiones para campo más extenso. Equipado con un sistema de riego básico y cámaras para monitoreo básico de los cultivos.',
            'price' => 259.99,
            'offerPrice' => 208.99,
            'voltage' => '190V',
            'guarantee' => '1 año',
            'manufacturing_price' => 150.00,
            'weigth' => '3.5 kg',
            'materials' => 'Plástico resistente al agua',
            'dimensions' => '20x20x8 cm',
            'battery' => 'Batería recargable de ion de litio',
            'engine' => 'Motores eléctricos',
            'components' => 'Sistema de riego básico, cámaras de monitoreo',
        ]);
        
    }

}
