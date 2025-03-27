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
        Schema::create('medical_studies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('customers')->onDelete('cascade');
            $table->date('fecha');
            $table->decimal('peso', 5, 2)->nullable();
            $table->decimal('altura', 5, 2)->nullable();
            $table->string('presion_arterial', 50)->nullable();
            $table->text('recomendaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_studies');
    }
};
