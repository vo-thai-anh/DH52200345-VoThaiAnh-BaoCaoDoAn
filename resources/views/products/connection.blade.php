@extends('layouts.app')
@section('content')

<h1>Kiểm tra kết nối & Truy vấn DB</h1>
<hr>

<?php
// --- BƯỚC 1: KIỂM TRA KẾT NỐI ---
echo "<h2>Trạng thái kết nối:</h2>";
try {
    \DB::connection()->getPdo();
    echo "<b style='color:green;'>Kết nối thành công!</b>";
} catch (\Exception $e) {
    echo "<b style='color:red;'>Kết nối thất bại.</b>";
    echo "<br><b>Lỗi:</b> " . $e->getMessage();
    // Dừng trang lại ngay nếu không kết nối được
    die();
}
echo "<hr>"; // Thêm đường kẻ ngang

// --- BƯỚC 2: THỬ TRUY VẤN DỮ LIỆU ---
    
// !!! THAY 'users' BẰNG TÊN BẢNG BẠN MUỐN THỬ !!!
$ten_bang_cua_ban = 'product'; 
// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

echo "<h2>Thử truy vấn 5 dòng đầu từ bảng '{$ten_bang_cua_ban}':</h2>";

try {
    // Sử dụng Query Builder của Laravel để truy vấn
    $data = \DB::table($ten_bang_cua_ban)->get();
    if ($data->isEmpty()) {
        echo "Truy vấn thành công, nhưng bảng '{$ten_bang_cua_ban}' hiện không có dữ liệu.";
    } else {
        echo "<b>Lấy dữ liệu thành công! Đây là 5 dòng (hoặc ít hơn) đầu tiên:</b>";
        
        // Dùng <pre> để hiển thị dữ liệu (array/object) cho dễ đọc
        echo "<pre>";
        print_r($data->toArray()); 
        echo "</pre>";
    }

} catch (\Exception $e) {
    // Bắt lỗi nếu tên bảng sai hoặc không có quyền truy cập
    echo "<b style='color:red;'>LỖI KHI TRUY VẤN BẢNG:</b> " . $e->getMessage();
}
?>

@endsection
