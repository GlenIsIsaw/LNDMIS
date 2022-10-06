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
        Schema::create('list_of_trainings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade'); 
            $table->string('certificate_type');
            $table->string('certificate_title');
            $table->date('date_covered');
            $table->string('venue');
            $table->string('sponsors');
            $table->string('level');
            $table->integer('num_hours');
            $table->string('type');
            $table->string('certificate');
            $table->boolean('attendance_form')->default(0);
            $table->string('status')->default('Not Submitted');
            $table->longText('comment')->nullable();
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
        Schema::dropIfExists('list_of_trainings');
    }
};
