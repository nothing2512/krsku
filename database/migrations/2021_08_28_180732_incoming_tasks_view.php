<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class IncomingTasksView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE VIEW incoming_tasks_view AS
            SELECT
                task.*,
                IF (
                    deadline > CURRENT_DATE,
                    DATEDIFF(deadline, CURRENT_DATE),
                    DATEDIFF(CURRENT_DATE, deadline)
                ) as deadlineDifference,
                courses.name as courseName,
                CURRENT_DATE > deadline as late
            FROM tasks_view task
            JOIN courses ON courses.id = task.courseId
            JOIN semesters
                ON semesters.id = courses.semesterId
                AND semesters.active = 1
            WHERE status = 0
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
