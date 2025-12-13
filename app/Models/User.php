<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // 1. KHAI BÁO TÊN BẢNG (Bắt buộc)
    protected $table = 'users';

    // 2. KHAI BÁO KHÓA CHÍNH (Bắt buộc)
    // Tên cột khóa chính thực tế là 'user_id'
    protected $primaryKey = 'user_id';
     public function isadmin()
    {
        return $this->role === 'admin';
    }
    public function isuser()
    {
        return $this->role === 'user';
    }
    /**
     * Các thuộc tính có thể gán giá trị hàng loạt (fillable)
     * Đảm bảo bao gồm tất cả các cột bạn muốn thêm vào (ví dụ: đăng ký)
     */
    protected $fillable = [
        'username',
        'password',
        'email',
        'fullname',
        'phone_number',
        'address',
        'role',
        'created_at',
        'updated_at',
    ];

    /**
     * Các thuộc tính nên ẩn đi khi chuyển đổi Model thành mảng/JSON
     */
    protected $hidden = [
        'password',
        // 'remember_token', // Có thể bỏ qua nếu bạn không dùng remember me
    ];

    /**
     * Ánh xạ các thuộc tính sang kiểu dữ liệu cụ thể
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Laravel 9+ dùng 'hashed' để tự động hash khi gán
    ];
}