<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('profile_pictures', function (Blueprint $table) {
            $table->longText('image_blob')->nullable(); // Column to store image data as a blob
            $table->dropColumn('file_path'); // Remove file path column if unnecessary
        });
    }

    public function down(): void
    {
        Schema::table('profile_pictures', function (Blueprint $table) {
            $table->dropColumn('image_blob');
            $table->string('file_path')->nullable();
        });
    }
};

