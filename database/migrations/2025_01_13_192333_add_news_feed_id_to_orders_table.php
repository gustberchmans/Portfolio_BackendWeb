<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewsFeedIdToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Add the nullable news_feed_id column
            $table->unsignedBigInteger('news_feed_id')->nullable()->after('meal_id');

            // Optional: Add a foreign key constraint, but it's not mandatory if you want it to be optional
            // $table->foreign('news_feed_id')->references('id')->on('news_feeds')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Drop the column if rolling back the migration
            $table->dropColumn('news_feed_id');
        });
    }
}
