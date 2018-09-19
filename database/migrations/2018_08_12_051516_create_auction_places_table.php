<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuctionPlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auction_places', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('division_id');
            $table->integer('district_id');
            $table->integer('upazila_id');
            $table->string('gpsLocation')->nullable();
            $table->bigInteger('user_id');
            $table->bigInteger('auction_id');
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
        Schema::dropIfExists('auction_places');
    }
}
