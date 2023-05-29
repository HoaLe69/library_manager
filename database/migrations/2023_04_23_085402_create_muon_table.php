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
        Schema::create('muon', function (Blueprint $table) {
            $table->string('MA_DG' , 10);
            $table->unsignedBigInteger('MA_SACH');
            $table->date('NGAY_MUON');
            $table->date('NGAY_TRA');
            $table->date('NGAY_GIAO');
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
        Schema::dropIfExists('muon');
    }
};
