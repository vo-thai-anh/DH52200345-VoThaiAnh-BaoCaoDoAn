
<?php
    
// !!! THAY 'users' BẰNG TÊN BẢNG BẠN MUỐN THỬ !!!
$ten_bang_cua_ban = 'products';
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
{{-- @if (Auth::check())
    <!-- Hiển thị phần đề xuất cá nhân hóa -->
    <h2>Đề xuất dành cho bạn, {{ Auth::user()->fullname }}</h2>
    <!-- Logic hiển thị sản phẩm -->
@else
    <!-- Hiển thị nội dung chung cho khách -->
    <h2>Sản phẩm nổi bật</h2>
    <!-- Logic hiển thị sản phẩm -->
@endif --}}
<section class="hero-section container" >
    <div class="hero-content">
        <h1 class="hero-title">
            Send <strong>flowers</strong> like you mean it.
        </h1>
        <p class="hero-text">
            Where flowers are our inspiration to create lasting memories.
            Whatever the occasion, our flowers will make it special cursus a sit amet mauris.
        </p>
        <div class="hero-signature1">
            Sara
        </div>
    </div>
    <div class="hero-image">
        <img src="{{ asset('./images/Cuc.jpg') }}" alt="CucDai">
    </div>
    </section>

        <section class="product-grid container">
                @foreach($data->toArray() as $item )
                <a href="{{ route('detail',$item->product_id) }}" class="product-link" >
                <div class='product-item'>
                <div class='product-image-wrapper lily'>
                <img src='./images/{{$item->product_id}}.jpg'>
                </div>
                <h3 class='product-title'>{{ $item->name }}  </h3>
                <p  class='product-price'>{{ number_format($item->price , 0, ',', '.') }}  VND </p>
                </div>
                </a>
                @endforeach

        </section>
</main>
@endsection

