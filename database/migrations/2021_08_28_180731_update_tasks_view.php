<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTasksView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE OR REPLACE VIEW tasks_view AS
            SELECT
                tasks.*,
                courses.name as courseName,
                GROUP_CONCAT(DISTINCT user.name ORDER BY user.id ASC SEPARATOR ',') as members
            FROM tasks
            JOIN courses ON courses.id = tasks.courseId
            LEFT JOIN team_users user ON user.teamId = tasks.teamId
            GROUP BY tasks.id
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
