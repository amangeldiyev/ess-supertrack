<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNotifcationSentToTaxiRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('taxi_requests', function (Blueprint $table) {
            $table->tinyInteger('notification_sent')->default(0)->after('ordered_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('taxi_requests', function (Blueprint $table) {
            $table->dropColumn('notification_sent');
        });
    }
}
