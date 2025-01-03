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
        Schema::create('dash_monitoring_tats', function (Blueprint $table) {
            // $table->id();
            $table->string('seq_no',1);
            $table->string('regno',50)->unique();
            $table->string('tat_time',8);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dash_monitoring_tats');
    }
};
