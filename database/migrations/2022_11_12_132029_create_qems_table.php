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
        Schema::create('qems', function (Blueprint $table) {
            $table->id();
            $table->foreignId('list_of_training_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->json('content');
            $table->json('benefits');
            $table->json('realization');
            $table->floatval('total_average');
            $table->text('remarks');
            $table->integer('supervisor')->nullable();
            $table->string('status')->default('Not Submitted');
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
        Schema::dropIfExists('qems');
    }
};
