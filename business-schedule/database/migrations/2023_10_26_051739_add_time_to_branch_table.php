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
        Schema::table('branchtime', function (Blueprint $table) {
            $table->string('startTime')->nullable();;
            $table->string('endTime')->nullable();;
            $table->boolean('closed')->default(false);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('branchtime', function (Blueprint $table) {
            $table->dropColumn('weekdays');
        });
    }
};
