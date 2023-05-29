<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class muon extends Model
{
    use HasFactory;
    protected $table = 'muon';
    public function getListBorrow()
    {
        $list = DB::table($this->table)
            ->join('docgia', 'docgia.MA_DG', '=', 'muon.MA_DG')
            ->join('sach', 'sach.MA_SACH', '=', 'muon.MA_SACH')
            ->select('*')->get();
        return $list;
    }
    public function insert($data, $codeType)
    {
        $debt = DB::table('theloai')
            ->where('MA_TL', $codeType)
            ->first();
        $update = DB::table('sach')->where('MA_SACH', '=', $data['MA_SACH'])->update(['TINH_TRANG' => 'Đang cho mượn']);
        if ($debt) {
             DB::table('theloai')->where('MA_TL', '=', $codeType)->update(['LUOT_MUOT' => $debt->LUOT_MUOT + 1]);
        }
        $insert = DB::table($this->table)->insert($data);
        return $insert;
    }
    public function updateUser($data, $code)
    {
        $update = DB::table($this->table)->where('MA_DG', '=', $code)->update($data);
        return $update;
    }
    public function deleteUser($code)
    {
        $delete = DB::table($this->table)->where('MA_DG', '=', $code)->delete();
        return $delete;
    }
}
