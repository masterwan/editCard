<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wears', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description');
            $table->integer('currency_id');
            $table->integer('wear_category_id');
            $table->integer('wear_subcategory_id');
            $table->integer('brand_id');
            $table->integer('size_id');
            $table->integer('color_id');
            $table->text('image_url_preview');
            $table->text('buy_url');
            $table->string('lamoda_id');
            $table->string('is_on_model');


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
        Schema::dropIfExists('wears');
    }
}
