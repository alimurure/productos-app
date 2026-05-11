<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id('id_producto');
            $table->string('nombre', 100);
            $table->string('marca', 100);
            $table->decimal('precio', 10, 2);
            $table->integer('stock');
            $table->unsignedBigInteger('id_categoria');
            $table->timestamps();
            $table->foreign('id_categoria')
                  ->references('id_categoria')
                  ->on('categorias')
                  ->onDelete('cascade');
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
