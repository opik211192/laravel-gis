<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWilayahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wilayahs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_bm');
            $table->string('no_registrasi');
            $table->string('nama_pekerjaan');
            $table->date('tgl_pemasangan');
            $table->date('tgl_pengecekan');
            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('village_id');            
            $table->string('uraian_lokasi');
            $table->string('x');
            $table->string('y');
            $table->string('latitude');
            $table->string('longitude');
            $table->unsignedBigInteger('zone_id');
            $table->unsignedBigInteger('band_id');
            $table->unsignedBigInteger('utm_zone_id');
            $table->string('sketsa');
            $table->string('gambar');
            $table->string('tinggi_orthometrik');
            $table->string('tinggi_elipsoid');
            $table->timestamps();

            //relasi
            $table->foreign('province_id')->references('id')->on('indonesia_provinces');
            $table->foreign('city_id')->references('id')->on('indonesia_cities');
            $table->foreign('district_id')->references('id')->on('indonesia_districts');
            $table->foreign('village_id')->references('id')->on('indonesia_villages');
            
            $table->foreign('zone_id')->references('id')->on('zones');
            $table->foreign('band_id')->references('id')->on('bands');
            $table->foreign('utm_zone_id')->references('id')->on('utm_zones');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wilayahs');
    }
}
