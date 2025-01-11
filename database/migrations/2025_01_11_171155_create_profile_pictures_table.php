<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('profile_pictures', function (Blueprint $table) {
            // Update the existing table as needed
            if (!Schema::hasColumn('profile_pictures', 'file_path')) {
                $table->string('file_path')->nullable(false)->change();
            }
            if (!Schema::hasColumn('profile_pictures', 'file_name')) {
                $table->string('file_name')->nullable(false)->change();
            }
            if (!Schema::hasColumn('profile_pictures', 'file_size')) {
                $table->bigInteger('file_size')->nullable(false)->change();
            }
            if (!Schema::hasColumn('profile_pictures', 'file_type')) {
                $table->string('file_type')->nullable(false)->change();
            }
        });
    }

    public function down()
    {
        Schema::table('profile_pictures', function (Blueprint $table) {
            // Reverse the changes if needed
            $table->dropColumn('file_path');
            $table->dropColumn('file_name');
            $table->dropColumn('file_size');
            $table->dropColumn('file_type');
        });
    }
};

