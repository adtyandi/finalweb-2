<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanKreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_kredits', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tempat_lahir', 20);
            $table->date('tanggal_lahir');
            $table->string('phone', 13);
            $table->string('no_ktp');
            $table->string('npwp');
            $table->string('kewarganegaraan');
            $table->string('provinsi');
            $table->string('gender');
            $table->string('status');
            $table->string('nama_ibu');
            $table->string('alamat_identitas');
            $table->string('alamat_terkini');
            $table->string('jumlah_permohonan');
            $table->string('tujuan_penggunaan');
            $table->text('ket_penggunaan');
            $table->string('jangka_waktu');
            $table->string('jaminan_kredit');
            $table->string('posisi_jaminan');
            $table->string('status_jaminan');
            $table->string('kode_qr')->nullable();
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
        Schema::dropIfExists('pengajuan_kredits');
    }
}
