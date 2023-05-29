<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class phieuphat extends Model
{
    use HasFactory;
    protected $table = 'phieuphat';
    public function getOne($code)
    {
        $bill = DB::table($this->table)->select('*')->where('MA_DG', '=', $code)->orderBy('NGAY_TRA')->first();
        return $bill;
    }
    public function insert($data, $codebook, $status)
    {
        $insert = 0;
        DB::table('sach')->where('MA_SACH', '=', $codebook)->update(['TINH_TRANG' => $status]);
        $debt = DB::table($this->table)
            ->where('NGAY_TRA', $data['NGAY_TRA'])
            ->first();
        if ($debt) {
            DB::table('docgia')->where('MA_DG', $data['MA_DG'])->update(['TONG_NO' => $debt->TIEN_PHAT + $data['TIEN_PHAT']]);
            $insert =  DB::statement("
            UPDATE $this->table
            SET TIEN_PHAT = " . ($debt->TIEN_PHAT + $data['TIEN_PHAT']) . "
            WHERE NGAY_TRA = '" . $data['NGAY_TRA'] . "'
                ");
        }
        if (!$debt) {
            $previousDebt = DB::table($this->table)
                ->where('NGAY_TRA', '<', $data['NGAY_TRA'])
                ->orderBy('NGAY_TRA', 'desc')
                ->first();
            $totalDebt = $previousDebt ? $previousDebt->TIEN_PHAT + $data['TIEN_PHAT'] : $data['TIEN_PHAT'];
            DB::table('docgia')->where('MA_DG', $data['MA_DG'])->update(['TONG_NO' => $totalDebt]);
            $data['TIEN_PHAT'] = $totalDebt;
            $insert =  DB::table($this->table)
                ->insert($data);
        }
        return $insert;
    }
    public function deleteBill($code)
    {
        $delete = DB::table($this->table)->where('MA_DG', '=', $code)->delete();
        return $delete;
    }
}
