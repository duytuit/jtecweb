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
        Schema::create('checktension', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            // $table->dateTime('create_date');
            $table->float('target125');
            $table->float('target2');
            $table->float('target55');
            $table->float('weight125');
            $table->float('weight2');
            $table->float('weight55');
            // $table->string('machine');
            // $table->string('checkresult');
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
        Schema::dropIfExists('checktension');
    }
};
