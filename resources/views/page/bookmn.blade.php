@extends('layout.main')
<link rel="stylesheet" href="{{ asset('css/page/book_manager.css') }}">
@section('content')
    <div class="wrapper-category">
        <div class="category-search">
            <div class="titles">Danh mục sách</div>
            <div class="input-group">
                <input type="text" placeholder="nhập tên sách" class="search-input">
                <input type="text" placeholder="nhập tác giả" class="search-input">
                <div class="another-show">
                    <i class='bx bxs-grid'></i>
                </div>
            </div>
            <button class="btn-action add-book">Thêm Sách</button>
        </div>
    </div>
    <div class="category-search body">
        <table class="table list-book">
            <thead>
                <tr>
                    <th>Mã Sách</th>
                    <th>Tiêu đề</th>
                    <th>Tình trạng sách</th>
                    <th>Tác Giả</th>
                    <th>Thể Loại</th>
                    <th>Nhà Xuất Bản</th>
                    <th>Năm XB</th>
                    <th>Ngày nhập kho</th>
                    <th>Giá</th>
                    <th>Tác vụ</th>
                </tr>
            </thead>
            <tbody class="list-books">
                @foreach ($listBook as $item)
                    <tr>
                        <td>{{ $item->MA_SACH }}</td>
                        <td>{{ $item->TEN_SACH }}</td>
                        <td>{{ $item->TINH_TRANG }}</td>
                        <td>{{ $item->TAC_GIA }}</td>
                        <td>{{ $item->TEN_TL }}</td>
                        <td>{{ $item->NHA_XUAT_BAN }}</td>
                        <td>{{ $item->NXB }}</td>
                        <td>{{ $item->NGAY_NHAP }}</td>
                        <td>{{ $item->TRI_GIA }} VNĐ</td>
                        <td hidden>{{ $item->MA_NV }}</td>
                        <td hidden>{{ asset('storage/' . $item->THUMBNAIL) }}</td>
                        <td hidden>{{ $item->MA_TL }}</td>
                        <td>
                            <button class="btn-delete btn-thanh-ly">Xóa</button>
                            @if ($item->TINH_TRANG === 'Đang cho mượn')
                                <button disabled='true' class="btn-delete btn-borrow" class="btn btn-primary"
                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop">Mượn</button>
                            @else
                                <button  class="btn-delete btn-borrow" class="btn btn-primary"
                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop">Mượn</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div hidden class="gallery mt-4 ">
            <div class="row gy-4">
                @foreach ($listBook as $item)
                    <div class=".col-xxl-2 col-xl-2 col-sm-6">
                        <div class="container-card" data-index="{{ $loop->index }}">
                            <div class="thumnail">
                                <img src="{{ asset('storage/' . $item->THUMBNAIL) }}" alt="{{ $item->TEN_SACH }}"
                                    class="image">
                            </div>
                            <div class="infor-book">
                                <div class="title">
                                    <h2 class="name">{{ $item->TEN_SACH }}</h2>
                                </div>
                                <p class="author ">Tác Giả : {{ $item->TAC_GIA }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="modal-container">
        <div class="modal-wrapper">
            <form method="POST" action="/book/add" class="form-modal" enctype="multipart/form-data">
                <div class="form-group-file">
                    <div class="thum">
                        <img src="{{ asset('img/books.png') }}" alt="" class="thum-img">
                    </div>
                    <input type="file" class="input-file" name="THUMBNAIL" accept="image/*">
                    <div class="text-center">
                        <button class="btn-submit btn-add" type="submit">Thêm</button>
                        <button class="btn-submit btn-update" type="submit" hidden>Cập nhật</button>
                    </div>
                </div>
                <div class="form-group-text">
                    <div class="form-group ">
                        <label for="">Tên Sách</label>
                        <input type="text" class="input-text w-100" placeholder="Nhập tên sách" name="TEN_SACH">
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <div class="form-group ">
                                <label for="">Tác Giả</label>
                                <input type="text" class="input-text" name="TAC_GIA" placeholder="Nhập tên tác giả">
                            </div>
                            <div class="form-group p-relative">
                                <label for="">Tên loại sách</label>
                                <input type="text" class="input-text" name="MA_TL" placeholder="Nhập tên loại sách"
                                    autocomplete='off'>
                                <div class="submenu">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Tình trạng sách</label>
                                <input type="text" class="input-text" name="TINH_TRANG"
                                    placeholder="Nhập tình trạng sách">
                            </div>
                            <div class="form-group">
                                <label for="">Trị giá</label>
                                <input type="text" class="input-text" name="TRI_GIA" placeholder="Nhập giá sách">
                            </div>

                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Nhà Xuất bản</label>
                                <input type="text" class="input-text" name="NHA_XUAT_BAN" placeholder="Nhập NXB">
                            </div>
                            <div class="form-group">
                                <label for="">Năm Xuất bản</label>
                                <input type="text" class="input-text" name="NXB" placeholder="Nhập năm XB">
                            </div>
                            <div class="form-group">
                                <label for="">Ngày nhập kho</label>
                                <input type="date" class="input-text w-100" name="NGAY_NHAP">
                            </div>
                            <div class="form-group">
                                <label for="">Người tiếp nhận</label>
                                <input type="text" class="input-text w-100" name="MA_NV"
                                    placeholder="Người tiếp nhận">

                            </div>

                        </div>
                    </div>

                </div>
            </form>

        </div>
        <div class="close">
            <i class='bx bx-x'></i>
        </div>
    </div>
    <div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">
                        <h3>Phiếu cho mượn</h3>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/add/borrow/book" method="POST" class="form-modal">
                        <div class="row">
                            <div class="col-3">
                                <div class="thumnails">
                                    <img src="{{ asset('img/books.png') }}" alt="">
                                </div>
                                <div class="submit">
                                    <button class="btn-add">Thêm</button>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="MADG">Mã Độc Giả</label>
                                            <input type="text" name="MA_DG" placeholder="Nhập mã độc giả..."
                                                id="MADG">
                                        </div>
                                        <input type="text" hidden name="MA_TL" placeholder="Nhập mã độc giả...">
                                        <div class="form-group">
                                            <label for="MA_SACH">Mã sách</label>
                                            <input type="text" name="MA_SACH" placeholder="Nhập mã sách ..."
                                                id="MA_SACH">
                                        </div>
                                        <div class="form-group">
                                            <label for="NGAY_MUON">Ngày mượn</label>
                                            <input type="text" name="NGAY_MUON" value=""
                                                placeholder="Nhập mã sách ..." id="NGAY_MUON">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Tên Độc giả</label>
                                            <input type="text" name="TEN_DG" placeholder="Nhập tên độc giả..."
                                                id="MADG">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tên sách</label>
                                            <input type="text" name="TEN_SACH" placeholder="Nhập tên sách..."
                                                id="MADG">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Ngày trả</label>
                                            <input type="date" name="NGAY_TRA" style="padding: 5px 32px"
                                                placeholder="Nhập tên độc giả..." id="MADG">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script src="{{ asset('js/book.js') }}"></script>
@endsection
