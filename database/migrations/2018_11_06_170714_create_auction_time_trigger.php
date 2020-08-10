<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuctionTimeTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* DB::unprepared('CREATE TRIGGER `auction_time_trigger` BEFORE INSERT ON `auction_times`
 FOR EACH ROW SET
    NEW.auctionExpiryDate = IFNULL(NEW.auctionExpiryDate, DATE_ADD(CURRENT_TIMESTAMP,INTERVAL 7 DAY))
'); */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /* DB::unprepared('DROP TRIGGER IF EXISTS auction_time_trigger'); */
    }
}
