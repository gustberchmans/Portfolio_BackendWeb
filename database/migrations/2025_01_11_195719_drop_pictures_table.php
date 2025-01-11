<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropPicturesTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('pictures');
    }

    public function down()
    {
        // This is to reverse the migration if you ever want to rollback
        Schema::create('pictures', function (Blueprint $table) {
            $table->id();
            $table->binary('file_data'); // To store the image data
            $table->string('file_type'); // To store the mime type of the image
            $table->timestamps();
        });
    }
};
