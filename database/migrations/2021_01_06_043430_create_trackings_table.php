<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trackings', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->string('reference');
            $table->timestamps();
        });

        Schema::create('tracking_status', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tracking_id')->unsigned();
            $table->foreign('tracking_id')->references('id')->on('trackings');
            $table->bigInteger('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('status');
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
        Schema::table('tracking_status', function (Blueprint $table) {
            $table->dropForeign('tracking_status_tracking_id_foreign');
            $table->dropForeign('tracking_status_status_id_foreign');
        });
        
        Schema::dropIfExists('trackings');
        Schema::dropIfExists('tracking_status');
    }
}
