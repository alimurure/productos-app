<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use App\Models\Producto;
 
class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        Producto::truncate();
 
        $productos = [
            // Electrónica (id_categoria = 1)
            ['nombre' => 'Laptop HP 15',        'marca' => 'HP',       'precio' => 2500.00, 'stock' => 10, 'id_categoria' => 1],
            ['nombre' => 'Audífonos Bluetooth', 'marca' => 'Sony',     'precio' =>  120.50, 'stock' => 25, 'id_categoria' => 1],
            ['nombre' => 'Teclado Mecánico',    'marca' => 'Logitech', 'precio' =>  189.90, 'stock' => 15, 'id_categoria' => 1],
            // Ropa y Accesorios (id_categoria = 2)
            ['nombre' => 'Polo Deportivo',      'marca' => 'Adidas',   'precio' =>   45.00, 'stock' => 50, 'id_categoria' => 2],
            ['nombre' => 'Gorra Casual',        'marca' => 'Nike',     'precio' =>   35.00, 'stock' => 30, 'id_categoria' => 2],
            // Alimentos y Bebidas (id_categoria = 3)
            ['nombre' => 'Café Orgánico 250g',  'marca' => 'Altomayo', 'precio' =>   18.90, 'stock' => 100, 'id_categoria' => 3],
            ['nombre' => 'Avena Tres Ositos',   'marca' => '3 Ositos', 'precio' =>    8.50, 'stock' =>  80, 'id_categoria' => 3],
            // Hogar y Jardín (id_categoria = 4)
            ['nombre' => 'Lámpara LED',         'marca' => 'Philips',  'precio' =>   55.00, 'stock' =>  20, 'id_categoria' => 4],
            // Deportes (id_categoria = 5)
            ['nombre' => 'Pelota de Fútbol',    'marca' => 'Mikasa',   'precio' =>   79.00, 'stock' =>  40, 'id_categoria' => 5],
        ];
 
        foreach ($productos as $prod) {
            Producto::create($prod);
        }
 
        $this->command->info('✔ Productos insertados: ' . count($productos));
    }
}
