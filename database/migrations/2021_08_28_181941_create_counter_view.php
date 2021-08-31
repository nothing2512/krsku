<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCounterView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE VIEW counter_view AS
            SELECT
                (
                    SELECT COUNT(*)
                    FROM semesters
                    WHERE code <> 0
                ) as semester,
                (
                    SELECT SUM(sks)
                    FROM courses
                    JOIN semesters ON semesters.id = courses.semesterId AND semesters.code <> 0
                ) as sks,
                (
                    SELECT FORMAT(AVG(ipk), 2)
                    FROM semester_view
                    WHERE
                        code <> 0
                        AND id IN (SELECT semesterId FROM courses)
                        AND id NOT IN (
                            SELECT semesterId FROM courses WHERE ipk = 0
                        )
                ) as ipk,
                0 as certificates,
                144 as targetSks,
                14 as targetCertificates,
                8 as targetSemester
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('counter_view');
    }
}
