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
        Schema::create('family_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Familiar
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade'); // Usuario relacionado
            $table->string('relationship'); // Relación con el paciente (ej. madre, padre, hermano, etc.)
            $table->string('address')->nullable(); // Dirección del familiar
            $table->string('phone')->nullable(); // Teléfono del familiar
            $table->string('postal_code')->nullable(); // Código postal del familiar
            $table->string('email')->unique(); // Correo electrónico del familiar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_members');
    }
};
