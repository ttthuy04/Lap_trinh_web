<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    public function up()
    {
        Schema::create('class1', function (Blueprint $table) {
            $table->unsignedBigInteger('class_id');  // Kiểu dữ liệu phù hợp với id lớp
            $table->foreign('class_id')->references('id')->on('class1'); // Liên kết với bảng class1
            $table->enum('grade_level', ['Pre-K', 'Kindergarten']); // Cấp độ lớp
            $table->string('room_number', 10); // Phòng học
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            Schema::dropIfExists('class1');
        });
    }
}
