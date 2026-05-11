<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Producto extends Model
{
    use HasFactory;
 
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    protected $fillable = ['nombre', 'marca', 'precio', 'stock', 'id_categoria'];
 
    // Relación: Un producto pertenece a una categoría
    public function categoria()
    {
        return $this->belongsTo(
            'App\Models\Categoria',
            'id_categoria',
            'id_categoria'
        );
    }
}
