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
        Schema::table('users', function (Blueprint $table) {
            $table->date('birthday')->nullable(); // For storing birthday
            $table->text('about')->nullable();    // For storing about text
            $table->string('profile_picture')->nullable(); // For storing the profile picture filename
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('birthday');
            $table->dropColumn('about');
            $table->dropColumn('profile_picture');
        });
    }

};
