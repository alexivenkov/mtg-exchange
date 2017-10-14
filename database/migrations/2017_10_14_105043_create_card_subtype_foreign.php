<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardSubtypeForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('card_subtype', function (Blueprint $table) {
            $table->foreign('card_id')
                ->references('id')
                ->on('cards')
                ->onDelete('cascade');

            $table->foreign('subtype_id')
                ->references('id')
                ->on('subtypes')
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
            $table->dropForeign('card_subtype_card_id_foreign');
            $table->dropForeign('card_subtype_type_id_foreign');
        });
    }
}
