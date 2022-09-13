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
        Schema::create('attendance_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trainings_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('competency');
            $table->text('knowledge_acquired');
            $table->text('outcome');
            $table->text('personal_action');
            $table->string('esign')->default(' ');
            $table->string('edate')->default(' ');
            $table->string('ssign')->default(' ');
            $table->string('sdate')->default(' ');
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
        Schema::dropIfExists('attendance_forms');
    }
};
