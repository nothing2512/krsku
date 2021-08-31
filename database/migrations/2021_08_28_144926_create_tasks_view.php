<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTasksView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE VIEW tasks_view AS
            SELECT
                tasks.*,
                teams.name as teamName,
                GROUP_CONCAT(DISTINCT user.name ORDER BY user.id ASC SEPARATOR ',') as members
            FROM tasks
            LEFT JOIN teams ON teams.id = tasks.teamId
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
        Schema::dropIfExists('tasks_view');
    }
}
