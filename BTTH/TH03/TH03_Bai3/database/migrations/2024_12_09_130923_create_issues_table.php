<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuesTable extends Migration
{
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->unsignedBigInteger('computer_id'); // Foreign Key
            $table->string('reported_by', 50)->nullable();
            $table->dateTime('reported_date');
            $table->text('description');
            $table->enum('urgency', ['Low', 'Medium', 'High']);
            $table->enum('status', ['Open', 'In Progress', 'Resolved']);
            $table->timestamps();

            // Foreign Key Constraint
            $table->foreign('computer_id')->references('id')->on('computers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('issues');
    }
}
