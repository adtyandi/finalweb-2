<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBerkassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berkass', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kredit_id')->nullable()->unsigned();
            $table->string('file_name');
            $table->foreign('kredit_id')->references('id')->on('pengajuan_kredits')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('berkass');
    }
}
