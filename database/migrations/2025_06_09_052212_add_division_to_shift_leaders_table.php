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
        Schema::table('shift_leaders', function (Blueprint $table) {
            $table->enum('division', ['Unit Personnel', 'WTP Personnel', 'Ash FGD Personnel'])->nullable()->after('phone_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shift_leaders', function (Blueprint $table) {
            //
        });
    }
};
