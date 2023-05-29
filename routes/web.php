<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StatisticalController;
Route::get('/', function () {
    return view('layout.main');
});
Route::get('/book', [BookController::class , 'getBook']);
Route::post('/book/add' ,[BookController::class , 'addBook']);
Route::get('/book-type', [BookController::class , 'getBookType'] );
Route::put('/update-book', [BookController::class , 'updateBook'] );
Route::post('/add/book-type', [BookController::class , 'addBookType'] );
Route::get('/get-book-type', [BookController::class , 'getBookTypeByQuery'] );
Route::put('/update/book-type/{code}' , [BookController::class , 'updateBookType']);
Route::delete('/delete/book-type/{code}' , [BookController::class , 'deleteTypeBook']);
Route::delete('/delete/book/{code}' , [BookController::class , 'deleteBook']);
Route::get('/users-manager' , [UserController::class , 'getAllUser']);
Route::post('/add/users' , [UserController::class , 'addUser']);
Route::put('/update/users/{code}' , [UserController::class , 'updateUser']);
Route::delete('/delete/users/{code}' , [UserController::class , 'deleteUser']);
Route::get('/staff-manager' , [StaffController::class , 'getAllStaff']);
Route::post('/add/staff' , [StaffController::class , 'addStaff']);
Route::put('/update/staff/{code}' , [StaffController::class , 'updateStaff']);
Route::put('/delete/staff/{code}' , [StaffController::class , 'deleteStaff']);
Route::get('/borrow/book' , [BookController::class , 'getListBorrowBook']);
Route::post('/add/borrow/book' , [BookController::class , 'addBorrowBook']);
Route::post('/add/bill/book' , [BookController::class , 'addBill']);
Route::get('/get/bill/book/{code}' , [BookController::class , 'getBill']);
Route::get('/thong-ke-luot-muon' , [StatisticalController::class , 'getAllPayBoook']);
Route::get('/thong-ke-tra-muon' , [StatisticalController::class , 'getPayLate']);
Route::get('/thong-ke-tien-no' , [StatisticalController::class , 'getMoneyLend']);
Route::post('/cap-nhat-tien-no' , [UserController::class , 'updateMoney']);
Route::get('/get-book-by-query' , [BookController::class , 'getBookByQuery']);
