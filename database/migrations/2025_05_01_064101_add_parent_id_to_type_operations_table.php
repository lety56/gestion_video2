<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentIdToTypeOperationsTable extends Migration
{
    public function up()
    {
        Schema::table('type_operations', function (Blueprint $table) {
            // Utilisez le bon nom de colonne id_type_operations
            $table->unsignedBigInteger('parent_id')->nullable()->after('description');
            $table->foreign('parent_id')->references('id_type_operations')->on('type_operations')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('type_operations', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropColumn('parent_id');
        });
    }
}