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
        Schema::create('complanes', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('serial')->nullable();
            $table->string('p_date')->nullable();;
            $table->string('invoice_serial')->nullable();
            $table->string('invoice_date')->nullable();
            $table->string('product_type')->nullable();
            $table->string('product_weight')->nullable();
            $table->string('problem_date')->nullable();
            $table->string('temperature')->nullable();

            $table->boolean('subject_weight')->default(0);
            $table->boolean('subject_quality')->default(0);
            $table->boolean('subject_delivery_time')->default(0);
            $table->boolean('subject_packaging')->default(0);
            $table->boolean('subject_finance')->default(0);
            $table->boolean('subject_behavior')->default(0);
            $table->string('subject_other')->nullable();

            $table->longText('issue')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complanes');
    }
};
