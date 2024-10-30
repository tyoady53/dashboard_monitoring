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
        Schema::create('dash_monitoring_regnos', function (Blueprint $table) {
            // $table->bigInteger('id')->primary();
            $table->timestamp('dttm');
            $table->string('cust_name',50);
            $table->string('cust_branch',50);
            $table->string('regno',20);
            $table->string('type',10);
            $table->string('sc',1);
            $table->string('ps',1);
            $table->string('rs',1);
            $table->string('vr',1);
            $table->string('au',1);
            $table->string('kr',1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dash_monitoring_regnos');
    }
};
