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
        Schema::create('collaborations', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->constrained('users')->cascadeOnDelete();
            $table->boolean('commercial')->default(0);
            $table->boolean('scientific')->default(0);
            $table->boolean('custom_production')->default(0);

            $table->boolean('honey')->default(0);
            $table->boolean('pollen')->default(0);
            $table->boolean('propolis')->default(0);
            $table->boolean('royal_jelly')->default(0);
            $table->boolean('bee_venom')->default(0);

            $table->longText('description')->nullable();
            $table->longText('images')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collaborations');
    }
};
