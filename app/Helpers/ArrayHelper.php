<?php

namespace App\Helpers;

use Carbon\Carbon;

class ArrayHelper
{
    public static function getModels()
    {
        return collect(get_declared_classes())->filter(function ($item) {
            return (substr($item, 0, 11) === 'App\Models\\');
        });
    }
    public static function decode_string($value)
    {
        return preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match) {
            return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
        }, $value);
    }
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
    public static function positions()
    {
        return [
            [
                'id' => 1,
                'name' => 'General Director',
            ],
            [
                'id' => 2,
                'name' => 'Director',
            ],
            [
                'id' => 3,
                'name' => 'Supper Manager',
            ],
            [
                'id' => 4,
                'name' => 'Manager',
            ],
            [
                'id' => 5,
                'name' => 'Supper Chief',
            ],
            [
                'id' => 6,
                'name' => 'Chief',
            ],
            [
                'id' => 7,
                'name' => 'Staff',
            ],
            [
                'id' => 8,
                'name' => 'Suppser Leader',
            ],
            [
                'id' => 9,
                'name' => 'Leader',
            ],
            [
                'id' => 10,
                'name' => 'Sub Leader',
            ],
            [
                'id' => 11,
                'name' => 'worker',
            ],
        ];
    }
    public static function formTypeJobs()
    {
        return [
            [
                'id' => 1,
                'from_dept' => [5], // id bộ phận yêu cầu
                'to_dept' => [
                    8, // id bộ phận tiếp nhận
                ],
                'confirm_from_dept' => 1, // 0:duyệt tay, 1: tự động duyệt
                'confirm_to_dept' => 1, // 0:duyệt tay, 1: tự động duyệt
                'confirm_by_from_dept' => [5], //duyệt bởi leader ,sub leader -- id lấy từ positionsTitle()
                'confirm_by_to_dept' => [],
            ],
            [
                'id' => 2,
                'from_dept' => [5], // id bộ phận yêu cầu,gửi yêu cầu cho leader,subleader
                'to_dept' => [], // id bộ phận tiếp nhận
                'confirm_from_dept' => 0, // 0:duyệt tay, 1: tự động duyệt
                'confirm_to_dept' => 0, // 0:duyệt tay, 1: tự động duyệt
                'confirm_by_from_dept' => [4, 5], //duyệt bởi leader ,sub leader -- id lấy từ positionsTitle()
                'confirm_by_to_dept' => [],
                'data_table' => [
                    'team' => 'CẮT',
                    'name' => 'máy cắt thường',
                    'name_machine' => '',
                    'check_list' => [
                        [
                            'id' => 0,
                            'position' => 'Toàn bộ thiết.bị: máy, bàn…',
                            'method' => 'Không có bụi bẩn, bật máy không có tiếng kêu lạ',
                            'handle' => 'Liên lạc cấp trên',
                            'image' => 'public/assets/images/pages/check_cut_machine/1.png',
                            'answer' => '',
                            'answer_list' => [0, 1], //1: bình thường , 0: bất thường
                        ],
                        [
                            'id' => 1,
                            'position' => 'Màn hình máy cắt',
                            'method' => 'Hiển thị rõ ràng, xem có bị nứt vỡ trầy xước hay không',
                            'handle' => 'Liên lạc cấp trên',
                            'image' => 'public/assets/images/pages/check_cut_machine/2.png',
                            'answer' => '',
                            'answer_list' => [0, 1], //1: bình thường , 0: bất thường
                        ],
                        [
                            'id' => 2,
                            'position' => 'Nút bấm điều khiển',
                            'method' => 'Không bị kẹt, rách',
                            'handle' => 'Liên lạc cấp trên',
                            'image' => 'public/assets/images/pages/check_cut_machine/3.png',
                            'answer' => '',
                            'answer_list' => [0, 1], //1: bình thường , 0: bất thường
                        ],
                        [
                            'id' => 3,
                            'position' => 'Con lăn vận chuyển',
                            'method' => 'Không bị mòn, sứt, biến dạng',
                            'handle' => 'Liên lạc cấp trên',
                            'image' => 'public/assets/images/pages/check_cut_machine/4.png',
                            'answer' => '',
                            'answer_list' => [0, 1], //1: bình thường , 0: bất thường
                        ],
                        [
                            'id' => 4,
                            'position' => 'Ống dẫn dây',
                            'method' => 'Không bị biến dạng',
                            'handle' => 'Liên lạc cấp trên',
                            'image' => 'public/assets/images/pages/check_cut_machine/5.png',
                            'answer' => '',
                            'answer_list' => [0, 1], //1: bình thường , 0: bất thường
                        ],
                        [
                            'id' => 5,
                            'position' => 'Áp lực khí',
                            'method' => '0.6±0.05 Mpa',
                            'handle' => 'Liên lạc cấp trên',
                            'image' => 'public/assets/images/pages/check_cut_machine/6.png',
                            'answer' => '',
                            'answer_list' => [0, 1], //1: bình thường , 0: bất thường
                        ],
                        [
                            'id' => 6,
                            'position' => 'Máy tính',
                            'method' => 'Màn hình h.thị rõ ràng, bàn phím và chuột không bị kẹt nút, mất nút',
                            'handle' => 'Liên lạc cấp trên',
                            'image' => 'public/assets/images/pages/check_cut_machine/7.png',
                            'answer' => '',
                            'answer_list' => [0, 1], //1: bình thường , 0: bất thường
                        ],
                        [
                            'id' => 7,
                            'position' => 'Súng scan',
                            'method' => 'Hoạt động bình thường',
                            'handle' => 'Liên lạc cấp trên',
                            'image' => 'public/assets/images/pages/check_cut_machine/8.png',
                            'answer' => '',
                            'answer_list' => [0, 1], //1: bình thường , 0: bất thường
                        ],
                    ],
                ],
            ],
            [
                'id' => 3,
                'from_dept' => [5], // id bộ phận yêu cầu
                'to_dept' => [],
                'confirm_from_dept' => 0, // 0:duyệt tay, 1: tự động duyệt
                'confirm_to_dept' => 0, // 0:duyệt tay, 1: tự động duyệt
                'confirm_by_from_dept' => [4, 5], //duyệt bởi leader ,sub leader -- id lấy từ positionsTitle()
                'confirm_by_to_dept' => [],
                'data_table' => [
                    'team' => 'CẮT',
                    'name' => 'máy tự động',
                    'name_machine' => '',
                    'check_list' => [
                        [
                            'id' => 0,
                            'position' => 'Toàn bộ t.bị: máy, bàn…',
                            'method' => 'Không có bụi bẩn, bật máy không có tiếng kêu lạ',
                            'handle' => 'Liên lạc cấp trên',
                            'image' => 'public/assets/images/pages/check_cut_machine_auto/1.png',
                            'answer' => '',
                            'answer_list' => [0, 1], //1: bình thường , 0: bất thường
                        ],
                        [
                            'id' => 1,
                            'position' => 'Màn hình máy cắt',
                            'method' => 'Hiển thị rõ ràng, có bị trầy xước nứt vỡ hay không',
                            'handle' => 'Liên lạc cấp trên',
                            'image' => 'public/assets/images/pages/check_cut_machine_auto/2.png',
                            'answer' => '',
                            'answer_list' => [0, 1], //1: bình thường , 0: bất thường
                        ],
                        [
                            'id' => 2,
                            'position' => 'Con lăn vận chuyển',
                            'method' => 'Không bị mòn, sứt, biến dạng',
                            'handle' => 'Liên lạc cấp trên',
                            'image' => 'public/assets/images/pages/check_cut_machine_auto/3.png',
                            'answer' => '',
                            'answer_list' => [0, 1], //1: bình thường , 0: bất thường
                        ],
                        [
                            'id' => 3,
                            'position' => 'Ống dẫn dây',
                            'method' => 'Không bị biến dạng',
                            'handle' => 'Liên lạc cấp trên',
                            'image' => 'public/assets/images/pages/check_cut_machine_auto/4.png',
                            'answer' => '',
                            'answer_list' => [0, 1], //1: bình thường , 0: bất thường
                        ],
                        [
                            'id' => 4,
                            'position' => 'Áp lực khí chính',
                            'method' => '0.5±0.05 Mpa',
                            'handle' => 'Liên lạc cấp trên',
                            'image' => 'public/assets/images/pages/check_cut_machine_auto/5.png',
                            'answer' => '',
                            'answer_list' => [0, 1], //1: bình thường , 0: bất thường
                        ],
                        [
                            'id' => 5,
                            'position' => 'Máy tính',
                            'method' => 'Màn hình h.thị rõ ràng, bàn phím không bị kẹt nút, mất nút',
                            'handle' => 'Liên lạc cấp trên',
                            'image' => 'public/assets/images/pages/check_cut_machine_auto/6.png',
                            'answer' => '',
                            'answer_list' => [0, 1], //1: bình thường , 0: bất thường
                        ],
                        [
                            'id' => 6,
                            'position' => 'Súng scan(2 súng)',
                            'method' => 'Hoạt động bình thường',
                            'handle' => 'Liên lạc cấp trên',
                            'image' => 'public/assets/images/pages/check_cut_machine_auto/7.png',
                            'answer' => '',
                            'answer_list' => [0, 1], //1: bình thường , 0: bất thường
                        ],
                    ],
                ],
            ],
            [
                'id' => 4,
                'from_dept' => [4], // id bộ phận yêu cầu
                'to_dept' => [],
                'confirm_from_dept' => 1, // 0:duyệt tay, 1: tự động duyệt
                'confirm_to_dept' => 0, // 0:duyệt tay, 1: tự động duyệt
                'confirm_by_from_dept' => [4, 5], //duyệt bởi leader ,sub leader -- id lấy từ positionsTitle()
                'confirm_by_to_dept' => [],
                'data_table' => [
                    'model' => '',
                    'color' => '',
                    'name' => '',
                    'ip' => '',
                    'wifi' => '',
                    'position' => ''
                ],
            ],
            [
                'id' => 5,
                'from_dept' => [], // id bộ phận yêu cầu
                'to_dept' => [],
                'confirm_from_dept' => 1, // 0:duyệt tay, 1: tự động duyệt
                'confirm_to_dept' => 0, // 0:duyệt tay, 1: tự động duyệt
                'confirm_by_from_dept' => [], //duyệt bởi leader ,sub leader -- id lấy từ positionsTitle()
                'confirm_by_to_dept' => [],
                'data_table' => [
                    'model' => '',
                    'color' => '',
                    'name' => '',
                    'ip' => '',
                    'wifi' => '',
                    'position' => ''
                ],
            ],
        ];
    }
    public static function PositionByDevices()
    {
        return [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13];
    }
    public static function devicesList()
    {
        return [
            [
                "name" => "T031",
                "model" => "ASUS",
                "color" => "Trắng"
            ],
            [
                "name" => "T002",
                "model" => "ASUS",
                "color" => "Trắng"
            ],
            [
                "name" => "T036",
                "model" => "ASUS",
                "color" => "Trắng"
            ],
            [
                "name" => "T096",
                "model" => "ASUS",
                "color" => "Đen"
            ],
            [
                "name" => "T171",
                "model" => "Samsung",
                "color" => "Đen"
            ],
            [
                "name" => "T206",
                "model" => "Samsung",
                "color" => "Đen"
            ],
            [
                "name" => "T224",
                "model" => "Samsung",
                "color" => "Vàng"
            ],
            [
                "name" => "T225",
                "model" => "Samsung",
                "color" => "Vàng"
            ],
            [
                "name" => "T134",
                "model" => "Samsung",
                "color" => "Trắng"
            ],
            [
                "name" => "T143",
                "model" => "Samsung",
                "color" => "Đen"
            ],
            [
                "name" => "T167",
                "model" => "Samsung",
                "color" => "Đen"
            ],
            [
                "name" => "T124",
                "model" => "Samsung",
                "color" => "Đen"
            ],
            [
                "name" => "T215",
                "model" => "Samsung",
                "color" => "Vàng"
            ],
            [
                "name" => "THB T202",
                "model" => "Samsung",
                "color" => "Trắng"
            ],
            [
                "name" => "T131",
                "model" => "Samsung",
                "color" => "Đen"
            ],
            [
                "name" => "T173",
                "model" => "Samsung",
                "color" => "Đen"
            ],
            [
                "name" => "T016",
                "model" => "ASUS",
                "color" => "Trắng"
            ],
            [
                "name" => "T226",
                "model" => "Samsung",
                "color" => "Xám"
            ],
            [
                "name" => "T072",
                "model" => "ASUS",
                "color" => "Đen"
            ],
            [
                "name" => "T035",
                "model" => "ASUS",
                "color" => "Trắng"
            ],
            [
                "name" => "T116",
                "model" => "ASUS",
                "color" => "Đen"
            ],
            [
                "name" => "T145",
                "model" => "Samsung",
                "color" => "Đen"
            ],
            [
                "name" => "T183",
                "model" => "Samsung",
                "color" => "Trắng"
            ],
            [
                "name" => "T218",
                "model" => "Samsung",
                "color" => "Vàng"
            ],
            [
                "name" => "T186",
                "model" => "Samsung",
                "color" => "Trắng"
            ],
            [
                "name" => "T211",
                "model" => "Samsung",
                "color" => "Vàng"
            ],
            [
                "name" => "T212",
                "model" => "Samsung",
                "color" => "Vàng"
            ],
            [
                "name" => "T213",
                "model" => "Samsung",
                "color" => "Vàng"
            ],
            [
                "name" => "T169",
                "model" => "Samsung",
                "color" => "Trắng"
            ],
            [
                "name" => "T155",
                "model" => "Samsung",
                "color" => "Trắng"
            ],
            [
                "name" => "T191",
                "model" => "Samsung",
                "color" => "Trắng"
            ],
            [
                "name" => "T152",
                "model" => "Samsung",
                "color" => "Đen"
            ],
            [
                "name" => "T140",
                "model" => "Samsung",
                "color" => "Trắng"
            ],
            [
                "name" => "T160",
                "model" => "Samsung",
                "color" => "Trắng"
            ],
            [
                "name" => "T214",
                "model" => "Samsung",
                "color" => "Vàng"
            ],
            [
                "name" => "T227",
                "model" => "Samsung",
                "color" => "Xám"
            ],
            [
                "name" => "T089",
                "model" => "ASUS",
                "color" => "Đen"
            ],
            [
                "name" => "T091",
                "model" => "ASUS",
                "color" => "Đen"
            ],
            [
                "name" => "T098",
                "model" => "ASUS",
                "color" => "Đen"
            ],
            [
                "name" => "T082",
                "model" => "ASUS",
                "color" => "Đen"
            ],
            [
                "name" => "T015",
                "model" => "ASUS",
                "color" => "Trắng"
            ],
            [
                "name" => "T029",
                "model" => "ASUS",
                "color" => "Trắng"
            ],
            [
                "name" => "T084",
                "model" => "ASUS",
                "color" => "Đen"
            ],
            [
                "name" => "T108",
                "model" => "ASUS",
                "color" => "Đen"
            ],
            [
                "name" => "T125",
                "model" => "Samsung",
                "color" => "Trắng"
            ],
            [
                "name" => "T156",
                "model" => "Samsung",
                "color" => "Trắng"
            ],
            [
                "name" => "T174",
                "model" => "Samsung",
                "color" => "Đen"
            ],
            [
                "name" => "T130",
                "model" => "Samsung",
                "color" => "Đen"
            ],
            [
                "name" => "T129",
                "model" => "Samsung",
                "color" => "Trắng"
            ],
            [
                "name" => "T158",
                "model" => "Samsung",
                "color" => "Trắng"
            ],
            [
                "name" => "T220",
                "model" => "Samsung",
                "color" => "Vàng"
            ],
            [
                "name" => "T007",
                "model" => "ASUS",
                "color" => "Trắng"
            ],
            [
                "name" => "T222",
                "model" => "Samsung",
                "color" => "Vàng"
            ],
            [
                "name" => "T106",
                "model" => "ASUS",
                "color" => "Đen"
            ],
            [
                "name" => "T229",
                "model" => "Samsung",
                "color" => "Xám"
            ],
            [
                "name" => "T230",
                "model" => "Samsung",
                "color" => "Xám"
            ],
            [
                "name" => "T074",
                "model" => "ASUS",
                "color" => "Đen"
            ],
            [
                "name" => "T110",
                "model" => "ASUS",
                "color" => "Đen"
            ],
            [
                "name" => "T111",
                "model" => "ASUS",
                "color" => "Đen"
            ],
            [
                "name" => "T083",
                "model" => "ASUS",
                "color" => "Đen"
            ],
            [
                "name" => "T028",
                "model" => "ASUS",
                "color" => "Trắng"
            ],
            [
                "name" => "T100",
                "model" => "ASUS",
                "color" => "Đen"
            ],
            [
                "name" => "T161",
                "model" => "Samsung",
                "color" => "Trắng"
            ],
            [
                "name" => "T126",
                "model" => "Samsung",
                "color" => "Trắng"
            ],
            [
                "name" => "T157",
                "model" => "Samsung",
                "color" => "Trắng"
            ],
            [
                "name" => "T136",
                "model" => "Samsung",
                "color" => "Đen"
            ],
            [
                "name" => "T165",
                "model" => "Samsung",
                "color" => "Đen"
            ],
            [
                "name" => "T216",
                "model" => "Samsung",
                "color" => "Vàng"
            ],
            [
                "name" => "T217",
                "model" => "Samsung",
                "color" => "Vàng"
            ],
            [
                "name" => "T194",
                "model" => "Samsung",
                "color" => "Trắng"
            ],
            [
                "name" => "T127",
                "model" => "Samsung",
                "color" => "Đen"
            ],
            [
                "name" => "T223",
                "model" => "Samsung",
                "color" => "Vàng"
            ],
            [
                "name" => "T101",
                "model" => "ASUS",
                "color" => "Đen"
            ],
            [
                "name" => "T228",
                "model" => "Samsung",
                "color" => "Xám"
            ]
        ];
    }
    public static function machineList()
    {
        return [
            [
                'type' => 1,
                'name' => 'CA001',
                'model' => 'C371A',
            ],
            [
                'type' => 1,
                'name' => 'CA002',
                'model' => 'C371',
            ],
            [
                'type' => 1,
                'name' => 'CA003',
                'model' => 'C371A',
            ],
            [
                'type' => 1,
                'name' => 'CA004',
                'model' => 'C371A',
            ],
            [
                'type' => 1,
                'name' => 'CA005',
                'model' => 'C371A',
            ],
            [
                'type' => 1,
                'name' => 'CA006',
                'model' => 'C371A',
            ],
            [
                'type' => 1,
                'name' => 'CA007',
                'model' => 'C371A',
            ],
            [
                'type' => 1,
                'name' => 'CA008',
                'model' => 'C371A',
            ],
            [
                'type' => 1,
                'name' => 'CA009',
                'model' => 'C371',
            ],
            [
                'type' => 1,
                'name' => 'CA010',
                'model' => 'C371',
            ],
            [
                'type' => 1,
                'name' => 'CA011',
                'model' => 'C371',
            ],
            [
                'type' => 1,
                'name' => 'CA012',
                'model' => 'C371',
            ],
            [
                'type' => 1,
                'name' => 'CA013',
                'model' => 'C371A',
            ],
            [
                'type' => 1,
                'name' => 'CA014',
                'model' => 'C371',
            ],
            [
                'type' => 1,
                'name' => 'CA015',
                'model' => 'C371A',
            ],
            [
                'type' => 1,
                'name' => 'CA016',
                'model' => 'C371',
            ],
            [
                'type' => 1,
                'name' => 'CA017',
                'model' => 'C385A',
            ],
            [
                'type' => 2,
                'name' => 'TD001',
                'model' => 'C558SZ1',
            ],
            [
                'type' => 2,
                'name' => 'TD002',
                'model' => 'C558SZ2',
            ],
            [
                'type' => 2,
                'name' => 'TD003',
                'model' => 'C558SZ3',
            ],
            [
                'type' => 2,
                'name' => 'TD004',
                'model' => 'C558SZ4',
            ],
            [
                'type' => 2,
                'name' => 'TD005',
                'model' => 'C558SZ5',
            ],
            [
                'type' => 2,
                'name' => 'TD006',
                'model' => 'C558SZ6',
            ],
            [
                'type' => 2,
                'name' => 'TD007',
                'model' => 'C551',
            ],
            [
                'type' => 2,
                'name' => 'TD008',
                'model' => 'C558SZ6',
            ],
            [
                'type' => 2,
                'name' => 'TD009',
                'model' => 'C558SZ7',
            ],
            [
                'type' => 2,
                'name' => 'TD010',
                'model' => 'C558S',
            ],

        ];
    }
    public static function marital()
    {
        return [
            [
                'id' => 0,
                'name' => 'Chưa kết hôn',
            ],

            [
                'id' => 1,
                'name' => 'Đã kết hôn',

            ],
            [
                'id' => 2,
                'name' => 'Ly hôn',
            ],
        ];
    }
    public static function positionTitle()
    {
        return [
            [
                'id' => 0,
                'name' => 'Nhân viên',
            ],
            [
                'id' => 1,
                'name' => 'Trưởng phòng',
            ],
            [
                'id' => 2,
                'name' => 'Phó phòng',
            ],
            [
                'id' => 3,
                'name' => 'Trợ lý',
            ],
            [
                'id' => 4,
                'name' => 'Sub Leader',
            ],
            [
                'id' => 5,
                'name' => 'Leader',
            ],
        ];
    }
    public static function worker()
    {
        return [
            [
                'id' => 0,
                'name' => 'Đang làm việc',
            ],
            [
                'id' => 1,
                'name' => 'Nghỉ việc',
            ],
            [
                'id' => 2,
                'name' => 'Nghỉ chế độ bảo hiểm',
            ],
            [
                'id' => 3,
                'name' => 'Nghỉ không lương',
            ]
        ];
    }
    public static function banksList()
    {
        return [
            [
                'id' => 1,
                'name' => 'TMCP Đầu tư và Phát triển Việt Nam	',
                'code' => 'BIDV',
            ],
            [
                'id' => 2,
                'name' => 'TMCP Ngoại Thương Việt Nam	',
                'code' => 'Vietcombank',
            ],
            [
                'id' => 3,
                'name' => 'TMCP Công thương Việt Nam	',
                'code' => 'VietinBank',
            ],
            [
                'id' => 4,
                'name' => 'TMCP Quân Đội	',
                'code' => 'MBBANK',
            ],
            [
                'id' => 5,
                'name' => 'TMCP Á Châu	',
                'code' => 'ACB',
            ],
            [
                'id' => 6,
                'name' => 'TMCP Sài Gòn – Hà Nội	',
                'code' => 'SHB',
            ],
            [
                'id' => 7,
                'name' => 'TMCP Kỹ Thương	',
                'code' => 'Techcombank',
            ],
            [
                'id' => 8,
                'name' => 'NN&PT Nông thôn Việt Nam	',
                'code' => 'Agribank',
            ],
            [
                'id' => 9,
                'name' => 'TMCP Phát triển Thành phố Hồ Chí Minh	',
                'code' => 'HDBank',
            ],
            [
                'id' => 10,
                'name' => 'TMCP Bưu điện Liên Việt	',
                'code' => 'LienVietPostBank',
            ],
            [
                'id' => 11,
                'name' => 'TMCP Quốc Tế 	',
                'code' => 'VIB',
            ],
            [
                'id' => 12,
                'name' => 'TMCP Đông Nam Á	',
                'code' => 'SeABank',
            ],
            [
                'id' => 13,
                'name' => 'Chính sách xã hội Việt Nam	',
                'code' => 'VBSP',
            ],
            [
                'id' => 14,
                'name' => 'TMCP Tiên Phong	',
                'code' => 'TPBank',
            ],
            [
                'id' => 15,
                'name' => 'TMCP Phương Đông	',
                'code' => 'OCB',
            ],
            [
                'id' => 16,
                'name' => 'TMCP Hàng Hải	',
                'code' => 'MSB',
            ],
            [
                'id' => 17,
                'name' => 'TMCP Sài Gòn Thương Tín	',
                'code' => 'Sacombank',
            ],
            [
                'id' => 18,
                'name' => 'TMCP Xuất Nhập Khẩu	',
                'code' => 'Eximbank',
            ],
            [
                'id' => 19,
                'name' => 'TMCP Sài Gòn	',
                'code' => 'SCB',
            ],
            [
                'id' => 20,
                'name' => 'Phát triển Việt Nam	',
                'code' => 'VDB',
            ],
            [
                'id' => 21,
                'name' => 'TMCP Nam Á	Nam A ',
                'code' => 'Bank',
            ],
            [
                'id' => 22,
                'name' => 'TMCP An Bình	',
                'code' => 'ABBANK',
            ],
            [
                'id' => 23,
                'name' => 'TMCP Đại Chúng Việt Nam	',
                'code' => 'PVcomBank',
            ],
            [
                'id' => 24,
                'name' => 'TMCP Bắc Á	Bac A ',
                'code' => 'Bank',
            ],
            [
                'id' => 25,
                'name' => 'TNHH MTV UOB Việt Nam	',
                'code' => 'UOB',
            ],
            [
                'id' => 26,
                'name' => 'TNHH MTV Woori Việt Nam	',
                'code' => 'Woori',
            ],
            [
                'id' => 27,
                'name' => 'TNHH MTV HSBC Việt Nam	',
                'code' => 'HSBC',
            ],
            [
                'id' => 28,
                'name' => 'TNHH MTV Standard Chartered Việt Nam	',
                'code' => 'SCBVL',
            ],
            [
                'id' => 29,
                'name' => 'TNHH MTV Public Bank Việt Nam	',
                'code' => 'PBVN',
            ],
            [
                'id' => 30,
                'name' => 'TNHH MTV Shinhan Việt Nam	',
                'code' => 'SHBVN',
            ],
            [
                'id' => 31,
                'name' => 'TMCP Quốc dân	',
                'code' => 'NCB',
            ],
            [
                'id' => 32,
                'name' => 'TMCP Việt Á	',
                'code' => 'VietABank',
            ],
            [
                'id' => 33,
                'name' => 'TMCP Bản Việt	 ',
                'code' => 'Viet Capital Bank',
            ],
            [
                'id' => 34,
                'name' => 'TMCP Đông Á',
                'code' => 'DongABank',
            ],
            [
                'id' => 35,
                'name' => 'TMCP Việt Nam Thương Tín	',
                'code' => 'Vietbank',
            ],
            [
                'id' => 36,
                'name' => 'TNHH MTV ANZ Việt Nam',
                'code' => 'ANZVL',
            ],
            [
                'id' => 37,
                'name' => 'TNHH MTV Đại Dương	',
                'code' => 'OceanBank',
            ],
            [
                'id' => 38,
                'name' => 'TNHH MTV CIMB Việt Nam',
                'code' => 'CIMB',
            ],
            [
                'id' => 39,
                'name' => 'TMCP Kiên Long',
                'code' => 'Kienlongbank',
            ],
            [
                'id' => 40,
                'name' => 'TNHH Indovina',
                'code' => 'IVB',
            ],
            [
                'id' => 41,
                'name' => 'TMCP Bảo Việt',
                'code' => 'BAOVIETBank',
            ],
            [
                'id' => 42,
                'name' => 'TMCP Sài Gòn Công Thương	',
                'code' => 'SAIGONBANK',
            ],
            [
                'id' => 43,
                'name' => 'Hợp tác xã Việt Nam',
                'code' => 'Co-opBank',
            ],
            [
                'id' => 44,
                'name' => 'TNHH MTV Dầu khí toàn cầu',
                'code' => 'GPBank',
            ],
            [
                'id' => 45,
                'name' => 'Liên doanh Việt Nga',
                'code' => 'VRB',
            ],
            [
                'id' => 46,
                'name' => 'TNHH MTV Xây dựng',
                'code' => 'CB',
            ],
            [
                'id' => 47,
                'name' => 'TNHH MTV Hong Leong Việt Nam	',
                'code' => 'HLBVN',
            ],
            [
                'id' => 48,
                'name' => 'TMCP Xăng dầu ',
                'code' => 'Petrolimex',
            ],

        ];
    }

    public static function arrayExamPd()
    {
        return [
            1 => [
                'title' => 'Bài kiểm tra năng lực nhận biết màu dây',
                'description' => '<i>Điểm đạt: 96->100 điểm</i><br>
                               <i>Từ 90->95 điểm: kiểm tra lại sau 2 ngày (nếu không đạt sẽ được đào tạo lại)</i><br>
                               <i>Dưới 90 điểm: Không đạt ( đào tạo lại màu dây 1 tuần)</i><br>',
                'messager' => [
                    1 => '<br><img src="public\assets\frontend\images\logos\anh-icon-vui.jpg" width="100" /><br>Thi đạt',
                    2 => '<br><img src="public\assets\frontend\images\logos\anh-icon-buon.jpg" width="100" /><br>( Kiểm tra lại sau 2 ngày )',
                    3 => '<br><img src="public\assets\frontend\images\logos\anh-icon-buon.jpg" width="100" /><br>( Đào tạo lại màu dây 1 tuần )'
                ],
                'time' => 5,
                'scores' => [96, 90], // điểm đạt
                'data' =>
                [
                    [
                        'group' => '<strong>Bạn hãy chọn đáp án đúng bằng cách tích vào ô có <u>ký hiệu</u> tương ứng với màu dây:</strong><br>',
                        'point' => 1.8,
                        'width' => 3,
                        'random' => 0,
                        'questions' =>  [
                            [
                                'id' => 1,
                                'name' => 'Màu Đỏ',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\do.png',
                                'width_image' => 70,
                                'answer' => 'R',
                                'answer_list' => ['O', 'P', 'R', 'Y'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 2,
                                'name' => 'Màu Đen',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\den.png',
                                'width_image' => 70,
                                'answer' => 'B',
                                'answer_list' => ['B', 'Br', 'R', 'Gr'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 3,
                                'name' => 'Màu Xanh',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh.png',
                                'width_image' => 70,
                                'answer' => 'L',
                                'answer_list' => ['L', 'Lg', 'G', 'Sb'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'

                            ],
                            [
                                'id' => 4,
                                'name' => 'Màu Nâu',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\nau.png',
                                'width_image' => 70,
                                'answer' => 'Br',
                                'answer_list' => ['Br', 'B', 'Gr', 'O'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'

                            ],
                            [
                                'id' => 5,
                                'name' => 'Màu vàng',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\vang.png',
                                'width_image' => 70,
                                'answer' => 'Y',
                                'answer_list' => ['O', 'P', 'R', 'Y'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'

                            ],
                            [
                                'id' => 6,
                                'name' => 'Màu xanh lá cây',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacay.png',
                                'width_image' => 70,
                                'answer' => 'G',
                                'answer_list' => ['G', 'L', 'Lg', 'Sb'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'

                            ],
                            [
                                'id' => 7,
                                'name' => 'Màu xanh lộc non',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon.png',
                                'width_image' => 70,
                                'answer' => 'Lg',
                                'answer_list' => ['G', 'L', 'Lg', 'Sb'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'

                            ],
                            [
                                'id' => 8,
                                'name' => 'Màu cam',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\cam.png',
                                'width_image' => 70,
                                'answer' => 'O',
                                'answer_list' => ['O', 'B', 'Y', 'W'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 9,
                                'name' => 'Màu xám',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xam.png',
                                'width_image' => 70,
                                'answer' => 'Gr',
                                'answer_list' => ['Br', 'Gr', 'R', 'B'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 10,
                                'name' => 'Màu Hồng',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\hong.png',
                                'width_image' => 70,
                                'answer' => 'P',
                                'answer_list' => ['O', 'P', 'R', 'Y'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 11,
                                'name' => 'Màu xanh da trời',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhdatroi.png',
                                'width_image' => 70,
                                'answer' => 'Sb',
                                'answer_list' => ['G', 'L', 'Lg', 'Sb'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'

                            ],
                            [
                                'id' => 12,
                                'name' => 'Màu Trắng',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\trang.png',
                                'width_image' => 70,
                                'answer' => 'W',
                                'answer_list' => ['Gr', 'B', 'O', 'W'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'

                            ],
                            [
                                'id' => 13,
                                'name' => 'Màu tím',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\tim.png',
                                'width_image' => 70,
                                'answer' => 'V',
                                'answer_list' => ['O', 'P', 'V', 'Y'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'

                            ],
                            [
                                'id' => 14,
                                'name' => 'Đỏ - Trắng',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\dotrang.png',
                                'width_image' => 70,
                                'answer' => 'RW',
                                'answer_list' => ['RW', 'WR', 'WV', 'WG'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'

                            ],
                            [
                                'id' => 15,
                                'name' => 'Đỏ - Đen',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\doden.png',
                                'width_image' => 70,
                                'answer' => 'RB',
                                'answer_list' => ['RB', 'BR', 'RY', 'RG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 16,
                                'name' => 'Đỏ - Vàng',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\dovang.png',
                                'width_image' => 70,
                                'answer' => 'RY',
                                'answer_list' => ['RB', 'YR', 'RY', 'RG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 17,
                                'name' => 'Đỏ - Xanh lá cây',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\doxanhlacay.png',
                                'width_image' => 70,
                                'answer' => 'RG',
                                'answer_list' => ['RB', 'RL', 'RY', 'RG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 18,
                                'name' => 'Đỏ - Xanh',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\doxanh.png',
                                'width_image' => 70,
                                'answer' => 'RL',
                                'answer_list' => ['RB', 'RL', 'RY', 'RG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 19,
                                'name' => 'Vàng - Đỏ',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\vangdo.png',
                                'width_image' => 70,
                                'answer' => 'YR',
                                'answer_list' => ['YR', 'YG', 'RY', 'YL'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'

                            ],
                            [
                                'id' => 20,
                                'name' => 'Vàng - Đen',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\vangden.png',
                                'width_image' => 70,
                                'answer' => 'YB',
                                'answer_list' => ['YR', 'YB', 'RY', 'BY'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 21,
                                'name' => 'Vàng - Xanh lá cây',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\vangxanhlacay.png',
                                'width_image' => 70,
                                'answer' => 'YG',
                                'answer_list' => ['YR', 'YG', 'RY', 'BY'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 22,
                                'name' => 'Vàng - Xanh',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\vangxanh.png',
                                'width_image' => 70,
                                'answer' => 'YL',
                                'answer_list' => ['YL', 'YB', 'YG', 'YW'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 23,
                                'name' => 'Vàng - Trắng',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\vangtrang.png',
                                'width_image' => 70,
                                'answer' => 'YW',
                                'answer_list' => ['YL', 'WY', 'YG', 'YW'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 24,
                                'name' => 'Xanh lá cây- Trắng',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacaytrang.png',
                                'width_image' => 70,
                                'answer' => 'GW',
                                'answer_list' => ['GW', 'WR', 'GB', 'WG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'

                            ],
                            [
                                'id' => 25,
                                'name' => 'Xanh lá cây- Đỏ',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacaydo.png',
                                'width_image' => 70,
                                'answer' => 'GR',
                                'answer_list' => ['GR', 'RG', 'GB', 'GL'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'

                            ],
                            [
                                'id' => 26,
                                'name' => 'Xanh lá cây- Vàng',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacayvang.png',
                                'width_image' => 70,
                                'answer' => 'GY',
                                'answer_list' => ['GY', 'GL', 'GB', 'GW'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'

                            ],
                            [
                                'id' => 27,
                                'name' => 'Xanh lá cây- Đen',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacayden.png',
                                'width_image' => 70,
                                'answer' => 'GB',
                                'answer_list' => ['GY', 'GL', 'GB', 'BG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 28,
                                'name' => 'Xanh lá cây- Xanh',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacayxanh.png',
                                'width_image' => 70,
                                'answer' => 'GL',
                                'answer_list' => ['LG', 'GL', 'GB', 'GW'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 29,
                                'name' => 'Xanh-Trắng',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-trang.png',
                                'width_image' => 70,
                                'answer' => 'LW',
                                'answer_list' => ['LW', 'WL', 'LgW', 'GW'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'

                            ],
                            [
                                'id' => 30,
                                'name' => 'Xanh-Đỏ',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-do.png',
                                'width_image' => 70,
                                'answer' => 'LR',
                                'answer_list' => ['LR', 'RL', 'LgR', 'GR'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'

                            ],
                            [
                                'id' => 31,
                                'name' => 'Xanh-Vàng',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-vang.png',
                                'width_image' => 70,
                                'answer' => 'LY',
                                'answer_list' => ['LY', 'YL', 'GY', 'LB'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'

                            ],
                            [
                                'id' => 32,
                                'name' => 'Xanh-Đen',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-den.png',
                                'width_image' => 70,
                                'answer' => 'LB',
                                'answer_list' => ['LgB', 'BL', 'GB', 'LB'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'

                            ],
                            [
                                'id' => 33,
                                'name' => 'Xanh-Xanh lá cây',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-xanhlacay.png',
                                'width_image' => 70,
                                'answer' => 'LG',
                                'answer_list' => ['LG', 'GL', 'LY', 'LB'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'

                            ],
                            [
                                'id' => 34,
                                'name' => 'Nâu-Trắng',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\nau-trang.png',
                                'width_image' => 70,
                                'answer' => 'BrW',
                                'answer_list' => ['BrW', 'GrW', 'BrR', 'BrY'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 35,
                                'name' => 'Nâu-Đỏ',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\nau-do.png',
                                'width_image' => 70,
                                'answer' => 'BrR',
                                'answer_list' => ['BrW', 'GrR', 'BrR', 'BrY'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 36,
                                'name' => 'Nâu-Vàng',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\nau-vang.png',
                                'width_image' => 70,
                                'answer' => 'BrY',
                                'answer_list' => ['BrW', 'GrR', 'BrR', 'BrY'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 37,
                                'name' => 'Nâu-Đen',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\nau-den.png',
                                'width_image' => 70,
                                'answer' => 'BrB',
                                'answer_list' => ['BrW', 'GrR', 'BrB', 'BrY'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 38,
                                'name' => 'Xanh lộc non-Đỏ',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-do.png',
                                'width_image' => 70,
                                'answer' => 'LgR',
                                'answer_list' => ['LgW', 'LgR', 'LR', 'GR'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 39,
                                'name' => 'Xanh lộc non-Vàng',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-vang.png',
                                'width_image' => 70,
                                'answer' => 'LgY',
                                'answer_list' => ['LgW', 'LgY', 'LY', 'GY'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 40,
                                'name' => 'Xanh lộc non-Đen',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-den.png',
                                'width_image' => 70,
                                'answer' => 'LgB',
                                'answer_list' => ['LB', 'LgR', 'LgB', 'GB'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 41,
                                'name' => 'Xanh lộc non-Trắng',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-trang.png',
                                'width_image' => 70,
                                'answer' => 'LgW',
                                'answer_list' => ['LgW', 'GW', 'LW', 'GY'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 42,
                                'name' => 'Đen-Trắng',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\den-trang.png',
                                'width_image' => 70,
                                'answer' => 'BW',
                                'answer_list' => ['BW', 'WB', 'PW', 'WG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 43,
                                'name' => 'Đen-Đỏ',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\den-do.png',
                                'width_image' => 70,
                                'answer' => 'BR',
                                'answer_list' => ['BW', 'BR', 'RB', 'BY'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 44,
                                'name' => 'Đen-Vàng',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\den-vang.png',
                                'width_image' => 70,
                                'answer' => 'BY',
                                'answer_list' => ['BW', 'BR', 'YB', 'BY'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'

                            ],
                            [
                                'id' => 45,
                                'name' => 'Đen-Xanh',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\den-xanh.png',
                                'width_image' => 70,
                                'answer' => 'BL',
                                'answer_list' => ['BL', 'LB', 'BY', 'BW'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'

                            ],
                            [
                                'id' => 46,
                                'name' => 'Đen-Xanh lá cây',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\den-xanhlacay.png',
                                'width_image' => 70,
                                'answer' => 'BG',
                                'answer_list' => ['BL', 'BG', 'BY', 'GB'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 47,
                                'name' => 'Trắng - Đỏ',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-do.png',
                                'width_image' => 70,
                                'answer' => 'WR',
                                'answer_list' => ['WR', 'RW', 'WY', 'WV'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 48,
                                'name' => 'Trắng - Xanh',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-xanh.png',
                                'width_image' => 70,
                                'answer' => 'WL',
                                'answer_list' => ['WY', 'LW', 'WL', 'WV'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 49,
                                'name' => 'Trắng - Vàng',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-vang.png',
                                'width_image' => 70,
                                'answer' => 'WY',
                                'answer_list' => ['WY', 'YW', 'WL', 'WR'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 50,
                                'name' => 'Trắng - Tím',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-tim.png',
                                'width_image' => 70,
                                'answer' => 'WV',
                                'answer_list' => ['WY', 'WV', 'WL', 'WR'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 51,
                                'name' => 'Trắng-Xanh lá cây',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-xanhlacay.png',
                                'width_image' => 70,
                                'answer' => 'WG',
                                'answer_list' => ['WG', 'WV', 'WL', 'GW'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'

                            ],
                            [
                                'id' => 52,
                                'name' => 'Cam - Trắng',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\cam-trang.png',
                                'width_image' => 70,
                                'answer' => 'OW',
                                'answer_list' => ['GW', 'OW', 'WY', 'GW'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 53,
                                'name' => 'Hồng - Đen',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\hong-den.png',
                                'width_image' => 70,
                                'answer' => 'PB',
                                'answer_list' => ['PB', 'BY', 'LgB', 'GB'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'

                            ],
                            [
                                'id' => 54,
                                'name' => 'Xám - Đỏ',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xam-do.png',
                                'width_image' => 70,
                                'answer' => 'GrR',
                                'answer_list' => ['BrW', 'GrR', 'BrR', 'BrY'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 55,
                                'name' => 'Xám - Đen',
                                'point' => 1.815,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xam-den.png',
                                'width_image' => 70,
                                'answer' => 'GrB',
                                'answer_list' => ['BrW', 'GrB', 'BrB', 'GrY'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'

                            ],
                        ],
                    ]
                ]
            ],
            2 => [
                'title' => 'Bài kiểm tra kiến thức công nhân mới vào cắm',
                'description' => '<i>Điểm đạt: 80 điểm trở lên </i><br>
                                           <i>Từ 60->80 điểm: kiểm tra lại</i><br>
                                           <i>Từ 50->59 điểm: đào tạo lại</i><br>
                                           <i>Dưới 50 điểm: Không đạt</i><br>',
                'messager' => [
                    1 => '<br>Điểm đạt: 80 điểm trở lên<br><img src="public\assets\frontend\images\logos\anh-icon-vui.jpg" width="100" />',
                    2 => '<br>Từ 60->80 điểm: kiểm tra lại<br><img src="public\assets\frontend\images\logos\anh-icon-buon.jpg" width="100" />',
                    3 => '<br>Từ 50->59 điểm: đào tạo lại. <br>Dưới 50 điểm: Không đạt<br><img src="public\assets\frontend\images\logos\anh-icon-buon.jpg" width="100" />'
                ],
                'time' => 5,
                'scores' => [80, 60], // điểm đạt
                'data' =>
                [
                    [
                        'group' => '<div><h5>I) Bạn hãy chọn đáp án đúng bằng cách tích vào ô có ký hiệu tương ứng với màu dây (20 điểm): (1 câu đúng 1 điểm)</h5></div>',
                        'point' => 20,
                        'width' => 3,
                        'random' => 20,
                        'questions' =>  [
                            [
                                'id' => 1,
                                'name' => 'Đỏ - Trắng',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\dotrang.png',
                                'width_image' => 70,
                                'answer' => 'RW',
                                'answer_list' => ['RW', 'WR', 'WV', 'WG'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 2,
                                'name' => 'Đỏ - Đen',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\doden.png',
                                'width_image' => 70,
                                'answer' => 'RB',
                                'answer_list' => ['RB', 'BR', 'RY', 'RG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 3,
                                'name' => 'Đỏ - Vàng',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\dovang.png',
                                'width_image' => 70,
                                'answer' => 'RY',
                                'answer_list' => ['RB', 'YR', 'RY', 'RG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 4,
                                'name' => 'Đỏ - Xanh lá cây',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\doxanhlacay.png',
                                'width_image' => 70,
                                'answer' => 'RG',
                                'answer_list' => ['RB', 'RL', 'RY', 'RG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 5,
                                'name' => 'Đỏ - Xanh',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\doxanh.png',
                                'width_image' => 70,
                                'answer' => 'RL',
                                'answer_list' => ['RB', 'RL', 'RY', 'RG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 6,
                                'name' => 'Vàng - Đỏ',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\vangdo.png',
                                'width_image' => 70,
                                'answer' => 'YR',
                                'answer_list' => ['YR', 'YG', 'RY', 'YL'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 7,
                                'name' => 'Vàng - Đen',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\vangden.png',
                                'width_image' => 70,
                                'answer' => 'YB',
                                'answer_list' => ['YR', 'YB', 'RY', 'BY'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 8,
                                'name' => 'Vàng - Xanh lá cây',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\vangxanhlacay.png',
                                'width_image' => 70,
                                'answer' => 'YG',
                                'answer_list' => ['YR', 'YG', 'RY', 'BY'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 9,
                                'name' => 'Vàng - Xanh',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\vangxanh.png',
                                'width_image' => 70,
                                'answer' => 'YL',
                                'answer_list' => ['YL', 'YB', 'YG', 'YW'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 10,
                                'name' => 'Vàng - Trắng',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\vangtrang.png',
                                'width_image' => 70,
                                'answer' => 'YW',
                                'answer_list' => ['YL', 'WY', 'YG', 'YW'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 11,
                                'name' => 'Xanh lá cây- Trắng',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacaytrang.png',
                                'width_image' => 70,
                                'answer' => 'GW',
                                'answer_list' => ['GW', 'WR', 'GB', 'WG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 12,
                                'name' => 'Xanh lá cây- Đỏ',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacaydo.png',
                                'width_image' => 70,
                                'answer' => 'GR',
                                'answer_list' => ['GR', 'RG', 'GB', 'GL'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 13,
                                'name' => 'Xanh lá cây- Vàng',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacayvang.png',
                                'width_image' => 70,
                                'answer' => 'GY',
                                'answer_list' => ['GY', 'GL', 'GB', 'GW'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'

                            ],
                            [
                                'id' => 14,
                                'name' => 'Xanh lá cây- Đen',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacayden.png',
                                'width_image' => 70,
                                'answer' => 'GB',
                                'answer_list' => ['GY', 'GL', 'GB', 'BG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 15,
                                'name' => 'Xanh lá cây- Xanh',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacayxanh.png',
                                'width_image' => 70,
                                'answer' => 'GL',
                                'answer_list' => ['LG', 'GL', 'GB', 'GW'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 16,
                                'name' => 'Xanh-Trắng',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-trang.png',
                                'width_image' => 70,
                                'answer' => 'LW',
                                'answer_list' => ['LW', 'WL', 'LgW', 'GW'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 17,
                                'name' => 'Xanh-Đỏ',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-do.png',
                                'width_image' => 70,
                                'answer' => 'LR',
                                'answer_list' => ['LR', 'RL', 'LgR', 'GR'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 18,
                                'name' => 'Xanh-Vàng',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-vang.png',
                                'width_image' => 70,
                                'answer' => 'LY',
                                'answer_list' => ['LY', 'YL', 'GY', 'LB'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 19,
                                'name' => 'Xanh-Đen',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-den.png',
                                'width_image' => 70,
                                'answer' => 'LB',
                                'answer_list' => ['LgB', 'BL', 'GB', 'LB'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 20,
                                'name' => 'Xanh-Xanh lá cây',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-xanhlacay.png',
                                'width_image' => 70,
                                'answer' => 'LG',
                                'answer_list' => ['LG', 'GL', 'LY', 'LB'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'

                            ],
                            [
                                'id' => 21,
                                'name' => 'Nâu-Trắng',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\nau-trang.png',
                                'width_image' => 70,
                                'answer' => 'BrW',
                                'answer_list' => ['BrW', 'GrW', 'BrR', 'BrY'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 22,
                                'name' => 'Nâu-Đỏ',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\nau-do.png',
                                'width_image' => 70,
                                'answer' => 'BrR',
                                'answer_list' => ['BrW', 'GrR', 'BrR', 'BrY'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 23,
                                'name' => 'Nâu-Vàng',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\nau-vang.png',
                                'width_image' => 70,
                                'answer' => 'BrY',
                                'answer_list' => ['BrW', 'GrR', 'BrR', 'BrY'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 24,
                                'name' => 'Nâu-Đen',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\nau-den.png',
                                'width_image' => 70,
                                'answer' => 'BrB',
                                'answer_list' => ['BrW', 'GrR', 'BrB', 'BrY'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 25,
                                'name' => 'Xanh lộc non-Đỏ',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-do.png',
                                'width_image' => 70,
                                'answer' => 'LgR',
                                'answer_list' => ['LgW', 'LgR', 'LR', 'GR'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 26,
                                'name' => 'Xanh lộc non-Vàng',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-vang.png',
                                'width_image' => 70,
                                'answer' => 'LgY',
                                'answer_list' => ['LgW', 'LgY', 'LY', 'GY'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 27,
                                'name' => 'Xanh lộc non-Đen',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-den.png',
                                'width_image' => 70,
                                'answer' => 'LgB',
                                'answer_list' => ['LB', 'LgR', 'LgB', 'GB'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 28,
                                'name' => 'Xanh lộc non-Trắng',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-trang.png',
                                'width_image' => 70,
                                'answer' => 'LgW',
                                'answer_list' => ['LgW', 'GW', 'LW', 'GY'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 29,
                                'name' => 'Đen-Trắng',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\den-trang.png',
                                'width_image' => 70,
                                'answer' => 'BW',
                                'answer_list' => ['BW', 'WB', 'PW', 'WG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 30,
                                'name' => 'Đen-Đỏ',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\den-do.png',
                                'width_image' => 70,
                                'answer' => 'BR',
                                'answer_list' => ['BW', 'BR', 'RB', 'BY'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 31,
                                'name' => 'Đen-Vàng',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\den-vang.png',
                                'width_image' => 70,
                                'answer' => 'BY',
                                'answer_list' => ['BW', 'BR', 'YB', 'BY'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 32,
                                'name' => 'Đen-Xanh',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\den-xanh.png',
                                'width_image' => 70,
                                'answer' => 'BL',
                                'answer_list' => ['BL', 'LB', 'BY', 'BW'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'

                            ],
                            [
                                'id' => 33,
                                'name' => 'Đen-Xanh lá cây',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\den-xanhlacay.png',
                                'width_image' => 70,
                                'answer' => 'BG',
                                'answer_list' => ['BL', 'BG', 'BY', 'GB'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 34,
                                'name' => 'Trắng - Đỏ',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-do.png',
                                'width_image' => 70,
                                'answer' => 'WR',
                                'answer_list' => ['WR', 'RW', 'WY', 'WV'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 35,
                                'name' => 'Trắng - Xanh',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-xanh.png',
                                'width_image' => 70,
                                'answer' => 'WL',
                                'answer_list' => ['WY', 'LW', 'WL', 'WV'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 36,
                                'name' => 'Trắng - Vàng',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-vang.png',
                                'width_image' => 70,
                                'answer' => 'WY',
                                'answer_list' => ['WY', 'YW', 'WL', 'WR'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 37,
                                'name' => 'Trắng - Tím',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-tim.png',
                                'width_image' => 70,
                                'answer' => 'WV',
                                'answer_list' => ['WY', 'WV', 'WL', 'WR'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 38,
                                'name' => 'Trắng-Xanh lá cây',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-xanhlacay.png',
                                'width_image' => 70,
                                'answer' => 'WG',
                                'answer_list' => ['WG', 'WV', 'WL', 'GW'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 39,
                                'name' => 'Cam - Trắng',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\cam-trang.png',
                                'width_image' => 70,
                                'answer' => 'OW',
                                'answer_list' => ['GW', 'OW', 'WY', 'GW'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 40,
                                'name' => 'Hồng - Đen',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\hong-den.png',
                                'width_image' => 70,
                                'answer' => 'PB',
                                'answer_list' => ['PB', 'BY', 'LgB', 'GB'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 41,
                                'name' => 'Xám - Đỏ',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xam-do.png',
                                'width_image' => 70,
                                'answer' => 'GrR',
                                'answer_list' => ['BrW', 'GrR', 'BrR', 'BrY'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 42,
                                'name' => 'Xám - Đen',
                                'point' => 1,
                                'path_image' => 'public\assets\frontend\images\anh-mau-day\xam-den.png',
                                'width_image' => 70,
                                'answer' => 'GrB',
                                'answer_list' => ['BrW', 'GrB', 'BrB', 'GrY'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ]
                        ]
                    ],
                    [
                        'group' => '<div><h5>II) Bạn hãy chọn đáp án đúng bằng cách tích vào ô có hình ảnh tương ứng (20 điểm): (1 câu đúng 5 điểm)</h5></div>',
                        'point' => 5,
                        'width' => 1,
                        'random' => 0,
                        'questions' => [
                            [
                                'id' => 43,
                                'name' => 'Tanshi cái hàng doitsu',
                                'point' => 5,
                                'path_image' => null,
                                'width_image' => 70,
                                'answer' => 'public\assets\frontend\images\tanshi\tanshi-cai-doitsu.png',
                                'answer_list' => [
                                    'public\assets\frontend\images\tanshi\tanshi-cai-doitsu.png',
                                    'public\assets\frontend\images\tanshi\tanshi-duc-yazaky.png',
                                    'public\assets\frontend\images\tanshi\tanshi-cai-yazaky.png',
                                    'public\assets\frontend\images\tanshi\tanshi-duc-doitsu.png',
                                ],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 70,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 44,
                                'name' => 'Tanshi đực hàng doitsu',
                                'point' => 5,
                                'path_image' => null,
                                'width_image' => 70,
                                'answer' => 'public\assets\frontend\images\tanshi\tanshi-duc-doitsu.png',
                                'answer_list' => [
                                    'public\assets\frontend\images\tanshi\tanshi-cai-doitsu.png',
                                    'public\assets\frontend\images\tanshi\tanshi-duc-yazaky.png',
                                    'public\assets\frontend\images\tanshi\tanshi-cai-yazaky.png',
                                    'public\assets\frontend\images\tanshi\tanshi-duc-doitsu.png',
                                ],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 70,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 45,
                                'name' => 'Tanshi cái hàng Yazaky',
                                'point' => 5,
                                'path_image' => null,
                                'width_image' => 70,
                                'answer' => 'public\assets\frontend\images\tanshi\tanshi-cai-yazaky.png',
                                'answer_list' => [
                                    'public\assets\frontend\images\tanshi\tanshi-cai-doitsu.png',
                                    'public\assets\frontend\images\tanshi\tanshi-duc-yazaky.png',
                                    'public\assets\frontend\images\tanshi\tanshi-cai-yazaky.png',
                                    'public\assets\frontend\images\tanshi\tanshi-duc-doitsu.png',
                                ],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 70,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 46,
                                'name' => 'Tanshi đực hàng Yazaky',
                                'point' => 5,
                                'path_image' => null,
                                'width_image' => 70,
                                'answer' => 'public\assets\frontend\images\tanshi\tanshi-duc-yazaky.png',
                                'answer_list' => [
                                    'public\assets\frontend\images\tanshi\tanshi-cai-doitsu.png',
                                    'public\assets\frontend\images\tanshi\tanshi-duc-yazaky.png',
                                    'public\assets\frontend\images\tanshi\tanshi-cai-yazaky.png',
                                    'public\assets\frontend\images\tanshi\tanshi-duc-doitsu.png',
                                ],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 70,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                        ],
                    ],
                    [
                        'group' => '<div><h5>III) Bạn hãy tích vào câu trả lời đúng (20 điểm): (1 câu đúng 4 điểm)</h5></div>',
                        'point' => 4,
                        'width' => 1,
                        'random' => 0,
                        'questions' => [
                            [
                                'id' => 47,
                                'name' => 'Khi bắt đầu vào làm việc đầu giờ sáng và đầu giờ chiều,người thao tác cần phải làm gì ?',
                                'point' => 4,
                                'path_image' => null,
                                'width_image' => 70,
                                'answer' => 'Kéo cân với lực khoảng 2kg',
                                'answer_list' => ['Kéo cân với lực khoảng 2kg', '5S', 'Chuẩn bị linh kiện', 'Rút dây'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 48,
                                'name' => 'Chủng loại conecter nào sau khi cắm xong kéo lại 1 lực 2kg theo 5 hướng ?',
                                'point' => 4,
                                'path_image' => null,
                                'width_image' => 70,
                                'answer' => 'DRC & HD',
                                'answer_list' => ['DRC & HD', 'Doitsu', 'Yazaky', 'Tất cả'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 49,
                                'name' => 'Kiểm tra tụt chốt tại công đoạn cắm phương pháp nào là đúng',
                                'point' => 4,
                                'path_image' => null,
                                'width_image' => 70,
                                'answer' => 'Nhìn bằng mắt thường và Soi đèn pin',
                                'answer_list' => ['Nhìn bằng mắt thường', 'Soi đèn pin', 'Kiểm tra bằng máy thông điện', 'Nhìn bằng mắt thường và Soi đèn pin'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'

                            ],
                            [
                                'id' => 50,
                                'name' => 'Bạn hãy cho biết tiêu chuẩn cắm hạt umesen ( hạt đỏ , hạt trắng )',
                                'point' => 4,
                                'path_image' => null,
                                'width_image' => 70,
                                'answer' => '0→1mm',
                                'answer_list' => ['0→1mm', '0mm', '1mm', '0.1mm'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'

                            ],
                            [
                                'id' => 51,
                                'name' => 'Khi phát sinh linh kiện thiếu,thừa ta phải làm gì?',
                                'point' => 4,
                                'path_image' => null,
                                'width_image' => 70,
                                'answer' => 'Tất cả',
                                'answer_list' => ['Kiểm tra lại', 'Đánh dấu lại', 'Báo cấp trên', 'Tất cả'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                        ],
                    ],
                    [
                        'group' => '<div><h5>IV) Bạn hãy tích vào câu trả lời đúng (20 điểm): (1 câu đúng 5 điểm)</h5></div>',
                        'point' => 5,
                        'width' => 1,
                        'random' => 4,
                        'questions' => [
                            [
                                'id' => 52,
                                'name' => ' Khi cắm 2 dây cùng màu ta phải (  … ) vào EDP và sơ đồ cắm. ',
                                'point' => 5,
                                'path_image' => null,
                                'width_image' => 70,
                                'answer' => 'Đánh dấu',
                                'answer_list' => ['Đánh dấu', 'lộc màu dây', 'Không đánh dấu', 'Cắm luôn'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 53,
                                'name' => 'Connector doitsu cắm dây dựa vào (  …  ). ',
                                'point' => 5,
                                'path_image' => null,
                                'width_image' => 70,
                                'answer' => 'Số và chữ',
                                'answer_list' => ['Số và chữ', 'Hướng', 'Số', 'Chữ'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 54,
                                'name' => ' Connector yazaky cắm dây dựa vào(  … )trên connector và cắm theo quy trình (  … ). ',
                                'point' => 5,
                                'path_image' => null,
                                'width_image' => 70,
                                'answer' => 'hướng lẫy,Đếm tanshi từ bên gần nhất',
                                'answer_list' => ['hướng lẫy,Đếm tanshi từ phải sang trái', 'hướng lẫy,Đếm tanshi từ trái sang phải', 'hướng lẫy,Đếm tanshi từ bên gần nhất', 'Số,Đếm tanshi từ trái sang phải'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 55,
                                'name' => 'Cách cầm dây để cắm áp dụng với : dây đơn ( …) ',
                                'point' => 5,
                                'path_image' => null,
                                'width_image' => 70,
                                'answer' => 'Cầm cả bó dây để cắm',
                                'answer_list' => ['Nhặt từng dây để cắm', 'Cầm cả bó dây để cắm', 'lộc theo màu dây rồi cắm'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 56,
                                'name' => 'Cách cầm dây để cắm áp dụng với : dây xoắn(  … ) ',
                                'point' => 5,
                                'path_image' => null,
                                'width_image' => 70,
                                'answer' => 'lộc theo màu dây rồi cắm',
                                'answer_list' => ['lộc theo màu dây rồi cắm', 'Cầm cả bó dây để cắm', 'Nhặt từng dây để cắm'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 57,
                                'name' => 'Cách cầm dây để cắm áp dụng với : dây chập bộ( …) ',
                                'point' => 5,
                                'path_image' => null,
                                'width_image' => 70,
                                'answer' => 'Nhặt từng dây để cắm',
                                'answer_list' => ['Nhặt từng dây để cắm', 'Cầm cả bó dây để cắm', 'lộc theo màu dây rồi cắm'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                        ],
                    ],
                    [
                        'group' => '<div><h5>V) Hãy sắp xếp thứ tự thao tác ở dưới cho đúng quy trình (10 điểm): (1 câu đúng 5 điểm)</h5></div>',
                        'point' => 5,
                        'width' => 1,
                        'random' => 0,
                        'questions' => [
                            [
                                'id' => 58,
                                'name' => 'Thao tác cắm conecter doitsu từ 2→12 chân: </br> a. Tiến hành lắp USJ vào conecter </br>  b.Nhìn theo số để cắm dây điện vào connector đến khi có tiếng kêu cạch thì kéo lại với lực thẳng = 2kg </br> c.Nhìn lại xem các tanshi có bằng mặt,điểm sáng có đều nhau không </br> d.Check tanshi xem có bằng nhau không ',
                                'point' => 5,
                                'path_image' => null,
                                'width_image' => 70,
                                'answer' => 'b→d→a→c',
                                'answer_list' => ['b→d→a→c', 'c→a→d→b', 'b→d→c→a', 'c→d→a→b'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'

                            ],
                            [
                                'id' => 59,
                                'name' => 'Thao tác cắm connector DRC&HD </br> a.Xác nhận số lượng hạt umesen đã được cắm sau đó đếm tanshi xem đã đủ chân chưa. </br> b.Cắm dây điện vào connector đến khi có tiếng kêu cạch thì kéo lại với lực = 2kg theo 5  hướng : trên,dưới,trái,phải,thẳng </br> c.Kiểm tra xem tanshi có bằng mặt không,điểm sáng có đều nhau và đủ chân không',
                                'point' => 5,
                                'path_image' => null,
                                'width_image' => 70,
                                'answer' => '.b→a→c',
                                'answer_list' => ['.b→a→c', 'c→a→b', 'c→b→a'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                        ],
                    ],
                    [
                        'group' => '<div><h5>VI) Chọn câu trả lời đúng (10 điểm): (1 câu đúng 2,5 điểm)  </br>   Hãy nêu ý nghĩa của việc phân loại Itemslip theo các màu ?</h5></div>',
                        'point' => 2.5,
                        'width' => 1,
                        'random' => 0,
                        'questions' => [
                            [
                                'id' => 60,
                                'name' => 'Itemslip Màu trắng ',
                                'point' => 2.5,
                                'path_image' => null,
                                'width_image' => 70,
                                'answer' => 'Hiển thị hàng ok',
                                'answer_list' => ['Hiển thị hàng ok', 'Hiển thị hàng bị thiếu nguyên vật liệu', 'Hiển thị là mã hàng bộ dây đầu'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 61,
                                'name' => 'Itemslip  Màu xanh  ',
                                'point' => 2.5,
                                'path_image' => null,
                                'width_image' => 70,
                                'answer' => 'Hiển thị hàng bị thiếu nguyên vật liệu',
                                'answer_list' => ['Hiển thị hàng ok', 'Hiển thị hàng bị thiếu nguyên vật liệu', 'Hiển thị là mã hàng bộ dây đầu'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 62,
                                'name' => 'Itemslip Màu vàng  ',
                                'point' => 2.5,
                                'path_image' => null,
                                'width_image' => 70,
                                'answer' => 'Hiển thị là mã hàng bộ dây đầu',
                                'answer_list' => ['Hiển thị hàng ok', 'Hiển thị hàng bị thiếu nguyên vật liệu', 'Hiển thị là mã hàng bộ dây đầu'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 63,
                                'name' => 'Bạn hãy nêu quy trình xử lý hàng lỗi ?',
                                'point' => 2.5,
                                'path_image' => null,
                                'width_image' => 70,
                                'answer' => 'Đánh dấu băng dính đỏ tại vị trí NG→ Báo cáo cấp trên để xử lý',
                                'answer_list' => ['Đánh dấu băng dính đỏ tại vị trí NG→ Báo cáo cấp trên để xử lý', 'Báo cáo cấp trên để xử lý', 'Đánh dấu băng dính đỏ tại vị trí NG', 'Hỏi bạn bên cạnh'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                        ],
                    ],
                ],
            ],
            3 => [
                'title' => 'Bài kiểm tra năng lực nhìn bản vẽ',
                'description' => '<i>Điểm đạt: 90->100 điểm</i><br>
                               <i>Từ 80->90 điểm: kiểm tra lại sau 2 ngày (nếu không đạt sẽ được đào tạo lại)</i><br>
                               <i>Dưới 80 điểm: Không đạt ( đào tạo lại màu dây 1 tuần)</i><br>',
                'messager' => [
                    1 => '<br>Điểm đạt: 90->100 điểm<br><img src="public\assets\frontend\images\logos\anh-icon-vui.jpg" width="100" />',
                    2 => '<br>Từ 80->90 điểm: kiểm tra lại sau 2 ngày<br><img src="public\assets\frontend\images\logos\anh-icon-buon.jpg" width="100" />',
                    3 => '<br>Dưới 80 điểm: Không đạt<br><img src="public\assets\frontend\images\logos\anh-icon-buon.jpg" width="100" />'
                ],
                'time' => 10,
                'scores' => [90, 80], // điểm đạt
                'data' =>
                [
                    [
                        'group' => '',
                        'point' => 4.76,
                        'width' => 3,
                        'random' => 0,
                        'questions' =>
                        [
                            [
                                'id' => 1,
                                'name' => 'Maku được in mấy lần ?',
                                'point' => 4.76,
                                'path_image' => 'public\assets\frontend\images\ktnq\1_ktnq.png',
                                'width_image' => 70,
                                'answer' => 'Maku in 2 lần',
                                'answer_list' => ['Maku in 1 lần', 'Maku in 2 lần', 'Không có maku'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 2,
                                'name' => 'Kích thước 10mm thể hiện điều gi?',
                                'point' => 4.76,
                                'path_image' => 'public\assets\frontend\images\ktnq\2_ktnq.png',
                                'width_image' => 70,
                                'answer' => 'Khoảng cách thắt macku 10mm',
                                'answer_list' => ['Khoảng cách thắt macku 10mm', 'Khoảng cách quấn băng dính 10mm', 'Cả 2 phương án trên'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 3,
                                'name' => 'Quy cách quấn U bằng băng dính là bao nhiêu ?',
                                'point' => 4.76,
                                'path_image' => 'public\assets\frontend\images\ktnq\3_ktnq.png',
                                'width_image' => 70,
                                'answer' => 'Quấn U từ 8~8.5',
                                'answer_list' => ['Quấn U từ 0.8~0.85', 'Quấn U từ 8~8.5', 'Quấn U từ 0.8~8.5'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 4,
                                'name' => 'Khoảng cách quấn nhánh là bao nhiêu ?',
                                'point' => 4.76,
                                'path_image' => 'public\assets\frontend\images\ktnq\4_ktnq.png',
                                'width_image' => 70,
                                'answer' => 'Quấn băng dính nhánh khoảng cách là 50 mm',
                                'answer_list' => ['Quấn băng dính nhánh khoảng cách là 50 mm', 'Quấn băng dính nhánh khoảng cách ~ 50 mm', 'Quấn băng dính nhánh khoảng cách không quá 50 mm'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 5,
                                'name' => 'Điểm bó cố định như thế nào?',
                                'point' => 4.76,
                                'path_image' => 'public\assets\frontend\images\ktnq\5_ktnq.png',
                                'width_image' => 70,
                                'answer' => 'Quấn băng dính lên connerter và đầu chụp hở macku',
                                'answer_list' => ['Quấn băng dính lên connerter kín macku', 'Quấn băng dính lên đầu chụp kín macku', 'Quấn băng dính lên connerter và đầu chụp hở macku'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 6,
                                'name' => 'Loa có yêu cầu gì ?',
                                'point' => 4.76,
                                'path_image' => 'public\assets\frontend\images\ktnq\6_ktnq.png',
                                'width_image' => 70,
                                'answer' => 'Quấn kín băng dính kín loa',
                                'answer_list' => ['Quấn kín băng dính kín loa', 'Quấn kín băng dính hở loa', 'Không quấn băng dính lên loa'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 7,
                                'name' => 'Cách quấn băng dính đầu ống là bao nhiêu?',
                                'point' => 4.76,
                                'path_image' => 'public\assets\frontend\images\ktnq\7_ktnq.png',
                                'width_image' => 70,
                                'answer' => 'Kích Thước ra 30 mm vào 30 mm',
                                'answer_list' => ['Kích Thước ra 30 mm vào 30 mm', 'Kích Thước 30 mm', 'Kích Thước 90 mm'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 8,
                                'name' => 'Tanshi yêu cầu gì ?',
                                'point' => 4.76,
                                'path_image' => 'public\assets\frontend\images\ktnq\8_ktnq.png',
                                'width_image' => 70,
                                'answer' => 'Tanshi nhúng toàn phần',
                                'answer_list' => ['Tanshi nhúng tâm', 'Tanshi nhúng toàn phần', 'Tanshi không nhúng'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 9,
                                'name' => 'Yêu cầu quấn băng dính ống và chân nhánh là bao nhiêu ?',
                                'point' => 4.76,
                                'path_image' => 'public\assets\frontend\images\ktnq\9_ktnq.png',
                                'width_image' => 70,
                                'answer' => 'Quấn nhánh là 10mm,lên ống là 30mm',
                                'answer_list' => ['Quấn nhánh là 30mm,lên ống là 10mm', 'Quấn nhánh là 10mm,lên ống là 30mm', 'Quấn nhánh là 30mm,lên ống là 30mm'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 10,
                                'name' => 'Kí hiệu 1-2-3 nghĩa là gì?',
                                'point' => 4.76,
                                'path_image' => 'public\assets\frontend\images\ktnq\10_ktnq.png',
                                'width_image' => 70,
                                'answer' => 'Vị trí số 1 đầu ống,3 bó cố định, 2 ống xoắn',
                                'answer_list' => ['Vị trí số 1đầu ống,2 bó cố định,3 ống xoắn', 'Vị trí số 2 đầu ống,1 bó cố định, 3 ống xoắn', 'Vị trí số 1 đầu ống,3 bó cố định, 2 ống xoắn'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 11,
                                'name' => 'Tanshi yêu cầu gì ?',
                                'point' => 4.76,
                                'path_image' => 'public\assets\frontend\images\ktnq\11_ktnq.png',
                                'width_image' => 70,
                                'answer' => 'Tanshi nhúng tâm',
                                'answer_list' => ['Tanshi nhúng tâm', 'Tanshi nhúng toàn phần', 'Tanshi không nhúng'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 12,
                                'name' => 'Kích thước 240 mm được hiểu như thế nào?',
                                'point' => 4.76,
                                'path_image' => 'public\assets\frontend\images\ktnq\12_ktnq.png',
                                'width_image' => 70,
                                'answer' => 'Đo từ giữa nhánh đến đầu ống',
                                'answer_list' => ['Đo từ giữa nhánh đến đầu connerter', 'Đo từ giữa nhánh đến chân connerter', 'Đo từ giữa nhánh đến đầu ống'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 13,
                                'name' => 'Tanshi yêu cầu hướng như thế nào ?',
                                'point' => 4.76,
                                'path_image' => 'public\assets\frontend\images\ktnq\13_ktnq.png',
                                'width_image' => 70,
                                'answer' => 'Tanshi ngửa',
                                'answer_list' => ['Tanshi ngửa', 'Tanshi úp', 'Tanshi nghiêng'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 14,
                                'name' => 'Điểm bó này được bó như thế nào?',
                                'point' => 4.76,
                                'path_image' => 'public\assets\frontend\images\ktnq\14_ktnq.png',
                                'width_image' => 70,
                                'answer' => 'Bó vào connerter',
                                'answer_list' => ['Bó vào ống', 'Bó vào connerter', 'Bó vào dây điện'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 15,
                                'name' => 'Cách đo băng dính trắng hàng KOBELCO như thế nào?',
                                'point' => 4.76,
                                'path_image' => 'public\assets\frontend\images\ktnq\15_ktnq.png',
                                'width_image' => 70,
                                'answer' => 'Đo từ giữa băng dính đến giữa băng dính',
                                'answer_list' => ['Đo từ đầu băng dính đến đầu băng dính', 'Đo từ cuối băng dính đến cuối băng dính', 'Đo từ giữa băng dính đến giữa băng dính'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 16,
                                'name' => 'Cách đo tanshi hàng takeuchi?',
                                'point' => 4.76,
                                'path_image' => 'public\assets\frontend\images\ktnq\16_ktnq.png',
                                'width_image' => 70,
                                'answer' => 'Đo từ giữa tanshi',
                                'answer_list' => ['Đo từ đầu tanshi', 'Đo từ giữa tanshi', 'Đo từ chân tanshi'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 17,
                                'name' => 'Cách đo connerter hàng takeuchi?',
                                'point' => 4.76,
                                'path_image' => 'public\assets\frontend\images\ktnq\17_ktnq.png',
                                'width_image' => 70,
                                'answer' => 'Đo từ chân conneter',
                                'answer_list' => ['Đo từ đầu conneter', 'Đo từ giữa conneter', 'Đo từ chân conneter'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 18,
                                'name' => 'Cách quấn băng dính nhánh hàng takeuchi?',
                                'point' => 4.76,
                                'path_image' => 'public\assets\frontend\images\ktnq\18_ktnq.png',
                                'width_image' => 70,
                                'answer' => 'Quấn chụm',
                                'answer_list' => ['Quấn chụm', 'Quấn tách nhánh', 'Quấn cách chân'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 19,
                                'name' => 'Cách quấn băng dính nhánh hàng takeuchi?',
                                'point' => 4.76,
                                'path_image' => 'public\assets\frontend\images\ktnq\19_ktnq.png',
                                'width_image' => 70,
                                'answer' => 'Quấn cách chân',
                                'answer_list' => ['Quấn chụm', 'Quấn tách nhánh', 'Quấn cách chân'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 20,
                                'name' => 'Nhánh rẽ được yêu cầu quấn băng dính như thế nào?',
                                'point' => 4.76,
                                'path_image' => 'public\assets\frontend\images\ktnq\20_ktnq.png',
                                'width_image' => 70,
                                'answer' => 'Quấn 0mm-30mm',
                                'answer_list' => ['Quấn 20mm-30mm', 'Quấn 0mm-30mm', 'Quấn 30mm-30mm'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 21,
                                'name' => 'Kích thước quấn chụm là bao nhiêu ?',
                                'point' => 4.76,
                                'path_image' => 'public\assets\frontend\images\ktnq\21_ktnq.png',
                                'width_image' => 70,
                                'answer' => 'Quấn 20mm',
                                'answer_list' => ['Quấn 20mm', 'Quấn dưới 20 mm', 'Quấn trên  20 mm'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                        ]
                    ]
                ]
            ],
            4 => [
                'title' => 'Bài kiểm tra kiến thức công nhân nhóm Nối',
                'description' => '<i>Điểm đạt: 80 điểm trở lên </i><br>
                               <i>Từ 61->80 điểm: kiểm tra lại</i><br>
                               <i>Từ 50->60 điểm: đào tạo lại</i><br>
                               <i>Dưới 50 điểm: Không đạt</i><br>',
                'messager' => [
                    1 => '<br>Điểm đạt: 80 điểm trở lên<br><img src="public\assets\frontend\images\logos\anh-icon-vui.jpg" width="100" />',
                    2 => '<br>Từ 61->80 điểm: kiểm tra lại<br><img src="public\assets\frontend\images\logos\anh-icon-buon.jpg" width="100" />',
                    3 => '<br>Từ 50->60 điểm: đào tạo lại. <br>Dưới 50 điểm: Không đạt<br><img src="public\assets\frontend\images\logos\anh-icon-buon.jpg" width="100" />'
                ],
                'time' => 30,
                'scores' => [80, 60], // điểm đạt
                'data' =>
                [
                    [
                        'group' => '<h5>I. AN TOÀN LAO ĐỘNG ( 4 điểm )</h5>',
                        'point' => 4,
                        'width' => 1,
                        'random' => 0,
                        'questions' =>  [
                            [
                                'id' => 1,
                                'name' => 'Theo bạn thao tác an toàn lao động là thao tác nào?',
                                'point' => 4,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Tất cả phương án trên',
                                'answer_list' => ['Khi thay mỏ, dừng thao tác, đi ra ngoài phải tắt nguồn điện', 'Khi thao tác nối  mỏ nối phải có cover bảo vệ', 'Khi đang chuẩn bị không để chân lên công tắc chân', 'Khi thao tác phải sử dụng găng tay bảo hộ', 'Khi xử lý sự cố máy mọc phải tắt nguồn điện', 'Tất cả phương án trên'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ]
                        ]
                    ],
                    [
                        'group' => '<div><h5>II. KIỂM TRA NĂNG LỰC NHẬN BIẾT MÀU DÂY ( 12 điểm )</h5></div>
                                  <div style="color:red">Bạn hãy chọn đáp án đúng bằng cách tích vào đáp án màu dây tương ứng với màu dây trong ảnh</div>',
                        'point' => 1,
                        'width' => 3,
                        'random' => 0,
                        'questions' =>  [
                            [
                                'id' => 2,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_1.png',
                                'width_image' => 70,
                                'answer' => 'RY',
                                'answer_list' => ['RV', 'RW', 'RY'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 3,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_2.png',
                                'width_image' => 70,
                                'answer' => 'GW',
                                'answer_list' => ['GY', 'GW', 'GBr'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 4,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_3.png',
                                'width_image' => 70,
                                'answer' => 'B',
                                'answer_list' => ['Br', 'BR', 'B'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 5,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_4.png',
                                'width_image' => 70,
                                'answer' => 'Br',
                                'answer_list' => ['Br', 'BR', 'BG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 6,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_5.png',
                                'width_image' => 70,
                                'answer' => 'V',
                                'answer_list' => ['V', 'O', 'G'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 7,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_6.png',
                                'width_image' => 70,
                                'answer' => 'LgR',
                                'answer_list' => ['Lg', 'LgR', 'GW'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 8,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_7.png',
                                'width_image' => 70,
                                'answer' => 'PB',
                                'answer_list' => ['PV', 'OR', 'PB'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 9,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_8.png',
                                'width_image' => 70,
                                'answer' => 'LY',
                                'answer_list' => ['LW', 'LY', 'GY'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 10,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_9.png',
                                'width_image' => 70,
                                'answer' => 'LW',
                                'answer_list' => ['LR', 'LW', 'GL'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 11,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_10.png',
                                'width_image' => 70,
                                'answer' => 'YL',
                                'answer_list' => ['YL', 'LgR', 'GW'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 12,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_11.png',
                                'width_image' => 70,
                                'answer' => 'LG',
                                'answer_list' => ['PO', 'LG', 'PV'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 13,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_12.png',
                                'width_image' => 70,
                                'answer' => 'W',
                                'answer_list' => ['O', 'Y', 'W'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                        ]
                    ],
                    [
                        'group' => '<h5>III. KIỂM TRA THÔNG TIN TRÊN EDP ( 5 điểm)</h5>',
                        'point' => 5,
                        'width' => 1,
                        'random' => 0,
                        'questions' =>  [
                            [
                                'id' => 14,
                                'name' => 'Giải thích các thông số trên EDP ?',
                                'point' => 5,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group3_1.png',
                                'width_image' => 70,
                                'answer' => '1',
                                'answer_list' => [1 => 'Kích thước dây', 2 => 'Mã sản phẩm', 3 => 'Số dây', 4 => 'Chủng loại dây', 5 => 'Giá để tanshi', 6 => 'Tên lot', 7 => 'Tanshi A', 8 => 'Đầu chuốt Tanshi A', 9 => 'Tanshi B', 10 => 'Đầu chuốt Tanshi B', 11 => 'Nội dung cần chú ý', 12 => 'Số lượng dây cắt', 13 => 'Kí hiệu của lót hàng', 14 => 'Tên mối nối', 15 => 'Kích thước dây sau xoắn', 16 => 'Cost QR', 17 => 'Maku dây'],
                                'show_question' => 1,
                                'multiple_answer' => [1 => 'Kích thước dây', 2 => 'Mã sản phẩm', 3 => 'Số dây', 4 => 'Chủng loại dây', 5 => 'Giá để tanshi', 6 => 'Tên lot', 7 => 'Tanshi A', 8 => 'Đầu chuốt Tanshi A', 9 => 'Tanshi B', 10 => 'Đầu chuốt Tanshi B', 11 => 'Nội dung cần chú ý', 12 => 'Số lượng dây cắt', 13 => 'Kí hiệu của lót hàng', 14 => 'Tên mối nối', 15 => 'Kích thước dây sau xoắn', 16 => 'Cost QR', 17 => 'Maku dây'],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ]
                        ]
                    ],
                    [
                        'group' => '<div><h5>IV. TIÊU CHUẨN B NỐI VÀ TIÊU CHUẨN SỎ ỐNG ( 16 điểm )</h5><div>
                                   <div style="color:red">Nhìn vào ảnh tiêu chuẩn B và ống để chọn đúng B cần nối tương ứng</div>',
                        'point' => 5,
                        'width' => 1,
                        'random' => 0,
                        'questions' =>  [
                            [
                                'id' => 15,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group4_1.png',
                                'width_image' => 70,
                                'answer' => 'B1.25',
                                'answer_list' => ['B1.25', 'B2', 'B5.5', 'B8'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 16,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group4_2.png',
                                'width_image' => 70,
                                'answer' => 'B2',
                                'answer_list' => ['B1.25', 'B2', 'B5.5', 'B8'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 17,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group4_3.png',
                                'width_image' => 70,
                                'answer' => 'B5.5',
                                'answer_list' => ['B1.25', 'B2', 'B5.5', 'B8'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 18,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group4_4.png',
                                'width_image' => 70,
                                'answer' => 'B8',
                                'answer_list' => ['B1.25', 'B2', 'B5.5', 'B8'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 19,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group4_5.png',
                                'width_image' => 70,
                                'answer' => 'B14',
                                'answer_list' => ['B14', 'B22', 'B38', 'B60'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 20,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group4_6.png',
                                'width_image' => 70,
                                'answer' => 'B22',
                                'answer_list' => ['B14', 'B22', 'B38', 'B60'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 21,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group4_7.png',
                                'width_image' => 70,
                                'answer' => 'B38',
                                'answer_list' => ['B14', 'B22', 'B38', 'B60'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 22,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group4_8.png',
                                'width_image' => 70,
                                'answer' => 'B60',
                                'answer_list' => ['B14', 'B22', 'B38', 'B60'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 23,
                                'name' => 'Những đầu dây nối đơn xem hình bên nếu sơ đồ nối không hiển thị cho dây kamas vậy khi nối có cần cho dây kamas vào mối nối không',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group4_9.png',
                                'width_image' => 30,
                                'answer' => 'Không',
                                'answer_list' => ['Có', 'Không'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 24,
                                'name' => 'Tiêu chuẩn sỏ ống ami của dây SRD: Ami = 20',
                                'point' => 2,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Không phải sỏ (Nếu sơ đồ nối ghi chú sỏ ống gì thì sỏ ống đó L=10)',
                                'answer_list' => ['Sỏ ống L= 10mm', 'Sỏ ống L= 15mm', 'Không phải sỏ (Nếu sơ đồ nối ghi chú sỏ ống gì thì sỏ ống đó L=10)'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 25,
                                'name' => 'Tiêu chuẩn sỏ ống ami của dây SRD: Ami = 30',
                                'point' => 2,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Sỏ ống L= 20mm',
                                'answer_list' => ['Sỏ ống L= 15mm', 'Sỏ ống L= 20mm', 'Không phải sỏ'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 26,
                                'name' => 'Tiêu chuẩn sỏ ống ami của dây SRD: Ami dài từ 40 trở lên thì:',
                                'point' => 2,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Lấy chiều dài kích thước ami trừ đi 10 để ra kích thước ống cần sỏ',
                                'answer_list' => ['Lấy chiều dài kích thước ami trừ đi 10 để ra kích thước ống cần sỏ', 'Lấy chiều dài kích thước ami trừ đi 20 để ra kích thước ống cần sỏ', 'Sỏ ống dài bằng ami'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 27,
                                'name' => 'Khi sơ đồ nối không hiển thị ống cần sỏ thì dựa vào đâu để biết mối nối này cần sỏ ống gì',
                                'point' => 1,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Cả 2 đáp án trên',
                                'answer_list' => ['Dựa vào đầu chuốt và xác định ống cần sỏ theo bảng tiêu chuẩn ( Chuốt 12= Es, chuốt 8= sumi...)', 'Dựa vào đầu trang SĐN. Nếu đầu trang khoanh vào ống gì thì sẽ sỏ ống đó', 'Cả 2 đáp án trên'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                        ]
                    ],
                    [
                        'group' => '<div><h5>V. KIỂM TRA ÁP LỰC KHÍ VÀ KÉO CÂN MÁY NỐI ( 12 điểm )</h5></div>
                                   <div style="color:red">Hãy chọn đáp án đúng </div>',
                        'point' => 5,
                        'width' => 1,
                        'random' => 0,
                        'questions' =>  [
                            [
                                'id' => 28,
                                'name' => 'Áp lực khí: 0.55~0.65 Mpa, >= 15kg, Dây 0.75',
                                'point' => 4,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'B2',
                                'answer_list' => ['B1.25', 'B2', 'B5.5'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 29,
                                'name' => 'Áp lực khí: 0.55~0.65 Mpa, >= 29kg, Dây 2',
                                'point' => 4,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'B5.5',
                                'answer_list' => ['B1.25', 'B2', 'B5.5'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 30,
                                'name' => 'Áp lực khí: 0.55~0.65 Mpa, >= 9kg, Dây 0.5',
                                'point' => 4,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'B1.25',
                                'answer_list' => ['B1.25', 'B2', 'B5.5'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                        ],
                    ],
                    [
                        'group' => '<div><h5>VI. TIÊU CHUẨN KHOẢNG CÁCH DẬP B NỐI VÀ ĐỒNG THỪA ( 24 điểm)</h5></div>
                                   <div style="color:red">Hãy chọn đáp án đúng </div>',
                        'point' => 5,
                        'width' => 1,
                        'random' => 0,
                        'questions' =>  [
                            [
                                'id' => 31,
                                'name' => 'Tiêu chuẩn khoảng cách dập B nối: B1.25',
                                'point' => 4,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group6_1.png',
                                'width_image' => 70,
                                'answer' => 'Khoảng cách 2 bên vết dập A,B =  1 ~ 2mm. Khoảng cách của A,B phải đại khái bằng nhau',
                                'answer_list' => ['Khoảng cách 2 bên vết dập A,B = 0.5~2mm. Khoảng cách của A,B phải đại khái bằng nhau.', 'Khoảng cách 2 bên vết dập A,B = 0.5~1mm. Khoảng cách của A,B phải đại khái bằng nhau', 'Khoảng cách 2 bên vết dập A,B =  1 ~ 2mm. Khoảng cách của A,B phải đại khái bằng nhau'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 32,
                                'name' => 'Tiêu chuẩn khoảng cách dập B nối: B2',
                                'point' => 4,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group6_2.png',
                                'width_image' => 70,
                                'answer' => 'Khoảng cách 2 bên vết dập A,B =  1 ~ 2mm. Khoảng cách của A,B phải đại khái bằng nhau',
                                'answer_list' => ['Khoảng cách 2 bên vết dập A,B =  1 ~ 2mm. Khoảng cách của A,B phải đại khái bằng nhau', 'Khoảng cách 2 bên vết dập A,B = 0.5~1mm. Khoảng cách của A,B phải đại khái bằng nhau', 'Khoảng cách 2 bên vết dập A,B = 0.5~2mm. Khoảng cách của A,B phải đại khái bằng nhau'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 33,
                                'name' => 'Tiêu chuẩn khoảng cách dập B nối: B5.5',
                                'point' => 4,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group6_3.png',
                                'width_image' => 70,
                                'answer' => 'Khoảng cách 2 bên vết dập A,B = 0.5~1mm. Khoảng cách của A,B phải đại khái bằng nhau',
                                'answer_list' => ['Khoảng cách 2 bên vết dập A,B = 0.5~2mm. Khoảng cách của A,B phải đại khái bằng nhau', 'Khoảng cách 2 bên vết dập A,B = 0.5~1mm. Khoảng cách của A,B phải đại khái bằng nhau', 'Khoảng cách 2 bên vết dập A,B =  1 ~ 2mm. Khoảng cách của A,B phải đại khái bằng nhau'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 34,
                                'name' => 'Tiêu chuẩn đồng thừa từ B đến vỏ dây điện (Chuốt 8: đồng thừa 1, Chuốt 12: đồng thừa 5)',
                                'point' => 3,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group6_4.png',
                                'width_image' => 70,
                                'answer' => 'Cả 3 đáp án trên',
                                'answer_list' => ['B1.25', 'B2', 'B5.5', 'Cả 3 đáp án trên'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 35,
                                'name' => 'Tiêu chuẩn đồng thừa từ B đến vỏ dây điện (Chuốt 10: đồng thừa 1, Chuốt 14: đồng thừa 5)',
                                'point' => 3,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group6_4.png',
                                'width_image' => 70,
                                'answer' => 'B8',
                                'answer_list' => ['B8', 'B14', 'B22', 'Cả 3 đáp án trên'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 36,
                                'name' => 'Tiêu chuẩn đồng thừa từ B đến vỏ dây điện (Chuốt 14: đồng thừa 3 , Chuốt 18: đồng thừa 7)',
                                'point' => 3,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group6_4.png',
                                'width_image' => 70,
                                'answer' => 'B14',
                                'answer_list' => ['B8', 'B14', 'B22', 'Cả 3 đáp án trên'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 37,
                                'name' => 'Tiêu chuẩn đồng thừa từ B đến vỏ dây điện (Chuốt 16: đồng thừa 3 , Chuốt 20: đồng thừa 7)',
                                'point' => 3,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group6_4.png',
                                'width_image' => 70,
                                'answer' => 'B22',
                                'answer_list' => ['B8', 'B14', 'B22', 'Cả 3 đáp án trên'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                        ],
                    ],
                    [
                        'group' => '<div><h5>VII. KIỂM TRA CHẤT LƯỢNG SAU KHI NỐI ( 15 điểm)</h5><div>
                                   <div style="color:red">Hãy chọn đáp án đúng </div>',
                        'point' => 5,
                        'width' => 1,
                        'random' => 0,
                        'questions' =>  [
                            [
                                'id' => 38,
                                'name' => 'Khi nào thì kiểm tra vết dập mối nối?',
                                'point' => 5,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Kiểm tra vết dập B ngay sau khi nối xong từng PCS',
                                'answer_list' => ['Kiểm tra vết dập B ngay sau khi nối xong cả mối', 'Kiểm tra vết dập B ngay sau khi nối xong từng PCS', 'Kiểm tra vết dập B ngay sau khi nối xong một bộ'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 39,
                                'name' => 'Khi nối xong phải kiểm tra những gì?',
                                'point' => 5,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Tất cả các đáp án trên',
                                'answer_list' => ['So sánh số dây trên edp có khớp với số dây trên sơ đồ nối không và xem cả hướng nối của dây', 'Kiểm tra vết dập của B có nằm trong tiêu chuẩn, có đủ vết dập và có đủ số lượng B cần nối không', 'Xác nhận đã sỏ ống đúng loại mà sơ đồ nối yêu cầu và sỏ đủ số lượng chưa', 'Đếm số lượng mối B đã nối của bộ đang làm xem có đủ mối như sơ đồ nối yêu cầu không', 'Tất cả các đáp án trên'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 40,
                                'name' => 'Những lỗi thường sảy ra khi nối?',
                                'point' => 5,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Tất cả đáp án trên',
                                'answer_list' => ['Nối sai số dây', 'Nối thiếu dây', 'Nối thừa dây', 'Sỏ sai ống', 'Sỏ thiếu ống', 'Sỏ thừa ống', 'Nối tụt đồng', 'B bị biến dạng', 'Vết dập B bị lệch', 'Nối rối dây', 'Nối sai tanshi', 'Nối sai sai đầu gia công, sai đầu chừa dây xoắn', 'Tất cả đáp án trên'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ]
                        ]
                    ],
                    [
                        'group' => '<div><h5>VIII. CÁC CHÚ Ý TRÊN SƠ ĐỒ NỐI CÁCH CHUYỂN HÀNG (12 điểm )</h5></div>
                                     <div style="color:red">Hãy chọn đáp án đúng </div>',
                        'point' => 5,
                        'width' => 1,
                        'random' => 0,
                        'questions' =>  [
                            [
                                'id' => 41,
                                'name' => 'Khi nối bộ có bao nhiêu mối nối trở lên thì bấm vào xem ảnh để phóng mối cần nối lên ?',
                                'point' => 3,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group8_1.png',
                                'width_image' => 70,
                                'answer' => '2 mối trở nên',
                                'answer_list' => ['3 mối trở nên', '2 mối trở nên', '4 mối trở nên'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 42,
                                'name' => 'Nếu trên sơ đồ nối hiển thị như ảnh thì hàng chuyển vào thùng nào?',
                                'point' => 3,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group8_2.png',
                                'width_image' => 70,
                                'answer' => 'Thùng hàng chờ nhúng',
                                'answer_list' => ['Thùng hàng hoàn thiện', 'Thùng hàng chờ nhúng'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 43,
                                'name' => 'Nếu trên sơ đồ nối hiển thị như ảnh thì hàng chuyển vào thùng nào?',
                                'point' => 3,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group8_3.png',
                                'width_image' => 70,
                                'answer' => 'Thùng hàng hoàn thiện',
                                'answer_list' => ['Thùng hàng hoàn thiện', 'Thùng hàng chờ nhúng'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 44,
                                'name' => 'Nếu trên sơ đồ nối hiển thị như ảnh thì hàng chuyển vào thùng nào?',
                                'point' => 3,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group8_4.png',
                                'width_image' => 70,
                                'answer' => 'Thùng hàng hoàn thiện',
                                'answer_list' => ['Thùng hàng hoàn thiện', 'Thùng hàng chờ nhúng'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                        ]
                    ]
                ]
            ],
            5 => [
                'title' => 'Bài kiểm tra kiến thức công nhân nhóm Xoắn',
                'description' => '<i>Điểm đạt: 80 điểm trở lên </i><br>
                                           <i>Từ 61->80 điểm: kiểm tra lại</i><br>
                                           <i>Từ 50->60 điểm: đào tạo lại</i><br>
                                           <i>Dưới 50 điểm: Không đạt</i><br>',
                'messager' => [
                    1 => '<br>Điểm đạt: 80 điểm trở lên<br><img src="public\assets\frontend\images\logos\anh-icon-vui.jpg" width="100" />',
                    2 => '<br>Từ 61->80 điểm: kiểm tra lại<br><img src="public\assets\frontend\images\logos\anh-icon-buon.jpg" width="100" />',
                    3 => '<br>Từ 50->60 điểm: đào tạo lại. <br>Dưới 50 điểm: Không đạt<br><img src="public\assets\frontend\images\logos\anh-icon-buon.jpg" width="100" />'
                ],
                'time' => 30,
                'scores' => [80, 60], // điểm đạt
                'data' =>
                [
                    [
                        'group' => '<h5>I. AN TOÀN LAO ĐỘNG ( 4 điểm )</h5>',
                        'point' => 4,
                        'width' => 1,
                        'random' => 0,
                        'questions' =>  [
                            [
                                'id' => 1,
                                'name' => 'Theo bạn thao tác an toàn lao động là thao tác nào?',
                                'point' => 4,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Tất cả phương án trên',
                                'answer_list' => ['Khi thay mỏ, dừng thao tác, đi ra ngoài phải tắt nguồn điện', 'Khi thao tác nối  mỏ nối phải có cover bảo vệ', 'Khi đang chuẩn bị không để chân lên công tắc chân', 'Khi thao tác phải sử dụng găng tay bảo hộ', 'Khi xử lý sự cố máy mọc phải tắt nguồn điện', 'Tất cả phương án trên'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ]
                        ]
                    ],
                    [
                        'group' => '<div><h5>II. KIỂM TRA NĂNG LỰC NHẬN BIẾT MÀU DÂY ( 12 điểm )</h5></div>
                                              <div style="color:red">Bạn hãy chọn đáp án đúng bằng cách tích vào đáp án màu dây tương ứng với màu dây trong ảnh</div>',
                        'point' => 1,
                        'width' => 3,
                        'random' => 0,
                        'questions' =>  [
                            [
                                'id' => 2,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_1.png',
                                'width_image' => 70,
                                'answer' => 'RY',
                                'answer_list' => ['RV', 'RW', 'RY'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 3,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_2.png',
                                'width_image' => 70,
                                'answer' => 'GW',
                                'answer_list' => ['GY', 'GW', 'GBr'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 4,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_3.png',
                                'width_image' => 70,
                                'answer' => 'B',
                                'answer_list' => ['Br', 'BR', 'B'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 5,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_4.png',
                                'width_image' => 70,
                                'answer' => 'Br',
                                'answer_list' => ['Br', 'BR', 'BG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 6,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_5.png',
                                'width_image' => 70,
                                'answer' => 'V',
                                'answer_list' => ['V', 'O', 'G'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 7,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_6.png',
                                'width_image' => 70,
                                'answer' => 'LgR',
                                'answer_list' => ['Lg', 'LgR', 'GW'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 8,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_7.png',
                                'width_image' => 70,
                                'answer' => 'PB',
                                'answer_list' => ['PV', 'OR', 'PB'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 9,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_8.png',
                                'width_image' => 70,
                                'answer' => 'LY',
                                'answer_list' => ['LW', 'LY', 'GY'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 10,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_9.png',
                                'width_image' => 70,
                                'answer' => 'LW',
                                'answer_list' => ['LR', 'LW', 'GL'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 11,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_10.png',
                                'width_image' => 70,
                                'answer' => 'YL',
                                'answer_list' => ['YL', 'LgR', 'GW'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 12,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_11.png',
                                'width_image' => 70,
                                'answer' => 'LG',
                                'answer_list' => ['PO', 'LG', 'PV'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 13,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_12.png',
                                'width_image' => 70,
                                'answer' => 'W',
                                'answer_list' => ['O', 'Y', 'W'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                        ]
                    ],
                    [
                        'group' => '<h5>III. KIỂM TRA THÔNG TIN TRÊN EDP ( 5 điểm)</h5>',
                        'point' => 5,
                        'width' => 1,
                        'random' => 0, // nếu là 0 thì random all,nếu lớn hơn không thì random theo
                        'questions' =>  [
                            [
                                'id' => 14,
                                'name' => 'Giải thích các thông số trên EDP ?',
                                'point' => 5,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group3_1.png',
                                'width_image' => 70,
                                'answer' => '1',
                                'answer_list' => [1 => 'Kích thước dây', 2 => 'Mã sản phẩm', 3 => 'Số dây', 4 => 'Chủng loại dây', 5 => 'Giá để tanshi', 6 => 'Tên lot', 7 => 'Tanshi A', 8 => 'Đầu chuốt Tanshi A', 9 => 'Tanshi B', 10 => 'Đầu chuốt Tanshi B', 11 => 'Nội dung cần chú ý', 12 => 'Số lượng dây cắt', 13 => 'Kí hiệu của lót hàng', 14 => 'Tên mối nối', 15 => 'Kích thước dây sau xoắn', 16 => 'Cost QR', 17 => 'Maku dây'],
                                'show_question' => 1,
                                'multiple_answer' => [1 => 'Kích thước dây', 2 => 'Mã sản phẩm', 3 => 'Số dây', 4 => 'Chủng loại dây', 5 => 'Giá để tanshi', 6 => 'Tên lot', 7 => 'Tanshi A', 8 => 'Đầu chuốt Tanshi A', 9 => 'Tanshi B', 10 => 'Đầu chuốt Tanshi B', 11 => 'Nội dung cần chú ý', 12 => 'Số lượng dây cắt', 13 => 'Kí hiệu của lót hàng', 14 => 'Tên mối nối', 15 => 'Kích thước dây sau xoắn', 16 => 'Cost QR', 17 => 'Maku dây'],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ]
                        ]
                    ],
                    [
                        'group' => '<div><h5>IV. QUY TRÌNH THAO TÁC XOẮN ( 24 điểm )</h5></div>
                                    <div style="color:red">Hãy nhập <strong>SỐ</strong> vào ô trống từ B1-> B12 để đúng trình tự thao tác các bước xoắn</div>',
                        'point' => 24,
                        'width' => 1,
                        'random' => 0,
                        'questions' =>  [
                            [
                                'id' => 15,
                                'name' => 'Hãy nhập <strong>SỐ</strong> vào ô trống từ B1-> B12 để đúng trình tự thao tác các bước xoắn?',
                                'point' => 2,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => '1',
                                'answer_list' => [1 => 'Bật công tắc nguồn cây máy tính'],
                                'show_question' => 1,
                                'multiple_answer' => [1 => 'Bật công tắc nguồn cây máy tính'],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 16,
                                'name' => 'Hãy nhập <strong>SỐ</strong> vào ô trống từ B1-> B12 để đúng trình tự thao tác các bước xoắn?',
                                'point' => 2,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => '1',
                                'answer_list' => [4 => 'Quét mã QR ở chương trình xoắn. Dữ liệu sẽ được nạp tự động xuống bộ điều khiển'],
                                'show_question' => 1,
                                'multiple_answer' => [4 => 'Quét mã QR ở chương trình xoắn. Dữ liệu sẽ được nạp tự động xuống bộ điều khiển'],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 17,
                                'name' => 'Hãy nhập <strong>SỐ</strong> vào ô trống từ B1-> B12 để đúng trình tự thao tác các bước xoắn?',
                                'point' => 2,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => '1',
                                'answer_list' =>  [5 => 'Nhấn nút "Về gốc" để xe xoắn trở về gốc (vị trí xoắn)'],
                                'show_question' => 1,
                                'multiple_answer' => [5 => 'Nhấn nút "Về gốc" để xe xoắn trở về gốc (vị trí xoắn)'],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 18,
                                'name' => 'Hãy nhập <strong>SỐ</strong> vào ô trống từ B1-> B12 để đúng trình tự thao tác các bước xoắn?',
                                'point' => 2,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => '1',
                                'answer_list' => [8 => 'Kẹp đầu dây còn lại vào kẹp máy xoắn'],
                                'show_question' => 1,
                                'multiple_answer' => [8 => 'Kẹp đầu dây còn lại vào kẹp máy xoắn'],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 19,
                                'name' => 'Hãy nhập <strong>SỐ</strong> vào ô trống từ B1-> B12 để đúng trình tự thao tác các bước xoắn?',
                                'point' => 2,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => '1',
                                'answer_list' => [6 => 'Dải dây vào khay tách dây và kẹp dây vào 2 đầu kẹp của xe xoắn'],
                                'show_question' => 1,
                                'multiple_answer' => [6 => 'Dải dây vào khay tách dây và kẹp dây vào 2 đầu kẹp của xe xoắn'],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 20,
                                'name' => 'Hãy nhập <strong>SỐ</strong> vào ô trống từ B1-> B12 để đúng trình tự thao tác các bước xoắn?',
                                'point' => 2,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => '1',
                                'answer_list' =>  [9 => 'Nhấn nút "Bật máy xoắn" để máy xoắn bắt đầu xoắn'],
                                'show_question' => 1,
                                'multiple_answer' => [9 => 'Nhấn nút "Bật máy xoắn" để máy xoắn bắt đầu xoắn'],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 21,
                                'name' => 'Hãy nhập <strong>SỐ</strong> vào ô trống từ B1-> B12 để đúng trình tự thao tác các bước xoắn?',
                                'point' => 2,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => '1',
                                'answer_list' => [7 => 'Nhấn nút "Chạy" để xe kẹp dây xoắn chạy về vị trí khớp với kích thước của dây vừa scan edp'],
                                'show_question' => 1,
                                'multiple_answer' => [7 => 'Nhấn nút "Chạy" để xe kẹp dây xoắn chạy về vị trí khớp với kích thước của dây vừa scan edp'],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 22,
                                'name' => 'Hãy nhập <strong>SỐ</strong> vào ô trống từ B1-> B12 để đúng trình tự thao tác các bước xoắn?',
                                'point' => 2,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => '1',
                                'answer_list' => [10 => 'Khi xoắn xong xi lanh tự động nhả dây đã xoắn đồng thời người làm tháo luôn đầu dây đang kẹp ở máy xoắn ra'],
                                'show_question' => 1,
                                'multiple_answer' => [10 => 'Khi xoắn xong xi lanh tự động nhả dây đã xoắn đồng thời người làm tháo luôn đầu dây đang kẹp ở máy xoắn ra'],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 23,
                                'name' => 'Hãy nhập <strong>SỐ</strong> vào ô trống từ B1-> B12 để đúng trình tự thao tác các bước xoắn?',
                                'point' => 2,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => '1',
                                'answer_list' => [12 => 'Thực hiện B8,B9,B10. Làm như vậy đến khi hết dây'],
                                'show_question' => 1,
                                'multiple_answer' => [12 => 'Thực hiện B8,B9,B10. Làm như vậy đến khi hết dây'],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 24,
                                'name' => 'Hãy nhập <strong>SỐ</strong> vào ô trống từ B1-> B12 để đúng trình tự thao tác các bước xoắn?',
                                'point' => 2,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => '1',
                                'answer_list' => [11 => 'Đo kích thước dây xoắn và mắt xoắn, nếu đo ok thì nhập mắt xoắn đo được vào phần mền xoắn và nhấn enter để lưu dữ liệu và lưu sản lượng'],
                                'show_question' => 1,
                                'multiple_answer' => [11 => 'Đo kích thước dây xoắn và mắt xoắn, nếu đo ok thì nhập mắt xoắn đo được vào phần mền xoắn và nhấn enter để lưu dữ liệu và lưu sản lượng'],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 25,
                                'name' => 'Hãy nhập <strong>SỐ</strong> vào ô trống từ B1-> B12 để đúng trình tự thao tác các bước xoắn?',
                                'point' => 2,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => '1',
                                'answer_list' =>  [3 => 'Bật chương trình điều khiển và phần mềm xoắn trên máy tính'],
                                'show_question' => 1,
                                'multiple_answer' => [3 => 'Bật chương trình điều khiển và phần mềm xoắn trên máy tính'],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 26,
                                'name' => 'Hãy nhập <strong>SỐ</strong> vào ô trống từ B1-> B12 để đúng trình tự thao tác các bước xoắn?',
                                'point' => 2,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => '1',
                                'answer_list' =>  [2 => 'Bật máy xoắn'],
                                'show_question' => 1,
                                'multiple_answer' => [2 => 'Bật máy xoắn'],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ]
                        ]
                    ],
                    [
                        'group' => '<div><h5>V. CÁC DẠNG LỐI CÓ THỂ XẢY RA KHI THAO TÁC XOẮN ( 15 điểm )</h5></div>
                                    <div style="color:red">Hãy chọn đáp án đúng</div>',
                        'point' => 15,
                        'width' => 1,
                        'random' => 0,
                        'questions' =>  [
                            [
                                'id' => 27,
                                'name' => 'Lỗi xoắn nhầm thừa thiếu dây?',
                                'point' => 5,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Cả 3 đáp án trên',
                                'answer_list' => ['Xoắn nhầm số dây', 'Xoắn thiếu dây', 'Xoắn thừa dây', 'Cả 3 đáp án trên'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 28,
                                'name' => 'Lỗi âm dương kích thước?',
                                'point' => 5,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Cả 3 đáp án trên',
                                'answer_list' => ['Xoắn dương kích thước', 'Xoắn âm kích thước', 'Xoắn sai kích thước đầu chừa', 'Cả 3 đáp án trên'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 29,
                                'name' => 'Lỗi biến dạng dây, sai đầu xoắn?',
                                'point' => 5,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Cả 3 đáp án trên',
                                'answer_list' => ['Xoắn sai đầu tanshi A,B', 'Xoắn đồng bị cuộn cồng lên', 'Xoắn dây bị biến dạng màu dây', 'Cả 3 đáp án trên'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                        ]
                    ],
                    [
                        'group' => '<div><h5>VI. KIỂM TRA HÀNG KHI THAO TÁC ( 18 điểm )</h5></div>',
                        'point' => 18,
                        'width' => 1,
                        'random' => 0,
                        'questions' =>  [
                            [
                                'id' => 30,
                                'name' => 'Sau khi scan EDP lên phần mềm xoắn xong thì phải kiểm tra thông tin gì giữa EDP và phần mềm xoắn?',
                                'point' => 3,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Tất cả đáp án trên',
                                'answer_list' => ['Kiểm tra tên số dây, màu dây', 'Kiểm tra thứ tự lần xoắn xác định đầu chừa A,B', 'Đánh dấu chừa nếu cần', 'Tất cả đáp án trên'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 31,
                                'name' => 'Sau khi làm xong thì phải kiểm tra những gì?',
                                'point' => 3,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Tất cả đáp án trên',
                                'answer_list' => ['Kiểm tra tên số dây, màu dây', 'Kiểm tra tanshi A và B, Chỉnh đầu dây bằng nhau', 'Đo kích thước đầu chừa, đoạn xoắn, kích thước cả dây của 1pcs cuối', 'Tất cả đáp án trên'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 32,
                                'name' => 'Trong quá trình xoắn 1 bộ thì phải đo kích thước dây sau xoắn mấy lần?',
                                'point' => 3,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Đo 3 lần : dây đầu, dây giữa và dây cuối',
                                'answer_list' => ['Đo 2 lần dây đầu và dây cuối', 'Đo 3 lần : dây đầu, dây giữa và dây cuối', 'Đo 1 lần : dây đầu'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 33,
                                'name' => 'Khi đo dây đầu mà không đạt kích thước dây thì phải làm gì?',
                                'point' => 3,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Tất cả phương án trên',
                                'answer_list' => ['Sửa luôn lại kích thước dây đó cho ok rồi kẹp dây thứ 2 vào máy và chỉnh lại thông số và đo lại dây nếu kích thước ok thì làm nốt các dây còn lại. Nếu kích thước chưa ok thì tiếp tục chỉnh lại thông số cho đến khi ok kích thước dây rồi mới làm tiếp các dây còn lại', 'Để riêng dây đó ra và treo thẻ lỗi rồi kẹp dây thứ 2 vào máy và chỉnh lại thông số và đo lại dây nếu kích thước ok thì làm nốt các dây còn lại. Nếu kích thước chưa ok thì tiếp tục chỉnh lại thông số cho đến khi ok kích thước dây rồi mới làm tiếp các dây còn lại', 'Tất cả phương án trên'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 34,
                                'name' => 'Khi nào thì nhập mắt xoắn?',
                                'point' => 3,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Sau khi chỉnh kích thước dây sau xoắn ok thì lúc đó đo kích thước mắt xoắn và nhập vào phần mềm',
                                'answer_list' => ['Xoắn dây đầu xong đo mắt xoắn nhập vào phần mềm', 'Sau khi chỉnh kích thước dây sau xoắn ok thì lúc đó đo kích thước mắt xoắn và nhập vào phần mềm', 'Làm xong cả bộ xoắn thì đo mắt xoắn nhập vào phần mềm'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 35,
                                'name' => 'Tiêu chuẩn kích thước mắt xoắn của bộ dây là: 20~30?',
                                'point' => 3,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Kích thước mắt xoắn đo được : 26',
                                'answer_list' => ['Kích thước mắt xoắn đo được : 17', 'Kích thước mắt xoắn đo được : 26', 'Kích thước mắt xoắn đo được : 32'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                        ]
                    ],
                    [
                        'group' => '<div><h5>VII. NHỮNG CHÚ Ý KHI THAO TÁC TRÊN PHẦN MỀM XOẮN ( 10 điểm )</h5></div>',
                        'point' => 10,
                        'width' => 1,
                        'random' => 0,
                        'questions' =>  [
                            [
                                'id' => 36,
                                'name' => 'Khi scan EDP xong phần mềm xoắn báo như ảnh thì phải làm gì?',
                                'point' => 5,
                                'path_image' => '\public\assets\frontend\images\congdoanxoan\group7_1.png',
                                'width_image' => 70,
                                'answer' => 'Xác nhận lại dây của bộ vừa scan và báo quản lý',
                                'answer_list' => ['Tắt đi scan edp tiếp và làm bình thường', 'Báo quản lý', 'Đánh dấu chừa nếu cần', 'Xác nhận lại dây của bộ vừa scan và báo quản lý'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 37,
                                'name' => 'Khi scan EDP xong phần mềm xoắn báo như ảnh thì phải làm gì?',
                                'point' => 5,
                                'path_image' => '\public\assets\frontend\images\congdoanxoan\group7_2.png',
                                'width_image' => 70,
                                'answer' => 'Đây là bộ xoắn 3 đoạn phải xoắn theo thứ tự, và đánh dấu dây trước khi xoắn. Đánh 1 dấu vàng vào số dây 1V41',
                                'answer_list' => ['Đây là bộ xoắn 4 đoạn phải xoắn theo thứ tự, và đánh dấu dây trước khi xoắn', 'Đây là bộ xoắn 3 đoạn phải xoắn theo thứ tự, và đánh dấu dây trước khi xoắn', 'Đây là bộ xoắn 2 đoạn phải xoắn theo thứ tự, và đánh dấu dây trước khi xoắn', 'Đánh 1 dấu vàng vào số dây 1V41', 'Đây là bộ xoắn 3 đoạn phải xoắn theo thứ tự, và đánh dấu dây trước khi xoắn. Đánh 1 dấu vàng vào số dây 1V41'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ]
                        ]
                    ],
                    [
                        'group' => '<div><h5>VIII.  CHUYỂN HÀNG SAU KHI XOẮN XONG (12 điểm )</h5></div>',
                        'point' => 12,
                        'width' => 1,
                        'random' => 0,
                        'questions' =>  [
                            [
                                'id' => 38,
                                'name' => 'Nhìn vào ảnh dưới đây thì sau khi xoắn ok hàng sẽ chuyển đi đâu?',
                                'point' => 4,
                                'path_image' => '\public\assets\frontend\images\congdoanxoan\group8_1.png',
                                'width_image' => 70,
                                'answer' => 'Chuyển vào thùng chờ nối',
                                'answer_list' => ['Chuyển vào thùng hoàn thiện', 'Chuyển vào thùng chờ nối', 'Chuyển vào thùng chờ dập'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 39,
                                'name' => 'Nhìn vào ảnh dưới đây thì sau khi xoắn ok hàng sẽ chuyển đi đâu?',
                                'point' => 4,
                                'path_image' => '\public\assets\frontend\images\congdoanxoan\group8_2.png',
                                'width_image' => 70,
                                'answer' => 'Chuyển vào thùng hoàn thiện',
                                'answer_list' => ['Chuyển vào thùng hoàn thiện', 'Chuyển vào thùng chờ nối', 'Chuyển vào thùng chờ dập'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 40,
                                'name' => 'Nhìn vào ảnh dưới đây thì sau khi xoắn ok hàng sẽ chuyển đi đâu?',
                                'point' => 4,
                                'path_image' => '\public\assets\frontend\images\congdoanxoan\group8_3.png',
                                'width_image' => 70,
                                'answer' => 'Chuyển vào thùng chờ dập',
                                'answer_list' => ['Chuyển vào thùng hoàn thiện', 'Chuyển vào thùng chờ nối', 'Chuyển vào thùng chờ dập'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                        ]
                    ]
                ],
            ],
            6 => [
                'title' => 'Bài kiểm tra kiến thức công nhân Dập (mới)',
                'description' => '<i>Điểm đạt: 80 điểm trở lên </i><br>
                               <i>Từ 61->80 điểm: kiểm tra lại</i><br>
                               <i>Từ 50->60 điểm: đào tạo lại</i><br>
                               <i>Dưới 50 điểm: Không đạt</i><br>',
                'messager' => [
                    1 => '<br>Điểm đạt: 80 điểm trở lên<br><img src="public\assets\frontend\images\logos\anh-icon-vui.jpg" width="100" />',
                    2 => '<br>Từ 61->80 điểm: kiểm tra lại<br><img src="public\assets\frontend\images\logos\anh-icon-buon.jpg" width="100" />',
                    3 => '<br>Từ 50->60 điểm: đào tạo lại. <br>Dưới 50 điểm: Không đạt<br><img src="public\assets\frontend\images\logos\anh-icon-buon.jpg" width="100" />'
                ],
                'time' => 30,
                'scores' => [80, 60], // điểm đạt
                'data' =>
                [
                    [
                        'group' => '<h5>I. AN TOÀN LAO ĐỘNG ( 3 điểm )</h5>
                                    <div style="color:red">Theo bạn thao tác an toàn lao động là thao tác nào? (Tích vào đáp án đúng)</div>',
                        'point' => 3,
                        'width' => 1,
                        'random' => 0,
                        'questions' =>  [
                            [
                                'id' => 1,
                                'name' => 'Theo bạn thao tác an toàn lao động là thao tác nào?',
                                'point' => 3,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => '1',
                                'answer_list' => [1 => 'Tuyệt đối không được điều chỉnh khi chưa tắt máy', 2 => 'Khoảng cách tay cầm dây đến máy ≥ 15mm', 3 => 'Khi đang chuẩn bị không để chân lên công tắc chân', 4 => 'Không có mặt nạ bảo vệ vẫn có thể dập', 5 => 'Tanshi bị kẹt trong máy có thể dùng tay để lấy ra'],
                                'show_question' => 1,
                                'multiple_answer' => [1 => 'Tuyệt đối không được điều chỉnh khi chưa tắt máy', 2 => 'Khoảng cách tay cầm dây đến máy ≥ 15mm', 3 => 'Khi đang chuẩn bị không để chân lên công tắc chân'],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'checkbox'
                            ]
                        ]
                    ],
                    [
                        'group' => '<div><h5>II. KIỂM TRA NĂNG LỰC NHẬN BIẾT MÀU DÂY ( 6 điểm )</h5></div>
                                  <div style="color:red">Bạn hãy chọn đáp án đúng bằng cách tích vào đáp án màu dây tương ứng với màu dây trong ảnh</div>',
                        'point' => 6,
                        'width' => 3,
                        'random' => 0,
                        'questions' =>  [
                            [
                                'id' => 2,
                                'name' => '',
                                'point' => 0.5,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_1.png',
                                'width_image' => 70,
                                'answer' => 'RY',
                                'answer_list' => ['RV', 'RW', 'RY'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 3,
                                'name' => '',
                                'point' => 0.5,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_2.png',
                                'width_image' => 70,
                                'answer' => 'GW',
                                'answer_list' => ['GY', 'GW', 'GBr'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 4,
                                'name' => '',
                                'point' => 0.5,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_3.png',
                                'width_image' => 70,
                                'answer' => 'B',
                                'answer_list' => ['Br', 'BR', 'B'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 5,
                                'name' => '',
                                'point' => 0.5,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_4.png',
                                'width_image' => 70,
                                'answer' => 'Br',
                                'answer_list' => ['Br', 'BR', 'BG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 6,
                                'name' => '',
                                'point' => 0.5,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_5.png',
                                'width_image' => 70,
                                'answer' => 'V',
                                'answer_list' => ['V', 'O', 'G'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 7,
                                'name' => '',
                                'point' => 0.5,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_6.png',
                                'width_image' => 70,
                                'answer' => 'LgR',
                                'answer_list' => ['Lg', 'LgR', 'GW'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 8,
                                'name' => '',
                                'point' => 0.5,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_7.png',
                                'width_image' => 70,
                                'answer' => 'PB',
                                'answer_list' => ['PV', 'OR', 'PB'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 9,
                                'name' => '',
                                'point' => 0.5,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_8.png',
                                'width_image' => 70,
                                'answer' => 'LY',
                                'answer_list' => ['LW', 'LY', 'GY'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 10,
                                'name' => '',
                                'point' => 0.5,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_9.png',
                                'width_image' => 70,
                                'answer' => 'LW',
                                'answer_list' => ['LR', 'LW', 'GL'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 11,
                                'name' => '',
                                'point' => 0.5,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_10.png',
                                'width_image' => 70,
                                'answer' => 'YL',
                                'answer_list' => ['YL', 'LgR', 'GW'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 12,
                                'name' => '',
                                'point' => 0.5,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_11.png',
                                'width_image' => 70,
                                'answer' => 'LG',
                                'answer_list' => ['PO', 'LG', 'PV'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 13,
                                'name' => '',
                                'point' => 0.5,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_12.png',
                                'width_image' => 70,
                                'answer' => 'W',
                                'answer_list' => ['O', 'Y', 'W'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                        ]
                    ],
                    [
                        'group' => '<h5>III. KIỂM TRA THÔNG TIN TRÊN EDP ( 5 điểm)</h5>',
                        'point' => 5,
                        'width' => 1,
                        'random' => 0,
                        'questions' =>  [
                            [
                                'id' => 14,
                                'name' => 'Giải thích các thông số trên EDP ?',
                                'point' => 5,
                                'path_image' => '\public\assets\frontend\images\congdoandap2\group3_1.png',
                                'width_image' => 70,
                                'answer' => '1',
                                'answer_list' => [1 => 'Kích thước dây', 2 => 'Mã sản phẩm', 3 => 'Số dây', 4 => 'Chủng loại, kích cỡ, màu sắc dây', 5 => 'Vị trí để tanshi', 6 => 'Số lot', 7 => 'Tanshi A', 8 => 'Đầu chuốt Tanshi A', 9 => 'Tanshi B', 10 => 'Đầu chuốt Tanshi B', 11 => 'Nội dung cần chú ý', 12 => 'Số lượng', 13 => 'Kí hiệu của lót hàng', 14 => 'Tên mối nối', 15 => 'Kích thước dây sau xoắn', 16 => 'Mã QR', 17 => 'Maku dây', 18 => 'Kí hiệu dập chồng', 19 => 'Sỏ ống, gomusen... đầu A/B', 20 => 'Dập xong hàn'],
                                'show_question' => 1,
                                'multiple_answer' => [1 => 'Kích thước dây', 2 => 'Mã sản phẩm', 3 => 'Số dây', 4 => 'Chủng loại, kích cỡ, màu sắc dây', 5 => 'Vị trí để tanshi', 6 => 'Số lot', 7 => 'Tanshi A', 8 => 'Đầu chuốt Tanshi A', 9 => 'Tanshi B', 10 => 'Đầu chuốt Tanshi B', 11 => 'Nội dung cần chú ý', 12 => 'Số lượng', 13 => 'Kí hiệu của lót hàng', 14 => 'Tên mối nối', 15 => 'Kích thước dây sau xoắn', 16 => 'Mã QR', 17 => 'Maku dây', 18 => 'Kí hiệu dập chồng', 19 => 'Sỏ ống, gomusen... đầu A/B', 20 => 'Dập xong hàn'],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ]
                        ]
                    ],
                    [
                        'group' => '<h5>IV. QUY TRÌNH THAO TÁC DẬP</h5>
                                    <div style="color:red">Theo bạn thao tác an toàn lao động là thao tác nào? (Tích vào đáp án đúng)</div>',
                        'point' => 40,
                        'width' => 1,
                        'random' => 0,
                        'questions' =>  [
                            [
                                'id' => 15,
                                'name' => 'Tình tự thao tác dập gồm những bước nào (chọn phương án đúng) (5 điểm)?',
                                'point' => 5,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Phương án 2:<br><div style="margin-left: 35px;">1. Kiểm tra máy hằng ngày, mỗi ngày 1 lần trước khi dập</div><div style="margin-left: 35px;">2. Kiểm tra EDP và tiến hành oder khuôn dập và tanshi</div><div style="margin-left: 35px;">3. Thiết lập khuôn dập.</div><div style="margin-left: 35px;">4. Thiết lập Tanshi</div><div style="margin-left: 35px;">5. Sử dụng chương trình so sánh tanshi bằng máy để kiểm tra tanshi trước khi dập.</div><div style="margin-left: 35px;">6. Bật nguồn điện</div><div style="margin-left: 35px;">7. Dập vào dây thử để lấy chiều cao, đo chiều cao của tanshi bằng panme. Ok thì dập vào dây thật, NG thì thiết lập lại đến khi ok</div><div style="margin-left: 35px;">8. Kiểm tra đầu đồng xem có bị thừa sợi đồng không, ok thì tiến hành dập.</div><div style="margin-left: 35px;">9. Kiểm tra ngoại quan rồi thả hàng vào đúng vị trí quy định.</div><div style="margin-left: 35px;">10. Tắt nguồn điện</div><div style="margin-left: 35px;">11. Tiến hành cất dọn khuôn dập</div>',
                                'answer_list' => [
                                    'Phương án 1:<br>
                                                       <div style="margin-left: 35px;">1. Bật nguồn điện</div>
                                                       <div style="margin-left: 35px;">2. Kiểm tra EDP và tiến hành thiết lập khuôn dập và tanshi</div>
                                                       <div style="margin-left: 35px;">3. Kiểm tra hình dạng tanshi đã dập, đo chiều cao của tanshi bằng panme đến khi ok.</div>
                                                       <div style="margin-left: 35px;">4. Kiểm tra máy hằng ngày, mỗi ngày 1 lần trước khi dập</div>
                                                       <div style="margin-left: 35px;">5. Sử dụng chương trình so sánh tanshi bằng máy để kiểm tra tanshi trước khi dập.</div>
                                                       <div style="margin-left: 35px;">6. Tắt nguồn điện</div>
                                                       <div style="margin-left: 35px;">7. Thả hàng vào đúng vị trí quy định</div>
                                                       <div style="margin-left: 35px;">8. Thiết lập khuôn dập.</div>
                                                       <div style="margin-left: 35px;">9. Thiết lập Tanshi.</div>
                                                       <div style="margin-left: 35px;">10. Tiến hành cất dọn khuôn dập</div>',
                                    'Phương án 2:<br><div style="margin-left: 35px;">1. Kiểm tra máy hằng ngày, mỗi ngày 1 lần trước khi dập</div><div style="margin-left: 35px;">2. Kiểm tra EDP và tiến hành oder khuôn dập và tanshi</div><div style="margin-left: 35px;">3. Thiết lập khuôn dập.</div><div style="margin-left: 35px;">4. Thiết lập Tanshi</div><div style="margin-left: 35px;">5. Sử dụng chương trình so sánh tanshi bằng máy để kiểm tra tanshi trước khi dập.</div><div style="margin-left: 35px;">6. Bật nguồn điện</div><div style="margin-left: 35px;">7. Dập vào dây thử để lấy chiều cao, đo chiều cao của tanshi bằng panme. Ok thì dập vào dây thật, NG thì thiết lập lại đến khi ok</div><div style="margin-left: 35px;">8. Kiểm tra đầu đồng xem có bị thừa sợi đồng không, ok thì tiến hành dập.</div><div style="margin-left: 35px;">9. Kiểm tra ngoại quan rồi thả hàng vào đúng vị trí quy định.</div><div style="margin-left: 35px;">10. Tắt nguồn điện</div><div style="margin-left: 35px;">11. Tiến hành cất dọn khuôn dập</div>'
                                ],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 16,
                                'name' => 'Những điểm lưu ý khi đứng máy dập (Hãy chọn đáp án đúng) ( 7 điểm )',
                                'point' => 7,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => '1',
                                'answer_list' => [1 => 'Không được điều chỉnh khi chưa tắt máy', 2 => 'Khoảng cách tay cầm dây đến máy ≥ 15mm', 3 => 'Khi đang chuẩn bị không để chân lên công tắc chân', 4 => 'Khi xử lý sự cố máy móc phải tắt nguồn điện bỏ chân ra khỏi công tắc chân', 5 => 'Khi máy báo đỏ "pip pip" phải kiểm tra ngoại quan →Nếu NG thì cắt đi dập lại', 6 => 'Bê máy bằng 2 tay', 7 => 'Khi có bất thường thực hiện: Dừng→ Gọi→ Đợi', 8 => 'Có thể dập mà không cần mặt nạ bảo vệ', 9 => 'Khi điều chỉnh chiều cao không cần tắt máy', 10 => 'Có thể tự lấy tanshi và khuôn dập', 11 => 'Khi có bất thường tự xử lý, không cần báo cáo cấp trên', 12 => 'Tất cả những đáp án trên'],
                                'show_question' => 1,
                                'multiple_answer' => [1 => 'Không được điều chỉnh khi chưa tắt máy', 2 => 'Khoảng cách tay cầm dây đến máy ≥ 15mm', 3 => 'Khi đang chuẩn bị không để chân lên công tắc chân', 4 => 'Khi xử lý sự cố máy móc phải tắt nguồn điện bỏ chân ra khỏi công tắc chân', 5 => 'Khi máy báo đỏ "pip pip" phải kiểm tra ngoại quan →Nếu NG thì cắt đi dập lại', 6 => 'Bê máy bằng 2 tay', 7 => 'Khi có bất thường thực hiện: Dừng→ Gọi→ Đợi'],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'checkbox'
                            ],
                            [
                                'id' => 17,
                                'name' => 'Trình tự thao tác lắp khuôn dập.(Bạn hãy chọn phương án đúng)  ( 5 điểm )?',
                                'point' => 5,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Phương án 1:<br><div style="margin-left: 35px;">1. Kiểm tra bàn gá với đế máy xem có dính dị vật không, nếu có dùng chổi quét sạch rồi mới lắp máy</div><div style="margin-left: 35px;">2. So sánh tên khuôn dập thực tế với trên phần mềm xem có đúng không </div><div style="margin-left: 35px;">3. Đặt khuôn dập lên bàn gá, đẩy cổ khuôn dập lên cài vào trục máy, sau đó lắp khuôn dập khớp với bàn gá rồi khóa chốt lại</div><div style="margin-left: 35px;">4. Đối với khuôn Doitsu kiểm tra vai máy xem có bằng nhau không rồi quay tay 1 vòng cảm nhận lực xem có nhẹ không, có bị mắc không, khuôn Yazaki kiểm tra vai máy xem có bằng nhau không</div><div style="margin-left: 35px;">5. Lắp tanshi lên tay đỡ và khóa chốt</div><div style="margin-left: 35px;">6. Lắp tanshi vào khuôn dập</div>',
                                'answer_list' => [
                                    'Phương án 1:<br><div style="margin-left: 35px;">1. Kiểm tra bàn gá với đế máy xem có dính dị vật không, nếu có dùng chổi quét sạch rồi mới lắp máy</div><div style="margin-left: 35px;">2. So sánh tên khuôn dập thực tế với trên phần mềm xem có đúng không </div><div style="margin-left: 35px;">3. Đặt khuôn dập lên bàn gá, đẩy cổ khuôn dập lên cài vào trục máy, sau đó lắp khuôn dập khớp với bàn gá rồi khóa chốt lại</div><div style="margin-left: 35px;">4. Đối với khuôn Doitsu kiểm tra vai máy xem có bằng nhau không rồi quay tay 1 vòng cảm nhận lực xem có nhẹ không, có bị mắc không, khuôn Yazaki kiểm tra vai máy xem có bằng nhau không</div><div style="margin-left: 35px;">5. Lắp tanshi lên tay đỡ và khóa chốt</div><div style="margin-left: 35px;">6. Lắp tanshi vào khuôn dập</div>',
                                    'Phương án 2:<br>
                                    <div style="margin-left: 35px;">1. Đặt khuôn dập lên bàn gá, đẩy cổ khuôn dập lên cài vào trục máy, sau đó lắp khuôn dập khớp với bàn gá rồi khóa chốt lại</div>
                                    <div style="margin-left: 35px;">2. Đối với khuôn Doitsu kiểm tra vai máy xem có bằng nhau không rồi quay tay 1 vòng cảm nhận lực xem có nhẹ không, có bị mắc không, khuôn Yazaki kiểm tra vai máy xem có bằng nhau không</div>
                                    <div style="margin-left: 35px;">3. Kiểm tra bàn gá với đế máy xem có dính dị vật không, nếu có dùng chổi quét sạch rồi mới lắp máy</div>
                                    <div style="margin-left: 35px;">4. Lắp tanshi lên tay đỡ và khóa chốt</div>
                                    <div style="margin-left: 35px;">5. Lắp tanshi vào khuôn dập</div>
                                    <div style="margin-left: 35px;">6. So sánh tên khuôn dập thực tế với trên phần mềm xem có đúng không </div>'
                                ],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 18,
                                'name' => 'Dựa vào đâu để thiết lập chiều cao ( 4 điểm )',
                                'point' => 4,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Bảng tiêu chuẩn chiều cao, dây và tanshi thực tế chuẩn bị dập',
                                'answer_list' => ['Bảng tiêu chuẩn chiều cao và dây thực tế chuẩn bị dập', 'Bảng tiêu chuẩn chiều cao, dây và tanshi thực tế chuẩn bị dập', 'Thiết lập chiều cao dựa vào trí nhớ', 'Tanshi giống nhau thì chiều cao giống nhau', 'Tất cả những phương án trên'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 19,
                                'name' => 'Trình tự sử dụng panme đo chiều cao tanshi.(Bạn hãy chọn phương án đúng) ( 5 điểm )?',
                                'point' => 5,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Phương án 1:<br><div style="margin-left: 35px;">1. Vặn núm to cách hàm cố định khoảng 0.5mm thì dùng núm vặn nhỏ vặn vào đến khi tạch tạch 3 tiếng, reset về "0" sau đó xoáy ra</div><div style="margin-left: 35px;">2. Đặt phần bụng tanshi chạm vào hàm cố định và vuông góc với hàm cố định sao cho điểm tiếp xúc với panme chính giữa thân tanshi</div><div style="margin-left: 35px;">3. Vặn núm to trước đến khi hàm di động gần chạm vào hàm cố định (cách khoảng 0.5mm) thì dùng núm nhỏ vặn tạch tạch 2 tiếng là ok</div>',
                                'answer_list' => [
                                    'Phương án 1:<br><div style="margin-left: 35px;">1. Vặn núm to cách hàm cố định khoảng 0.5mm thì dùng núm vặn nhỏ vặn vào đến khi tạch tạch 3 tiếng, reset về "0" sau đó xoáy ra</div><div style="margin-left: 35px;">2. Đặt phần bụng tanshi chạm vào hàm cố định và vuông góc với hàm cố định sao cho điểm tiếp xúc với panme chính giữa thân tanshi</div><div style="margin-left: 35px;">3. Vặn núm to trước đến khi hàm di động gần chạm vào hàm cố định (cách khoảng 0.5mm) thì dùng núm nhỏ vặn tạch tạch 2 tiếng là ok</div>',
                                    'Phương án 2:<br>
                                                       <div style="margin-left: 35px;">1. Đặt phần bụng tanshi chạm vào hàm cố định và vuông góc với hàm cố định sao cho điểm tiếp xúc chính giữa thân tanshi</div>
                                                       <div style="margin-left: 35px;">2. Vặn núm to trước đến khi hàm di động gần chạm vào hàm cố định (cách khoảng 0.5mm) thì dùng núm nhỏ vặn tạch tạch 2 tiếng là ok</div>
                                                       <div style="margin-left: 35px;">3. Vặn hàm di động chạm vào hàm cố định, reset về "0" sau đó xoáy ra</div>'
                                ],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 20,
                                'name' => 'Điểm chú ý khi sử dụng panme. (Bạn hãy chọn đáp án đúng) ( 5 điểm )',
                                'point' => 5,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => '1',
                                'answer_list' => [1 => 'Thao tác vặn nhẹ nhàng', 2 => 'Đo ở điểm chính giữa trên lưng tanshi', 3 => 'Không cần reset panme về "0" trước khi đo', 4 => 'Đo ở điểm nào trên lưng tanshi cũng được', 5 => 'Thao tác vặn nhanh, dứt khoát'],
                                'show_question' => 1,
                                'multiple_answer' => [1 => 'Thao tác vặn nhẹ nhàng', 2 => 'Đo ở điểm chính giữa trên lưng tanshi'],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'checkbox'
                            ],
                            [
                                'id' => 21,
                                'name' => 'Nhận biết khuôn Doitsu và khuôn Yazaki ( Bạn hãy điền số thích hợp vào ô trống) ( 2 điểm )?',
                                'point' => 2,
                                'path_image' => '\public\assets\frontend\images\congdoandap2\group4_6.png',
                                'width_image' => 70,
                                'answer' => '1',
                                'answer_list' => [1 => 'Khuôn Yazaki', 2 => 'Khuôn Doitsu', 3 => 'Bàn gá Doitsu',  4 => 'Bàn gá Yazaki'],
                                'show_question' => 1,
                                'multiple_answer' => [1 => 'Khuôn Yazaki', 2 => 'Khuôn Doitsu', 3 => 'Bàn gá Doitsu', 4 => 'Bàn gá Yazaki'],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 22,
                                'name' => 'Tanshi tròn sỏ ống nào sẽ phải chuyển lên nhúng (Bạn hãy chọn đáp án đúng nhất) ( 3 điểm )',
                                'point' => 3,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Sỏ ống sumi, bini, ES mà EDP ghi chú nhúng tất, nhúng tâm hoặc không ghi chú gì',
                                'answer_list' => ['Sỏ ống sumi', 'Sỏ ống bini', 'Sỏ ống ES', 'Sỏ ống sumi, bini, ES mà EDP ghi chú nhúng tất, nhúng tâm hoặc không ghi chú gì', 'Tất cả những loại ống trên'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 23,
                                'name' => 'Tanshi nào sẽ phải chuyển lên hàn (Bạn hãy chọn đáp án đúng) ( 3 điểm )',
                                'point' => 3,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Tất cả các phương án',
                                'answer_list' => ['Tanshi ****', 'Có ghi chú dập hàn hoặc Dập nhỏ keo', 'Không có tiêu chuẩn, được chi thị bóp hàn', 'Có tiêu chuẩn nhưng được hiển thị hàn', 'Có ghi chú tiếng nhật はんだ', 'Có ghi chú tiếng nhật ハンダ', 'Tất cả các phương án'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                        ],

                    ],
                    [
                        'group' => '<h5>V. CÁCH SỬ DỤNG PHẦN MỀM DẬP</h5>',
                        'point' => 3,
                        'width' => 1,
                        'random' => 0,
                        'questions' =>  [
                            [
                                'id' => 24,
                                'name' => 'Mục đích của việc sử dụng phần mềm so sánh tanshi (Bạn hãy chọn đáp án đúng) ( 3 điểm )',
                                'point' => 3,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Tất cả các phương án',
                                'answer_list' => ['Lưu dữ liệu đã dập lên phần mềm', 'So sánh và lưu dữ liệu chiều cao', 'So sánh tanshi, phòng tránh lỗi dập nhầm', 'Điều tra dữ liệu dễ dàng', 'Tất cả các phương án'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 25,
                                'name' => 'Cách sử dụng phần mềm dập (Bạn hãy chọn phương án đúng) ( 5 điểm )?',
                                'point' => 5,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Phương án 2:<br><div style="margin-left: 35px;">1. Mở phần mềm dập</div><div style="margin-left: 35px;">2. Nhập mã nhân viên 2 lần</div><div style="margin-left: 35px;">3. Nhấn vào công đoạn Dập</div><div style="margin-left: 35px;">4. Ở Phần mềm Dập nhấn "Truy cập"</div><div style="margin-left: 35px;">5. Scan mã QR trên EDP cần dập vào dòng đầu tiên</div><div style="margin-left: 35px;">6. Màn hình hiên thị thông số : Mã sản phẩm, số lót, số dây,cỡ dây, đầu tanshi A-B</div><div style="margin-left: 35px;">7. Scan tên tanshi so sánh trên cuộn tanshi</div><div style="margin-left: 35px;">8. Máy tính sẽ đọc + hiển thị số dây +  đầu tanshi cần dập, tiêu chuẩn chiều cao và thông số để thiết lập</div><div style="margin-left: 35px;">9. Thiết lập chiều cao, dập thử, đo ok thì nhập lên máy, NG thì thiết lập lại đến khi ok</div>',
                                'answer_list' => [
                                    'Phương án 1:<br>
                                                       <div style="margin-left: 35px;">1. Mở phần mềm dập</div>
                                                       <div style="margin-left: 35px;">2. Nhấn vào công đoạn Dập</div>
                                                       <div style="margin-left: 35px;">3. Nhập mã nhân viên 2 lần</div>
                                                       <div style="margin-left: 35px;">4. Ở Phần mềm Dập nhấn "Truy cập"</div>
                                                       <div style="margin-left: 35px;">5. Scan mã QR trên EDP cần dập vào dòng đầu tiên</div>
                                                       <div style="margin-left: 35px;">6. Màn hình hiên thị thông số : Mã sản phẩm, số lót, số dây,cỡ dây, đầu tanshi A-B</div>
                                                       <div style="margin-left: 35px;">7. Thiết lập chiều cao, dập thử, đo ok thì nhập lên máy, NG thì thiết lập lại đến khi ok</div>
                                                       <div style="margin-left: 35px;">8. Máy tính sẽ đọc + hiển thị số dây +  đầu tanshi cần dập, tiêu chuẩn chiều cao và thông số để thiết lập</div>
                                                       <div style="margin-left: 35px;">9. Scan tên tanshi so sánh trên cuộn tanshi</div>',
                                    'Phương án 2:<br><div style="margin-left: 35px;">1. Mở phần mềm dập</div><div style="margin-left: 35px;">2. Nhập mã nhân viên 2 lần</div><div style="margin-left: 35px;">3. Nhấn vào công đoạn Dập</div><div style="margin-left: 35px;">4. Ở Phần mềm Dập nhấn "Truy cập"</div><div style="margin-left: 35px;">5. Scan mã QR trên EDP cần dập vào dòng đầu tiên</div><div style="margin-left: 35px;">6. Màn hình hiên thị thông số : Mã sản phẩm, số lót, số dây,cỡ dây, đầu tanshi A-B</div><div style="margin-left: 35px;">7. Scan tên tanshi so sánh trên cuộn tanshi</div><div style="margin-left: 35px;">8. Máy tính sẽ đọc + hiển thị số dây +  đầu tanshi cần dập, tiêu chuẩn chiều cao và thông số để thiết lập</div><div style="margin-left: 35px;">9. Thiết lập chiều cao, dập thử, đo ok thì nhập lên máy, NG thì thiết lập lại đến khi ok</div>'
                                ],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                        ]
                    ],
                    [
                        'group' => '<h5>VI.DÂY DẬP CHỒNG</h5>',
                        'point' => 3,
                        'width' => 1,
                        'random' => 0,
                        'questions' =>  [
                            [
                                'id' => 26,
                                'name' => 'Đâu là kí hiệu dập chồng (bạn hãy chọn đáp án đúng) ( 5 điểm )?',
                                'point' => 5,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'ﾀﾞﾌﾞﾙ',
                                'answer_list' => ['はんだ', 'ﾀﾞﾌﾞﾙ', 'ﾂｲｽﾄ', '圧着後ハンダ', 'マーク No'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 27,
                                'name' => 'Trình tự thao tác dập chồng (Bạn hãy chọn phương án đúng) ( 5 điểm )?',
                                'point' => 5,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Phương án 1:<br><div style="margin-left: 35px;">1. Chọn dây dập chồng cùng mã sản phẩm, cùng tên tanshi, Chọn số dây dập chồng tương ứng</div><div style="margin-left: 35px;">2. Trên phần mềm nhấn "Dập chồng" sau đó Scan EDP lên.  Đối với dập chồng 3 dây trở lên nhấn "Dập Thêm" trên phần mềm dập đến khi scan hết EDP bộ dập chồng</div><div style="margin-left: 35px;">3. Nhặt dây của từng số dây đến khi đủ bộ dập chồng (Ví dụ dập chồng 5 dây phải nhặt mỗi số dây 1 pcs) Dây sỏ chồng phải lấy dây theo ống, maku, ghibushi đã sỏ sẵn để dập.</div><div style="margin-left: 35px;">4. Xếp đầu dây bằng nhau, không dây nào bị tụt xuống thấp hơn hay đồng cao hơn, rồi tiến hành dập</div>',
                                'answer_list' => [
                                    'Phương án 1:<br><div style="margin-left: 35px;">1. Chọn dây dập chồng cùng mã sản phẩm, cùng tên tanshi, Chọn số dây dập chồng tương ứng</div><div style="margin-left: 35px;">2. Trên phần mềm nhấn "Dập chồng" sau đó Scan EDP lên.  Đối với dập chồng 3 dây trở lên nhấn "Dập Thêm" trên phần mềm dập đến khi scan hết EDP bộ dập chồng</div><div style="margin-left: 35px;">3. Nhặt dây của từng số dây đến khi đủ bộ dập chồng (Ví dụ dập chồng 5 dây phải nhặt mỗi số dây 1 pcs) Dây sỏ chồng phải lấy dây theo ống, maku, ghibushi đã sỏ sẵn để dập.</div><div style="margin-left: 35px;">4. Xếp đầu dây bằng nhau, không dây nào bị tụt xuống thấp hơn hay đồng cao hơn, rồi tiến hành dập</div>',
                                    'Phương án 2:<br>
                                                <div style="margin-left: 35px;">1. Chọn dây dập chồng cùng mã sản phẩm, cùng tên tanshi, Chọn số dây dập chồng tương ứng</div>
                                                <div style="margin-left: 35px;">2. Xếp đầu dây bằng nhau, không dây nào bị tụt xuống thấp hơn hay đồng cao hơn, rồi tiến hành dập</div>
                                                <div style="margin-left: 35px;">3. Nhặt dây của từng số dây đến khi đủ bộ dập chồng (Ví dụ dập chồng 5 dây phải nhặt mỗi số dây 1 pcs) Dây sỏ chồng phải lấy dây theo ống, maku, ghibushi đã sỏ sẵn để dập</div>
                                                <div style="margin-left: 35px;">4. Trên phần mềm nhấn "Dập chồng" sau đó Scan EDP lên.  Đối với dập chồng 3 dây trở lên nhấn "Dập Thêm" trên phần mềm dập đến khi scan hết EDP bộ dập chồng</div>'
                                ],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 28,
                                'name' => 'Thao tác dập chồng (Bạn hãy chọn câu trả lời đúng) ( 2 điểm )?',
                                'point' => 2,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => '1',
                                'answer_list' => [1 => 'Không được dập chồng dây cùng 1 bó dây với nhau (trừ trường hợp EDP hiển thị dập chồng với chính nó)', 2 => 'Dây sỏ chồng phải lấy dây từ ống, maku, ghibushi để dập và kiểm tra', 3 => 'Dập xong không cần nhặt từng pcs tanshi lên kiểm tra xem đã nhặt đúng dây chưa', 4 => 'Có thể lấy nhiều dây trong cùng 1 số dây để dập chồng vào nhau'],
                                'show_question' => 1,
                                'multiple_answer' => [1 => 'Không được dập chồng dây cùng 1 bó dây với nhau (trừ trường hợp EDP hiển thị dập chồng với chính nó)', 2 => 'Dây sỏ chồng phải lấy dây từ ống, maku, ghibushi để dập và kiểm tra'],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'checkbox'
                            ],
                            [
                                'id' => 29,
                                'name' => 'Tiêu chuẩn dập chồng đối với tanshi LA, BA ( 3điểm )?',
                                'point' => 3,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Dây to và nhỏ để ngang nhau',
                                'answer_list' => [1 => 'Dây nhỏ để trên', 2 => 'Dây to và nhỏ để ngang nhau', 3 => 'Dây nhỏ để dưới'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [1 => '\public\assets\frontend\images\congdoandap2\group6_4.png', 2 => '\public\assets\frontend\images\congdoandap2\group6_5.png', 3 => '\public\assets\frontend\images\congdoandap2\group6_6.png'],
                                'type_input' => 'number'
                            ],
                        ]
                    ],
                    [
                        'group' => '<h5>VII.Dây SRD</h5>',
                        'point' => 3,
                        'width' => 1,
                        'random' => 0,
                        'questions' =>  [
                            [
                                'id' => 30,
                                'name' => 'Chú ý khi dập dây SRD (Bạn hãy chọn đáp án đúng)  ( 4 điểm )?',
                                'point' => 4,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => '1',
                                'answer_list' => [1 => 'Người chia hàng cho dập phần tanshi trong phần ghi chú trước', 2 => 'Nếu có tanshi trong phần ghi chú, báo quản lý để liên lạc tách EDP', 3 => 'Khi dập NG phải nhờ bên gia công SRD họ kiểm tra xem cắt đi có ok không và nhờ họ sửa hộ', 4 => 'Trên phần mềm tích vào "dây SRD" để dập SRD và nhập số lõi tương ứng để phần mềm nhận đủ sản lượng', 5 => 'SRD có tanshi trong phần ghi chú và tanshi ngoài thì dập tanshi nào trước cũng được', 6 => 'Khi dập NG có thể cắt đi dập lại'],
                                'show_question' => 1,
                                'multiple_answer' => [1 => 'Người chia hàng cho dập phần tanshi trong phần ghi chú trước', 2 => 'Nếu có tanshi trong phần ghi chú, báo quản lý để liên lạc tách EDP', 3 => 'Khi dập NG phải nhờ bên gia công SRD họ kiểm tra xem cắt đi có ok không và nhờ họ sửa hộ', 4 => 'Trên phần mềm tích vào "dây SRD" để dập SRD và nhập số lõi tương ứng để phần mềm nhận đủ sản lượng'],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'checkbox'
                            ],
                            [
                                'id' => 31,
                                'name' => 'Dây SRD thả hàng dựa vào đâu ( 5 điểm )?',
                                'point' => 5,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Tất cả các phương án',
                                'answer_list' => ['Tất cả đầu tanshi đã được dập ok', 'Ami 0-10 thả vào hoàn thiện', 'Ami 15 trở lên thả nối', 'Ami **** chuyển lên hàn (nếu không có ghi chú "Không hàn")', 'Có lõi dây hiển thị "J" thả nối', 'Tất cả các phương án'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                        ]
                    ],
                    [
                        'group' => '<h5>VIII.Phân loại hàng Hoàn thiện, xoắn, nối (6 điểm )</h5>',
                        'point' => 6,
                        'width' => 1,
                        'random' => 0,
                        'questions' =>  [
                            [
                                'id' => 32,
                                'name' => 'Hàng xoắn (Bạn hãy chọn đáp án đúng) ( 2 điểm )?',
                                'point' => 2,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => '1',
                                'answer_list' => [1 => 'Hàng đã được dập hết tất cả đầu tanshi,Hiển thị  số  ở phần thông số xoắn', 2 => 'Đã dập 1 đầu tanshi, đầu còn lại là J nối, Hiển thị  số  ở phần thông số xoắn', 3 => 'Đã dập 1 đầu tanshi, đầu còn lại là J nối, Phần thông số xoắn không có số,Không có ghi chú xoắn cùng với số dây nào ở phần ghi chú', 4 => 'Hàng đã được dập tất cả các đầu tanshi & Không hiển thị xoắn, nối'],
                                'show_question' => 1,
                                'multiple_answer' => [1 => 'Hàng đã được dập hết tất cả đầu tanshi,Hiển thị  số  ở phần thông số xoắn', 2 => 'Đã dập 1 đầu tanshi, đầu còn lại là J nối, Hiển thị  số  ở phần thông số xoắn'],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'checkbox'
                            ],
                            [
                                'id' => 33,
                                'name' => 'Hàng nối (Bạn hãy chọn đáp án đúng) ( 2 điểm )?',
                                'point' => 2,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => '1',
                                'answer_list' => [1 => 'Đã dập 1 đầu tanshi, đầu còn lại là J nối, Phần thông số xoắn không có số,Không có ghi chú xoắn cùng với số dây nào ở phần ghi chú', 2 => 'Dây SRD đã dập hết đầu tanshi ,Có lõi dây J nối (ở phần tanshi hoặc ghi chú),Có ami L=20mm trở lên (ami không ghi chú gì)', 3 => 'Đã dập 1 đầu tanshi, đầu còn lại là J nối, Hiển thị  số  ở phần thông số xoắn'],
                                'show_question' => 1,
                                'multiple_answer' => [1 => 'Đã dập 1 đầu tanshi, đầu còn lại là J nối, Phần thông số xoắn không có số,Không có ghi chú xoắn cùng với số dây nào ở phần ghi chú', 2 => 'Dây SRD đã dập hết đầu tanshi ,Có lõi dây J nối (ở phần tanshi hoặc ghi chú),Có ami L=20mm trở lên (ami không ghi chú gì)'],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'checkbox'
                            ],
                            [
                                'id' => 34,
                                'name' => 'Hàng 1 đầu  (Bạn hãy chọn đáp án đúng) ( 1 điểm )?',
                                'point' => 1,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Đối với dây đơn: đã được dập 1 đầu,  đầu còn  lại chưa được dập,  Dây dập chồng, SRD, sỏ ống * hoặc conector: Còn bất kì 1 đầu nào chưa dập',
                                'answer_list' => [1 => 'Đã dập 1 đầu tanshi, đầu còn lại là J nối, Phần thông số xoắn không có số,Không có ghi chú xoắn cùng với số dây nào ở phần ghi chú', 2 => 'Đối với dây đơn: đã được dập 1 đầu,  đầu còn  lại chưa được dập,  Dây dập chồng, SRD, sỏ ống * hoặc conector: Còn bất kì 1 đầu nào chưa dập'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 35,
                                'name' => 'Hàng hoàn thiện  (Bạn hãy chọn đáp án đúng) ( 1 điểm)?',
                                'point' => 1,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Hàng đã được dập tất cả các đầu tanshi & Không hiển thị xoắn, nối',
                                'answer_list' => [1 => 'Hàng đã được dập hết tất cả đầu tanshi,Hiển thị  số  ở phần thông số xoắn', 2 => 'Hàng đã được dập tất cả các đầu tanshi & Không hiển thị xoắn, nối'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                        ]
                    ],
                    [
                        'group' => '<h5>IV.Kiểm tra ngoại quan tanshi ( 9 điểm )</h5>',
                        'point' => 9,
                        'width' => 3,
                        'random' => 0,
                        'questions' =>  [
                            [
                                'id' => 36,
                                'name' => '',
                                'point' => 0.5,
                                'path_image' => '\public\assets\frontend\images\congdoandap2\group9_1.png',
                                'width_image' => 70,
                                'answer' => 'NG',
                                'answer_list' => ['OK', 'NG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 37,
                                'name' => '',
                                'point' => 0.5,
                                'path_image' => '\public\assets\frontend\images\congdoandap2\group9_2.png',
                                'width_image' => 70,
                                'answer' => 'NG',
                                'answer_list' => ['OK', 'NG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 38,
                                'name' => '',
                                'point' => 0.5,
                                'path_image' => '\public\assets\frontend\images\congdoandap2\group9_3.png',
                                'width_image' => 70,
                                'answer' => 'OK',
                                'answer_list' => ['OK', 'NG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 39,
                                'name' => '',
                                'point' => 0.5,
                                'path_image' => '\public\assets\frontend\images\congdoandap2\group9_4.png',
                                'width_image' => 70,
                                'answer' => 'NG',
                                'answer_list' => ['OK', 'NG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 40,
                                'name' => '',
                                'point' => 0.5,
                                'path_image' => '\public\assets\frontend\images\congdoandap2\group9_5.png',
                                'width_image' => 70,
                                'answer' => 'OK',
                                'answer_list' => ['OK', 'NG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 41,
                                'name' => '',
                                'point' => 0.5,
                                'path_image' => '\public\assets\frontend\images\congdoandap2\group9_6.png',
                                'width_image' => 70,
                                'answer' => 'NG',
                                'answer_list' => ['OK', 'NG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 42,
                                'name' => '',
                                'point' => 0.5,
                                'path_image' => '\public\assets\frontend\images\congdoandap2\group9_7.png',
                                'width_image' => 70,
                                'answer' => 'NG',
                                'answer_list' => ['OK', 'NG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 43,
                                'name' => '',
                                'point' => 0.5,
                                'path_image' => '\public\assets\frontend\images\congdoandap2\group9_8.png',
                                'width_image' => 70,
                                'answer' => 'NG',
                                'answer_list' => ['OK', 'NG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 44,
                                'name' => '',
                                'point' => 0.5,
                                'path_image' => '\public\assets\frontend\images\congdoandap2\group9_9.png',
                                'width_image' => 70,
                                'answer' => 'NG',
                                'answer_list' => ['OK', 'NG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 45,
                                'name' => '',
                                'point' => 0.5,
                                'path_image' => '\public\assets\frontend\images\congdoandap2\group9_10.png',
                                'width_image' => 70,
                                'answer' => 'OK',
                                'answer_list' => ['OK', 'NG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 46,
                                'name' => '',
                                'point' => 0.5,
                                'path_image' => '\public\assets\frontend\images\congdoandap2\group9_11.png',
                                'width_image' => 70,
                                'answer' => 'NG',
                                'answer_list' => ['OK', 'NG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 47,
                                'name' => '',
                                'point' => 0.5,
                                'path_image' => '\public\assets\frontend\images\congdoandap2\group9_12.png',
                                'width_image' => 70,
                                'answer' => 'NG',
                                'answer_list' => ['OK', 'NG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 48,
                                'name' => '',
                                'point' => 0.5,
                                'path_image' => '\public\assets\frontend\images\congdoandap2\group9_13.png',
                                'width_image' => 70,
                                'answer' => 'OK',
                                'answer_list' => ['OK', 'NG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 49,
                                'name' => '',
                                'point' => 0.5,
                                'path_image' => '\public\assets\frontend\images\congdoandap2\group9_14.png',
                                'width_image' => 70,
                                'answer' => 'NG',
                                'answer_list' => ['OK', 'NG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 50,
                                'name' => '',
                                'point' => 0.5,
                                'path_image' => '\public\assets\frontend\images\congdoandap2\group9_15.png',
                                'width_image' => 70,
                                'answer' => 'NG',
                                'answer_list' => ['OK', 'NG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 51,
                                'name' => '',
                                'point' => 0.5,
                                'path_image' => '\public\assets\frontend\images\congdoandap2\group9_16.png',
                                'width_image' => 70,
                                'answer' => 'OK',
                                'answer_list' => ['OK', 'NG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 52,
                                'name' => '',
                                'point' => 0.5,
                                'path_image' => '\public\assets\frontend\images\congdoandap2\group9_17.png',
                                'width_image' => 70,
                                'answer' => 'NG',
                                'answer_list' => ['OK', 'NG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 53,
                                'name' => '',
                                'point' => 0.5,
                                'path_image' => '\public\assets\frontend\images\congdoandap2\group9_18.png',
                                'width_image' => 70,
                                'answer' => 'NG',
                                'answer_list' => ['OK', 'NG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                        ]
                    ]
                ]
            ],
            7 => [
                'title' => 'Bài kiểm tra kiến thức công nhân bên cắt',
                'description' => '<i>Điểm đạt: 80 điểm trở lên </i><br>
                                           <i>Từ 61->80 điểm: kiểm tra lại</i><br>
                                           <i>Từ 50->60 điểm: đào tạo lại</i><br>
                                           <i>Dưới 50 điểm: Không đạt</i><br>',
                'messager' => [
                    1 => '<br>Điểm đạt: 80 điểm trở lên<br><img src="public\assets\frontend\images\logos\anh-icon-vui.jpg" width="100" />',
                    2 => '<br>Từ 61->80 điểm: kiểm tra lại<br><img src="public\assets\frontend\images\logos\anh-icon-buon.jpg" width="100" />',
                    3 => '<br>Từ 50->60 điểm: đào tạo lại. <br>Dưới 50 điểm: Không đạt<br><img src="public\assets\frontend\images\logos\anh-icon-buon.jpg" width="100" />'
                ],
                'time' => 30,
                'scores' => [80, 60], // điểm đạt
                'data' =>
                [
                    [
                        'group' => '<h5>I. AN TOÀN LAO ĐỘNG ( 5 điểm )</h5>',
                        'point' => 5,
                        'width' => 1,
                        'random' => 0,
                        'questions' =>  [
                            [
                                'id' => 1,
                                'name' => 'Theo bạn thao tác an toàn lao động là thao tác nào? (Khoanh vào câu trả lời đúng)',
                                'point' => 4,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Tất cả các phương án',
                                'answer_list' => ['Khi cắt dây phải có mặt nạ bảo vệ', 'Khi treo dây lên xe phải treo đều hai bên', 'Khi sử lý sự cố phải dừng máy', 'Khi kẹt tanshi phải dùng nhíp gắp tanshi', 'Khi lấy dây phải bê bằng hai tay', 'Tất cả các phương án'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ]
                        ]
                    ],
                    [
                        'group' => '<div><h5>II. KIỂM TRA NĂNG LỰC NHẬN BIẾT MÀU DÂY ( 12 điểm )</h5></div>
                                              <div style="color:red">Bạn hãy chọn đáp án đúng bằng cách tích vào đáp án màu dây tương ứng với màu dây trong ảnh</div>',
                        'point' => 1,
                        'width' => 3,
                        'random' => 0,
                        'questions' =>  [
                            [
                                'id' => 2,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_1.png',
                                'width_image' => 70,
                                'answer' => 'RY',
                                'answer_list' => ['RV', 'RW', 'RY'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 3,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_2.png',
                                'width_image' => 70,
                                'answer' => 'GW',
                                'answer_list' => ['GY', 'GW', 'GBr'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 4,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_3.png',
                                'width_image' => 70,
                                'answer' => 'B',
                                'answer_list' => ['Br', 'BR', 'B'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 5,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_4.png',
                                'width_image' => 70,
                                'answer' => 'Br',
                                'answer_list' => ['Br', 'BR', 'BG'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 6,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_5.png',
                                'width_image' => 70,
                                'answer' => 'V',
                                'answer_list' => ['V', 'O', 'G'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 7,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_6.png',
                                'width_image' => 70,
                                'answer' => 'LgR',
                                'answer_list' => ['Lg', 'LgR', 'GW'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 8,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_7.png',
                                'width_image' => 70,
                                'answer' => 'PB',
                                'answer_list' => ['PV', 'OR', 'PB'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 9,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_8.png',
                                'width_image' => 70,
                                'answer' => 'LY',
                                'answer_list' => ['LW', 'LY', 'GY'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 10,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_9.png',
                                'width_image' => 70,
                                'answer' => 'LW',
                                'answer_list' => ['LR', 'LW', 'GL'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 11,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_10.png',
                                'width_image' => 70,
                                'answer' => 'YL',
                                'answer_list' => ['YL', 'LgR', 'GW'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 12,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_11.png',
                                'width_image' => 70,
                                'answer' => 'LG',
                                'answer_list' => ['PO', 'LG', 'PV'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 13,
                                'name' => '',
                                'point' => 1,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group2_12.png',
                                'width_image' => 70,
                                'answer' => 'W',
                                'answer_list' => ['O', 'Y', 'W'],
                                'show_question' => 0,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                        ]
                    ],
                    [
                        'group' => '<h5>III. KIỂM TRA THÔNG TIN TRÊN EDP ( 5 điểm)</h5>',
                        'point' => 5,
                        'width' => 1,
                        'random' => 0, // nếu là 0 thì random all,nếu lớn hơn không thì random theo
                        'questions' =>  [
                            [
                                'id' => 14,
                                'name' => 'Giải thích các thông số trên EDP ?',
                                'point' => 5,
                                'path_image' => '\public\assets\frontend\images\congdoandap\group3_1.png',
                                'width_image' => 70,
                                'answer' => '1',
                                'answer_list' => [1 => 'Kích thước dây', 2 => 'Mã sản phẩm', 3 => 'Số dây', 4 => 'Chủng loại dây', 5 => 'Giá để tanshi', 6 => 'Tên lot', 7 => 'Tanshi A', 8 => 'Đầu chuốt Tanshi A', 9 => 'Tanshi B', 10 => 'Đầu chuốt Tanshi B', 11 => 'Nội dung cần chú ý', 12 => 'Số lượng dây cắt', 13 => 'Kí hiệu của lót hàng', 14 => 'Tên mối nối', 15 => 'Kích thước dây sau xoắn', 16 => 'Cost QR', 17 => 'Maku dây'],
                                'show_question' => 1,
                                'multiple_answer' => [1 => 'Kích thước dây', 2 => 'Mã sản phẩm', 3 => 'Số dây', 4 => 'Chủng loại dây', 5 => 'Giá để tanshi', 6 => 'Tên lot', 7 => 'Tanshi A', 8 => 'Đầu chuốt Tanshi A', 9 => 'Tanshi B', 10 => 'Đầu chuốt Tanshi B', 11 => 'Nội dung cần chú ý', 12 => 'Số lượng dây cắt', 13 => 'Kí hiệu của lót hàng', 14 => 'Tên mối nối', 15 => 'Kích thước dây sau xoắn', 16 => 'Cost QR', 17 => 'Maku dây'],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ]
                        ]
                    ],
                    [
                        'group' => '<h5>IV. Phân biệt chủng loại kích cỡ dây ( 10 điểm) </h5>',
                        'point' => 10,
                        'width' => 1,
                        'random' => 0, // nếu là 0 thì random all,nếu lớn hơn không thì random theo
                        'questions' =>  [
                            [
                                'id' => 15,
                                'name' => 'Dựa vào đâu để Phân biệt kích cỡ dây, màu dây ?',
                                'point' => 5,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Tất cả các phương án',
                                'answer_list' => ['Dựa vào edp', 'Dựa vào tem mác dán trên quận dây', 'Tất cả các phương án'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 16,
                                'name' => 'Các chủng loại dây khó cắt được phân biệt như thế nào?',
                                'point' => 5,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Mác Qr code màu vàng',
                                'answer_list' => ['Mác Qr code màu vàng', 'Mác Qr code màu trắng'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ]
                        ]
                    ],
                    [
                        'group' => '<h5>V.NHỮNG LỖI CÓ THỂ PHÁT SINH TRONG CÔNG ĐOẠN CẮT( 15 điểm) </h5>',
                        'point' => 15,
                        'width' => 1,
                        'random' => 0, // nếu là 0 thì random all,nếu lớn hơn không thì random theo
                        'questions' =>  [
                            [
                                'id' => 17,
                                'name' => 'Tích vào câu trả lời đúng?',
                                'point' => 5,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => '1',
                                'answer_list' => [1 => 'Lỗi Sai chủng loại dây', 2 => 'Máy không chuốt được vỏ dây', 3 => 'Cắt sai đầu chuất', 4 => 'Cắt thừa thiếu số lượng', 5 => 'Cắt âm dương kích thước', 6 => 'Dập nhầm đầu so với chiều ghiboshi', 7 => 'Lỗi xước dây・Đứt dây', 8 => 'Sỏ sai, sỏ nhầm', 9 => 'Thiếu ghiboshi・Thừa ghiboshi', 10 => 'Lỗi gia công dây shirrudo bị ngắn', 11 => 'Cắm sai nhầm đầu gia công', 12 => 'Nối nhầm đầu chuốt', 13 => 'Lỗi biến dạng tanshi・hỏng・xước', 14 => 'Lỗi chiều cao tanshi', 15 => 'Lỗi ngược maku'],
                                'show_question' => 1,
                                'multiple_answer' => [1 => 'Lỗi Sai chủng loại dây', 3 => 'Cắt sai đầu chuất', 4 => 'Cắt thừa thiếu số lượng', 5 => 'Cắt âm dương kích thước', 7 => 'Lỗi xước dây・Đứt dây', 8 => 'Sỏ sai, sỏ nhầm', 9 => 'Thiếu ghiboshi・Thừa ghiboshi', 10 => 'Lỗi gia công dây shirrudo bị ngắn', 13 => 'Lỗi biến dạng tanshi・hỏng・xước', 14 => 'Lỗi chiều cao tanshi', 15 => 'Lỗi ngược maku'],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'checkbox'
                            ]
                        ]
                    ],
                    [
                        'group' => '<h5>VI.ĐỨNG MÁY (20 điểm) </h5>',
                        'point' => 20,
                        'width' => 1,
                        'random' => 0, // nếu là 0 thì random all,nếu lớn hơn không thì random theo
                        'questions' =>  [
                            [
                                'id' => 18,
                                'name' => 'Sử lý sự cố máy? (5 ĐIỂM) (Tích vào câu trả lời đúng)',
                                'point' => 5,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Dừng máy, kiểm tra dây, bỏ dây xước hỏng nếu có, trừ số lượng, kiểm tra lại máy sử lý lỗi đầu vào',
                                'answer_list' => ['Dừng máy, kiểm tra dây, bỏ dây xước hỏng nếu có, trừ số lượng, kiểm tra lại máy sử lý lỗi đầu vào', 'Dừng máy, kiểm tra lại máy sử lý lỗi đầu vào, bỏ dây xước hỏng nếu có, trừ số lượng trên máy '],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 19,
                                'name' => 'Khi thiết lập dây cắt kiểm tra những gì (15 ĐIỂM)',
                                'point' => 5,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Tất cả các phương án',
                                'answer_list' => ['Khi lắp dây chếch chủng loại dây trên edp trùng khớp với mác Qr code và dán trên quận dây', 'Kiểm tra con lăn theo chủng loại dây ', 'Kiểm tra lực giao theo chủng loại dây', 'Kiểm tra dây xem có đủ đầu chuất, đủ kích thước , dây có vết xước không', 'Cắt thử để tes lực giao bẻ đầu đồng đứt NG sẽ điều chỉn lại, ok sẽ tiến hàng cắt hàng loạt', 'Tất cả các phương án'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ]
                        ]
                    ],
                    [
                        'group' => '<h5>VII.GIA CÔNG, SỎ(20 điểm) </h5>',
                        'point' => 20,
                        'width' => 1,
                        'random' => 0, // nếu là 0 thì random all,nếu lớn hơn không thì random theo
                        'questions' =>  [
                            [
                                'id' => 20,
                                'name' => 'Trên EDP có bao nhiêu vi trí hiển thị sở? (10 ĐIỂM) (Tích vào câu trả lời đúng)',
                                'point' => 5,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => '5',
                                'answer_list' => ['1', '2', '3', '4', '5'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 21,
                                'name' => 'Nhìn vào đâu để lấy gôm (10 ĐIỂM)',
                                'point' => 5,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Nhìn vào tên gôm hiển thị trên edp, Xác định vị trí giá gôm trên edp, đối chiếu với mác gôm hiển thị trên giá và mác trên túi gôm trùng khớp',
                                'answer_list' => ['Nhìn vào tên gôm hiển thị trên edp', 'Nhìn vào vị trí giá gôm', 'Nhìn vào tên gôm hiển thị trên edp, Xác định vị trí giá gôm trên edp, đối chiếu với mác gôm hiển thị trên giá và mác trên túi gôm trùng khớp'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ]
                        ]
                    ],
                ]
            ],
            8 => [
                'title' => 'Bài kiểm tra năng lực công nhân trên 1 năm',
                'description' => '<i>Điểm đạt: 90->100 điểm</i><br>
                                <i>Từ 80->90 điểm: kiểm tra lại sau 2 ngày (nếu không đạt sẽ được đào tạo lại)</i><br>
                                <i>Dưới 80 điểm: Không đạt ( đào tạo lại màu dây 1 tuần)</i><br>',
                'messager' => [
                    1 => '<br>Điểm đạt: 90->100 điểm<br><img src="public\assets\frontend\images\logos\anh-icon-vui.jpg" width="100" />',
                    2 => '<br>Từ 80->90 điểm: kiểm tra lại sau 2 ngày<br><img src="public\assets\frontend\images\logos\anh-icon-buon.jpg" width="100" />',
                    3 => '<br>Dưới 80 điểm: Không đạt<br><img src="public\assets\frontend\images\logos\anh-icon-buon.jpg" width="100" />'
                ],
                'time' => 10,
                'scores' => [90, 80], // điểm đạt
                'data' =>
                [
                    [
                        'group' => '',
                        'point' => 5,
                        'width' => 1,
                        'random' => 0,
                        'questions' =>  [
                            [
                                'id' => 1,
                                'name' => 'Maku được in mấy lần ?',
                                'point' => 4.54,
                                'path_image' => '\public\assets\frontend\images\ktnq2\group1_1.png',
                                'width_image' => 70,
                                'answer' => 'Maku in 2 lần',
                                'answer_list' => ['Maku in 1 lần', 'Maku in 2 lần', 'Không có maku'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 2,
                                'name' => 'Quy trình kiểm tra NQ gồm có bao nhiêu bước?',
                                'point' => 4.54,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Gồm 14 bước',
                                'answer_list' => ['Gồm 14 bước', 'Gồm 12 bước', 'Gồm 15 bước'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 3,
                                'name' => 'Vị trí nào sau đây được đóng dấu thông mạch ?',
                                'point' => 4.54,
                                'path_image' => '\public\assets\frontend\images\ktnq2\group1_3.png',
                                'width_image' => 70,
                                'answer' => 'Đầu mác sản phẩm',
                                'answer_list' => ['Đầu mác sản phẩm', ' Cuối mác sản phẩm', 'Chỗ nào cũng được'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 4,
                                'name' => 'Khoảng cách quấn nhánh là bao nhiêu ?',
                                'point' => 4.54,
                                'path_image' => '\public\assets\frontend\images\ktnq2\group1_4.png',
                                'width_image' => 70,
                                'answer' => 'Quấn băng dính nhánh khoảng cách là 50 mm',
                                'answer_list' => ['Quấn băng dính nhánh khoảng cách là 50 mm', 'Quấn băng dính nhánh khoảng cách ~ 50 mm', 'Quấn băng dính nhánh khoảng cách không quá 50 mm'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 5,
                                'name' => 'Rải hàng theo hướng nào là đúng ?',
                                'point' => 4.54,
                                'path_image' => '\public\assets\frontend\images\ktnq2\group1_5.png',
                                'width_image' => 70,
                                'answer' => 'Rải hàng theo bản vẽ từ trái qua phải',
                                'answer_list' => ['Rải hàng theo bản vẽ từ trái qua phải', 'Rải hàng theo bản vẽ phải qua trái', 'Rải hàng theo như thế nào mình cảm thấy thuận tiện là được'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 6,
                                'name' => 'Hãy nêu thứ tự các hạng mục KTNQ theo các bước?<br>
                                           <div>1. Đọc ghi chú của bản vẽ và hình ảnh chú ý treo trên mẫu</div>
                                           <div>2. Xác nhận mã sản phẩm và số lần sửa đổi của mẫu , hàng , bản vẽ xem có trùng khớp nhau không</div>
                                           <div>3.Rải mẫu và hàng theo chiều của bản vẽ</div>',
                                'point' => 4.54,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Bước 2.bước 1.bước 3',
                                'answer_list' => ['Bước 1.bước 2.bước 3', 'Bước 1.bước 3.bước 2', 'Bước 2.bước 1.bước 3'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 7,
                                'name' => 'Nêu trình tự các bước kiểm tra CLIP ?<br>
                                           <div>1. Vạch bút sơn</div>
                                           <div>2. Kiểm tra đúng chủng loại, màu sắc</div>
                                           <div>3. Kiểm tra hướng clip</div>',
                                'point' => 4.54,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Bước 2.bước 3.bước 1',
                                'answer_list' => ['Bước 3.bước 1.bước 3', 'Bước 2.bước 1.bước 3', 'Bước 2.bước 3.bước 1'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 8,
                                'name' => 'Nêu trình tự các bước kiểm tra điểm bó cố định?<br>
                                           <div>1. Kiểm tra màu băng dính</div>
                                           <div>2. Kiểm tra hướng bó</div>
                                           <div>3. Kiểm tra điểm bó chặt chưa ?</div>
                                           <div>4. Đếm điểm bó</div>',
                                'point' => 4.54,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Bước 1.bước 2.bước 3.bước 4',
                                'answer_list' => ['Bước 3.bước 1.bước 4 .bước 3', 'Bước 1.bước 2.bước 3.bước 4', 'Bước 2.bước 3.bước 1.bước 4'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 9,
                                'name' => 'Nêu trình tự các bước kiểm tra điểm bó cố định?<br>
                                           <div>1. Kiểm tra màu băng dính</div>
                                           <div>2. Kiểm tra hướng bó</div>
                                           <div>3. Kiểm tra điểm bó chặt chưa ?</div>
                                           <div>4. Đếm điểm bó</div>',
                                'point' => 4.54,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Bước 1.bước 2.bước 3.bước 4',
                                'answer_list' => ['Bước 3.bước 1.bước 4 .bước 3', 'Bước 1.bước 2.bước 3.bước 4', 'Bước 2.bước 3.bước 1.bước 4'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 10,
                                'name' => '"Nêu trình tự các bước kiểm tra cầu chì?<br>
                                           <div>1. Dùng JIG để kiểm tra cầu chì</div>
                                           <div>2. KT chủng loại ,màu sắc, ampe</div>
                                           <div>3. Kiểm tra hướng cầu chì</div>
                                           <div>4. KT dấu bút sơn trắng, đỏ trên thân cầu chì</div>',
                                'point' => 4.54,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Bước 4.bước 1.bước 2 .bước 3',
                                'answer_list' => ['Bước 4.bước 1.bước 2 .bước 3', 'Bước 1.bước 2.bước 3.bước 4', 'Bước 2.bước 3.bước 1.bước 4'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 11,
                                'name' => 'Cách phân biệt mấy loại ống bảo vệ tanshi ?<br>
                                           <div>1. ống ES sấy chảy nhựa,ống sumi không sấy,ống bini sấy không chảy nhựa</div>
                                           <div>2.Ông ES sấy chảy nhựa,ống sumi sấy không chảy nhựa,ống bini không sấy</div>
                                           <div>3.ống ES không sấy ,ống sumi sấy không chảy nhựa,ống bini sấy chảy nhựa</div>',
                                'point' => 4.54,
                                'path_image' => '',
                                'width_image' => 70,
                                'answer' => 'Bước 2',
                                'answer_list' => ['Bước 3', 'Bước 1', 'Bước 2'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 12,
                                'name' => 'Quy cách quấn U bằng băng dính là bao nhiêu?',
                                'point' => 4.54,
                                'path_image' => '\public\assets\frontend\images\ktnq2\group1_12.png',
                                'width_image' => 70,
                                'answer' => 'Quấn U từ 8~8.5',
                                'answer_list' => ['Quấn U từ 0.8~0.85', 'Quấn U từ 8~8.5', 'Quấn U từ 0.8~8.5'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 13,
                                'name' => 'Cách quấn băng dính đầu ống là bao nhiêu?',
                                'point' => 4.54,
                                'path_image' => '\public\assets\frontend\images\ktnq2\group1_13.png',
                                'width_image' => 70,
                                'answer' => 'Kích Thước ra 30 mm vào 30 mm',
                                'answer_list' => ['Kích Thước ra 30 mm vào 30 mm', 'Kích Thước 30 mm', 'Kích Thước 90 mm'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 14,
                                'name' => 'Kí hiệu 1-2-3 nghĩa là gì ?',
                                'point' => 4.54,
                                'path_image' => '\public\assets\frontend\images\ktnq2\group1_14.png',
                                'width_image' => 70,
                                'answer' => 'Vị trí số 1 đầu ống,3 bó cố định, 2 ống xoắn',
                                'answer_list' => ['Vị trí số 1đầu ống,2 bó cố định,3 ống xoắn', 'Vị trí số 2 đầu ống,1 bó cố định, 3 ống xoắn', 'Vị trí số 1 đầu ống,3 bó cố định, 2 ống xoắn'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 15,
                                'name' => '"Kích thước 240 mm được hiểu như thế nào?',
                                'point' => 4.54,
                                'path_image' => '\public\assets\frontend\images\ktnq2\group1_15.png',
                                'width_image' => 70,
                                'answer' => 'Đo từ giữa nhánh đến đầu ống',
                                'answer_list' => ['Đo từ giữa nhánh đến đầu connerter', 'Đo từ giữa nhánh đến chân connerter', 'Đo từ giữa nhánh đến đầu ống'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 16,
                                'name' => 'Tanshi yêu cầu hướng như thế nào ?',
                                'point' => 4.54,
                                'path_image' => '\public\assets\frontend\images\ktnq2\group1_16.png',
                                'width_image' => 70,
                                'answer' => 'Tanshi ngửa',
                                'answer_list' => ['Tanshi ngửa', 'Tanshi úp', 'Tanshi nghiêng'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 17,
                                'name' => 'Điểm bó này được bó như thế nào?',
                                'point' => 4.54,
                                'path_image' => '\public\assets\frontend\images\ktnq2\group1_17.png',
                                'width_image' => 70,
                                'answer' => 'Bó vào connerter',
                                'answer_list' => ['Bó vào ống', 'Bó vào connerter', 'Bó vào dây điện'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 18,
                                'name' => 'Cách đo băng dính trắng hàng KOBELCO như thế nào?',
                                'point' => 4.54,
                                'path_image' => '\public\assets\frontend\images\ktnq2\group1_18.png',
                                'width_image' => 70,
                                'answer' => 'Đo từ giữa băng dính đến giữa băng dính',
                                'answer_list' => ['Đo từ đầu băng dính đến đầu băng dính', 'Đo từ cuối băng dính đến cuối băng dính', 'Đo từ giữa băng dính đến giữa băng dính'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 19,
                                'name' => 'Cách đo tanshi hàng takeuchi ?',
                                'point' => 4.54,
                                'path_image' => '\public\assets\frontend\images\ktnq2\group1_19.png',
                                'width_image' => 70,
                                'answer' => 'Đo từ giữa tanshi',
                                'answer_list' => ['Đo từ đầu tanshi', 'Đo từ giữa tanshi', 'Đo từ chân tanshi'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 20,
                                'name' => 'Cách quấn băng dính nhánh hàng takeuchi ?',
                                'point' => 4.54,
                                'path_image' => '\public\assets\frontend\images\ktnq2\group1_20.png',
                                'width_image' => 70,
                                'answer' => 'Quấn chụm',
                                'answer_list' => ['Quấn chụm', 'Quấn tách nhánh', 'Quấn cách chân'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 21,
                                'name' => 'Cách quấn băng dính nhánh hàng takeuchi?',
                                'point' => 4.54,
                                'path_image' => '\public\assets\frontend\images\ktnq2\group1_21.png',
                                'width_image' => 70,
                                'answer' => 'Quấn cách chân',
                                'answer_list' => ['Quấn chụm', 'Quấn tách nhánh', 'Quấn cách chân'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                            [
                                'id' => 22,
                                'name' => 'Kích thước quấn chụm là bao nhiêu ?',
                                'point' => 4.54,
                                'path_image' => '\public\assets\frontend\images\ktnq2\group1_22.png',
                                'width_image' => 70,
                                'answer' => 'Quấn 20mm',
                                'answer_list' => ['Quấn 20mm', 'Quấn dưới 20 mm', 'Quấn trên  20 mm'],
                                'show_question' => 1,
                                'multiple_answer' => [],
                                'answer_image_width' => 0,
                                'answer_image' => [],
                                'type_input' => 'number'
                            ],
                        ]
                    ],
                ]
            ]
        ];
    }

    public static function groupQuestion()
    {
        return [
            [
                'group' => 'I) Bạn hãy chọn đáp án đúng bằng cách tích vào ô có ký hiệu tương ứng với màu dây (20 điểm): (1 câu đúng 1 điểm)',
                'point' => 1,
                'quantity_question' => 20,
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
                        'show_question' => 0,
                    ],
                    [
                        'id' => 3,
                        'name' => 'Đỏ - Vàng',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\dovang.png',
                        'answer' => 'RY',
                        'answer_list' => ['RB', 'YR', 'RY', 'RG'],
                        'show_question' => 0,
                    ],
                    [
                        'id' => 4,
                        'name' => 'Đỏ - Xanh lá cây',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\doxanhlacay.png',
                        'answer' => 'RG',
                        'answer_list' => ['RB', 'RL', 'RY', 'RG'],
                        'show_question' => 0,
                    ],
                    [
                        'id' => 5,
                        'name' => 'Đỏ - Xanh',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\doxanh.png',
                        'answer' => 'RL',
                        'answer_list' => ['RB', 'RL', 'RY', 'RG'],
                        'show_question' => 0,
                    ],
                    [
                        'id' => 6,
                        'name' => 'Vàng - Đỏ',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\vangdo.png',
                        'answer' => 'YR',
                        'answer_list' => ['YR', 'YG', 'RY', 'YL'],
                        'show_question' => 0,

                    ],
                    [
                        'id' => 7,
                        'name' => 'Vàng - Đen',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\vangden.png',
                        'answer' => 'YB',
                        'answer_list' => ['YR', 'YB', 'RY', 'BY'],
                        'show_question' => 0,
                    ],
                    [
                        'id' => 8,
                        'name' => 'Vàng - Xanh lá cây',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\vangxanhlacay.png',
                        'answer' => 'YG',
                        'answer_list' => ['YR', 'YG', 'RY', 'BY'],
                        'show_question' => 0,
                    ],
                    [
                        'id' => 9,
                        'name' => 'Vàng - Xanh',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\vangxanh.png',
                        'answer' => 'YL',
                        'answer_list' => ['YL', 'YB', 'YG', 'YW'],
                        'show_question' => 0,
                    ],
                    [
                        'id' => 10,
                        'name' => 'Vàng - Trắng',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\vangtrang.png',
                        'answer' => 'YW',
                        'answer_list' => ['YL', 'WY', 'YG', 'YW'],
                        'show_question' => 0,
                    ],
                    [
                        'id' => 11,
                        'name' => 'Xanh lá cây- Trắng',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacaytrang.png',
                        'answer' => 'GW',
                        'answer_list' => ['GW', 'WR', 'GB', 'WG'],
                        'show_question' => 0,

                    ],
                    [
                        'id' => 12,
                        'name' => 'Xanh lá cây- Đỏ',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacaydo.png',
                        'answer' => 'GR',
                        'answer_list' => ['GR', 'RG', 'GB', 'GL'],
                        'show_question' => 0,

                    ],
                    [
                        'id' => 13,
                        'name' => 'Xanh lá cây- Vàng',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacayvang.png',
                        'answer' => 'GY',
                        'answer_list' => ['GY', 'GL', 'GB', 'GW'],
                        'show_question' => 0,

                    ],
                    [
                        'id' => 14,
                        'name' => 'Xanh lá cây- Đen',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacayden.png',
                        'answer' => 'GB',
                        'answer_list' => ['GY', 'GL', 'GB', 'BG'],
                        'show_question' => 0,
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
                        'show_question' => 0,

                    ],
                    [
                        'id' => 17,
                        'name' => 'Xanh-Đỏ',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-do.png',
                        'answer' => 'LR',
                        'answer_list' => ['LR', 'RL', 'LgR', 'GR'],
                        'show_question' => 0,

                    ],
                    [
                        'id' => 18,
                        'name' => 'Xanh-Vàng',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-vang.png',
                        'answer' => 'LY',
                        'answer_list' => ['LY', 'YL', 'GY', 'LB'],
                        'show_question' => 0,

                    ],
                    [
                        'id' => 19,
                        'name' => 'Xanh-Đen',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-den.png',
                        'answer' => 'LB',
                        'answer_list' => ['LgB', 'BL', 'GB', 'LB'],
                        'show_question' => 0,

                    ],
                    [
                        'id' => 20,
                        'name' => 'Xanh-Xanh lá cây',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-xanhlacay.png',
                        'answer' => 'LG',
                        'answer_list' => ['LG', 'GL', 'LY', 'LB'],
                        'show_question' => 0,

                    ],
                    [
                        'id' => 21,
                        'name' => 'Nâu-Trắng',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\nau-trang.png',
                        'answer' => 'BrW',
                        'answer_list' => ['BrW', 'GrW', 'BrR', 'BrY'],
                        'show_question' => 0,
                    ],
                    [
                        'id' => 22,
                        'name' => 'Nâu-Đỏ',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\nau-do.png',
                        'answer' => 'BrR',
                        'answer_list' => ['BrW', 'GrR', 'BrR', 'BrY'],
                        'show_question' => 0,
                    ],
                    [
                        'id' => 23,
                        'name' => 'Nâu-Vàng',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\nau-vang.png',
                        'answer' => 'BrY',
                        'answer_list' => ['BrW', 'GrR', 'BrR', 'BrY'],
                        'show_question' => 0,
                    ],
                    [
                        'id' => 24,
                        'name' => 'Nâu-Đen',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\nau-den.png',
                        'answer' => 'BrB',
                        'answer_list' => ['BrW', 'GrR', 'BrB', 'BrY'],
                        'show_question' => 0,
                    ],
                    [
                        'id' => 25,
                        'name' => 'Xanh lộc non-Đỏ',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-do.png',
                        'answer' => 'LgR',
                        'answer_list' => ['LgW', 'LgR', 'LR', 'GR'],
                        'show_question' => 0,
                    ],
                    [
                        'id' => 26,
                        'name' => 'Xanh lộc non-Vàng',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-vang.png',
                        'answer' => 'LgY',
                        'answer_list' => ['LgW', 'LgY', 'LY', 'GY'],
                        'show_question' => 0,
                    ],
                    [
                        'id' => 27,
                        'name' => 'Xanh lộc non-Đen',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-den.png',
                        'answer' => 'LgB',
                        'answer_list' => ['LB', 'LgR', 'LgB', 'GB'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 28,
                        'name' => 'Xanh lộc non-Trắng',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-trang.png',
                        'answer' => 'LgW',
                        'answer_list' => ['LgW', 'GW', 'LW', 'GY'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 29,
                        'name' => 'Đen-Trắng',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\den-trang.png',
                        'answer' => 'BW',
                        'answer_list' => ['BW', 'WB', 'PW', 'WG'],
                        'show_question' => 0,
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
                        'show_question' => 0,

                    ],
                    [
                        'id' => 32,
                        'name' => 'Đen-Xanh',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\den-xanh.png',
                        'answer' => 'BL',
                        'answer_list' => ['BL', 'LB', 'BY', 'BW'],
                        'show_question' => 0,

                    ],
                    [
                        'id' => 33,
                        'name' => 'Đen-Xanh lá cây',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\den-xanhlacay.png',
                        'answer' => 'BG',
                        'answer_list' => ['BL', 'BG', 'BY', 'GB'],
                        'show_question' => 0,
                    ],
                    [
                        'id' => 34,
                        'name' => 'Trắng - Đỏ',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-do.png',
                        'answer' => 'WR',
                        'answer_list' => ['WR', 'RW', 'WY', 'WV'],
                        'show_question' => 0,
                    ],
                    [
                        'id' => 35,
                        'name' => 'Trắng - Xanh',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-xanh.png',
                        'answer' => 'WL',
                        'answer_list' => ['WY', 'LW', 'WL', 'WV'],
                        'show_question' => 0,
                    ],
                    [
                        'id' => 36,
                        'name' => 'Trắng - Vàng',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-vang.png',
                        'answer' => 'WY',
                        'answer_list' => ['WY', 'YW', 'WL', 'WR'],
                        'show_question' => 0,
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
                        'id' => 38,
                        'name' => 'Trắng-Xanh lá cây',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-xanhlacay.png',
                        'answer' => 'WG',
                        'answer_list' => ['WG', 'WV', 'WL', 'GW'],
                        'show_question' => 0,

                    ],
                    [
                        'id' => 39,
                        'name' => 'Cam - Trắng',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\cam-trang.png',
                        'answer' => 'OW',
                        'answer_list' => ['GW', 'OW', 'WY', 'GW'],
                        'show_question' => 0,
                    ],
                    [
                        'id' => 40,
                        'name' => 'Hồng - Đen',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\hong-den.png',
                        'answer' => 'PB',
                        'answer_list' => ['PB', 'BY', 'LgB', 'GB'],
                        'show_question' => 0,

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
                        'show_question' => 0,

                    ],
                ],
            ],
            [
                'group' => 'II) Bạn hãy chọn đáp án đúng bằng cách tích vào ô có hình ảnh tương ứng (20 điểm): (1 câu đúng 5 điểm) ',
                'point' => 5,
                'quantity_question' => 4,
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
                'group' => 'III) Bạn hãy tích vào câu trả lời đúng (20 điểm): (1 câu đúng 4 điểm) ',
                'point' => 4,
                'quantity_question' => 5,
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
                        'answer' => 'Nhìn bằng mắt thường và Soi đèn pin',
                        'answer_list' => ['Nhìn bằng mắt thường', 'Soi đèn pin', 'Kiểm tra bằng máy thông điện', 'Nhìn bằng mắt thường và Soi đèn pin'],
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
                ],
            ],
            [
                'group' => 'IV) Bạn hãy tích vào câu trả lời đúng (20 điểm): (1 câu đúng 5 điểm) ',
                'point' => 5,
                'quantity_question' => 4,
                'question' => [
                    [
                        'id' => 71,
                        'name' => ' Khi cắm 2 dây cùng màu ta phải (  … ) vào EDP và sơ đồ cắm. ',
                        'path_image' => null,
                        'answer' => 'Đánh dấu',
                        'answer_list' => ['Đánh dấu', 'lộc màu dây', 'Không đánh dấu', 'Cắm luôn'],
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
                        'answer' => 'hướng lẫy,Đếm tanshi từ bên gần nhất',
                        'answer_list' => ['hướng lẫy,Đếm tanshi từ phải sang trái', 'hướng lẫy,Đếm tanshi từ trái sang phải', 'hướng lẫy,Đếm tanshi từ bên gần nhất', 'Số,Đếm tanshi từ trái sang phải'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 74,
                        'name' => 'Cách cầm dây để cắm áp dụng với : dây đơn ( …) ',
                        'path_image' => null,
                        'answer' => 'Cầm cả bó dây để cắm',
                        'answer_list' => ['Nhặt từng dây để cắm', 'Cầm cả bó dây để cắm', 'lộc theo màu dây rồi cắm'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 75,
                        'name' => 'Cách cầm dây để cắm áp dụng với : dây xoắn(  … ) ',
                        'path_image' => null,
                        'answer' => 'lộc theo màu dây rồi cắm',
                        'answer_list' => ['lộc theo màu dây rồi cắm', 'Cầm cả bó dây để cắm', 'Nhặt từng dây để cắm'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 76,
                        'name' => 'Cách cầm dây để cắm áp dụng với : dây chập bộ( …) ',
                        'path_image' => null,
                        'answer' => 'Nhặt từng dây để cắm',
                        'answer_list' => ['Nhặt từng dây để cắm', 'Cầm cả bó dây để cắm', 'lộc theo màu dây rồi cắm'],
                        'show_question' => 1,
                    ],
                ],
            ],
            [
                'group' => 'V) Hãy sắp xếp thứ tự thao tác ở dưới cho đúng quy trình (10 điểm): (1 câu đúng 5 điểm) ',
                'point' => 5,
                'quantity_question' => 2,
                'question' => [
                    [
                        'id' => 81,
                        'name' => 'Thao tác cắm conecter doitsu từ 2→12 chân: </br> a. Tiến hành lắp USJ vào conecter </br>  b.Nhìn theo số để cắm dây điện vào connector đến khi có tiếng kêu cạch thì kéo lại với lực thẳng = 2kg </br> c.Nhìn lại xem các tanshi có bằng mặt,điểm sáng có đều nhau không </br> d.Check tanshi xem có bằng nhau không ',
                        'path_image' => null,
                        'answer' => 'b→d→a→c',
                        'answer_list' => ['b→d→a→c', 'c→a→d→b', 'b→d→c→a', 'c→d→a→b'],
                        'show_question' => 1,

                    ],
                    [
                        'id' => 82,
                        'name' => 'Thao tác cắm connector DRC&HD </br> a.Xác nhận số lượng hạt umesen đã được cắm sau đó đếm tanshi xem đã đủ chân chưa. </br> b.Cắm dây điện vào connector đến khi có tiếng kêu cạch thì kéo lại với lực = 2kg theo 5  hướng : trên,dưới,trái,phải,thẳng </br> c.Kiểm tra xem tanshi có bằng mặt không,điểm sáng có đều nhau và đủ chân không',
                        'path_image' => null,
                        'answer' => '.b→a→c',
                        'answer_list' => ['.b→a→c', 'c→a→b', 'c→b→a'],
                        'show_question' => 1,
                    ],
                ],
            ],
            [
                'group' => 'VI) Chọn câu trả lời đúng (10 điểm): (1 câu đúng 2,5 điểm)  </br>   Hãy nêu ý nghĩa của việc phân loại Itemslip theo các màu ?',
                'point' => 2.5,
                'quantity_question' => 4,
                'question' => [
                    [
                        'id' => 91,
                        'name' => 'Itemslip Màu trắng ',
                        'path_image' => null,
                        'answer' => 'Hiển thị hàng ok',
                        'answer_list' => ['Hiển thị hàng ok', 'Hiển thị hàng bị thiếu nguyên vật liệu', 'Hiển thị là mã hàng bộ dây đầu'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 92,
                        'name' => 'Itemslip  Màu xanh  ',
                        'path_image' => null,
                        'answer' => 'Hiển thị hàng bị thiếu nguyên vật liệu',
                        'answer_list' => ['Hiển thị hàng ok', 'Hiển thị hàng bị thiếu nguyên vật liệu', 'Hiển thị là mã hàng bộ dây đầu'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 93,
                        'name' => 'Itemslip Màu vàng  ',
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
            ],
        ];
    }
    public static function groupQuestion1()
    {
        return [
            'title' => 'Bài kiểm tra kiến thức công nhân mới',
            'description' => '<i>Điểm đạt: 80 điểm trở lên </i><br>
                                       <i>Từ 60->80 điểm: kiểm tra lại</i><br>
                                       <i>Từ 50->59 điểm: đào tạo lại</i><br>
                                       <i>Dưới 50 điểm: Không đạt</i><br>',
            'messager' => [
                1 => '<br>Điểm đạt: 80 điểm trở lên<br><img src="public\assets\frontend\images\logos\anh-icon-vui.jpg" width="100" />',
                2 => '<br>Từ 60->80 điểm: kiểm tra lại<br><img src="public\assets\frontend\images\logos\anh-icon-buon.jpg" width="100" />',
                3 => '<br>Từ 50->59 điểm: đào tạo lại. <br>Dưới 50 điểm: Không đạt<br><img src="public\assets\frontend\images\logos\anh-icon-buon.jpg" width="100" />'
            ],
            'time' => 5,
            'scores' => [80, 60], // điểm đạt
            'data' =>
            [
                [
                    'group' => '<div><h5>I) Bạn hãy chọn đáp án đúng bằng cách tích vào ô có ký hiệu tương ứng với màu dây (20 điểm): (1 câu đúng 1 điểm)</h5></div>',
                    'point' => 20,
                    'width' => 3,
                    'random' => 20,
                    'questions' =>  [
                        [
                            'id' => 1,
                            'name' => 'Đỏ - Trắng',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\dotrang.png',
                            'width_image' => 70,
                            'answer' => 'RW',
                            'answer_list' => ['RW', 'WR', 'WV', 'WG'],
                            'show_question' => 1,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 2,
                            'name' => 'Đỏ - Đen',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\doden.png',
                            'width_image' => 70,
                            'answer' => 'RB',
                            'answer_list' => ['RB', 'BR', 'RY', 'RG'],
                            'show_question' => 0,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 3,
                            'name' => 'Đỏ - Vàng',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\dovang.png',
                            'width_image' => 70,
                            'answer' => 'RY',
                            'answer_list' => ['RB', 'YR', 'RY', 'RG'],
                            'show_question' => 0,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 4,
                            'name' => 'Đỏ - Xanh lá cây',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\doxanhlacay.png',
                            'width_image' => 70,
                            'answer' => 'RG',
                            'answer_list' => ['RB', 'RL', 'RY', 'RG'],
                            'show_question' => 0,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 5,
                            'name' => 'Đỏ - Xanh',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\doxanh.png',
                            'width_image' => 70,
                            'answer' => 'RL',
                            'answer_list' => ['RB', 'RL', 'RY', 'RG'],
                            'show_question' => 0,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 6,
                            'name' => 'Vàng - Đỏ',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\vangdo.png',
                            'width_image' => 70,
                            'answer' => 'YR',
                            'answer_list' => ['YR', 'YG', 'RY', 'YL'],
                            'show_question' => 0,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 7,
                            'name' => 'Vàng - Đen',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\vangden.png',
                            'width_image' => 70,
                            'answer' => 'YB',
                            'answer_list' => ['YR', 'YB', 'RY', 'BY'],
                            'show_question' => 0,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 8,
                            'name' => 'Vàng - Xanh lá cây',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\vangxanhlacay.png',
                            'width_image' => 70,
                            'answer' => 'YG',
                            'answer_list' => ['YR', 'YG', 'RY', 'BY'],
                            'show_question' => 0,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 9,
                            'name' => 'Vàng - Xanh',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\vangxanh.png',
                            'width_image' => 70,
                            'answer' => 'YL',
                            'answer_list' => ['YL', 'YB', 'YG', 'YW'],
                            'show_question' => 0,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 10,
                            'name' => 'Vàng - Trắng',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\vangtrang.png',
                            'width_image' => 70,
                            'answer' => 'YW',
                            'answer_list' => ['YL', 'WY', 'YG', 'YW'],
                            'show_question' => 0,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 11,
                            'name' => 'Xanh lá cây- Trắng',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacaytrang.png',
                            'width_image' => 70,
                            'answer' => 'GW',
                            'answer_list' => ['GW', 'WR', 'GB', 'WG'],
                            'show_question' => 0,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 12,
                            'name' => 'Xanh lá cây- Đỏ',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacaydo.png',
                            'width_image' => 70,
                            'answer' => 'GR',
                            'answer_list' => ['GR', 'RG', 'GB', 'GL'],
                            'show_question' => 0,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 13,
                            'name' => 'Xanh lá cây- Vàng',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacayvang.png',
                            'width_image' => 70,
                            'answer' => 'GY',
                            'answer_list' => ['GY', 'GL', 'GB', 'GW'],
                            'show_question' => 0,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'

                        ],
                        [
                            'id' => 14,
                            'name' => 'Xanh lá cây- Đen',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacayden.png',
                            'width_image' => 70,
                            'answer' => 'GB',
                            'answer_list' => ['GY', 'GL', 'GB', 'BG'],
                            'show_question' => 0,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 15,
                            'name' => 'Xanh lá cây- Xanh',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlacayxanh.png',
                            'width_image' => 70,
                            'answer' => 'GL',
                            'answer_list' => ['LG', 'GL', 'GB', 'GW'],
                            'show_question' => 1,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 16,
                            'name' => 'Xanh-Trắng',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-trang.png',
                            'width_image' => 70,
                            'answer' => 'LW',
                            'answer_list' => ['LW', 'WL', 'LgW', 'GW'],
                            'show_question' => 0,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 17,
                            'name' => 'Xanh-Đỏ',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-do.png',
                            'width_image' => 70,
                            'answer' => 'LR',
                            'answer_list' => ['LR', 'RL', 'LgR', 'GR'],
                            'show_question' => 0,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 18,
                            'name' => 'Xanh-Vàng',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-vang.png',
                            'width_image' => 70,
                            'answer' => 'LY',
                            'answer_list' => ['LY', 'YL', 'GY', 'LB'],
                            'show_question' => 0,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 19,
                            'name' => 'Xanh-Đen',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-den.png',
                            'width_image' => 70,
                            'answer' => 'LB',
                            'answer_list' => ['LgB', 'BL', 'GB', 'LB'],
                            'show_question' => 0,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 20,
                            'name' => 'Xanh-Xanh lá cây',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\xanh-xanhlacay.png',
                            'width_image' => 70,
                            'answer' => 'LG',
                            'answer_list' => ['LG', 'GL', 'LY', 'LB'],
                            'show_question' => 0,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'

                        ],
                        [
                            'id' => 21,
                            'name' => 'Nâu-Trắng',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\nau-trang.png',
                            'width_image' => 70,
                            'answer' => 'BrW',
                            'answer_list' => ['BrW', 'GrW', 'BrR', 'BrY'],
                            'show_question' => 0,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 22,
                            'name' => 'Nâu-Đỏ',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\nau-do.png',
                            'width_image' => 70,
                            'answer' => 'BrR',
                            'answer_list' => ['BrW', 'GrR', 'BrR', 'BrY'],
                            'show_question' => 0,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 23,
                            'name' => 'Nâu-Vàng',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\nau-vang.png',
                            'width_image' => 70,
                            'answer' => 'BrY',
                            'answer_list' => ['BrW', 'GrR', 'BrR', 'BrY'],
                            'show_question' => 0,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 24,
                            'name' => 'Nâu-Đen',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\nau-den.png',
                            'width_image' => 70,
                            'answer' => 'BrB',
                            'answer_list' => ['BrW', 'GrR', 'BrB', 'BrY'],
                            'show_question' => 0,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 25,
                            'name' => 'Xanh lộc non-Đỏ',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-do.png',
                            'width_image' => 70,
                            'answer' => 'LgR',
                            'answer_list' => ['LgW', 'LgR', 'LR', 'GR'],
                            'show_question' => 0,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 26,
                            'name' => 'Xanh lộc non-Vàng',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-vang.png',
                            'width_image' => 70,
                            'answer' => 'LgY',
                            'answer_list' => ['LgW', 'LgY', 'LY', 'GY'],
                            'show_question' => 0,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 27,
                            'name' => 'Xanh lộc non-Đen',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-den.png',
                            'width_image' => 70,
                            'answer' => 'LgB',
                            'answer_list' => ['LB', 'LgR', 'LgB', 'GB'],
                            'show_question' => 1,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 28,
                            'name' => 'Xanh lộc non-Trắng',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-trang.png',
                            'width_image' => 70,
                            'answer' => 'LgW',
                            'answer_list' => ['LgW', 'GW', 'LW', 'GY'],
                            'show_question' => 1,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 29,
                            'name' => 'Đen-Trắng',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\den-trang.png',
                            'width_image' => 70,
                            'answer' => 'BW',
                            'answer_list' => ['BW', 'WB', 'PW', 'WG'],
                            'show_question' => 0,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 30,
                            'name' => 'Đen-Đỏ',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\den-do.png',
                            'width_image' => 70,
                            'answer' => 'BR',
                            'answer_list' => ['BW', 'BR', 'RB', 'BY'],
                            'show_question' => 1,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 31,
                            'name' => 'Đen-Vàng',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\den-vang.png',
                            'width_image' => 70,
                            'answer' => 'BY',
                            'answer_list' => ['BW', 'BR', 'YB', 'BY'],
                            'show_question' => 0,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 32,
                            'name' => 'Đen-Xanh',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\den-xanh.png',
                            'width_image' => 70,
                            'answer' => 'BL',
                            'answer_list' => ['BL', 'LB', 'BY', 'BW'],
                            'show_question' => 0,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'

                        ],
                        [
                            'id' => 33,
                            'name' => 'Đen-Xanh lá cây',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\den-xanhlacay.png',
                            'width_image' => 70,
                            'answer' => 'BG',
                            'answer_list' => ['BL', 'BG', 'BY', 'GB'],
                            'show_question' => 0,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 34,
                            'name' => 'Trắng - Đỏ',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-do.png',
                            'width_image' => 70,
                            'answer' => 'WR',
                            'answer_list' => ['WR', 'RW', 'WY', 'WV'],
                            'show_question' => 0,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 35,
                            'name' => 'Trắng - Xanh',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-xanh.png',
                            'width_image' => 70,
                            'answer' => 'WL',
                            'answer_list' => ['WY', 'LW', 'WL', 'WV'],
                            'show_question' => 0,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 36,
                            'name' => 'Trắng - Vàng',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-vang.png',
                            'width_image' => 70,
                            'answer' => 'WY',
                            'answer_list' => ['WY', 'YW', 'WL', 'WR'],
                            'show_question' => 0,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 37,
                            'name' => 'Trắng - Tím',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-tim.png',
                            'width_image' => 70,
                            'answer' => 'WV',
                            'answer_list' => ['WY', 'WV', 'WL', 'WR'],
                            'show_question' => 1,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 38,
                            'name' => 'Trắng-Xanh lá cây',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\trang-xanhlacay.png',
                            'width_image' => 70,
                            'answer' => 'WG',
                            'answer_list' => ['WG', 'WV', 'WL', 'GW'],
                            'show_question' => 0,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 39,
                            'name' => 'Cam - Trắng',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\cam-trang.png',
                            'width_image' => 70,
                            'answer' => 'OW',
                            'answer_list' => ['GW', 'OW', 'WY', 'GW'],
                            'show_question' => 0,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 40,
                            'name' => 'Hồng - Đen',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\hong-den.png',
                            'width_image' => 70,
                            'answer' => 'PB',
                            'answer_list' => ['PB', 'BY', 'LgB', 'GB'],
                            'show_question' => 0,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 41,
                            'name' => 'Xám - Đỏ',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\xam-do.png',
                            'width_image' => 70,
                            'answer' => 'GrR',
                            'answer_list' => ['BrW', 'GrR', 'BrR', 'BrY'],
                            'show_question' => 1,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 42,
                            'name' => 'Xám - Đen',
                            'point' => 1,
                            'path_image' => 'public\assets\frontend\images\anh-mau-day\xam-den.png',
                            'width_image' => 70,
                            'answer' => 'GrB',
                            'answer_list' => ['BrW', 'GrB', 'BrB', 'GrY'],
                            'show_question' => 0,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ]
                    ]
                ],
                [
                    'group' => '<div><h5>II) Bạn hãy chọn đáp án đúng bằng cách tích vào ô có hình ảnh tương ứng (20 điểm): (1 câu đúng 5 điểm)</h5></div>',
                    'point' => 5,
                    'width' => 1,
                    'random' => 0,
                    'questions' => [
                        [
                            'id' => 43,
                            'name' => 'Tanshi cái hàng doitsu',
                            'point' => 5,
                            'path_image' => null,
                            'width_image' => 70,
                            'answer' => 'public\assets\frontend\images\tanshi\tanshi-cai-doitsu.png',
                            'answer_list' => [
                                'public\assets\frontend\images\tanshi\tanshi-cai-doitsu.png',
                                'public\assets\frontend\images\tanshi\tanshi-duc-yazaky.png',
                                'public\assets\frontend\images\tanshi\tanshi-cai-yazaky.png',
                                'public\assets\frontend\images\tanshi\tanshi-duc-doitsu.png',
                            ],
                            'show_question' => 1,
                            'multiple_answer' => [],
                            'answer_image_width' => 70,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 44,
                            'name' => 'Tanshi đực hàng doitsu',
                            'point' => 5,
                            'path_image' => null,
                            'width_image' => 70,
                            'answer' => 'public\assets\frontend\images\tanshi\tanshi-duc-doitsu.png',
                            'answer_list' => [
                                'public\assets\frontend\images\tanshi\tanshi-cai-doitsu.png',
                                'public\assets\frontend\images\tanshi\tanshi-duc-yazaky.png',
                                'public\assets\frontend\images\tanshi\tanshi-cai-yazaky.png',
                                'public\assets\frontend\images\tanshi\tanshi-duc-doitsu.png',
                            ],
                            'show_question' => 1,
                            'multiple_answer' => [],
                            'answer_image_width' => 70,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 45,
                            'name' => 'Tanshi cái hàng Yazaky',
                            'point' => 5,
                            'path_image' => null,
                            'width_image' => 70,
                            'answer' => 'public\assets\frontend\images\tanshi\tanshi-cai-yazaky.png',
                            'answer_list' => [
                                'public\assets\frontend\images\tanshi\tanshi-cai-doitsu.png',
                                'public\assets\frontend\images\tanshi\tanshi-duc-yazaky.png',
                                'public\assets\frontend\images\tanshi\tanshi-cai-yazaky.png',
                                'public\assets\frontend\images\tanshi\tanshi-duc-doitsu.png',
                            ],
                            'show_question' => 1,
                            'multiple_answer' => [],
                            'answer_image_width' => 70,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 46,
                            'name' => 'Tanshi đực hàng Yazaky',
                            'point' => 5,
                            'path_image' => null,
                            'width_image' => 70,
                            'answer' => 'public\assets\frontend\images\tanshi\tanshi-duc-yazaky.png',
                            'answer_list' => [
                                'public\assets\frontend\images\tanshi\tanshi-cai-doitsu.png',
                                'public\assets\frontend\images\tanshi\tanshi-duc-yazaky.png',
                                'public\assets\frontend\images\tanshi\tanshi-cai-yazaky.png',
                                'public\assets\frontend\images\tanshi\tanshi-duc-doitsu.png',
                            ],
                            'show_question' => 1,
                            'multiple_answer' => [],
                            'answer_image_width' => 70,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                    ],
                ],
                [
                    'group' => '<div><h5>III) Bạn hãy tích vào câu trả lời đúng (20 điểm): (1 câu đúng 4 điểm)</h5></div>',
                    'point' => 4,
                    'width' => 1,
                    'random' => 0,
                    'questions' => [
                        [
                            'id' => 47,
                            'name' => 'Khi bắt đầu vào làm việc đầu giờ sáng và đầu giờ chiều,người thao tác cần phải làm gì ?',
                            'point' => 4,
                            'path_image' => null,
                            'width_image' => 70,
                            'answer' => 'Kéo cân với lực khoảng 2kg',
                            'answer_list' => ['Kéo cân với lực khoảng 2kg', '5S', 'Chuẩn bị linh kiện', 'Rút dây'],
                            'show_question' => 1,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 48,
                            'name' => 'Chủng loại conecter nào sau khi cắm xong kéo lại 1 lực 2kg theo 5 hướng ?',
                            'point' => 4,
                            'path_image' => null,
                            'width_image' => 70,
                            'answer' => 'DRC & HD',
                            'answer_list' => ['DRC & HD', 'Doitsu', 'Yazaky', 'Tất cả'],
                            'show_question' => 1,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 49,
                            'name' => 'Kiểm tra tụt chốt tại công đoạn cắm phương pháp nào là đúng',
                            'point' => 4,
                            'path_image' => null,
                            'width_image' => 70,
                            'answer' => 'Nhìn bằng mắt thường và Soi đèn pin',
                            'answer_list' => ['Nhìn bằng mắt thường', 'Soi đèn pin', 'Kiểm tra bằng máy thông điện', 'Nhìn bằng mắt thường và Soi đèn pin'],
                            'show_question' => 1,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'

                        ],
                        [
                            'id' => 50,
                            'name' => 'Bạn hãy cho biết tiêu chuẩn cắm hạt umesen ( hạt đỏ , hạt trắng )',
                            'point' => 4,
                            'path_image' => null,
                            'width_image' => 70,
                            'answer' => '0→1mm',
                            'answer_list' => ['0→1mm', '0mm', '1mm', '0.1mm'],
                            'show_question' => 1,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'

                        ],
                        [
                            'id' => 51,
                            'name' => 'Khi phát sinh linh kiện thiếu,thừa ta phải làm gì?',
                            'point' => 4,
                            'path_image' => null,
                            'width_image' => 70,
                            'answer' => 'Tất cả',
                            'answer_list' => ['Kiểm tra lại', 'Đánh dấu lại', 'Báo cấp trên', 'Tất cả'],
                            'show_question' => 1,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                    ],
                ],
                [
                    'group' => '<div><h5>IV) Bạn hãy tích vào câu trả lời đúng (20 điểm): (1 câu đúng 5 điểm)</h5></div>',
                    'point' => 5,
                    'width' => 1,
                    'random' => 4,
                    'questions' => [
                        [
                            'id' => 52,
                            'name' => ' Khi cắm 2 dây cùng màu ta phải (  … ) vào EDP và sơ đồ cắm. ',
                            'point' => 5,
                            'path_image' => null,
                            'width_image' => 70,
                            'answer' => 'Đánh dấu',
                            'answer_list' => ['Đánh dấu', 'lộc màu dây', 'Không đánh dấu', 'Cắm luôn'],
                            'show_question' => 1,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 53,
                            'name' => 'Connector doitsu cắm dây dựa vào (  …  ). ',
                            'point' => 5,
                            'path_image' => null,
                            'width_image' => 70,
                            'answer' => 'Số và chữ',
                            'answer_list' => ['Số và chữ', 'Hướng', 'Số', 'Chữ'],
                            'show_question' => 1,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 54,
                            'name' => ' Connector yazaky cắm dây dựa vào(  … )trên connector và cắm theo quy trình (  … ). ',
                            'point' => 5,
                            'path_image' => null,
                            'width_image' => 70,
                            'answer' => 'hướng lẫy,Đếm tanshi từ bên gần nhất',
                            'answer_list' => ['hướng lẫy,Đếm tanshi từ phải sang trái', 'hướng lẫy,Đếm tanshi từ trái sang phải', 'hướng lẫy,Đếm tanshi từ bên gần nhất', 'Số,Đếm tanshi từ trái sang phải'],
                            'show_question' => 1,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 55,
                            'name' => 'Cách cầm dây để cắm áp dụng với : dây đơn ( …) ',
                            'point' => 5,
                            'path_image' => null,
                            'width_image' => 70,
                            'answer' => 'Cầm cả bó dây để cắm',
                            'answer_list' => ['Nhặt từng dây để cắm', 'Cầm cả bó dây để cắm', 'lộc theo màu dây rồi cắm'],
                            'show_question' => 1,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 56,
                            'name' => 'Cách cầm dây để cắm áp dụng với : dây xoắn(  … ) ',
                            'point' => 5,
                            'path_image' => null,
                            'width_image' => 70,
                            'answer' => 'lộc theo màu dây rồi cắm',
                            'answer_list' => ['lộc theo màu dây rồi cắm', 'Cầm cả bó dây để cắm', 'Nhặt từng dây để cắm'],
                            'show_question' => 1,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 57,
                            'name' => 'Cách cầm dây để cắm áp dụng với : dây chập bộ( …) ',
                            'point' => 5,
                            'path_image' => null,
                            'width_image' => 70,
                            'answer' => 'Nhặt từng dây để cắm',
                            'answer_list' => ['Nhặt từng dây để cắm', 'Cầm cả bó dây để cắm', 'lộc theo màu dây rồi cắm'],
                            'show_question' => 1,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                    ],
                ],
                [
                    'group' => '<div><h5>V) Hãy sắp xếp thứ tự thao tác ở dưới cho đúng quy trình (10 điểm): (1 câu đúng 5 điểm)</h5></div>',
                    'point' => 5,
                    'width' => 1,
                    'random' => 0,
                    'questions' => [
                        [
                            'id' => 58,
                            'name' => 'Thao tác cắm conecter doitsu từ 2→12 chân: </br> a. Tiến hành lắp USJ vào conecter </br>  b.Nhìn theo số để cắm dây điện vào connector đến khi có tiếng kêu cạch thì kéo lại với lực thẳng = 2kg </br> c.Nhìn lại xem các tanshi có bằng mặt,điểm sáng có đều nhau không </br> d.Check tanshi xem có bằng nhau không ',
                            'point' => 5,
                            'path_image' => null,
                            'width_image' => 70,
                            'answer' => 'b→d→a→c',
                            'answer_list' => ['b→d→a→c', 'c→a→d→b', 'b→d→c→a', 'c→d→a→b'],
                            'show_question' => 1,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'

                        ],
                        [
                            'id' => 59,
                            'name' => 'Thao tác cắm connector DRC&HD </br> a.Xác nhận số lượng hạt umesen đã được cắm sau đó đếm tanshi xem đã đủ chân chưa. </br> b.Cắm dây điện vào connector đến khi có tiếng kêu cạch thì kéo lại với lực = 2kg theo 5  hướng : trên,dưới,trái,phải,thẳng </br> c.Kiểm tra xem tanshi có bằng mặt không,điểm sáng có đều nhau và đủ chân không',
                            'point' => 5,
                            'path_image' => null,
                            'width_image' => 70,
                            'answer' => '.b→a→c',
                            'answer_list' => ['.b→a→c', 'c→a→b', 'c→b→a'],
                            'show_question' => 1,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                    ],
                ],
                [
                    'group' => '<div><h5>VI) Chọn câu trả lời đúng (10 điểm): (1 câu đúng 2,5 điểm)  </br>   Hãy nêu ý nghĩa của việc phân loại Itemslip theo các màu ?</h5></div>',
                    'point' => 2.5,
                    'width' => 1,
                    'random' => 0,
                    'questions' => [
                        [
                            'id' => 60,
                            'name' => 'Itemslip Màu trắng ',
                            'point' => 2.5,
                            'path_image' => null,
                            'width_image' => 70,
                            'answer' => 'Hiển thị hàng ok',
                            'answer_list' => ['Hiển thị hàng ok', 'Hiển thị hàng bị thiếu nguyên vật liệu', 'Hiển thị là mã hàng bộ dây đầu'],
                            'show_question' => 1,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 61,
                            'name' => 'Itemslip  Màu xanh  ',
                            'point' => 2.5,
                            'path_image' => null,
                            'width_image' => 70,
                            'answer' => 'Hiển thị hàng bị thiếu nguyên vật liệu',
                            'answer_list' => ['Hiển thị hàng ok', 'Hiển thị hàng bị thiếu nguyên vật liệu', 'Hiển thị là mã hàng bộ dây đầu'],
                            'show_question' => 1,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 62,
                            'name' => 'Itemslip Màu vàng  ',
                            'point' => 2.5,
                            'path_image' => null,
                            'width_image' => 70,
                            'answer' => 'Hiển thị là mã hàng bộ dây đầu',
                            'answer_list' => ['Hiển thị hàng ok', 'Hiển thị hàng bị thiếu nguyên vật liệu', 'Hiển thị là mã hàng bộ dây đầu'],
                            'show_question' => 1,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                        [
                            'id' => 63,
                            'name' => 'Bạn hãy nêu quy trình xử lý hàng lỗi ?',
                            'point' => 2.5,
                            'path_image' => null,
                            'width_image' => 70,
                            'answer' => 'Đánh dấu băng dính đỏ tại vị trí NG→ Báo cáo cấp trên để xử lý',
                            'answer_list' => ['Đánh dấu băng dính đỏ tại vị trí NG→ Báo cáo cấp trên để xử lý', 'Báo cáo cấp trên để xử lý', 'Đánh dấu băng dính đỏ tại vị trí NG', 'Hỏi bạn bên cạnh'],
                            'show_question' => 1,
                            'multiple_answer' => [],
                            'answer_image_width' => 0,
                            'answer_image' => [],
                            'type_input' => 'number'
                        ],
                    ],
                ],
            ],
        ];
    }
}
