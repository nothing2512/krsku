<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSemesterView4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE OR REPLACE VIEW semester_view AS
            SELECT
                semesters.userId,
                semesters.id,
                semesters.name,
                semesters.code,
                semesters.active,
                FORMAT(
                    SUM(IFNULL(courses.score, 0)) /
                    SUM(IFNULL(courses.sks, 0))
                , 2) as ipk
            FROM semesters
            LEFT JOIN courses ON courses.semesterId = semesters.id
            GROUP BY semesters.id, semesters.userId
            ORDER BY semesters.active DESC, semesters.code DESC
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
