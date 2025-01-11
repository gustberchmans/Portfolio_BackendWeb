<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('profile_pictures', function (Blueprint $table) {
            $table->renameColumn('image_blob', 'file_data');
        });
    }

    public function down()
    {
        Schema::table('profile_pictures', function (Blueprint $table) {
            $table->renameColumn('file_data', 'image_blob');
        });
    }

};
