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
        Schema::create('shift_changes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shift_report_id')->unique()->constrained()->cascadeOnDelete();
            $table->foreignId('approved_by')->nullable()->references('id')->on('shift_leaders')->onDelete('cascade');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->dateTime('approved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shift_changes');
    }
};
