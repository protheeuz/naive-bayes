<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubkriteriaTable extends Migration
{
    public function up()
    {
        Schema::create('subkriteria', function (Blueprint $table) {
            $table->id('id_subkriteria');
            $table->foreignId('id_kriteria')->constrained('kriteria')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama', 50)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('subkriteria');
    }
}