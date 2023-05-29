<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\thongke;
use Illuminate\Support\Facades\DB;
class StatisticalController extends Controller
{
    private $thongke;
    public function __construct()
    {
        $this->thongke = new thongke();
    }
    public function getAllPayBoook(){
        $getAll = $this->thongke->getAllPayBook();
        $totalPay = DB::table('theloai')->sum('LUOT_MUOT');
        return view('page.statistical' , compact('getAll' , 'totalPay'));
    }
    public function getPayLate(Request $request){

        $data = $this->thongke->getPayLate($request->q);
        return response()->json($data , 200);
    }
    public function getMoneyLend(Request $request){
        $data = $this->thongke->getMoneyLend($request->q);
        return response()->json($data , 200);
    }
}
