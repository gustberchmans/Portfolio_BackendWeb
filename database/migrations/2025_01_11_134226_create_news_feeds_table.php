<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/XXXX_XX_XX_XXXXXX_create_news_feeds_table.php

    public function up()
    {
        Schema::create('news_feeds', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // News title
            $table->text('content'); // News content
            $table->timestamp('date'); // News date
            $table->foreignId('picture_id')->nullable()->constrained('pictures')->onDelete('set null'); // Image from the pictures table
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('news_feeds');
    }

};
