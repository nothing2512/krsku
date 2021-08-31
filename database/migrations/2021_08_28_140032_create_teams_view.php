<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTeamsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE VIEW teams_view AS
            SELECT
                teams.*,
                COUNT(user.id) as member,
                GROUP_CONCAT(DISTINCT user.name ORDER BY user.id ASC SEPARATOR ',') as members
            FROM teams
            JOIN team_users user ON user.teamId = teams.id
            GROUP BY teams.id
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams_view');
    }
}
