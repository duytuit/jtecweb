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
    /**
     * Mix the answer in array
     * Create By Duytuit
     */
    public static function mixAnswerInArray($value)
    {
        $fruits = ArrayHelper::arrayExamPd();
        $array_answer = array_column($fruits, 'answer');
        $arrayFiltered = array_filter($array_answer, fn($element) => $element != $value);
        $firstThreeElements = array_slice($arrayFiltered, 0, 3);
        array_push($firstThreeElements, $value);
        shuffle($firstThreeElements);
        return $firstThreeElements;
    }

    public static function arrayExamPd()
    {
        return [
            [
                'id' => 1,
                'name' => 'Màu Đỏ',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\do.png',
                'answer' => 'R'
            ],
            [
                'id' => 2,
                'name' => 'Màu Đen',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\den.png',
                'answer' => 'B'
            ],
            [
                'id' => 3,
                'name' => 'Màu Xanh',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh.png',
                'answer' => 'L'
            ],
            [
                'id' => 4,
                'name' => 'Màu Nâu',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\nau.png',
                'answer' => 'Br'
            ],
            [
                'id' => 5,
                'name' => 'Màu vàng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\vang.png',
                'answer' => 'Y'
            ],
            [
                'id' => 6,
                'name' => 'Màu xanh lá cây',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacay.png',
                'answer' => 'G'
            ],
            [
                'id' => 7,
                'name' => 'Màu xanh lộc non',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon.png',
                'answer' => 'Lg'
            ],
            [
                'id' => 8,
                'name' => 'Màu cam',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\cam.png',
                'answer' => 'O'
            ],
            [
                'id' => 9,
                'name' => 'Màu xám',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xam.png',
                'answer' => 'Gr'
            ],
            [
                'id' => 10,
                'name' => 'Màu Hồng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\hong.png',
                'answer' => 'P'
            ],
            [
                'id' => 11,
                'name' => 'Màu xanh da trời',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhdatroi.png',
                'answer' => 'Sb'
            ],
            [
                'id' => 12,
                'name' => 'Màu Trắng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\trang.png',
                'answer' => 'W'
            ],
            [
                'id' => 13,
                'name' => 'Màu tím',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\tim.png',
                'answer' => 'V'
            ],
            [
                'id' => 14,
                'name' => 'Đỏ - Trắng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\dotrang.png',
                'answer' => 'RW'
            ],
            [
                'id' => 15,
                'name' => 'Đỏ - Đen',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\doden.png',
                'answer' => 'RB'
            ],
            [
                'id' => 16,
                'name' => 'Đỏ - Vàng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\dovang.png',
                'answer' => 'RY'
            ],
            [
                'id' => 17,
                'name' => 'Đỏ - Xanh lá cây',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\doxanhlacay.png',
                'answer' => 'RG'
            ],
            [
                'id' => 18,
                'name' => 'Đỏ - Xanh',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\doxanh.png',
                'answer' => 'RL'
            ],
            [
                'id' => 19,
                'name' => 'Vàng - Đỏ',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\vangdo.png',
                'answer' => 'YR'
            ],
            [
                'id' => 20,
                'name' => 'Vàng - Đen',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\vangden.png',
                'answer' => 'YB'
            ],
            [
                'id' => 21,
                'name' => 'Vàng - Xanh lá cây',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\vangxanhlacay.png',
                'answer' => 'YG'
            ],
            [
                'id' => 22,
                'name' => 'Vàng - Xanh',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\vangxanh.png',
                'answer' => 'YL'
            ],
            [
                'id' => 23,
                'name' => 'Vàng - Trắng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\vangtrang.png',
                'answer' => 'YW'
            ],
            [
                'id' => 24,
                'name' => 'Xanh lá cây- Trắng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacaytrang.png',
                'answer' => 'GW'
            ],
            [
                'id' => 25,
                'name' => 'Xanh lá cây- Đỏ',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacaydo.png',
                'answer' => 'GR'
            ],
            [
                'id' => 26,
                'name' => 'Xanh lá cây- Vàng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacayvang.png',
                'answer' => 'GY'
            ],
            [
                'id' => 27,
                'name' => 'Xanh lá cây- Đen',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacayden.png',
                'answer' => 'GB'
            ],
            [
                'id' => 28,
                'name' => 'Xanh lá cây- Xanh',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacayxanh.png',
                'answer' => 'GL'
            ],
            [
                'id' => 29,
                'name' => 'Xanh-Trắng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-trang.png',
                'answer' => 'LW'
            ],
            [
                'id' => 30,
                'name' => 'Xanh-Đỏ',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-do.png',
                'answer' => 'LR'
            ],
            [
                'id' => 31,
                'name' => 'Xanh-Vàng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-vang.png',
                'answer' => 'LY'
            ],
            [
                'id' => 32,
                'name' => 'Xanh-Đen',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-den.png',
                'answer' => 'LB'
            ],
            [
                'id' => 33,
                'name' => 'Xanh-Xanh lá cây',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-xanhlacay.png',
                'answer' => 'LG'
            ],
            [
                'id' => 34,
                'name' => 'Nâu-Trắng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\nau-trang.png',
                'answer' => 'BrW'
            ],
            [
                'id' => 35,
                'name' => 'Nâu-Đỏ',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\nau-do.png',
                'answer' => 'BrR'
            ],
            [
                'id' => 36,
                'name' => 'Nâu-Vàng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\nau-vang.png',
                'answer' => 'BrY'
            ],
            [
                'id' => 37,
                'name' => 'Nâu-Đen',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\nau-den.png',
                'answer' => 'BrB'
            ],
            [
                'id' => 38,
                'name' => 'Xanh lọc non-Đỏ',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-do.png',
                'answer' => 'LgR'
            ],
            [
                'id' => 39,
                'name' => 'Xanh lọc non-Vàng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-vang.png',
                'answer' => 'LgY'
            ],
            [
                'id' => 40,
                'name' => 'Xanh lọc non-Đen',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-den.png',
                'answer' => 'LgB'
            ],
            [
                'id' => 41,
                'name' => 'Xanh lọc non-Trắng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-trang.png',
                'answer' => 'LgW'
            ],
            [
                'id' => 42,
                'name' => 'Đen-Trắng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\den-trang.png',
                'answer' => 'BW'
            ],
            [
                'id' => 43,
                'name' => 'Đen-Đỏ',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\den-do.png',
                'answer' => 'BR'
            ],
            [
                'id' => 44,
                'name' => 'Đen-Vàng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\den-vang.png',
                'answer' => 'BY'
            ],
            [
                'id' => 45,
                'name' => 'Đen-Xanh',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\den-xanh.png',
                'answer' => 'BL'
            ],
            [
                'id' => 46,
                'name' => 'Đen-Xanh lá cây',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\den-xanhlacay.png',
                'answer' => 'BG'
            ],
            [
                'id' => 47,
                'name' => 'Trắng - Đỏ',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-do.png',
                'answer' => 'WR'
            ],
            [
                'id' => 48,
                'name' => 'Trắng - Xanh',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-xanh.png',
                'answer' => 'WL'
            ],
            [
                'id' => 49,
                'name' => 'Trắng - Vàng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-vang.png',
                'answer' => 'WY'
            ],
            [
                'id' => 50,
                'name' => 'Trắng - Tím',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-tim.png',
                'answer' => 'WV'
            ],
            [
                'id' => 51,
                'name' => 'Trắng-Xanh lá cây',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-xanhlacay.png',
                'answer' => 'WG'
            ],
            [
                'id' => 52,
                'name' => 'Cam - Trắng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\cam-trang.png',
                'answer' => 'OW'
            ],
            [
                'id' => 53,
                'name' => 'Hồng - Đen',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\hong-den.png',
                'answer' => 'PB'
            ],
            [
                'id' => 54,
                'name' => 'Xám - Đỏ',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xam-do.png',
                'answer' => 'GrR'
            ],
            [
                'id' => 55,
                'name' => 'Xám - Đen',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xam-den.png',
                'answer' => 'GrB'
            ],

        ];
    }
}
