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
            $table->foreignId('list_of_training_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('idp_id')->nullable();
            $table->string('competency');
            $table->text('knowledge_acquired');
            $table->text('outcome');
            $table->text('personal_action');
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
