<?php

namespace App\Helpers;

use Carbon\Carbon;

class ArrayHelper
{
    public static function objArraySearch($array, $key, $value)
    {
        foreach ($array as $arraySingle) {
            if ($arraySingle->$key == $value) {
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
        $arrayFiltered = array_filter($array_answer, fn ($element) => $element != $value);
        $firstThreeElements = array_slice($arrayFiltered, 0, 3);
        array_push($firstThreeElements, $value);
        shuffle($firstThreeElements);
        return $firstThreeElements;
    }

    public static function cycleName()
    {
        $getYear = Carbon::now()->year;
        $cycle_name = [];
        for ($i = 0; $i <= 1; $i++) {
            for ($j = 1; $j <= 12; $j++) {
                $cycle_name[] = $j . ($getYear - $i);
            }
        }
        return $cycle_name;
    }
    public static function conversionDate()
    {
        return [
            1 => [1, 15],
            2 => [16, 100],
        ];
    }
    public static function getRangeDateExaminations()
    {
        return [
            1 => 15,
        ];
    }
    public static function arrayExamPd()
    {
        return [
            [
                'id' => 1,
                'name' => 'Màu Đỏ',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\do.png',
                'answer' => 'R',
                'answer_list' => ['O', 'P', 'R', 'Y'],
                'show_question' => 1,
            ],
            [
                'id' => 2,
                'name' => 'Màu Đen',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\den.png',
                'answer' => 'B',
                'answer_list' => ['B', 'Br', 'R', 'Gr'],
                'show_question' => 0,
            ],
            [
                'id' => 3,
                'name' => 'Màu Xanh',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh.png',
                'answer' => 'L',
                'answer_list' => ['L', 'Lg', 'G', 'Sb'],
                'show_question' => 1,

            ],
            [
                'id' => 4,
                'name' => 'Màu Nâu',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\nau.png',
                'answer' => 'Br',
                'answer_list' => ['Br', 'B', 'Gr', 'O'],
                'show_question' => 1,

            ],
            [
                'id' => 5,
                'name' => 'Màu vàng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\vang.png',
                'answer' => 'Y',
                'answer_list' => ['O', 'P', 'R', 'Y'],
                'show_question' => 0,

            ],
            [
                'id' => 6,
                'name' => 'Màu xanh lá cây',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacay.png',
                'answer' => 'G',
                'answer_list' => ['G', 'L', 'Lg', 'Sb'],
                'show_question' => 0,

            ],
            [
                'id' => 7,
                'name' => 'Màu xanh lộc non',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon.png',
                'answer' => 'Lg',
                'answer_list' => ['G', 'L', 'Lg', 'Sb'],
                'show_question' => 0,

            ],
            [
                'id' => 8,
                'name' => 'Màu cam',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\cam.png',
                'answer' => 'O',
                'answer_list' => ['O', 'B', 'Y', 'W'],
                'show_question' => 0,
            ],
            [
                'id' => 9,
                'name' => 'Màu xám',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xam.png',
                'answer' => 'Gr',
                'answer_list' => ['Br', 'Gr', 'R', 'B'],
                'show_question' => 1,
            ],
            [
                'id' => 10,
                'name' => 'Màu Hồng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\hong.png',
                'answer' => 'P',
                'answer_list' => ['O', 'P', 'R', 'Y'],
                'show_question' => 0,
            ],
            [
                'id' => 11,
                'name' => 'Màu xanh da trời',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhdatroi.png',
                'answer' => 'Sb',
                'answer_list' => ['G', 'L', 'Lg', 'Sb'],
                'show_question' => 1,

            ],
            [
                'id' => 12,
                'name' => 'Màu Trắng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\trang.png',
                'answer' => 'W',
                'answer_list' => ['Gr', 'B', 'O', 'W'],
                'show_question' => 0,

            ],
            [
                'id' => 13,
                'name' => 'Màu tím',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\tim.png',
                'answer' => 'V',
                'answer_list' => ['O', 'P', 'V', 'Y'],
                'show_question' => 1,

            ],
            [
                'id' => 14,
                'name' => 'Đỏ - Trắng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\dotrang.png',
                'answer' => 'RW',
                'answer_list' => ['RW', 'WR', 'WV', 'WG'],
                'show_question' => 1,

            ],
            [
                'id' => 15,
                'name' => 'Đỏ - Đen',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\doden.png',
                'answer' => 'RB',
                'answer_list' => ['RB', 'BR', 'RY', 'RG'],
                'show_question' => 0,
            ],
            [
                'id' => 16,
                'name' => 'Đỏ - Vàng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\dovang.png',
                'answer' => 'RY',
                'answer_list' => ['RB', 'YR', 'RY', 'RG'],
                'show_question' => 0,
            ],
            [
                'id' => 17,
                'name' => 'Đỏ - Xanh lá cây',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\doxanhlacay.png',
                'answer' => 'RG',
                'answer_list' => ['RB', 'RL', 'RY', 'RG'],
                'show_question' => 0,
            ],
            [
                'id' => 18,
                'name' => 'Đỏ - Xanh',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\doxanh.png',
                'answer' => 'RL',
                'answer_list' => ['RB', 'RL', 'RY', 'RG'],
                'show_question' => 0,
            ],
            [
                'id' => 19,
                'name' => 'Vàng - Đỏ',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\vangdo.png',
                'answer' => 'YR',
                'answer_list' => ['YR', 'YG', 'RY', 'YL'],
                'show_question' => 0,

            ],
            [
                'id' => 20,
                'name' => 'Vàng - Đen',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\vangden.png',
                'answer' => 'YB',
                'answer_list' => ['YR', 'YB', 'RY', 'BY'],
                'show_question' => 0,
            ],
            [
                'id' => 21,
                'name' => 'Vàng - Xanh lá cây',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\vangxanhlacay.png',
                'answer' => 'YG',
                'answer_list' => ['YR', 'YG', 'RY', 'BY'],
                'show_question' => 0,
            ],
            [
                'id' => 22,
                'name' => 'Vàng - Xanh',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\vangxanh.png',
                'answer' => 'YL',
                'answer_list' => ['YL', 'YB', 'YG', 'YW'],
                'show_question' => 0,
            ],
            [
                'id' => 23,
                'name' => 'Vàng - Trắng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\vangtrang.png',
                'answer' => 'YW',
                'answer_list' => ['YL', 'WY', 'YG', 'YW'],
                'show_question' => 0,
            ],
            [
                'id' => 24,
                'name' => 'Xanh lá cây- Trắng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacaytrang.png',
                'answer' => 'GW',
                'answer_list' => ['GW', 'WR', 'GB', 'WG'],
                'show_question' => 0,

            ],
            [
                'id' => 25,
                'name' => 'Xanh lá cây- Đỏ',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacaydo.png',
                'answer' => 'GR',
                'answer_list' => ['GR', 'RG', 'GB', 'GL'],
                'show_question' => 0,

            ],
            [
                'id' => 26,
                'name' => 'Xanh lá cây- Vàng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacayvang.png',
                'answer' => 'GY',
                'answer_list' => ['GY', 'GL', 'GB', 'GW'],
                'show_question' => 0,

            ],
            [
                'id' => 27,
                'name' => 'Xanh lá cây- Đen',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacayden.png',
                'answer' => 'GB',
                'answer_list' => ['GY', 'GL', 'GB', 'BG'],
                'show_question' => 0,
            ],
            [
                'id' => 28,
                'name' => 'Xanh lá cây- Xanh',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacayxanh.png',
                'answer' => 'GL',
                'answer_list' => ['LG', 'GL', 'GB', 'GW'],
                'show_question' => 0,
            ],
            [
                'id' => 29,
                'name' => 'Xanh-Trắng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-trang.png',
                'answer' => 'LW',
                'answer_list' => ['LW', 'WL', 'LgW', 'GW'],
                'show_question' => 0,

            ],
            [
                'id' => 30,
                'name' => 'Xanh-Đỏ',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-do.png',
                'answer' => 'LR',
                'answer_list' => ['LR', 'RL', 'LgR', 'GR'],
                'show_question' => 0,

            ],
            [
                'id' => 31,
                'name' => 'Xanh-Vàng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-vang.png',
                'answer' => 'LY',
                'answer_list' => ['LY', 'YL', 'GY', 'LB'],
                'show_question' => 0,

            ],
            [
                'id' => 32,
                'name' => 'Xanh-Đen',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-den.png',
                'answer' => 'LB',
                'answer_list' => ['LgB', 'BL', 'GB', 'LB'],
                'show_question' => 0,

            ],
            [
                'id' => 33,
                'name' => 'Xanh-Xanh lá cây',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-xanhlacay.png',
                'answer' => 'LG',
                'answer_list' => ['LG', 'GL', 'LY', 'LB'],
                'show_question' => 0,

            ],
            [
                'id' => 34,
                'name' => 'Nâu-Trắng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\nau-trang.png',
                'answer' => 'BrW',
                'answer_list' => ['BrW', 'GrW', 'BrR', 'BrY'],
                'show_question' => 0,
            ],
            [
                'id' => 35,
                'name' => 'Nâu-Đỏ',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\nau-do.png',
                'answer' => 'BrR',
                'answer_list' => ['BrW', 'GrR', 'BrR', 'BrY'],
                'show_question' => 0,
            ],
            [
                'id' => 36,
                'name' => 'Nâu-Vàng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\nau-vang.png',
                'answer' => 'BrY',
                'answer_list' => ['BrW', 'GrR', 'BrR', 'BrY'],
                'show_question' => 0,
            ],
            [
                'id' => 37,
                'name' => 'Nâu-Đen',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\nau-den.png',
                'answer' => 'BrB',
                'answer_list' => ['BrW', 'GrR', 'BrB', 'BrY'],
                'show_question' => 0,
            ],
            [
                'id' => 38,
                'name' => 'Xanh lọc non-Đỏ',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-do.png',
                'answer' => 'LgR',
                'answer_list' => ['LgW', 'LgR', 'LR', 'GR'],
                'show_question' => 0,
            ],
            [
                'id' => 39,
                'name' => 'Xanh lọc non-Vàng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-vang.png',
                'answer' => 'LgY',
                'answer_list' => ['LgW', 'LgY', 'LY', 'GY'],
                'show_question' => 0,
            ],
            [
                'id' => 40,
                'name' => 'Xanh lọc non-Đen',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-den.png',
                'answer' => 'LgB',
                'answer_list' => ['LB', 'LgR', 'LgB', 'GB'],
                'show_question' => 0,
            ],
            [
                'id' => 41,
                'name' => 'Xanh lọc non-Trắng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-trang.png',
                'answer' => 'LgW',
                'answer_list' => ['LgW', 'GW', 'LW', 'GY'],
                'show_question' => 0,
            ],
            [
                'id' => 42,
                'name' => 'Đen-Trắng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\den-trang.png',
                'answer' => 'BW',
                'answer_list' => ['BW', 'WB', 'PW', 'WG'],
                'show_question' => 0,
            ],
            [
                'id' => 43,
                'name' => 'Đen-Đỏ',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\den-do.png',
                'answer' => 'BR',
                'answer_list' => ['BW', 'BR', 'RB', 'BY'],
                'show_question' => 1,
            ],
            [
                'id' => 44,
                'name' => 'Đen-Vàng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\den-vang.png',
                'answer' => 'BY',
                'answer_list' => ['BW', 'BR', 'YB', 'BY'],
                'show_question' => 0,

            ],
            [
                'id' => 45,
                'name' => 'Đen-Xanh',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\den-xanh.png',
                'answer' => 'BL',
                'answer_list' => ['BL', 'LB', 'BY', 'BW'],
                'show_question' => 0,

            ],
            [
                'id' => 46,
                'name' => 'Đen-Xanh lá cây',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\den-xanhlacay.png',
                'answer' => 'BG',
                'answer_list' => ['BL', 'BG', 'BY', 'GB'],
                'show_question' => 0,
            ],
            [
                'id' => 47,
                'name' => 'Trắng - Đỏ',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-do.png',
                'answer' => 'WR',
                'answer_list' => ['WR', 'RW', 'WY', 'WV'],
                'show_question' => 0,
            ],
            [
                'id' => 48,
                'name' => 'Trắng - Xanh',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-xanh.png',
                'answer' => 'WL',
                'answer_list' => ['WY', 'LW', 'WL', 'WV'],
                'show_question' => 0,
            ],
            [
                'id' => 49,
                'name' => 'Trắng - Vàng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-vang.png',
                'answer' => 'WY',
                'answer_list' => ['WY', 'YW', 'WL', 'WR'],
                'show_question' => 0,
            ],
            [
                'id' => 50,
                'name' => 'Trắng - Tím',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-tim.png',
                'answer' => 'WV',
                'answer_list' => ['WY', 'WV', 'WL', 'WR'],
                'show_question' => 1,
            ],
            [
                'id' => 51,
                'name' => 'Trắng-Xanh lá cây',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-xanhlacay.png',
                'answer' => 'WG',
                'answer_list' => ['WG', 'WV', 'WL', 'GW'],
                'show_question' => 0,

            ],
            [
                'id' => 52,
                'name' => 'Cam - Trắng',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\cam-trang.png',
                'answer' => 'OW',
                'answer_list' => ['GW', 'OW', 'WY', 'GW'],
                'show_question' => 0,
            ],
            [
                'id' => 53,
                'name' => 'Hồng - Đen',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\hong-den.png',
                'answer' => 'PB',
                'answer_list' => ['PB', 'BY', 'LgB', 'GB'],
                'show_question' => 0,

            ],
            [
                'id' => 54,
                'name' => 'Xám - Đỏ',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xam-do.png',
                'answer' => 'GrR',
                'answer_list' => ['BrW', 'GrR', 'BrR', 'BrY'],
                'show_question' => 1,
            ],
            [
                'id' => 55,
                'name' => 'Xám - Đen',
                'path_image' => 'public\assets\frontend\images\anh-mau-day\xam-den.png',
                'answer' => 'GrB',
                'answer_list' => ['BrW', 'GrB', 'BrB', 'GrY'],
                'show_question' => 0,

            ],
        ];
    }

    public static function groupQuestion()
    {
        return [
            [
                'groupname' => 'I) Điền tên màu dây vào ô trống (20 điểm): (1 câu đúng 1 điểm) ',
                'point' => 1,
                'question' => [
                    [
                        'id' => 1,
                        'name' => 'Đỏ - Trắng',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\dotrang.png',
                        'answer' => 'RW',
                        'answer_list' => ['RW', 'WR', 'WV', 'WG'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 2,
                        'name' => 'Đỏ - Đen',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\doden.png',
                        'answer' => 'RB',
                        'answer_list' => ['RB', 'BR', 'RY', 'RG'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 3,
                        'name' => 'Đỏ - Vàng',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\dovang.png',
                        'answer' => 'RY',
                        'answer_list' => ['RB', 'YR', 'RY', 'RG'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 4,
                        'name' => 'Đỏ - Xanh lá cây',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\doxanhlacay.png',
                        'answer' => 'RG',
                        'answer_list' => ['RB', 'RL', 'RY', 'RG'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 5,
                        'name' => 'Đỏ - Xanh',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\doxanh.png',
                        'answer' => 'RL',
                        'answer_list' => ['RB', 'RL', 'RY', 'RG'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 6,
                        'name' => 'Vàng - Đỏ',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\vangdo.png',
                        'answer' => 'YR',
                        'answer_list' => ['YR', 'YG', 'RY', 'YL'],
                        'show_question' => 1,

                    ],
                    [
                        'id' => 7,
                        'name' => 'Vàng - Đen',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\vangden.png',
                        'answer' => 'YB',
                        'answer_list' => ['YR', 'YB', 'RY', 'BY'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 8,
                        'name' => 'Vàng - Xanh lá cây',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\vangxanhlacay.png',
                        'answer' => 'YG',
                        'answer_list' => ['YR', 'YG', 'RY', 'BY'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 9,
                        'name' => 'Vàng - Xanh',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\vangxanh.png',
                        'answer' => 'YL',
                        'answer_list' => ['YL', 'YB', 'YG', 'YW'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 10,
                        'name' => 'Vàng - Trắng',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\vangtrang.png',
                        'answer' => 'YW',
                        'answer_list' => ['YL', 'WY', 'YG', 'YW'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 11,
                        'name' => 'Xanh lá cây- Trắng',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacaytrang.png',
                        'answer' => 'GW',
                        'answer_list' => ['GW', 'WR', 'GB', 'WG'],
                        'show_question' => 1,

                    ],
                    [
                        'id' => 12,
                        'name' => 'Xanh lá cây- Đỏ',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacaydo.png',
                        'answer' => 'GR',
                        'answer_list' => ['GR', 'RG', 'GB', 'GL'],
                        'show_question' => 1,

                    ],
                    [
                        'id' => 13,
                        'name' => 'Xanh lá cây- Vàng',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacayvang.png',
                        'answer' => 'GY',
                        'answer_list' => ['GY', 'GL', 'GB', 'GW'],
                        'show_question' => 1,

                    ],
                    [
                        'id' => 14,
                        'name' => 'Xanh lá cây- Đen',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacayden.png',
                        'answer' => 'GB',
                        'answer_list' => ['GY', 'GL', 'GB', 'BG'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 15,
                        'name' => 'Xanh lá cây- Xanh',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacayxanh.png',
                        'answer' => 'GL',
                        'answer_list' => ['LG', 'GL', 'GB', 'GW'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 16,
                        'name' => 'Xanh-Trắng',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-trang.png',
                        'answer' => 'LW',
                        'answer_list' => ['LW', 'WL', 'LgW', 'GW'],
                        'show_question' => 1,

                    ],
                    [
                        'id' => 17,
                        'name' => 'Xanh-Đỏ',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-do.png',
                        'answer' => 'LR',
                        'answer_list' => ['LR', 'RL', 'LgR', 'GR'],
                        'show_question' => 1,

                    ],
                    [
                        'id' => 18,
                        'name' => 'Xanh-Vàng',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-vang.png',
                        'answer' => 'LY',
                        'answer_list' => ['LY', 'YL', 'GY', 'LB'],
                        'show_question' => 1,

                    ],
                    [
                        'id' => 19,
                        'name' => 'Xanh-Đen',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-den.png',
                        'answer' => 'LB',
                        'answer_list' => ['LgB', 'BL', 'GB', 'LB'],
                        'show_question' => 1,

                    ],
                    [
                        'id' => 20,
                        'name' => 'Xanh-Xanh lá cây',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-xanhlacay.png',
                        'answer' => 'LG',
                        'answer_list' => ['LG', 'GL', 'LY', 'LB'],
                        'show_question' => 1,

                    ],
                    [
                        'id' => 21,
                        'name' => 'Nâu-Trắng',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\nau-trang.png',
                        'answer' => 'BrW',
                        'answer_list' => ['BrW', 'GrW', 'BrR', 'BrY'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 22,
                        'name' => 'Nâu-Đỏ',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\nau-do.png',
                        'answer' => 'BrR',
                        'answer_list' => ['BrW', 'GrR', 'BrR', 'BrY'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 23,
                        'name' => 'Nâu-Vàng',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\nau-vang.png',
                        'answer' => 'BrY',
                        'answer_list' => ['BrW', 'GrR', 'BrR', 'BrY'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 24,
                        'name' => 'Nâu-Đen',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\nau-den.png',
                        'answer' => 'BrB',
                        'answer_list' => ['BrW', 'GrR', 'BrB', 'BrY'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 25,
                        'name' => 'Xanh lọc non-Đỏ',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-do.png',
                        'answer' => 'LgR',
                        'answer_list' => ['LgW', 'LgR', 'LR', 'GR'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 26,
                        'name' => 'Xanh lọc non-Vàng',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-vang.png',
                        'answer' => 'LgY',
                        'answer_list' => ['LgW', 'LgY', 'LY', 'GY'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 27,
                        'name' => 'Xanh lọc non-Đen',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-den.png',
                        'answer' => 'LgB',
                        'answer_list' => ['LB', 'LgR', 'LgB', 'GB'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 28,
                        'name' => 'Xanh lọc non-Trắng',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-trang.png',
                        'answer' => 'LgW',
                        'answer_list' => ['LgW', 'GW', 'LW', 'GY'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 28,
                        'name' => 'Đen-Trắng',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\den-trang.png',
                        'answer' => 'BW',
                        'answer_list' => ['BW', 'WB', 'PW', 'WG'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 30,
                        'name' => 'Đen-Đỏ',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\den-do.png',
                        'answer' => 'BR',
                        'answer_list' => ['BW', 'BR', 'RB', 'BY'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 31,
                        'name' => 'Đen-Vàng',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\den-vang.png',
                        'answer' => 'BY',
                        'answer_list' => ['BW', 'BR', 'YB', 'BY'],
                        'show_question' => 1,

                    ],
                    [
                        'id' => 32,
                        'name' => 'Đen-Xanh',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\den-xanh.png',
                        'answer' => 'BL',
                        'answer_list' => ['BL', 'LB', 'BY', 'BW'],
                        'show_question' => 1,

                    ],
                    [
                        'id' => 33,
                        'name' => 'Đen-Xanh lá cây',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\den-xanhlacay.png',
                        'answer' => 'BG',
                        'answer_list' => ['BL', 'BG', 'BY', 'GB'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 34,
                        'name' => 'Trắng - Đỏ',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-do.png',
                        'answer' => 'WR',
                        'answer_list' => ['WR', 'RW', 'WY', 'WV'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 35,
                        'name' => 'Trắng - Xanh',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-xanh.png',
                        'answer' => 'WL',
                        'answer_list' => ['WY', 'LW', 'WL', 'WV'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 36,
                        'name' => 'Trắng - Vàng',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-vang.png',
                        'answer' => 'WY',
                        'answer_list' => ['WY', 'YW', 'WL', 'WR'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 37,
                        'name' => 'Trắng - Tím',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-tim.png',
                        'answer' => 'WV',
                        'answer_list' => ['WY', 'WV', 'WL', 'WR'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 37,
                        'name' => 'Trắng-Xanh lá cây',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-xanhlacay.png',
                        'answer' => 'WG',
                        'answer_list' => ['WG', 'WV', 'WL', 'GW'],
                        'show_question' => 1,

                    ],
                    [
                        'id' => 39,
                        'name' => 'Cam - Trắng',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\cam-trang.png',
                        'answer' => 'OW',
                        'answer_list' => ['GW', 'OW', 'WY', 'GW'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 40,
                        'name' => 'Hồng - Đen',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\hong-den.png',
                        'answer' => 'PB',
                        'answer_list' => ['PB', 'BY', 'LgB', 'GB'],
                        'show_question' => 1,

                    ],
                    [
                        'id' => 41,
                        'name' => 'Xám - Đỏ',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\xam-do.png',
                        'answer' => 'GrR',
                        'answer_list' => ['BrW', 'GrR', 'BrR', 'BrY'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 42,
                        'name' => 'Xám - Đen',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\xam-den.png',
                        'answer' => 'GrB',
                        'answer_list' => ['BrW', 'GrB', 'BrB', 'GrY'],
                        'show_question' => 1,

                    ],
                ]
            ],
            [
                'groupname' => 'II) Nhận dạng Tanshi (20 điểm): (1 câu đúng 10 điểm) ',
                'point' => 10,
                'question' => [
                    [
                        'id' => 51,
                        'name' => 'Tanshi cái hàng doitsu',
                        'path_image' => null,
                        'answer' => 'public\assets\frontend\images\tanshi\tanshi-cai-doitsu.png',
                        'answer_list' => [
                            'public\assets\frontend\images\tanshi\tanshi-cai-doitsu.png',
                            'public\assets\frontend\images\tanshi\tanshi-duc-yazaky.png',
                            'public\assets\frontend\images\tanshi\tanshi-cai-yazaky.png',
                            'public\assets\frontend\images\tanshi\tanshi-duc-doitsu.png',
                        ],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 52,
                        'name' => 'Tanshi đực hàng doitsu',
                        'path_image' => null,
                        'answer' => 'public\assets\frontend\images\tanshi\tanshi-duc-doitsu.png',
                        'answer_list' => [
                            'public\assets\frontend\images\tanshi\tanshi-cai-doitsu.png',
                            'public\assets\frontend\images\tanshi\tanshi-duc-yazaky.png',
                            'public\assets\frontend\images\tanshi\tanshi-cai-yazaky.png',
                            'public\assets\frontend\images\tanshi\tanshi-duc-doitsu.png',
                        ],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 53,
                        'name' => 'Tanshi cái hàng Yazaky',
                        'path_image' => null,
                        'answer' => 'public\assets\frontend\images\tanshi\tanshi-cai-yazaky.png',
                        'answer_list' => [
                            'public\assets\frontend\images\tanshi\tanshi-cai-doitsu.png',
                            'public\assets\frontend\images\tanshi\tanshi-duc-yazaky.png',
                            'public\assets\frontend\images\tanshi\tanshi-cai-yazaky.png',
                            'public\assets\frontend\images\tanshi\tanshi-duc-doitsu.png',
                        ],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 54,
                        'name' => 'Tanshi đực hàng Yazaky',
                        'path_image' => null,
                        'answer' => 'public\assets\frontend\images\tanshi\tanshi-duc-yazaky.png',
                        'answer_list' => [
                            'public\assets\frontend\images\tanshi\tanshi-cai-doitsu.png',
                            'public\assets\frontend\images\tanshi\tanshi-duc-yazaky.png',
                            'public\assets\frontend\images\tanshi\tanshi-cai-yazaky.png',
                            'public\assets\frontend\images\tanshi\tanshi-duc-doitsu.png',
                        ],
                        'show_question' => 1,
                    ],
                ],
            ],
            [
                'groupname' => 'III) Khoanh tròn vào các câu trả lời đúng (20 điểm): (1 câu đúng 4 điểm) ',
                'point' => 4,
                'question' => [
                    [
                        'id' => 61,
                        'name' => 'Khi bắt đầu vào làm việc đầu giờ sáng và đầu giờ chiều,người thao tác cần phải làm gì ?',
                        'path_image' => null,
                        'answer' => 'Kéo cân với lực khoảng 2kg',
                        'answer_list' => ['Kéo cân với lực khoảng 2kg', '5S', 'Chuẩn bị linh kiện', 'Rút dây'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 62,
                        'name' => 'Chủng loại conecter nào sau khi cắm xong kéo lại 1 lực 2kg theo 5 hướng ?',
                        'path_image' => null,
                        'answer' => 'DRC & HD',
                        'answer_list' => ['DRC & HD', 'Doitsu', 'Yazaky', 'Tất cả'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 63,
                        'name' => 'Kiểm tra tụt chốt tại công đoạn cắm phương pháp nào là đúng',
                        'path_image' => null,
                        'answer' => 'A & B',
                        'answer_list' => ['Nhìn bằng mắt thường', 'Soi đèn pin', 'Kiểm tra bằng máy thông điện', 'A & B'],
                        'show_question' => 1,

                    ],
                    [
                        'id' => 64,
                        'name' => 'Bạn hãy cho biết tiêu chuẩn cắm hạt umesen ( hạt đỏ , hạt trắng )',
                        'path_image' => null,
                        'answer' => '0→1mm',
                        'answer_list' => ['0→1mm', '0mm', '1mm', '0.1mm'],
                        'show_question' => 1,

                    ],
                    [
                        'id' => 65,
                        'name' => 'Khi phát sinh linh kiện thiếu,thừa ta phải làm gì?',
                        'path_image' => null,
                        'answer' => 'Tất cả',
                        'answer_list' => ['Kiểm tra lại', 'Đánh dấu lại', 'Báo cấp trên', 'Tất cả'],
                        'show_question' => 1,
                    ],
                ]
            ],
            [
                'groupname' => 'IV) Điền từ thích hợp vào ô trống (20 điểm): (1 câu đúng 5 điểm) ',
                'point' => 5,
                'question' => [
                    [
                        'id' => 71,
                        'name' => ' Khi cắm 2 dây cùng màu ta phải (  … ) vào EDP và sơ đồ cắm. ',
                        'path_image' => null,
                        'answer' => 'Đánh dấu',
                        'answer_list' => ['Đánh dấu', 'Lọc màu dây', 'Không đánh dấu', 'Cắm luôn'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 72,
                        'name' => 'Connector doitsu cắm dây dựa vào (  …  ). ',
                        'path_image' => null,
                        'answer' => 'Số và chữ',
                        'answer_list' => ['Số và chữ', 'Hướng', 'Số', 'Chữ'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 73,
                        'name' => ' Connector yazaky cắm dây dựa vào(  … )trên connector và cắm theo quy trình (  … ). ',
                        'path_image' => null,
                        'answer' => 'hướng lẫy,Đếm tanshi từ bên gần nhất ',
                        'answer_list' => ['hướng lẫy,Đếm tanshi từ phải sang trái', 'hướng lẫy,Đếm tanshi từ trái sang phải', 'hướng lẫy,Đếm tanshi từ bên gần nhất', 'Số,Đếm tanshi từ trái sang phải'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 74,
                        'name' => 'Cách cầm dây để cắm áp dụng với : dây đơn ( …) ',
                        'path_image' => null,
                        'answer' => '.Cầm cả bó dây để cắm',
                        'answer_list' => ['Nhặt từng dây để cắm', 'Cầm cả bó dây để cắm', 'Lọc theo màu dây rồi cắm',],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 75,
                        'name' => 'Cách cầm dây để cắm áp dụng với : dây xoắn(  … ) ',
                        'path_image' => null,
                        'answer' => 'Lọc theo màu dây rồi cắm',
                        'answer_list' => ['Lọc theo màu dây rồi cắm', 'Cầm cả bó dây để cắm', 'Nhặt từng dây để cắm',],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 76,
                        'name' => 'Cách cầm dây để cắm áp dụng với : dây chập bộ( …) ',
                        'path_image' => null,
                        'answer' => 'Nhặt từng dây để cắm',
                        'answer_list' => ['Nhặt từng dây để cắm', 'Cầm cả bó dây để cắm', 'Lọc theo màu dây rồi cắm',],
                        'show_question' => 1,
                    ],
                ],
            ],
            [
                'groupname' => 'V) Hãy sắp xếp thứ tự thao tác ở dưới cho đúng quy trình (10 điểm): (1 câu đúng 5 điểm) ',
                'point' => 5,
                'question' => [
                    [
                        'id' => 81,
                        'name' => 'Thao tác cắm conecter doitsu từ 2→12 chân: a. Tiến hành lắp USJ vào conecter b.Nhìn theo số để cắm dây điện vào connector đến khi có tiếng kêu cạch thì kéo lại với lực thẳng = 2kg c.Nhìn lại xem các tanshi có bằng mặt,điểm sáng có đều nhau không d.Check tanshi xem có bằng nhau không ',
                        'path_image' => null,
                        'answer' => 'b→d→a→c',
                        'answer_list' => ['b→d→a→c', 'c→a→d→b', 'b→d→c→a', 'c→d→a→b'],
                        'show_question' => 1,

                    ],
                    [
                        'id' => 82,
                        'name' => 'Thao tác cắm connector DRC&HD a.Xác nhận số lượng hạt umesen đã được cắm sau đó đếm tanshi xem đã đủ chân chưa. b.Cắm dây điện vào connector đến khi có tiếng kêu cạch thì kéo lại với lực = 2kg theo 5  hướng : trên,dưới,trái,phải,thẳng c.Kiểm tra xem tanshi có bằng mặt không,điểm sáng có đều nhau và đủ chân không',
                        'path_image' => null,
                        'answer' => '.b→a→c',
                        'answer_list' => ['.b→a→c', 'c→a→b', 'c→b→a',],
                        'show_question' => 1,
                    ],
                ],
            ],
            [
                'groupname' => 'VI) Chọn câu trả lời đúng (10 điểm): (1 câu đúng 5 điểm) ',
                'point' => 5,
                'question' => [
                    [
                        'id' => 91,
                        'name' => '.Hãy nêu ý nghĩa của việc phân loại Itemslip theo các màu ? Itemslip Màu trắng ',
                        'path_image' => null,
                        'answer' => 'Hiển thị hàng ok',
                        'answer_list' => ['Hiển thị hàng ok', 'Hiển thị hàng bị thiếu nguyên vật liệu', 'Hiển thị là mã hàng bộ dây đầu'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 92,
                        'name' => '.Hãy nêu ý nghĩa của việc phân loại Itemslip theo các màu ? Itemslip  Màu xanh  ',
                        'path_image' => null,
                        'answer' => 'Hiển thị hàng bị thiếu nguyên vật liệu',
                        'answer_list' => ['Hiển thị hàng ok', 'Hiển thị hàng bị thiếu nguyên vật liệu', 'Hiển thị là mã hàng bộ dây đầu'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 93,
                        'name' => '.Hãy nêu ý nghĩa của việc phân loại Itemslip theo các màu ? Itemslip Màu vàng  ',
                        'path_image' => null,
                        'answer' => 'Hiển thị là mã hàng bộ dây đầu',
                        'answer_list' => ['Hiển thị hàng ok', 'Hiển thị hàng bị thiếu nguyên vật liệu', 'Hiển thị là mã hàng bộ dây đầu'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 94,
                        'name' => 'Bạn hãy nêu quy trình xử lý hàng lỗi ?',
                        'path_image' => null,
                        'answer' => 'Đánh dấu băng dính đỏ tại vị trí NG→ Báo cáo cấp trên để xử lý',
                        'answer_list' => ['Đánh dấu băng dính đỏ tại vị trí NG→ Báo cáo cấp trên để xử lý', 'Báo cáo cấp trên để xử lý', 'Đánh dấu băng dính đỏ tại vị trí NG', 'Hỏi bạn bên cạnh'],
                        'show_question' => 1,
                    ],
                ],
            ]
        ];
    }
}
