<?php
    
// !!! THAY 'users' BẰNG TÊN BẢNG BẠN MUỐN THỬ !!!
$ten_bang_cua_ban = 'cartitems';
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
try {
    // Sử dụng Query Builder của Laravel để truy vấn
    $data = \DB::table($ten_bang_cua_ban)->get();
    if ($data->isEmpty()) {
}
} catch (\Exception $e) {
    // Bắt lỗi nếu tên bảng sai hoặc không có quyền truy cập
    echo "<b style='color:red;'>LỖI KHI TRUY VẤN BẢNG:</b> " . $e->getMessage();
}
?>

@extends('layouts.app')
@section('content')

<section class="cart-page container">
    <h1 class="page-title">Giỏ Hàng Của Bạn</h1>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Mã sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Tổng cộng</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @php $tong = 0; @endphp
            @foreach($data->toArray() as $item)
            <tr>
                <td><img src="{{ asset('images/' . $item->product_id . '.jpg') }}" alt="Ảnh sản phẩm"></td>
                <td> <a href="{{ route('detail',['id'=>$item->product_id]) }}">{{ $item->name_product }}</a></td>
                <td>{{ $item->product_id }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->price,0,',','.') }}₫</td>
                <td>
                    @php
                        $subtotal = $item->quantity * $item->price;
                        $tong += $subtotal;
                    @endphp
                    {{ number_format($subtotal,0,',','.') }}₫
                </td>
                <td>
                    <form action="{{ route('removeitem', ['id' => $item->id]) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?');">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            Xóa
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="total-price">
        Tổng tiền: {{ number_format($tong,0,',','.') }}₫
        <button class="btn-primary"><a href="{{ route('formthanhtoan') }}"> Thanh toán  </a>  </button>
    </div>

</section>

@endsection
