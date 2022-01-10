<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkpiFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skpi_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('skpi_data_id')->unique()->constrained('skpi_datas')->onDelete('cascade'); // fk, 1-1
            $table->foreignId('collection_id')->constrained('skpi_collections')->onDelete('cascade'); // fk, m-1
            $table->text('mosmta_file')->nullable();
            $table->text('oracle_file')->nullable();
            $table->text('mtcna_file')->nullable();
            $table->text('ccent_file')->nullable();
            $table->text('ccna_file')->nullable();
            $table->text('toeic_file')->nullable();
            $table->text('moswa_file')->nullable();
            $table->text('other_file')->nullable();
            $table->text('organization_experience_file')->nullable();
            $table->text('award_file')->nullable();
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
        Schema::dropIfExists('skpi_files');
    }
}
