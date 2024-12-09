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
        Schema::create('sales', function (Blueprint $table) {
            $table->id('sale_id'); // Khóa chính
            $table->unsignedBigInteger('medicine_id'); // Khóa ngoại
            $table->integer('quantity');
            $table->dateTime('sale_date');
            $table->string('customer_phone', 10)->nullable(); // Tùy chọn
            $table->timestamps();

            // Định nghĩa khóa ngoại
            $table->foreign('medicine_id')->references('medicine_id')->on('medicines')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
