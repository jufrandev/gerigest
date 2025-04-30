<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by'); // Usuario que crea la nota
            $table->string('title'); // Título de la nota
            $table->text('content')->nullable(); // Contenido de la nota
            $table->unsignedBigInteger('note_type_id')->nullable(); // Tipo de nota
            $table->unsignedBigInteger('priority_id')->nullable(); // Prioridad
            $table->timestamps();

            // Relaciones
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('note_type_id')->references('id')->on('note_types')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('priority_id')->references('id')->on('priorities')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
