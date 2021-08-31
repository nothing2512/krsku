<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCoursesView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE VIEW courses_view AS
            SELECT
                courses.*,
                CASE
                    WHEN courses.day = 1 THEN 'Senin'
                    WHEN courses.day = 2 THEN 'Selasa'
                    WHEN courses.day = 3 THEN 'Rabu'
                    WHEN courses.day = 4 THEN 'Kamis'
                    WHEN courses.day = 5 THEN 'Jumat'
                    WHEN courses.day = 6 THEN 'Sabtu'
                    ELSE 'Minggu'
                END as day_name,
                CASE
                    WHEN courses.lms_type = 1 THEN 'LMS UNJ'
                    WHEN courses.lms_type = 2 THEN 'Google Classroom'
                    WHEN courses.lms_type = 3 THEN 'Ms. Teams'
                    ELSE 'Other'
                END as lms_name
            FROM courses
            JOIN semesters
                ON semesters.id = courses.semesterId
                AND semesters.active = 1
            ORDER BY courses.day ASC, courses.id DESC
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses_view');
    }
}
