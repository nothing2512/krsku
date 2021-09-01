<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateIncomingTasksView2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE OR REPLACE VIEW incoming_tasks_view AS
            SELECT
                task.*,
                semesters.userId,
                IF (
                    deadline > CURRENT_DATE,
                    DATEDIFF(deadline, CURRENT_DATE),
                    DATEDIFF(CURRENT_DATE, deadline)
                ) as deadlineDifference,
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
