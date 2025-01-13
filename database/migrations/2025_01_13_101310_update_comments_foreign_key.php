<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCommentsForeignKey extends Migration
{
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            // Remove the old foreign key if it exists
            $table->dropForeign(['news_id']); // If news_id exists
            $table->dropColumn('news_id');

            // Add the new foreign key to news_feeds
            $table->foreignId('news_feed_id')->constrained('news_feeds')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            // Roll back changes by dropping the new foreign key and restoring the old one
            $table->dropForeign(['news_feed_id']);
            $table->dropColumn('news_feed_id');
            $table->foreignId('news_id')->constrained('news')->onDelete('cascade'); // Optional, based on your previous setup
        });
    }
}

