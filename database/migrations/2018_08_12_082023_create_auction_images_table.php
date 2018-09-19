<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuctionImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auction_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('adImage1')->nullable();
            $table->text('adImage2')->nullable();
            $table->text('adImage3')->nullable();
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
        Schema::dropIfExists('auction_images');
    }
}
