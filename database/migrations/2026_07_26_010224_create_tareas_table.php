<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
   public function up(): void
{
    Schema::create('tareas', function (Blueprint $table) {
        $table->id();
        $table->string('titulo');
        $table->text('descripcion')->nullable();
        $table->string('archivo')->nullable(); // Para adjuntar PDF/Imágenes
        $table->dateTime('fecha_limite');
        $table->integer('estrellas_recompensa')->default(10); // ⭐ Puntos/Estrellas por completar
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // El maestro que la creó
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};
