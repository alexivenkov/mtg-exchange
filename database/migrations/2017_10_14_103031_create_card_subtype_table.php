<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardSubtypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_subtype', function (Blueprint $table) {
            $table->unsignedInteger('card_id');
            $table->unsignedInteger('subtype_id');
            $table->timestamps();

            $table->unique('card_id', 'subtype_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card_subtype');
    }
}
