<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisheIngredientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishe_ingredient', function (Blueprint $table) {
            $table->unsignedBigInteger('dishe_id')->nullable(false);
            $table->unsignedBigInteger('ingredient_id')->nullable(false);
            $table->unique(['dishe_id', 'ingredient_id']);
            $table->foreign('dishe_id')->references('id')->on('ingredients')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('ingredient_id')->references('id')->on('allergens')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dishe_ingredient');
    }
}
