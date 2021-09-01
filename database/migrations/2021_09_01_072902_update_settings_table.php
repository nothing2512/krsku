<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("settings", function (Blueprint $table) {
            $table->dropColumn("targetSks");
            $table->dropColumn("targetSemester");
            $table->dropColumn("targetCertificates");
        });

        Schema::table("settings", function (Blueprint $table) {
            $table->integer("targetSks")->default(1);
            $table->integer("targetSemester")->default(1);
            $table->integer("targetCertificates")->default(1);
        });
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
