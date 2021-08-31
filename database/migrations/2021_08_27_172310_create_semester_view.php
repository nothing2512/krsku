<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSemesterView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE VIEW semester_view AS
            SELECT
                semesters.id,
                semesters.name,
                semesters.code,
                semesters.active,
                COUNT(courses.score) as ipk
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
        Schema::dropIfExists('semester_view');
    }
}
