<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->id('medicine_id'); // Khóa chính
            $table->string('name', 255);
            $table->string('brand', 100)->nullable(); // Tùy chọn
            $table->string('dosage', 50)->nullable();
            $table->string('form', 50)->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('stock');
            $table->timestamps(); // Lưu ngày tạo/cập nhật
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
