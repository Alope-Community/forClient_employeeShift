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
        Schema::create('shift_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_employee_id')->references('id')->on('employees')->cascadeOnDelete();
            $table->foreignId('employee_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('from_shift_id')->nullable()->references('id')->on('shifts')->cascadeOnDelete();
            $table->foreignId('to_shift_id')->nullable()->references('id')->on('shifts')->cascadeOnDelete();
            $table->enum('type', ['change', 'problem'])->default('change');
            $table->string('title');
            $table->text('description');
            $table->dateTime('time');
            $table->text('address');
            $table->text('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shift_reports');
    }
};
