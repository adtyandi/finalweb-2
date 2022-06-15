<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgresPengajuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progres_pengajuans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kredit_id')->unsigned()->nullable();
            $table->string('status_pengajuan');
            $table->text('komentar')->nullable();
            $table->bigInteger('users_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('kredit_id')->references('id')->on('pengajuan_kredits')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('progres_pengajuans');
    }
}
