<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCounterView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE OR REPLACE VIEW counter_view AS
            SELECT
                users.id as userId,
                (
                    SELECT COUNT(*)
                    FROM semesters
                    WHERE
                        semesters.userId = users.id
                        AND code <> 0
                ) as semester,
                (
                    SELECT IFNULL(SUM(sks), 0)
                    FROM courses
                    JOIN semesters
                        ON semesters.id = courses.semesterId
                        AND semesters.code <> 0
                    WHERE semesters.userId = users.id
                ) as sks,
                (
                    SELECT FORMAT(IFNULL(AVG(ipk), 0), 2)
                    FROM semester_view
                    WHERE
                        semester_view.userId = users.id
                        AND code <> 0
                        AND id IN (SELECT semesterId FROM courses)
                        AND id NOT IN (
                            SELECT semesterId FROM courses WHERE ipk = 0
                        )
                ) as ipk,
                (
                    SELECT COUNT(*)
                    FROM certificates
                    WHERE certificates.userId = users.id
                ) as certificates,
                settings.targetSks,
                settings.targetCertificates,
                settings.targetSemester
            FROM users
            JOIN settings on settings.userId = users.id
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
