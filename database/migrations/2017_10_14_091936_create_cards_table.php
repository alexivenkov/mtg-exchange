<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->tinyInteger('cmc');
            $table->string('mana_cost');
            $table->text('description');
            $table->text('type_line');
            $table->tinyInteger('power')->nullable();
            $table->tinyInteger('toughness')->nullable();
            $table->integer('set_id');
            $table->string('rarity');
            $table->text('flavor')->nullable();
            $table->string('image');
            $table->string('artist');
            $table->string('color')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
