<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxiRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxi_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('number');
            $table->date('date');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('type')->default(0);
            $table->tinyInteger('passenger_type')->default(0);
            $table->tinyInteger('qty');
            $table->tinyInteger('driver_in_time')->default(0);
            $table->unsignedInteger('company_id');
            $table->string('passenger')->nullable();
            $table->string('phone')->nullable();
            $table->text('pick_up_location');
            $table->text('drop_off_location');
            $table->time('on_location_time')->nullable();
            $table->time('pick_up_time')->nullable();
            $table->time('drop_off_time')->nullable();
            $table->unsignedInteger('driver_id')->nullable();
            $table->unsignedInteger('vehicle_id')->nullable();
            $table->string('vehicle_type')->nullable();
            $table->text('comment')->nullable();
            $table->unsignedInteger('ordered_by');
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
        Schema::dropIfExists('taxi_requests');
    }
}
