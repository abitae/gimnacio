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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->time('horario');
            $table->integer('duracion'); // Duración en minutos
            $table->foreignId('instructor_id')->nullable()->constrained('employees')->onDelete('set null');
            $table->foreignId('branch_id')->nullable()->constrained()->onDelete('cascade');
            $table->integer('capacity')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
