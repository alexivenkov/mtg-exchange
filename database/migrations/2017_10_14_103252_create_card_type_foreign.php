<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardTypeForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('card_type', function (Blueprint $table) {
            $table->foreign('card_id')
                ->references('id')
                ->on('cards')
                ->onDelete('cascade');

            $table->foreign('type_id')
                ->references('id')
                ->on('types')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('card_type', function (Blueprint $table) {
            $table->dropForeign('card_type_card_id_foreign');
            $table->dropForeign('card_type_type_id_foreign');
        });
    }
}
