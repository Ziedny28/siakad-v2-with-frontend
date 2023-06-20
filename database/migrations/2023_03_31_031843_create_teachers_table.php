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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('ni')->unique();
            $table->string('name');
            $table->string('address');
            $table->string('pob');
            $table->string('password');
            $table->string('schedule');
            $table->string('email')->unique();

            $table->foreignId('subject_id')->constrained('subjects')->restrictOnDelete(); //mengajar
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
