@extends('layout.main')
<link rel="stylesheet" href="{{ asset('css/page/user-manager.css') }}">
@section('content')
    <div class="wrapper-category">
        <div class="category-search">
            <div class="titles">Danh sách độc giả</div>
            <div class="input-group">
                <input type="text" placeholder="nhập mã độc giả" class="search-input">
                <input type="text" placeholder="nhập tên độc giả" class="search-input">
            </div>
            <button class="btn-action add-user">Thêm độc giả</button>
        </div>

    </div>
    <div class="category-search body">
        <div class="row">
            <div class="col-8">
                <table class="table">
                    <thead>
                        <th>
                            Mã độc giả
                        </th>
                        <th>Họ Và Tên</th>
                        <th>Ngày Sinh</th>
                        <th>Địa chỉ</th>
                        <th>Ngày lập thẻ</th>
                        <th>Trạng thái thẻ</th>
                        <th>Tổng nợ</th>
                        <th>Tác vụ</th>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                            <tr>
                                <td>{{ $item->MA_DG }}</td>
                                <td>{{ $item->TEN_DG }}</td>
                                <td>{{ $item->NGAY_SINH }}</td>
                                <td>{{ $item->DIA_CHI }}</td>
                                <td hidden>{{ $item->email }}</td>
                                <td hidden>{{ $item->MA_NV }}</td>
                                <td>{{ $item->NGAY_LAP }}</td>
                                <td>{{ $item->TINH_TRANG }}</td>
                                <td>{{ $item->TONG_NO }} VNĐ</td>
                                <td>
                                    <button class="btn-delete">Xóa</button>
                                    <button class="btn-delete btn-money" data-bs-toggle="modal" data-bs-target="#exampleModal2">Thu Tiền</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-4">
                <div class="container-form">
                    <form action="/add/users" method="POST" class="form">
                        <div class="form-group">
                            <label for="">Mã Độc giả : </label>
                            <input type="text" class="input-text-type" name="MA_DG" placeholder="Nhập mã độc giả ">
                        </div>
                        <p class="OLD_MA_DG" hidden></p>
                        <div class="form-group mt-4">
                            <label for="">Họ và tên :</label>
                            <input type="text" class="input-text-type" name="TEN_DG" placeholder="Nhập tên độc giả">
                        </div>
                        <div class="form-group mt-4">
                            <label for="">Ngày sinh : </label>
                            <input type="date" class="input-text-type " name="NGAY_SINH" >
                        </div>
                        <div class="form-group mt-4">
                            <label for="">Địa chỉ : </label>
                            <input type="text" class="input-text-type" name="DIA_CHI" placeholder="Nhập địa chỉ">
                        </div>
                        <div class="form-group mt-4">
                            <label for="">Ngày lập thẻ : </label>
                            <input type="date" class="input-text-type" name="NGAY_LAP">
                        </div>
                        <div class="form-group mt-4">
                            <label for="">Email : </label>
                            <input type="text" class="input-text-type" name="email" placeholder="Nhập email ....">
                        </div>
                        <div class="form-group mt-4">
                            <label for="">Người lập thẻ : </label>
                            <input type="text" class="input-text-type" name="MA_NV" placeholder="Nhập tiếp nhận">
                        </div>
                        <button class="btn-submit btn-add mt-4">Thêm</button>
                        <button class="btn-submit btn-update mt-4" hidden>Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Phiếu thu tiền phạt</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/cap-nhat-tien-no" method="POST">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Họ Tên</label>
                                    <input type="text" id="name_user" >
                                </div>
                                <input type="text" name="MA_DG" id="name" hidden placeholder="tên sách...">
                                <div class="form-group">
                                    <label for="tien_no">Tiền nợ</label>
                                    <input type="text"  id="tien_no">
                                </div>
                                <div class="form-group">
                                    <label for="so_tien_thu">Số tiền thu</label>
                                    <input type="text" id="so_tien_thu" placeholder="Số tiền thu">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="TONG_NO">Còn lại</label>
                                    <input type="text" name="TONG_NO" id="TONG_NO" >
                                </div>
                                <div class="form-group">
                                    <label for="MA_NV">Người thu tiền</label>
                                    <input type="text" id="MA_NV" placeholder="Người thu tiền...">
                                </div>
                               
                            </div>

                        </div>
                        <div class="submit mt-4">
                            <button class="btn-submit">Thu tiền</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    <script src="{{ asset('js/users.js') }}"></script>
@endsection
