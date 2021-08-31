<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateSemesterView extends Migration
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
                semesters.id,
                semesters.name,
                semesters.code,
                semesters.active,
                FORMAT(AVG(courses.score), 2) as ipk
            FROM semesters
            LEFT JOIN courses ON courses.semesterId = semesters.id
            GROUP BY semesters.id
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
