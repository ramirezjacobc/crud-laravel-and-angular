<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
          $table->engine = 'InnoDB';

          $table->increments('id');
          $table->string('name');
          $table->text('description');
          $table->string('author');
          $table->date('published_date');
          $table->string('user');
          $table->integer('category_id')->unsigned();
          //$table->boolean('available');
          $table->boolean('available')->default(false);
          $table->timestamps();

          $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('books');
    }
}
