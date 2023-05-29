<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class BookType extends Model
{
    use HasFactory;
    protected $table = 'theloai';
    public function getBookType(){
        $bookType = DB::table($this->table)->select('*')->get();
        return $bookType;
    }
    public function getBookTypeByQuery($query){
        $bookType = DB::table($this->table)->select('*')->where('TEN_TL' ,  'LIKE' , $query.'%')->get();
        return $bookType;
    }
    public function insertTypeBook($data){
        $insert = DB::table($this->table)->insert($data);
        return $data;
    }
    public function editBookType($code , $data){
        $edit = DB::table($this->table)->where('MA_TL' , '=' , $code)->update($data);
        return $edit;
    }
    public function deleteType($code) {
        $delete = DB::table($this->table)->where('MA_TL' , '=' , $code)->delete();
        return $delete;
    }
}
