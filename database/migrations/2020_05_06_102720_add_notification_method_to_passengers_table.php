<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNotificationMethodToPassengersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('passengers', function (Blueprint $table) {
            $table->tinyInteger('notification_method')->default(0)->after('company_id');
            $table->tinyInteger('lang')->default(0)->after('company_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('passengers', function (Blueprint $table) {
            $table->dropColumn('notification_method');
            $table->dropColumn('lang');
        });
    }
}
