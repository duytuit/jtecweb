<?php

namespace App\Helpers;

class ArrayHelper
{
    public static function objArraySearch($array, $key, $value)
    {
        foreach($array as $arraySingle) {
            if($arraySingle->$key == $value) {
                return $arraySingle;
            }
        }
        return null;
    }
    public static function arrayExamPd()
    {
        return [
            [
                'name' => 'Màu Đỏ',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\do.png',
                'answer' => 'R'
            ],
            [
                'name' => 'Màu Đen',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\den.png',
                'answer' => 'B'
            ],
            [
                'name' => 'Màu Xanh',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh.png',
                'answer' => 'L'
            ],
            [
                'name' => 'Màu Nâu',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\nau.png',
                'answer' => 'Br'
            ],
            [
                'name' => 'Màu vàng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\vang.png',
                'answer' => 'Y'
            ],
            [
                'name' => 'Màu xanh lá cây',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacay.png',
                'answer' => 'G'
            ],
            [
                'name' => 'Màu xanh lộc non',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon.png',
                'answer' => 'Lg'
            ],
            [
                'name' => 'Màu cam',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\cam.png',
                'answer' => 'O'
            ],
            [
                'name' => 'Màu xám',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xam.png',
                'answer' => 'Gr'
            ],
            [
                'name' => 'Màu Hồng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\hong.png',
                'answer' => 'P'
            ],
            [
                'name' => 'Màu xanh da trời',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhdatroi.png',
                'answer' => 'Sb'
            ],
            [
                'name' => 'Màu Trắng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\trang.png',
                'answer' => 'W'
            ],
            [
                'name' => 'Màu tím',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\tim.png',
                'answer' => 'V'
            ],
            [
                'name' => 'Đỏ - Trắng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\dotrang.png',
                'answer' => 'RW'
            ],
            [
                'name' => 'Đỏ - Đen',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\doden.png',
                'answer' => 'RB'
            ],
            [
                'name' => 'Đỏ - Vàng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\dovang.png',
                'answer' => 'RY'
            ],
            [
                'name' => 'Đỏ - Xanh lá cây',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\doxanhlacay.png',
                'answer' => 'RG'
            ],
            [
                'name' => 'Đỏ - Xanh',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\doxanh.png',
                'answer' => 'RL'
            ],
            [
                'name' => 'Vàng - Đỏ',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\vangdo.png',
                'answer' => 'YR'
            ],
            [
                'name' => 'Vàng - Đen',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\vangden.png',
                'answer' => 'YB'
            ],
            [
                'name' => 'Vàng - Xanh lá cây',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\vangxanhlacay.png',
                'answer' => 'YG'
            ],
            [
                'name' => 'Vàng - Xanh',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\vangxanh.png',
                'answer' => 'YL'
            ],
            [
                'name' => 'Vàng - Trắng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\vangtrang.png',
                'answer' => 'YW'
            ],
            [
                'name' => 'Xanh lá cây- Trắng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacaytrang.png',
                'answer' => 'GW'
            ],
            [
                'name' => 'Xanh lá cây- Đỏ',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacaydo.png',
                'answer' => 'GR'
            ],
            [
                'name' => 'Xanh lá cây- Vàng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacayvang.png',
                'answer' => 'GY'
            ],
            [
                'name' => 'Xanh lá cây- Đen',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacayden.png',
                'answer' => 'GB'
            ],
            [
                'name' => 'Xanh lá cây- Xanh',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacayxanh.png',
                'answer' => 'GL'
            ],
            [
                'name' => 'Xanh-Trắng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-trang.png',
                'answer' => 'LW'
            ],
            [
                'name' => 'Xanh-Đỏ',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-do.png',
                'answer' => 'LR'
            ],
            [
                'name' => 'Xanh-Vàng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-vang.png',
                'answer' => 'LY'
            ],
            [
                'name' => 'Xanh-Đen',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-den.png',
                'answer' => 'LB'
            ],
            [
                'name' => 'Xanh-Xanh lá cây',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-xanhlacay.png',
                'answer' => 'LG'
            ],
            [
                'name' => 'Nâu-Trắng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\nau-trang.png',
                'answer' => 'BrW'
            ],
            [
                'name' => 'Nâu-Đỏ',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\nau-do.png',
                'answer' => 'BrR'
            ],
            [
                'name' => 'Nâu-Vàng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\nau-vang.png',
                'answer' => 'BrY'
            ],
            [
                'name' => 'Nâu-Đen',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\nau-den.png',
                'answer' => 'BrB'
            ],
            [
                'name' => 'Xanh lọc non-Đỏ',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-do.png',
                'answer' => 'LgR'
            ],
            [
                'name' => 'Xanh lọc non-Vàng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-vang.png',
                'answer' => 'LgY'
            ],
            [
                'name' => 'Xanh lọc non-Đen',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-den.png',
                'answer' => 'LgB'
            ],
            [
                'name' => 'Xanh lọc non-Trắng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-trang.png',
                'answer' => 'LgW'
            ],
            [
                'name' => 'Đen-Trắng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\den-trang.png',
                'answer' => 'BW'
            ],
            [
                'name' => 'Đen-Đỏ',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\den-do.png',
                'answer' => 'BR'
            ],
            [
                'name' => 'Đen-Vàng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\den-vang.png',
                'answer' => 'BY'
            ],
            [
                'name' => 'Đen-Xanh',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\den-xanh.png',
                'answer' => 'BL'
            ],
            [
                'name' => 'Đen-Xanh lá cây',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\den-xanhlacay.png',
                'answer' => 'BG'
            ],
            [
                'name' => 'Trắng - Đỏ',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-do.png',
                'answer' => 'WR'
            ],
            [
                'name' => 'Trắng - Xanh',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-xanh.png',
                'answer' => 'WL'
            ],
            [
                'name' => 'Trắng - Vàng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-vang.png',
                'answer' => 'WY'
            ],
            [
                'name' => 'Trắng - Tím',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-tim.png',
                'answer' => 'WV'
            ],
            [
                'name' => 'Trắng-Xanh lá cây',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-xanhlacay.png',
                'answer' => 'WG'
            ],
            [
                'name' => 'Cam - Trắng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\cam-trang.png',
                'answer' => 'OW'
            ],
            [
                'name' => 'Hồng - Đen',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\hong-den.png',
                'answer' => 'PB'
            ],
            [
                'name' => 'Xám - Đỏ',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xam-do.png',
                'answer' => 'GrR'
            ],
            [
                'name' => 'Xám - Đen',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xam-den.png',
                'answer' => 'GrB'
            ],

        ];
    }
}
