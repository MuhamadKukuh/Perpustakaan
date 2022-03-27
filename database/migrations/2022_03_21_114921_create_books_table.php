<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id('id_books');
            $table->foreignId('id_category');
            $table->foreignId('id_kelas');
            $table->string('bookTitle');
            $table->integer('bookTotal');
            $table->integer('tax');
            $table->integer('fine');
            $table->foreignId('id_bookshelf');
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
        Schema::dropIfExists('books');
    }
};
