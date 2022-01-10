<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkpiDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skpi_datas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->unique()->constrained('students')->onDelete('cascade'); // fk, 1-1
            $table->foreignId('collection_id')->constrained('skpi_collections')->onDelete('cascade'); // fk, m-1
            $table->foreignId('lecturer_id')->constrained('lectures')->onDelete('cascade'); // fk, m/1-m/1
            $table->string('mosmta')->nullable();
            $table->smallInteger('oracle')->nullable();
            $table->smallInteger('mtcna')->nullable();
            $table->smallInteger('ccent')->nullable();
            $table->smallInteger('ccna')->nullable();
            $table->smallInteger('toeic')->nullable();
            $table->smallInteger('moswa')->nullable();
            $table->string('other')->nullable();
            $table->string('organization_experience')->nullable();
            $table->string('award')->nullable();
            $table->string('thesis_title');
            $table->dateTime('date_filled');
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
        Schema::dropIfExists('skpi_datas');
    }
}