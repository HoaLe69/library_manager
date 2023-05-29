<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Books extends Model
{
    use HasFactory;
    protected $table = 'sach';
    public function getBook(){
        $listBook = DB::table($this->table)
                        ->join('theloai' , $this->table.'.MA_TL' , '=' ,'theloai.MA_TL')
                        ->get([$this->table.'.*' , 'theloai.TEN_TL']);
        return $listBook;
    }
    public function insert($data){
        $insert = DB::table($this->table)->insert($data);
        return $insert;
    }
    public function updateBook($data , $code){
        $update = DB::table($this->table)->where('MA_SACH' , '=' , $code)->update($data);
        return $update;
    }
}
