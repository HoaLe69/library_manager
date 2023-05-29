<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class docgia extends Model
{
    use HasFactory;
    protected $table = 'docgia';
    public function getUser(){
        $users = DB::table($this->table)->select('*')->get();
        return $users;
    }
    public function insert($data){
        $insert = DB::table($this->table)->insert($data);
        return $insert;
    }
    public function updateUser($data , $code){
        $update = DB::table($this->table)->where('MA_DG' , '=' , $code)->update($data);
        return $update;
    }
    public function deleteUser($code) {
        $delete = DB::table($this->table)->where('MA_DG' , '=' , $code)->delete();
        return $delete;
    }
    public function updataMoney($code , $data) {
        $update = DB::table($this->table)->where('MA_DG' , '=' , $code)->update($data);
        return $update;
    }
}
