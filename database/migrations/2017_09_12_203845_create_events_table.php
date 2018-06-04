<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('place');
            $table->date('date');
            $table->string('qr')->nullable();
            $table->integer('type');
            $table->integer('photographer_id')->unsigned()->nullable();
            $table->foreign('photographer_id')->references('id')->on('photographers')->onDelete('cascade');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
