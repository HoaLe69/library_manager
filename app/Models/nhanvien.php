<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class nhanvien extends Model
{
    use HasFactory;
    protected $table = 'nhanvien';
    public function getUser(){
        $users = DB::table($this->table)
            ->join('bophan' , 'nhanvien.MA_BP' , '=' , 'bophan.MA_BP')
        ->select('*')->get();
        return $users;
    }
    public function insert($data){
        $insert = DB::table($this->table)->insert($data);
        return $insert;
    }
    public function updateStaff($data , $code){
        $update = DB::table($this->table)->where('MA_NV' , '=' , $code)->update($data);
        return $update;
    }
    public function deleteStaff($code) {
        $delete = DB::table($this->table)->where('MA_NV' , '=' , $code)->delete();
        return $delete;
    }
}
