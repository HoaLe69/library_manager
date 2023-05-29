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
        Schema::create('docgia', function (Blueprint $table) {
            $table->string('MA_DG' , 10)->primary();
            $table->string('TEN_DG' , 30);
            $table->date('NGAY_SINH');
            $table->string('DIA_CHI' , 50);
            $table->string('email' , 20)->nullable();
            $table->string('NGAY_LAP');
            $table->string('TINH_TRANG');
            $table->string('MA_NV' , 10)->nullable();
            $table->foreign('MA_NV')->references('MA_NV')->on('nhanvien')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('docgia');
    }
};
