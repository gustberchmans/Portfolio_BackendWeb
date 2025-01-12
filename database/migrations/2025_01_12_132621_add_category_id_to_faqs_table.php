<?php
// database/migrations/xxxx_xx_xx_add_category_id_to_faqs_table.php
// database/migrations/xxxx_xx_xx_add_category_id_to_faqs_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToFaqsTable extends Migration
{
    public function up()
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
}


