<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCommentViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       /*  DB::statement('CREATE VIEW user_comments_views AS
SELECT comments.*, all_auction_details_views.user_id AS auction_user_id, all_auction_details_views.name, all_auction_details_views.email, all_auction_details_views.phoneNumber
FROM (comments
         INNER JOIN all_auction_details_views ON all_auction_details_views.id = comments.auction_id)
'); */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /* DB::statement('DROP VIEW IF EXISTS user_comments_views'); */
    }
}
