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
        Schema::table('categorias', function (Blueprint $table) {
            $table->string('banner')->nullable()->after('descripcion');
            $table->string('logo')->nullable()->after('banner');
            $table->string('color')->nullable()->after('logo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categorias', function (Blueprint $table) {
            $table->dropColumn('banner'); 
            $table->dropColumn( 'logo');
            $table->dropColumn( 'color'); 

        });
    }
};
