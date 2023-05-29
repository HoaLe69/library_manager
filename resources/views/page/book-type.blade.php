@extends('layout.main')
<link rel="stylesheet" href="{{ asset('css/page/book_type.css') }}">
@section('content')
    <div class="wrapper-category">
        <div class="category-search">
            <div class="titles">Danh sách thể loại</div>
            <div class="input-group">
                <input type="text" placeholder="nhập loại sách" class="search-input">
            </div>
        </div>
    </div>
    <div class="category-search body">
        <div class="row">
            <div class="col">
                <table class="table">
                    <thead>
                        <th>Mã Thẻ loại</th>
                        <th>Tên Thể loại</th>
                        <th>Lượt mượt</th>
                        <th>Xóa</th>
                    </thead>
                    <tbody class="body-book-type">
                        @foreach ($bookType as $item)
                            <tr>
                                <td>{{ $item->MA_TL }}</td>
                                <td>{{ $item->TEN_TL }}</td>
                                <td>{{ $item->LUOT_MUOT }}</td>
                                <td><button type="button" class="btn-delete">Xóa</button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col">
                <div class="container-form">
                    <form action="/add/book-type" method="POST" class="form">
                        <div class="form-group">
                            <label for="">Mã loại sách : </label>
                            <input type="text" class="input-text-type" name="MA_TL" placeholder="Nhập mã thể loại">
                        </div>
                        <input type="text" class="input-text-type" name="code" placeholder="Nhập mã thể loại" hidden>
                        <div class="form-group mt-4">
                            <label for="">Tên Loại sách : </label>
                            <input type="text" class="input-text-type" name="TEN_TL" placeholder="Nhập tên thể loại">
                        </div>
                        <button class="btn-submit btn-add mt-4">Thêm</button>
                        <button class="btn-submit btn-update mt-4" hidden>Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/book-type.js') }}"></script>
@endsection
