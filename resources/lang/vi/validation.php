<?php

return [

    'accepted' => ':attribute phải được chấp nhận.',
    'active_url' => ':attribute không phải là URL hợp lệ.',
    'after' => ':attribute phải là một ngày sau :date.',
    'after_or_equal' => ':attribute phải là thời gian sau hoặc đúng bằng :date.',
    'alpha' => ':attribute chỉ có thể chứa các chữ cái.',
    'alpha_dash' => ':attribute chỉ có thể chứa chữ cái, số, gạch ngang và gạch dưới.',
    'alpha_num' => ':attribute chỉ có thể chứa chữ cái và số.',
    'array' => ':attribute phải là một mảng.',
    'before' => ':attribute phải là một ngày trước :date.',
    'before_or_equal' => ':attribute phải là thời gian trước hoặc đúng bằng :date.',

    'between' => [
        'numeric' => ':attribute phải nằm giữa :min và :max.',
        'file' => ':attribute phải từ :min đến :max kilobytes.',
        'string' => ':attribute phải từ :min đến :max ký tự.',
        'array' => ':attribute phải có từ :min đến :max phần tử.',
    ],

        'boolean' => ':attribute chỉ được phép là true hoặc false.',
        'confirmed' => 'Xác nhận :attribute không khớp.',
        'date' => ':attribute không phải là ngày hợp lệ.',
        'email' => ':attribute phải là email hợp lệ.',
        'exists' => ':attribute không hợp lệ.',
        'file' => ':attribute phải là một tệp.',
        'filled' => ':attribute là bắt buộc.',
        
    'min' => [
        'numeric' => ':attribute phải lớn hơn hoặc bằng :min.',
        'file' => ':attribute phải có ít nhất :min kilobytes.',
        'string' => ':attribute phải có ít nhất :min ký tự.',
        'array' => ':attribute phải có ít nhất :min phần tử.',
    ],

    'max' => [
        'numeric' => ':attribute không được lớn hơn :max.',
        'file' => ':attribute không được lớn hơn :max kilobytes.',
        'string' => ':attribute không được lớn hơn :max ký tự.',
        'array' => ':attribute không được có quá :max phần tử.',
    ],

    'required' => ':attribute là bắt buộc.',
    'string' => ':attribute phải là chuỗi ký tự.',
    'unique' => ':attribute đã được sử dụng.',
    'same' => ':attribute và :other phải giống nhau.',
    'size' => [
        'numeric' => ':attribute phải bằng :size.',
        'file' => ':attribute phải có dung lượng :size kilobytes.',
        'string' => ':attribute phải có :size ký tự.',
        'array' => ':attribute phải chứa :size phần tử.',
    ],

    'attributes' => [
        'username' => 'Tên đăng nhập',
        'password' => 'Mật khẩu',
        'password_confirmation' => 'Xác nhận mật khẩu',
        'email' => 'Email',
        'fullname' => 'Họ và tên',
        'phone_number' => 'Số điện thoại',
        'address' => 'Địa chỉ',
        'name' => 'Tên hoa',
        'description' => 'Mô tả',
        'price' => 'Giá',
        'stock_quantity' => 'Tồn kho',
        'category_id' => 'Danh mục',
        'main_image' => 'Ảnh chính',
        'decimal' => ':decimal chữ số thập phân.',
    ],
    

];
