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
        Schema::create('phieuphat', function (Blueprint $table) {
            $table->id('MA_PHIEU');
            $table->string('MA_DG' , 10);
            $table->unsignedBigInteger('MA_SACH');
            $table->bigInteger('TIEN_PHAT');
            $table->string('GHI_CHU');
            $table->timestamps();

            $table->foreign('MA_DG')->references('MA_DG')->on('docgia')->onUpdate('cascade');
            $table->foreign('MA_SACH')->references('MA_SACH')->on('sach')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phieuphat');
    }
};
