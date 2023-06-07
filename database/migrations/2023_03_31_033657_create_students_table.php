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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('ni')->unique();
            $table->string('name');
            $table->string('address');
            $table->string('pob');
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignId('class_room_id')->constrained('class_rooms')->restrictOnDelete();//kelas murid
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
