<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nisn')->length(30);
            $table->string('nama_depan')->length(30);
            $table->string('nama_belakang')->nullable();
            $table->string('tempat_lahir')->length(30);
            $table->string('tanggal_lahir')->length(30);
            $table->string('jenis_kelamin')->length(20);
            $table->string('nama_ibu')->length(40);
            $table->string('nama_ayah')->length(40);
            $table->string('agama')->length(20);
            $table->text('alamat')->length(200);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('jurusan_id');
            $table->string('avatar')->nullable();
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
        Schema::dropIfExists('siswa');
    }
}
