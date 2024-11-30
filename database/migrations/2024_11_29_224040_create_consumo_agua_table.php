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
        Schema::create('consumo_aguas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cultivo_id')->constrained('cultivos')->onDelete('cascade');
            $table->date('data');
            $table->decimal('volume_utilizado', 10, 2);
            $table->string('estagio_cultura'); // Novo campo: Germinação, Crescimento, etc.
            $table->decimal('temperatura', 5, 2)->nullable(); // Temperatura média da semana
            $table->decimal('precipitacao', 5, 2)->nullable(); // Chuva em mm
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consumo_aguas');
    }
};
