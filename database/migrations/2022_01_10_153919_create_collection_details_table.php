<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // tabel detil pengumpulan untuk detil mahasiswa siapa saja yang bisa mengumpulkan
        Schema::create('collection_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collection_id')->constrained('skpi_collections')->onUpdate('cascade')->onDelete('cascade'); 
            // fk, m-1
            $table->bigInteger('student_id');
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
        Schema::dropIfExists('collection_details');
    }
}
