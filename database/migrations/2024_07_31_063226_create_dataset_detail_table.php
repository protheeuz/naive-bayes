<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatasetDetailTable extends Migration
{
    public function up()
    {
        Schema::create('dataset_detail', function (Blueprint $table) {
            $table->id('id_dataset_detail');
            $table->foreignId('id_dataset')->constrained('dataset')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_subkriteria')->constrained('subkriteria')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dataset_detail');
    }
}