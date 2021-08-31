<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateChartIpkView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE OR REPLACE VIEW chart_ipk_view AS
            SELECT
                userId,
                code,
                IF (ipk = 0,
                    (
                        SELECT FORMAT(AVG(ipk), 2)
						FROM semester_view
						WHERE
						    code <> 0
							AND id IN (SELECT semesterId FROM courses)
                            AND id NOT IN (
                                SELECT semesterId FROM courses WHERE ipk = 0
                            )
                    )
                , ipk) as ipk
            FROM semester_view
            WHERE code <> 0
            ORDER BY code ASC
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
