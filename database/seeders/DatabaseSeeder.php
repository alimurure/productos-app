<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // <-- Obligatorio para desactivar llaves foráneas

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Desactivar temporalmente el chequeo de llaves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // 2. Registrar todos los seeders en el orden correcto
        $this->call([
            UserSeeder::class,      // Primero usuarios
            CategoriaSeeder::class,  // Luego categorías (productos dependen de ellas)
            ProductoSeeder::class,
        ]);

        // 3. Reactivar el chequeo de llaves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}