<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('profile_pictures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // User relationship
            $table->string('file_path'); // Path to the stored image
            $table->string('file_name'); // Image filename
            $table->integer('file_size'); // Image size in bytes
            $table->string('file_type'); // MIME type (e.g., image/jpeg)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profile_pictures');
    }
};
