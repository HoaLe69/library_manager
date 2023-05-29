<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class thongke extends Model
{
    use HasFactory;
    public function getAllPayBook(){
        $getAll = DB::table('theloai')->select('*')->get();
        return $getAll;
    }
    public function getPayLate($day){
        $getAll = DB::table('muon')
        ->join('sach' , 'sach.MA_SACH' , '=' , 'muon.MA_SACH')
        ->select('*')
        ->where('NGAY_MUON' ,'like' , $day.'%')->get();
        return $getAll;
    }
    public function getMoneyLend($day){
        $getAll = DB::table('phieuphat')
        ->join('docgia' , 'docgia.MA_DG' , '=' , 'phieuphat.MA_DG')
        ->select('*')
        ->where('NGAY_TRA' ,'like' , $day.'%')->get();
        return $getAll;
    }
}
