<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkpiCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skpi_collections', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->enum('collection_type', [
                "Semua Mahasiswa",
                "Mahasiswa Jurusan SI",
                "Mahasiswa Jurusan IF",
                "Mahasiswa Jurusan MI",
                "Mahasiswa Tingkat 4 Saja",
                "Mahasiswa Tingkat 3 Saja",
                "Beberapa Mahasiswa"
            ]);
            $table->string('detail');
            $table->string('academic_year', 9);
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
        Schema::dropIfExists('skpi_collections');
    }
}
