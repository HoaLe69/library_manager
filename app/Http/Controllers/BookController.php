<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\BookType;
use App\Models\muon;
use App\Models\phieuphat;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    private $book;
    private $bookType;
    private $muon;
    private $phieuphat;
    public function __construct()
    {
        $this->book = new Books();
        $this->bookType = new BookType();
        $this->muon = new muon();
        $this->phieuphat = new phieuphat();
    }
    public function getBook()
    {
        $listBook = $this->book->getBook();
        return view('page.bookmn', compact('listBook'));
    }
    public function getBookType(Request $request)
    {
        $bookType = $this->bookType->getBookType();
        return view('page.book-type', compact('bookType'));
    }
    public function getBookTypeByQuery(Request $request)
    {
        $query = $request->q;
        $bookType = $this->bookType->getBookTypeByQuery($query);
        return response()->json([$bookType], 200);
    }
    public function addBookType(Request $request)
    {
        $add = $this->bookType->insertTypeBook($request->all());
        if ($add) {
            return redirect('/book-type');
        }
        return 'Thêm thất bại - Hãy kiểm tra lại dữ liệu';
    }
    public function updateBookType(Request $request, $code)
    {
        $edit = $this->bookType->editBookType($code, $request->all());
        if ($edit) {
            return response()->json('Cập nhật thành công', 200);
        }
        return response()->json('Cập nhật thất bại', 500);
    }
    public function deleteTypeBook($code)
    {
        $del = $this->bookType->deleteType($code);
        if ($del) {
            return response()->json('Xóa thành công', 200);
        }
        return response()->json('Xóa thất bại', 500);
    }

    protected function storeImage(Request $request)
    {
        $path = $request->file('THUMBNAIL')->store('public/book');
        return substr($path, strlen('public/'));
    }
    public function addBook(Request $request)
    {
        $code_book = explode(':', $request->MA_TL);
        $fileName = $this->storeImage($request);
        $data = [
            'THUMBNAIL' => $fileName,
            'MA_TL' => $code_book[0],
            'TINH_TRANG' => $request->TINH_TRANG,
            'TRI_GIA' => $request->TRI_GIA,
            'NGAY_NHAP' => $request->NGAY_NHAP,
            'NHA_XUAT_BAN' => $request->NHA_XUAT_BAN,
            'NXB' => $request->NXB,
            'TAC_GIA' => $request->TAC_GIA,
            'TEN_SACH' => $request->TEN_SACH,
            'MA_NV' => $request->MA_NV,
        ];
        $insert = $this->book->insert($data);
        if ($insert) {
            return redirect('/book');
        }
        return 'that bai';
    }
    public function updateBook(Request $request)
    {
        $data = $request->all();
        $code = explode(':', $request->TEN_SACH);
        $data['TEN_SACH'] = $code[1];
        if ($request->has('MA_TL')) {
            $code_book = explode(':', $request->MA_TL);
            $data['MA_TL']  = $code_book[0];
        }
        $update = $this->book->updateBook($data, $code[0]);
        if ($update) {
            return response()->json('Thành công');
        }
        return 'that bai';
    }


    public function format_date($date)
    {
        return date('d/m/Y', strtotime($date));
    }
    public function getListBorrowBook()
    {
        $listBorrow = $this->muon->getListBorrow();
        return view('page.borrow-manager', compact('listBorrow'));
    }
    public function addBorrowBook(Request $request)
    {
        $data['NGAY_TRA'] = $this->format_date($request->NGAY_TRA);
        $data['MA_DG'] = $request->MA_DG;
        $data['NGAY_MUON'] = $request->NGAY_MUON;
        $data['MA_SACH'] = $request->MA_SACH;
        $codeType = $request->MA_TL;
        $insert = $this->muon->insert($data, $codeType);
        if ($insert) {
            return redirect('/borrow/book');
        }
        return 'Có vấn đề !! hãy kiểm tra lại dữ liệu ???';
    }

    public function addBill(Request $request)
    {
        $data['MA_DG'] = $request->MA_DG;
        $data['NGAY_TRA'] = $request->NGAY_TRA;
        $data['MA_NV'] = $request->MA_NV;
        $data['TIEN_PHAT'] = $request->TIEN_PHAT;
        $codebook = $request->MA_SACH;
        $status = $request->TINH_TRANG;
        $borrow = DB::table('muon')->where('MA_DG', '=', $data['MA_DG'])
            ->where('MA_SACH', '=', $codebook)->whereNull('NGAY_TRA_THUC_TE')->first();
        if($borrow){
           $insertDay =  DB::table('muon')->where('MA_DG', '=', $data['MA_DG'])
            ->where('MA_SACH', '=', $codebook)->whereNull('NGAY_TRA_THUC_TE')->update(['NGAY_TRA_THUC_TE'=>$data['NGAY_TRA']]);
        }
        $bill = $this->phieuphat->insert($data, $codebook, $status);
        if ($bill) {
            return response()->json($status, 200);
        }
        return response()->json('Thêm Thất bại', 200);
    }
    public function getBill($code)
    {
        $bill = $this->phieuphat->getOne($code);
        if ($bill) {
            return response()->json($bill, 200);
        }
        return response()->json('Thêm Thất bại', 200);
    }

    public function getBookByQuery(Request $request){
        $query = $request->q;
        $listBook = DB::table('sach')->where('TEN_SACH' , 'like' , $query.'%')->select('*')->get();
        return $listBook;
    }
     public function deleteBook($code) {
        $delete = DB::table('sach')->where('MA_SACH' , '=' , $code)->delete();
        if ($delete) {
            return response()->json('Xóa thành công' , 200);
        }
        return response()->json('Xóa thất bại' , 200);
     }
 
}
