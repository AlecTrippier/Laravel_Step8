<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFetchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('tests', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('name',30)->comment('商品名');
        $table->integer('price')->comment('価格');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('tests');
}

}
