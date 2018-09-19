<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllAuctionDetailsViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::statement('CREATE VIEW all_auction_details_views AS
SELECT auction_details_views.*, categories.categoryName, sub_categories.subCategoryName, divisions.divisionName, districts.districtName, upazilas.upazilaName, users.name, users.email
FROM ((((((auction_details_views
         INNER JOIN categories ON categories.id = auction_details_views.category_id)
         INNER JOIN sub_categories ON sub_categories.id = auction_details_views.subcategory_id)
         INNER JOIN divisions ON divisions.id = auction_details_views.division_id)
        INNER JOIN districts ON districts.id = auction_details_views.district_id)
       INNER JOIN upazilas ON upazilas.id = auction_details_views.upazila_id)
      INNER JOIN users ON users.id = auction_details_views.user_id)
');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::statement('DROP VIEW IF EXISTS all_auction_details_views');
    }
}
