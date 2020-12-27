<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Sinhvien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_hocsinh', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tenhocsinh', 255);
            $table->string('sodienthoai', 15);
            $table->timestamps();
        });
    }
     
    public function down()
    {
        Schema::dropIfExists('tbl_hocsinh');
    }
}
