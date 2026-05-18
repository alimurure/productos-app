<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use App\Models\Categoria;
 
class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        // Limpia la tabla antes de insertar (evita duplicados)
        Categoria::truncate();
 
        $categorias = [
            ['descripcion' => 'Electrónica'],
            ['descripcion' => 'Ropa y Accesorios'],
            ['descripcion' => 'Alimentos y Bebidas'],
            ['descripcion' => 'Hogar y Jardín'],
            ['descripcion' => 'Deportes'],
        ];
 
        foreach ($categorias as $cat) {
            Categoria::create($cat);
        }
 
        $this->command->info('✔ Categorías insertadas: ' . count($categorias));
    }
}
