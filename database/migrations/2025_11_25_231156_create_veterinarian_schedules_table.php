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
        Schema::create('veterinarian_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('admin_users')->onDelete('cascade');
            $table->unsignedTinyInteger('day_of_week')->comment('0=Domingo, 1=Lunes, 2=Martes, 3=Miércoles, 4=Jueves, 5=Viernes, 6=Sábado');
            $table->time('start_time');
            $table->time('end_time');
            $table->unsignedInteger('consultation_duration')->default(30)->comment('Duración en minutos');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['user_id', 'day_of_week']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('veterinarian_schedules');
    }
};
