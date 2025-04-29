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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('room_number'); // Número de habitación
            $table->string('bed_number'); // Número de cama
            $table->string('medical_history_number'); // Número de historia clínica
            $table->string('insurance_provider'); // Compañía de seguros
            $table->string('insurance_policy_number'); // Número de póliza de seguros
            $table->string('emergency_contact_name'); // Nombre del contacto de emergencia
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
