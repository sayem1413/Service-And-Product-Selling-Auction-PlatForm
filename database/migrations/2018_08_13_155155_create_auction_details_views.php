<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuctionDetailsViews extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::statement('CREATE VIEW auction_details_views AS
SELECT auction_details.*, auction_places.division_id, auction_places.district_id, auction_places.upazila_id, auction_places.gpsLocation, auction_categories.category_id, auction_categories.subcategory_id, auction_images.adImage1, auction_images.adImage2, auction_images.adImage3, seller_details.phoneNumber
FROM ((((auction_details
         INNER JOIN auction_categories ON auction_categories.auction_id = auction_details.id)
         INNER JOIN auction_places ON auction_places.auction_id = auction_details.id)
         INNER JOIN auction_images ON auction_images.auction_id = auction_details.id)
        INNER JOIN seller_details ON seller_details.auction_id = auction_details.id)
');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::statement('DROP VIEW IF EXISTS auction_details_views');
    }

}
