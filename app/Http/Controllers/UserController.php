<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\docgia;
use DateTime;
class UserController extends Controller
{
    private $docgia;
    public function __construct()
    {
        $this->docgia = new docgia();
    }
    public function getAllUser()
    {
        $users = $this->docgia->getUser();
        return view('page.users-manager', compact('users'));
    }
     public function add_months_to_date($date, $months) {
        $date_time = DateTime::createFromFormat('d/m/Y', $date);
        $date_time->modify("+$months month");
        return $date_time->format('d/m/Y');
    }
    public function format_date($date)
    {
        return date('d/m/Y', strtotime($date));
    }
    public function addUser(Request $request)
    {
        $data = $request->all();
        $data['NGAY_LAP'] = $this->format_date($request->NGAY_LAP);
        $data['TINH_TRANG'] = $this->add_months_to_date($this->format_date($request->NGAY_LAP) , 6);
        $insert = $this->docgia->insert($data);
        if ($insert) {
            return redirect('/users-manager');
        }
        return 'Thêm thất bại , hãy xem lại dữ liệu đầu vào !!!!';
    }
    public function updateUser(Request $request , $code) {
        $data = $request->all();
        if ($request->has('NGAY_LAP')){
            $data['NGAY_LAP'] = $this->format_date($request->NGAY_LAP);
            $data['TINH_TRANG'] = $this->add_months_to_date($this->format_date($request->NGAY_LAP) , 6);
        }
        $update = $this->docgia->updateUser($data , $code);
        if ($update) {
            return response()->json('Cập nhật thành công !!!' , 200);
        }
        return response()->json('Cập nhật thất bại !!!' , 500);
    }
    public function deleteUser($code){
        $delete = $this->docgia->deleteUser($code);
        if ($delete) {
            return response()->json('Xóa thành công !!!' , 200);
        }
        return response()->json('Xóa thất bại !!!' , 500);
    }
    public function updateMoney(Request $request){
        $data['TONG_NO'] = $request->TONG_NO;
        $code = $request->MA_DG;
        $update = $this->docgia->updataMoney($code , $data);
        if ($update) {
            return redirect('/users-manager');
        }
        return response()->json(' thất bại !!!' , 500);
    }
}
