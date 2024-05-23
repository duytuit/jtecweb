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
                'name' => 'General Director'
            ],
            [
                'id' => 2,
                'name' => 'Director'
            ],
            [
                'id' => 3,
                'name' => 'Supper Manager'
            ],
            [
                'id' => 4,
                'name' => 'Manager'
            ],
            [
                'id' => 5,
                'name' => 'Supper Chief'
            ],
            [
                'id' => 6,
                'name' => 'Chief'
            ],
            [
                'id' => 7,
                'name' => 'Staff'
            ],
            [
                'id' => 8,
                'name' => 'Suppser Leader'
            ],
            [
                'id' => 9,
                'name' => 'Leader'
            ],
            [
                'id' => 10,
                'name' => 'Sub Leader'
            ],
            [
                'id' => 11,
                'name' => 'worker'
            ]
        ];
    }
    public static function formTypeJobs()
    {
        return [
            [
                'id' => 1,
                'from_dept' =>  [5], // id bộ phận yêu cầu
                'to_dept' => [
                    8 // id bộ phận tiếp nhận
                ],
                'confirm_from_dept' => 1, // 0:duyệt tay, 1: tự động duyệt
                'confirm_to_dept' => 1, // 0:duyệt tay, 1: tự động duyệt
                'confirm_by_from_dept' => [5], //duyệt bởi leader ,sub leader -- id lấy từ positionsTitle()
                'confirm_by_to_dept' => [],
            ],
            [
                'id' => 2,
                'from_dept' =>  [5], // id bộ phận yêu cầu,gửi yêu cầu cho leader,subleader
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
                            'position' => 'Toàn bộ t.bị: máy, bàn…',
                            'method' => 'K có bụi bẩn, bật máy k có tiếng kêu lạ',
                            'handle' => 'Liên lạc cấp trên',
                            'image' => 'public/assets/images/pages/check_cut_machine/1.png',
                            'answer' => '',
                            'answer_list' => [0, 1], //1: bình thường , 0: bất thường
                        ],
                        [
                            'id' => 1,
                            'position' => 'Màn hình máy cắt',
                            'method' => 'Hiển thị rõ ràng',
                            'handle' => 'Liên lạc cấp trên',
                            'image' => 'public/assets/images/pages/check_cut_machine/2.png',
                            'answer' => '',
                            'answer_list' => [0, 1], //1: bình thường , 0: bất thường
                        ],
                        [
                            'id' => 2,
                            'position' => 'Nút bấm điều khiển',
                            'method' => 'K bị kẹt, rách',
                            'handle' => 'Liên lạc cấp trên',
                            'image' => 'public/assets/images/pages/check_cut_machine/3.png',
                            'answer' => '',
                            'answer_list' => [0, 1], //1: bình thường , 0: bất thường
                        ],
                        [
                            'id' => 3,
                            'position' => 'Con lăn v.chuyển',
                            'method' => 'K bị mòn, sứt, biến dạng',
                            'handle' => 'Liên lạc cấp trên',
                            'image' => 'public/assets/images/pages/check_cut_machine/4.png',
                            'answer' => '',
                            'answer_list' => [0, 1], //1: bình thường , 0: bất thường
                        ],
                        [
                            'id' => 4,
                            'position' => 'Ống dẫn dây',
                            'method' => 'K bị biến dạng',
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
                            'method' => 'Màn hình h.thị rõ ràng, bàn phím và chuột k bị kẹt nút, mất nút',
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
                    ]
                ]
            ],
            [
                'id' => 3,
                'from_dept' =>  [5], // id bộ phận yêu cầu
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
                            'method' => 'K có bụi bẩn, bật máy k có tiếng kêu lạ',
                            'handle' => 'Liên lạc cấp trên',
                            'image' => 'public/assets/images/pages/check_cut_machine_auto/1.png',
                            'answer' => '',
                            'answer_list' => [0, 1], //1: bình thường , 0: bất thường
                        ],
                        [
                            'id' => 1,
                            'position' => 'Màn hình máy cắt',
                            'method' => 'Hiển thị rõ ràng',
                            'handle' => 'Liên lạc cấp trên',
                            'image' => 'public/assets/images/pages/check_cut_machine_auto/2.png',
                            'answer' => '',
                            'answer_list' => [0, 1], //1: bình thường , 0: bất thường
                        ],
                        [
                            'id' => 2,
                            'position' => 'Con lăn v.chuyển',
                            'method' => 'K bị mòn, sứt, biến dạng',
                            'handle' => 'Liên lạc cấp trên',
                            'image' => 'public/assets/images/pages/check_cut_machine_auto/3.png',
                            'answer' => '',
                            'answer_list' => [0, 1], //1: bình thường , 0: bất thường
                        ],
                        [
                            'id' => 3,
                            'position' => 'Ống dẫn dây',
                            'method' => 'K bị biến dạng',
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
                            'method' => 'Màn hình h.thị rõ ràng, bàn phím k bị kẹt nút, mất nút',
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
                    ]
                ]
            ],
        ];
    }
    public static function machineList()
    {
        return [
            [
                'type' => 1,
                'name' => 'CA01',
                'model' => 'C371A',
            ],
            [
                'type' => 1,
                'name' => 'CA02',
                'model' => 'C371',
            ],
            [
                'type' => 1,
                'name' => 'CA03',
                'model' => 'C371A',
            ],
            [
                'type' => 1,
                'name' => 'CA04',
                'model' => 'C371A',
            ],
            [
                'type' => 1,
                'name' => 'CA05',
                'model' => 'C371A',
            ],
            [
                'type' => 1,
                'name' => 'CA06',
                'model' => 'C371A',
            ],
            [
                'type' => 1,
                'name' => 'CA07',
                'model' => 'C371A',
            ],
            [
                'type' => 1,
                'name' => 'CA08',
                'model' => 'C371A',
            ],
            [
                'type' => 1,
                'name' => 'CA09',
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
                'name' => 'TD01',
                'model' => 'C558SZ1',
            ],
            [
                'type' => 2,
                'name' => 'TD02',
                'model' => 'C558SZ2',
            ],
            [
                'type' => 2,
                'name' => 'TD03',
                'model' => 'C558SZ3',
            ],
            [
                'type' => 2,
                'name' => 'TD04',
                'model' => 'C558SZ4',
            ],
            [
                'type' => 2,
                'name' => 'TD05',
                'model' => 'C558SZ5',
            ],
            [
                'type' => 2,
                'name' => 'TD06',
                'model' => 'C558SZ6',
            ],
            [
                'type' => 2,
                'name' => 'TD07',
                'model' => 'C551',
            ],
            [
                'type' => 2,
                'name' => 'TD08',
                'model' => 'C558SZ6',
            ],
            [
                'type' => 2,
                'name' => 'TD09',
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
                'name' => 'Chưa kết hôn'
            ],

            [
                'id' => 1,
                'name' => 'Đã kết hôn'

            ],
            [
                'id' => 2,
                'name' => 'Ly hôn'
            ]
        ];
    }
    public static function positionTitle()
    {
        return [
            [
                'id' => 0,
                'name' => 'Nhân viên'
            ],
            [
                'id' => 1,
                'name' => 'Trưởng phòng'
            ],
            [
                'id' => 2,
                'name' => 'Phó phòng'
            ],
            [
                'id' => 3,
                'name' => 'Trợ lý'
            ],
            [
                'id' => 4,
                'name' => 'Sub Leader'
            ],
            [
                'id' => 5,
                'name' => 'Leader'
            ],
        ];
    }
    public static function worker()
    {
        return [
            [
                'id' => 0,
                'name' => 'Nghỉ việc'
            ],
            [
                'id' => 1,
                'name' => 'Nghỉ chế độ bảo hiểm'
            ],
            [
                'id' => 2,
                'name' => 'Nghỉ không lương'
            ],
            [
                'id' => 3,
                'name' => 'Đang làm việc'
            ],
        ];
    }
    public static function banksList()
    {
        return [
            [
                'id' => 1,
                'name' => 'TMCP Đầu tư và Phát triển Việt Nam	',
                'code' => 'BIDV'
            ],
            [
                'id' => 2,
                'name' => 'TMCP Ngoại Thương Việt Nam	',
                'code' => 'Vietcombank'
            ],
            [
                'id' => 3,
                'name' => 'TMCP Công thương Việt Nam	',
                'code' => 'VietinBank'
            ],
            [
                'id' => 4,
                'name' => 'TMCP Quân Đội	',
                'code' => 'MBBANK'
            ],
            [
                'id' => 5,
                'name' => 'TMCP Á Châu	',
                'code' => 'ACB'
            ],
            [
                'id' => 6,
                'name' => 'TMCP Sài Gòn – Hà Nội	',
                'code' => 'SHB'
            ],
            [
                'id' => 7,
                'name' => 'TMCP Kỹ Thương	',
                'code' => 'Techcombank'
            ],
            [
                'id' => 8,
                'name' => 'NN&PT Nông thôn Việt Nam	',
                'code' => 'Agribank'
            ],
            [
                'id' => 9,
                'name' => 'TMCP Phát triển Thành phố Hồ Chí Minh	',
                'code' => 'HDBank'
            ],
            [
                'id' => 10,
                'name' => 'TMCP Bưu điện Liên Việt	',
                'code' => 'LienVietPostBank'
            ],
            [
                'id' => 11,
                'name' => 'TMCP Quốc Tế 	',
                'code' => 'VIB'
            ],
            [
                'id' => 12,
                'name' => 'TMCP Đông Nam Á	',
                'code' => 'SeABank'
            ],
            [
                'id' => 13,
                'name' => 'Chính sách xã hội Việt Nam	',
                'code' => 'VBSP'
            ],
            [
                'id' => 14,
                'name' => 'TMCP Tiên Phong	',
                'code' => 'TPBank'
            ],
            [
                'id' => 15,
                'name' => 'TMCP Phương Đông	',
                'code' => 'OCB'
            ],
            [
                'id' => 16,
                'name' => 'TMCP Hàng Hải	',
                'code' => 'MSB'
            ],
            [
                'id' => 17,
                'name' => 'TMCP Sài Gòn Thương Tín	',
                'code' => 'Sacombank'
            ],
            [
                'id' => 18,
                'name' => 'TMCP Xuất Nhập Khẩu	',
                'code' => 'Eximbank'
            ],
            [
                'id' => 19,
                'name' => 'TMCP Sài Gòn	',
                'code' => 'SCB'
            ],
            [
                'id' => 20,
                'name' => 'Phát triển Việt Nam	',
                'code' => 'VDB'
            ],
            [
                'id' => 21,
                'name' => 'TMCP Nam Á	Nam A ',
                'code' => 'Bank'
            ],
            [
                'id' => 22,
                'name' => 'TMCP An Bình	',
                'code' => 'ABBANK'
            ],
            [
                'id' => 23,
                'name' => 'TMCP Đại Chúng Việt Nam	',
                'code' => 'PVcomBank'
            ],
            [
                'id' => 24,
                'name' => 'TMCP Bắc Á	Bac A ',
                'code' => 'Bank'
            ],
            [
                'id' => 25,
                'name' => 'TNHH MTV UOB Việt Nam	',
                'code' => 'UOB'
            ],
            [
                'id' => 26,
                'name' => 'TNHH MTV Woori Việt Nam	',
                'code' => 'Woori'
            ],
            [
                'id' => 27,
                'name' => 'TNHH MTV HSBC Việt Nam	',
                'code' => 'HSBC'
            ],
            [
                'id' => 28,
                'name' => 'TNHH MTV Standard Chartered Việt Nam	',
                'code' => 'SCBVL'
            ],
            [
                'id' => 29,
                'name' => 'TNHH MTV Public Bank Việt Nam	',
                'code' => 'PBVN'
            ],
            [
                'id' => 30,
                'name' => 'TNHH MTV Shinhan Việt Nam	',
                'code' => 'SHBVN'
            ],
            [
                'id' => 31,
                'name' => 'TMCP Quốc dân	',
                'code' => 'NCB'
            ],
            [
                'id' => 32,
                'name' => 'TMCP Việt Á	',
                'code' => 'VietABank'
            ],
            [
                'id' => 33,
                'name' => 'TMCP Bản Việt	 ',
                'code' => 'Viet Capital Bank'
            ],
            [
                'id' => 34,
                'name' => 'TMCP Đông Á',
                'code' => 'DongABank'
            ],
            [
                'id' => 35,
                'name' => 'TMCP Việt Nam Thương Tín	',
                'code' => 'Vietbank'
            ],
            [
                'id' => 36,
                'name' => 'TNHH MTV ANZ Việt Nam',
                'code' => 'ANZVL'
            ],
            [
                'id' => 37,
                'name' => 'TNHH MTV Đại Dương	',
                'code' => 'OceanBank'
            ],
            [
                'id' => 38,
                'name' => 'TNHH MTV CIMB Việt Nam',
                'code' => 'CIMB'
            ],
            [
                'id' => 39,
                'name' => 'TMCP Kiên Long',
                'code' => 'Kienlongbank'
            ],
            [
                'id' => 40,
                'name' => 'TNHH Indovina',
                'code' => 'IVB'
            ],
            [
                'id' => 41,
                'name' => 'TMCP Bảo Việt',
                'code' => 'BAOVIETBank'
            ],
            [
                'id' => 42,
                'name' => 'TMCP Sài Gòn Công Thương	',
                'code' => 'SAIGONBANK'
            ],
            [
                'id' => 43,
                'name' => 'Hợp tác xã Việt Nam',
                'code' => 'Co-opBank'
            ],
            [
                'id' => 44,
                'name' => 'TNHH MTV Dầu khí toàn cầu',
                'code' => 'GPBank'
            ],
            [
                'id' => 45,
                'name' => 'Liên doanh Việt Nga',
                'code' => 'VRB'
            ],
            [
                'id' => 46,
                'name' => 'TNHH MTV Xây dựng',
                'code' => 'CB'
            ],
            [
                'id' => 47,
                'name' => 'TNHH MTV Hong Leong Việt Nam	',
                'code' => 'HLBVN'
            ],
            [
                'id' => 48,
                'name' => 'TMCP Xăng dầu ',
                'code' => 'Petrolimex'
            ],

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
                'groupname' => 'I) Bạn hãy chọn đáp án đúng bằng cách tích vào ô có ký hiệu tương ứng với màu dây (20 điểm): (1 câu đúng 1 điểm)',
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
                        'show_question' => 0,
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
                        'name' => 'Xanh lọc non-Đỏ',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-do.png',
                        'answer' => 'LgR',
                        'answer_list' => ['LgW', 'LgR', 'LR', 'GR'],
                        'show_question' => 0,
                    ],
                    [
                        'id' => 26,
                        'name' => 'Xanh lọc non-Vàng',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-vang.png',
                        'answer' => 'LgY',
                        'answer_list' => ['LgW', 'LgY', 'LY', 'GY'],
                        'show_question' => 0,
                    ],
                    [
                        'id' => 27,
                        'name' => 'Xanh lọc non-Đen',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-den.png',
                        'answer' => 'LgB',
                        'answer_list' => ['LB', 'LgR', 'LgB', 'GB'],
                        'show_question' => 0,
                    ],
                    [
                        'id' => 28,
                        'name' => 'Xanh lọc non-Trắng',
                        'path_image' => 'public\assets\frontend\images\anh-mau-day\xanhlocnon-trang.png',
                        'answer' => 'LgW',
                        'answer_list' => ['LgW', 'GW', 'LW', 'GY'],
                        'show_question' => 0,
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
                ]
            ],
            [
                'groupname' => 'II) Bạn hãy chọn đáp án đúng bằng cách tích vào ô có hình ảnh tương ứng (20 điểm): (1 câu đúng 5 điểm) ',
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
                'groupname' => 'III) Bạn hãy tích vào câu trả lời đúng (20 điểm): (1 câu đúng 4 điểm) ',
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
                ]
            ],
            [
                'groupname' => 'IV) Bạn hãy tích vào câu trả lời đúng (20 điểm): (1 câu đúng 5 điểm) ',
                'point' => 5,
                'quantity_question' => 4,
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
                        'answer' => 'hướng lẫy,Đếm tanshi từ bên gần nhất',
                        'answer_list' => ['hướng lẫy,Đếm tanshi từ phải sang trái', 'hướng lẫy,Đếm tanshi từ trái sang phải', 'hướng lẫy,Đếm tanshi từ bên gần nhất', 'Số,Đếm tanshi từ trái sang phải'],
                        'show_question' => 1,
                    ],
                    [
                        'id' => 74,
                        'name' => 'Cách cầm dây để cắm áp dụng với : dây đơn ( …) ',
                        'path_image' => null,
                        'answer' => 'Cầm cả bó dây để cắm',
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
                        'answer_list' => ['.b→a→c', 'c→a→b', 'c→b→a',],
                        'show_question' => 1,
                    ],
                ],
            ],
            [
                'groupname' => 'VI) Chọn câu trả lời đúng (10 điểm): (1 câu đúng 2,5 điểm)  </br>   Hãy nêu ý nghĩa của việc phân loại Itemslip theo các màu ?',
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
            ]
        ];
    }
}
