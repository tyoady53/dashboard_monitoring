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
        Schema::create('customer_branches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('outlet_id',5);
            $table->integer('customer_id');
            $table->string('branch_name');
            $table->string('is_show',1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_branches');
    }
};
