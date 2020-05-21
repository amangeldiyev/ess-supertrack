<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassengersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passengers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('badge_number')->unique();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->tinyInteger('sms_notification')->default(0);
            $table->tinyInteger('email_notification')->default(1);
            $table->tinyInteger('lang')->default(0);
            $table->unsignedInteger('company_id');
            $table->tinyInteger('deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('passengers');
    }
}
