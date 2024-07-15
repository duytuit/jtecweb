<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->comment('mã hàng');
            $table->string('lot_no')->comment('mã lot');
            $table->float('hangdangdo_cam')->comment('Hàng dang dở');
            $table->float('hangdangdo_lrap')->comment('Hàng dang dở');
            $table->float('hangdangdo_buredo')->comment('Hàng dang dở');
            $table->float('hangdangdo_kttm')->comment('Hàng dang dở');
            $table->float('hangdangdo_ktnq')->comment('Hàng dang dở');
            $table->float('ton_kho')->comment('Tồn kho');
            $table->float('thu2_le')->comment('Thứ 2 Lẻ');
            $table->float('thu3_air')->comment('Thứ 3 AIR');
            $table->float('thu4_le')->comment('Thứ 4 Lẻ');
            $table->float('thu5_le')->comment('Thứ 5 Lẻ');
            $table->float('thu5_air')->comment('Thứ 5 AIR');
            $table->float('thu6_air')->comment('Thứ 6 AIR');
            $table->float('thu6_sea_osaka')->comment('Thứ 6 SEA osaka');
            $table->float('thu6_sea_tokyo')->comment('Thứ 6 SEA tokyo');
            $table->float('mau')->comment('Hàng mẫu');
            $table->float('hangxuatchualam_dap')->comment('Hàng xuât chưa làm');
            $table->float('hangxuatchualam_cam')->comment('Hàng xuât chưa làm');
            $table->float('hangxuatchualam_lrap')->comment('Hàng xuât chưa làm');
            $table->float('hangxuatchualam_buredo')->comment('Hàng xuât chưa làm');
            $table->float('hangxuatchualam_kttm')->comment('Hàng xuât chưa làm');
            $table->float('hangxuatchualam_ktnq')->comment('Hàng xuât chưa làm');
            $table->float('don_gia')->comment('Đơn giá');
            $table->float('so_luong')->comment('Số lượng');
            $table->integer('gia_cong')->comment('Hàng mẫu');
            $table->float('soluongdaycatchualam_dap')->comment('dây cắt chưa làm');
            $table->float('soluongdaycatchualam_cam')->comment('dây cắt chưa làm');
            $table->float('soluongdaycatchualam_lrap')->comment('dây cắt chưa làm');
            $table->float('soluongdaycatchualam_buredo')->comment('dây cắt chưa làm');
            $table->float('soluongdaycatchualam_kttm')->comment('dây cắt chưa làm');
            $table->float('soluongdaycatchualam_ktnq')->comment('dây cắt chưa làm');
            $table->float('tonglichxuat_dongia')->comment('Tổng lịch xuất');
            $table->float('tonglichxuat_soluong')->comment('Tổng lịch xuất');
            $table->float('tonglichxuat_soluongxuat')->comment('Tổng lịch xuất');
            $table->float('soluonghangxuat_dap')->comment('Số lượng hàng xuất chưa làm');
            $table->float('soluonghangxuat_cam')->comment('Số lượng hàng xuất chưa làm');
            $table->float('soluonghangxuat_lrap')->comment('Số lượng hàng xuất chưa làm');
            $table->float('soluonghangxuat_buredo')->comment('Số lượng hàng xuất chưa làm');
            $table->float('soluonghangxuat_kttm')->comment('Số lượng hàng xuất chưa làm');
            $table->float('soluonghangxuat_ktnq')->comment('Số lượng hàng xuất chưa làm');
            $table->float('soluonghangxuatdaycat_dap')->comment('Số lượng hàng xuất dây cắt chưa làm');
            $table->float('soluonghangxuatdaycat_cam')->comment('Số lượng hàng xuất dây cắt chưa làm');
            $table->float('soluonghangxuatdaycat_lrap')->comment('Số lượng hàng xuất dây cắt chưa làm');
            $table->float('soluonghangxuatdaycat_buredo')->comment('Số lượng hàng xuất dây cắt chưa làm');
            $table->float('soluonghangxuatdaycat_kttm')->comment('Số lượng hàng xuất dây cắt chưa làm');
            $table->float('soluonghangxuatdaycat_ktnq')->comment('Số lượng hàng xuất dây cắt chưa làm');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('production_plans');
    }
};
