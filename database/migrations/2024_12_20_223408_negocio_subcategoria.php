<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('negocio_subcategoria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('negocio_id')->constrained('negocios', 'negocio_id')->onDelete('cascade');
            $table->foreignId('subcategoria_id')->constrained('subcategorias', 'subcategoria_id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'negocio_subcategoria');
    }
};
