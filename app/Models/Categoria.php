<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Categoria extends Model
{
    use HasFactory;
 
    protected $table = 'categorias';
    protected $primaryKey = 'id_categoria';
    protected $fillable = ['descripcion'];
 
    // Relación: Una categoría tiene muchos productos
    public function productos()
    {
        return $this->hasMany(
            'App\Models\Producto',
            'id_categoria',
            'id_categoria'
        );
    }
}
