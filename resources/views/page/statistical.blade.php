@extends('layout.main')
<link rel="stylesheet" href="{{ asset('css/page/staff-manager.css') }}">
<link rel="stylesheet" href="{{ asset('css/page/user-manager.css') }}">
<link rel="stylesheet" href="{{ asset('css/page/borrow-book.css') }}">
@section('content')
    <div class="wrapper-category">
        <div class="category-search">
            <div class="titles">Thống kê</div>
            <div class="input-group">
            </div>
        </div>

    </div>
    <div class="category-search body">
        <div class="row">
            <div class="col">
                <label for="">Ngày</label>
                <input type="text" placeholder="nhập ngày" id=""  class="search-input-sta">
                <table class="table">
                    <thead>
                        <th>STT</th>
                        <th>Tên Thể loại</th>
                        <th>Lượt mượn</th>
                        <th>tỉ lệ</th>
                    </thead>
                    <tbody>
                        @foreach ($getAll as $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $item->TEN_TL }}</td>
                                <td>{{ $item->LUOT_MUOT }}</td>
                                <td>{{ $item->LUOT_MUOT / $totalPay }}%</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col">
                <label for="">Ngày</label>
                <input type="text" placeholder="nhập ngày" id=""  class="search-input-sta">
                <table class="table">
                    <thead >
                        <th>STT</th>
                        <th>Tên Sách</th>
                        <th>Ngày mượn</th>
                        <th>Số ngày trả trễ</th>
                    </thead>
                    <tbody class="day-late">
                    </tbody>
                </table>
            </div>
            <div class="col">
                <label for="" style="color: var(--text-color)">Ngày</label>
                <input type="text" placeholder="nhập ngày" id="" class="search-input-sta">
                <table class="table">
                    <thead>
                        <th>STT</th>
                        <th>Tên độc giả</th>
                        <th>Số tiền nợ</th>
                    </thead>
                    <tbody class="money-lend">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/statistical.js') }}"></script>
@endsection
