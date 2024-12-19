<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('negocios', function (Blueprint $table) {
            $table->id('negocio_id');
            $table->string('nombre')->index();
            $table->string('direccion')->nullable();
            $table->string('ubicacion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('horarios')->nullable();
            $table->string('contacto_extra')->nullable();
            $table->enum('estado', ['activo','inactivo'])->default('inactivo');
            $table->string('imagen')->nullable();
            $table->foreignId(column: 'categoria_id')->index()->constrained('categorias', 'categoria_id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('negocios');
    }
};
