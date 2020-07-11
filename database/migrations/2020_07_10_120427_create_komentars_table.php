<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKomentarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komentars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('isi');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('pertanyaan_id');
            $table->unsignedBigInteger('jawaban_id');
            $table->foreign('user_id')->references('id')->on('users'); // menambah foreign key
            $table->foreign('pertanyaan_id')->references('id')->on('pertanyaans'); // menambah foreign key
            $table->foreign('jawaban_id')->references('id')->on('jawabans'); // menambah foreign key
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
        Schema::dropIfExists('komentars');
    }
}
