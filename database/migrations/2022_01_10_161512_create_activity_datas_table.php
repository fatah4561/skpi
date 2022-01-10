<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * tabel data aktifitas lainnya
 * dipisahkan dari tabel skpi_datas karena dinamis bisa sampai beberapa (maks 15)
 * relasi many to one dengan tabel skpi_datas
 */

class CreateActivityDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_datas', function (Blueprint $table) {
            $table->id();
            // fk, m-1
            $table->foreignId('skpi_data_id')->constrained('skpi_datas')->onUpdate('cascade')->onDelete('cascade');
            $table->string('activity_detail');
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
        Schema::dropIfExists('activity_datas');
    }
}
