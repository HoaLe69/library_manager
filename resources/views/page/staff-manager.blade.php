@extends('layout.main')
<link rel="stylesheet" href="{{ asset('css/page/staff-manager.css') }}">
<link rel="stylesheet" href="{{ asset('css/page/user-manager.css') }}">
@section('content')
    <div class="wrapper-category">
        <div class="category-search">
            <div class="titles">Danh sách nhân viên</div>
            <div class="input-group">
                <input type="text" placeholder="nhập mã nhân viên" class="search-input">
                <input type="text" placeholder="nhập tên nhân viên" class="search-input">
            </div>
            <button class="btn-action add-staff">Thêm nhân viên</button>
        </div>

    </div>
    <div class="category-search body">
        <div class="row">
            <div class="col-8">
                <table class="table">
                    <thead>
                        <th> Mã nhân viên</th>
                        <th>Họ Và Tên</th>
                        <th>Ngày Sinh</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Bộ phận</th>
                        <th>Chức vụ</th>
                        <th>Tác vụ</th>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                            <tr>
                                <td>{{ $item->MA_NV }}</td>
                                <td>{{ $item->TEN_NV }}</td>
                                <td>{{ $item->NGAY_SINH }}</td>
                                <td>{{ $item->DIA_CHI }}</td>
                                <td>{{ $item->SDT }}</td>
                                <td>{{ $item->TEN_BP }}</td>
                                <td>{{ $item->CHUC_VU }}</td>
                                <td><button class="btn-delete">Xóa</button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-4">
                <div class="container-form">
                    <form action="/add/staff" method="POST" class="form">
                        <div class="form-group">
                            <label for="">Mã nhân viên : </label>
                            <input type="text" class="input-text-type" name="MA_NV" placeholder="Nhập mã nhân viên ">
                        </div>
                        <p class="OLD_MA_NV" hidden></p>
                        <div class="form-group mt-4">
                            <label for="">Họ và tên :</label>
                            <input type="text" class="input-text-type" name="TEN_NV" placeholder="Nhập tên nhân viên">
                        </div>
                        <div class="form-group mt-4">
                            <label for="">Ngày sinh : </label>
                            <input type="date" class="input-text-type " name="NGAY_SINH" style="padding: 5px 30px">
                        </div>
                        <div class="form-group mt-4">
                            <label for="">Địa chỉ : </label>
                            <input type="text" class="input-text-type" name="DIA_CHI" placeholder="Nhập địa chỉ">
                        </div>
                        <div class="form-group mt-4">
                            <label for="">Chức vụ : </label>
                            <select name="CHUC_VU" id="" class="input-text-type select-option">
                                <option value="">-------Chọn Chức vụ-----</option>
                                <option value="Giám Đốc">Giám Đốc</option>
                                <option value="Phó Giám Đốc">Phó Giám Đốc</option>
                                <option value="Trưởng Phòng">Trưởng Phòng</option>
                                <option value="Phó Phòng">Phó Phòng</option>
                                <option value="Nhân Viên">Nhân Viên</option>
                            </select>
                        </div>
                        <div class="form-group mt-4">
                            <label for="">Số ĐT : </label>
                            <input type="text" class="input-text-type" name="SDT" placeholder="Nhập SDT ....">
                        </div>
                        <div class="form-group mt-4">
                            <label for="">Bộ phận : </label>
                            <select name="MA_BP" id="" class="input-text-type select-option">
                                <option value="">-------Chọn Bộ phận-----</option>
                                <option value="TT">Thủ Thư</option>
                                <option value="TK">Thủ Kho</option>
                                <option value="TQ">Thủ Quỹ</option>
                                <option value="BGD">Ban Giám Đốc</option>
                            </select>
                        </div>
                        <button class="btn-submit btn-add mt-4">Thêm</button>
                        <button class="btn-submit btn-update mt-4" hidden>Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/staff.js') }}"></script>
@endsection
