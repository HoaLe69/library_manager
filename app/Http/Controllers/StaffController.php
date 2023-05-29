<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\nhanvien;
class StaffController extends Controller
{
    private $nhanvien;
    public function __construct()
    {
        $this->nhanvien = new nhanvien();
    }
    public function getAllStaff()
    {
        $users = $this->nhanvien->getUser();
        return view('page.staff-manager', compact('users'));
    }
    public function addStaff(Request $request)
    {
        $data = $request->all();
        $insert = $this->nhanvien->insert($data);
        if ($insert) {
            return redirect('/staff-manager');
        }
        return 'Thêm thất bại , hãy xem lại dữ liệu đầu vào !!!!';
    }
    public function updateStaff(Request $request , $code) {
        $data = $request->all();
        $update = $this->nhanvien->updateStaff($data , $code);
        if ($update) {
            return response()->json('Cập nhật thành công !!!' , 200);
        }
        return response()->json('Cập nhật thất bại !!!' , 500);
    }
    public function deleteStaff($code){
        $delete = $this->nhanvien->deleteStaff($code);
        if ($delete) {
            return response()->json('Xóa thành công !!!' , 200);
        }
        return response()->json('Xóa thất bại !!!' , 500);
    }
}
