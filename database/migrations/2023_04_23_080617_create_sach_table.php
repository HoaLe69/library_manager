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
        Schema::create('sach', function (Blueprint $table) {
            $table->id('MA_SACH');
            $table->string('TEN_SACH');
            $table->string('MA_NV' , 10);
            $table->string('TAC_GIA' , 30);
            $table->integer('NXB');
            $table->string('NHA_XUAT_BAN' , 50);
            $table->date('NGAY_NHAP');
            $table->bigInteger('TRI_GIA');
            $table->string('TINH_TRANG' , 20)->default('sẵn sàng');
            $table->string('MA_TL' , 10)->nullable();
            $table->string('THUMBNAIL' , 50);
            $table->foreign('MA_TL')->references('MA_TL')->on('theloai')->onUpdate('cascade');
            $table->foreign('MA_NV')->references('MA_NV')->on('nhanvien')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sach');
    }
};
