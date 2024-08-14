<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatasetTable extends Migration
{
    public function up()
    {
        Schema::create('dataset', function (Blueprint $table) {
            $table->id('id_dataset');
            $table->string('kode', 10)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dataset');
    }
}
