<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * tabel untuk file aktifitas lainnya
 */
class CreateActivityFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_files', function (Blueprint $table) {
            $table->id();
            // fk, 1-1
            $table->foreignId('activity_data_id')->unique()->constrained('activity_datas')->onUpdate('cascade')->onDelete('cascade');
            $table->text('activity_file');
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
        Schema::dropIfExists('activity_files');
    }
}
