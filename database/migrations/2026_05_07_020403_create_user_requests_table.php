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
        Schema::create('user_requests', function (Blueprint $table) {
             $table->id();

    $table->foreignId('user_id')
          ->constrained('users')
          ->onDelete('cascade');

    $table->foreignId('department_id')
          ->constrained()
          ->onDelete('cascade');

    $table->foreignId('equipment_id')
          ->constrained()
          ->onDelete('cascade');

    $table->integer('quantity');

    $table->text('reason');

    $table->string('overall_status')
          ->default('pending_hod');

    $table->date('request_date');

    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_requests');
    }
};
