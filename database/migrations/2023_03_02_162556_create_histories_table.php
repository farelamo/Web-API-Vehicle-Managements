<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained();
            $table->foreignId('employee_id')->constrained();
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('spv_employee_id');
            $table->unsignedBigInteger('spv_admin_id');
            $table->boolean('spv_admin_approve')->nullable();
            $table->boolean('spv_employee_approve')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('fuel', 5);
            $table->string('distance');
            $table->text('description');
            $table->foreign('admin_id')->references('id')->on('users');
            $table->foreign('spv_employee_id')->references('id')->on('users');
            $table->foreign('spv_admin_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};