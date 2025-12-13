<?php

if (!function_exists('removeAccents')) {
    function removeAccents($str)
    {
        $unicode = [
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'd' => 'đ'
        ];

        foreach ($unicode as $nonUnicode => $uni) {
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }

        return $str;
    }
}

if (!function_exists('getStandardName')) {

    function getStandardName($name)
    {
        // Chuẩn hóa tên
        $name = strtolower(trim(removeAccents($name)));

        // Từ điển đồng nghĩa (trong config/synonyms.php)
        $synonyms = config('synonyms');

        foreach ($synonyms as $standard => $list) {

            $std = strtolower(trim(removeAccents($standard)));

            // Nếu tên trùng với tên chuẩn hóa
            if ($name === $std) {
                return $std;
            }

            // Nếu tên trùng 1 từ đồng nghĩa
            foreach ($list as $word) {
                if ($name === strtolower(trim(removeAccents($word)))) {
                    return $std;
                }
            }
        }

        return $name;
    }
}
