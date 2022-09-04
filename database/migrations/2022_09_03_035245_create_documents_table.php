<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('pname');
            $table->string('page');
            $table->string('sname');
            $table->string('sage');
            $table->string('section');
            $table->string('relation');
            $table->string('dated');
            $table->string('datem');
            $table->string('pnum');
            $table->string('pemail')->nullable();
            $table->string('snum');
            $table->string('semail')->nullable();
            $table->string('signature');
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
        Schema::dropIfExists('documents');
    }
};
