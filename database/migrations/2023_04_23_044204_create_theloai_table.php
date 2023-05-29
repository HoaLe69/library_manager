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
        Schema::create('theloai', function (Blueprint $table) {
            $table->string('MA_TL' , 10)->primary();
            $table->string('TEN_TL' , 40);
            $table->integer('LUOT_MUOT')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('theloai');
    }
};
