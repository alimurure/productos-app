<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
 
class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Elimina usuarios existentes para evitar duplicados
        User::truncate();
 
        User::create([
            'name'     => 'Administrador',
            'email'    => 'admin@productosapp.com',
            'password' => Hash::make('admin123'),  // Nunca guardar contraseñas en texto plano
            'rol'      => 'admin',
        ]);
 
        User::create([
            'name'     => 'Usuario Demo',
            'email'    => 'demo@productosapp.com',
            'password' => Hash::make('demo123'),
            'rol'      => 'user',
        ]);
 
        $this->command->info('✔ Usuarios creados: admin@productosapp.com / admin123');
    }
}
