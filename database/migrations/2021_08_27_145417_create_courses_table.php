<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            $table->bigInteger("semesterId");
            $table->string("name");
            $table->string("kosek");
            $table->string("dosen");
            $table->integer("day");
            $table->time("start_time");
            $table->time("end_time");
            $table->decimal("score", 10, 1)->default(0);
            $table->integer("lms_type");
            $table->string("lms_link")->nullable();
            $table->string("group_link")->nullable();

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
        Schema::dropIfExists('courses');
    }
}
