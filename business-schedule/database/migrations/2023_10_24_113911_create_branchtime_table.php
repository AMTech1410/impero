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
        Schema::create('branchtime', function (Blueprint $table) {
            $table->id();
            $table->enum('weekdays',['Mon','Tue','Wed','Thu','Fri','Sat','Sun']);
            $table->date('startDate');
            $table->date('endDate');
            $table->unsignedBigInteger('branch_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branchtime');
    }
};
