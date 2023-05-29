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
        Schema::create('nhanvien', function (Blueprint $table) {
            $table->string('MA_NV' , 10)->primary();
            $table->string('TEN_NV' , 30);
            $table->string('DIA_CHI' , 200);
            $table->string('SDT' , 11);
            $table->date('NGAY_SINH');
            $table->string('MA_BP' , 10);
            $table->timestamps();
            $table->foreign('MA_BP')->references('MA_BP')->on('bophan')->onUpdate('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('nhanvien');
    }
};
