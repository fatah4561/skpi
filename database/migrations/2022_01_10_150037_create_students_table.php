<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            // fk users, 1-1
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->string('nrp', 9)->unique();
            $table->string('name');
            $table->string('class', 7)->nullable();
            $table->string('major', 2)->nullable();
            $table->enum('college_type', ['Reguler', 'Professional']);
            $table->string('phone_number', 14)->nullable();
            $table->string('picture')->nullable();
            $table->enum('defence_status', ['Belum Lulus', 'Sudah Lulus']);
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
        Schema::dropIfExists('students');
    }
}
