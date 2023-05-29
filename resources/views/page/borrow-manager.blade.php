@extends('layout.main')
<link rel="stylesheet" href="{{ asset('css/page/staff-manager.css') }}">
<link rel="stylesheet" href="{{ asset('css/page/user-manager.css') }}">
<link rel="stylesheet" href="{{ asset('css/page/borrow-book.css') }}">
@section('content')
    <div class="wrapper-category">
        <div class="category-search">
            <div class="titles">Danh sách mượn trả</div>
            <div class="input-group">
                <input type="text" placeholder="nhập tên độc giả..." class="search-input">
            </div>
        </div>

    </div>
    <div class="category-search body">
        <table class="table">
            <thead>
                <th>Tên độc giả</th>
                <th>Tên sách</th>
                <th>Ngày mượn</th>
                <th>Hạn Trả</th>
                <th>Ngày Trả Thực tế</th>
                <th>Tác vụ</th>
            </thead>
            <tbody>
                @foreach ($listBorrow as $item)
                    <tr>
                        <td class="name">{{ $item->TEN_DG }}</td>
                        <td hidden class="MA_DG">{{ $item->MA_DG }}</td>
                        <td hidden class="TRI_GIA">{{ $item->TRI_GIA }}</td>
                        <td hidden class="MA_SACH">{{ $item->MA_SACH }}</td>
                        <td class="name_book">{{ $item->TEN_SACH }}</td>
                        <td class="NGAY_MUON">{{ $item->NGAY_MUON }}</td>
                        <td class="NGAY_TRA">{{ $item->NGAY_TRA }}</td>
                        @if ($item->NGAY_TRA_THUC_TE)
                            <td class="NGAY_TRA">{{ $item->NGAY_TRA_THUC_TE }}</td>
                        @else
                            <td class="NGAY_TRA">Chưa trả</td>
                        @endif
                        <td>
                            <button class="btn-delete btn-pay-book" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Trả
                                sách</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content pay-book">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Phiếu trả sách</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/add/bill/book" method="POST">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Họ và tên</label>
                                    <input type="text" id="name_users" placeholder="Họ tên độc giả...">
                                </div>
                                <input type="text" hidden name="MA_DG" placeholder="Họ tên độc giả...">
                                <input type="text" hidden name="MA_SACH" placeholder="Họ tên độc giả...">
                                <input type="text" hidden name="TINH_TRANG" value="Sẵn sàng"
                                    placeholder="Họ tên độc giả...">
                                <input type="text" hidden name="MA_TL" placeholder="Họ tên độc giả...">
                                <div class="form-group">
                                    <label for="NGAY_TRA">Ngày trả</label>
                                    <input type="text" name="NGAY_TRA" id="NGAY_TRA">
                                </div>
                                <div class="form-group">
                                    <label for="MA_NV">Người ghi nhận</label>
                                    <input type="text" name="MA_NV" id="MA_NV" placeholder="Người ghi nhận">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="TIEN_PHAT_KNAY">Tiền phạt kì này</label>
                                    <input type="text" id="TIEN_PHAT_KNAY" placeholder="tiền phạt kì này...">
                                </div>
                                <div class="form-group">
                                    <label for="TIEN_NO">Tiền nợ</label>
                                    <input type="text" id="TIEN_NO" placeholder="tiền nợ">
                                </div>
                                <div class="form-group">
                                    <label for="TIEN_PHAT">Tổng nợ</label>
                                    <input type="text" name="TIEN_PHAT" placeholder="tổng nợ...">
                                </div>
                            </div>
                            <button class="btn-delete btn-lost-book">Ghi nhận mất sách</button>
                        </div>
                        <div class="submit mt-4">
                            <button class="btn-submit">Thêm</button>
                        </div>
                    </form>
                </div>

            </div>
            <div class="modal-content lost-book" hidden>
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ghi nhận mất sách</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/add/bill/book" method="POST">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Tên sách</label>
                                    <input type="text" id="name_book" placeholder="tên sách...">
                                </div>
                                <input type="text" name="MA_DG" id="name" hidden placeholder="tên sách...">
                                <input type="text" name="MA_SACH" id="name" hidden placeholder="tên sách...">
                                <input type="text" name="TINH_TRANG" id="name" hidden value="Đã mất"
                                    placeholder="tên sách...">
                                <div class="form-group">
                                    <label for="NGAY_TRA">Ngày ghi nhận</label>
                                    <input type="text" name="NGAY_TRA" id="NGAY_TRA">
                                </div>
                                <div class="form-group">
                                    <label for="MA_NV">Người ghi nhận</label>
                                    <input type="text" name="MA_NV" placeholder="Người ghi nhận">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Họ tên độc giả</label>
                                    <input type="text" id="name_users" placeholder="Họ tên dộc giả...">
                                </div>
                                <div class="form-group">
                                    <label for="TIEN">Tiền phạt</label>
                                    <input type="text" id="TIEN" placeholder="Tiền phạt...">
                                </div>
                                <div class="form-group">
                                    <label for="TIEN_PHAT">Tổng nợ</label>
                                    <input type="text" name="TIEN_PHAT" id="TIEN_PHAT" placeholder="Tổng nợ">
                                </div>
                            </div>

                        </div>
                        <div class="submit mt-4">
                            <button class="btn-submit">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
   
    <script src="{{ asset('js/borrow.js') }}"></script>
@endsection
