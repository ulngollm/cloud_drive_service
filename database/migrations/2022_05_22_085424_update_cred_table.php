<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('token_storage_credentials', function (Blueprint $table) {
            $table->unsignedInteger('storage_id');

            $table->foreign('storage_id')
                ->references('id')
                ->on('storages')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('token_storage_credentials', function (Blueprint $table) {
            $table->dropForeign('storage_id');
            $table->dropColumn('storage_id');
        });
    }
};
