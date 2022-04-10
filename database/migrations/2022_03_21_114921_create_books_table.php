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
            $table->string('genre')->nullable();
            $table->foreignId('id_kelas');
            $table->string('bookTitle');
            $table->integer('bookTotal');
            $table->string('bookImage');
            $table->integer('tax')->nullable();
            $table->integer('fine')->nullable();
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
