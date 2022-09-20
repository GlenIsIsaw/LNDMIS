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
        Schema::create('idps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade'); 
            $table->string('purpose_meet')->default(' ');
            $table->string('purpose_improve')->default(' ');
            $table->string('purpose_obtain')->default(' ');
            $table->string('purpose_others')->default(' ');
            $table->string('purpose_explain')->default(' ');
            
            $table->json('competency');
            $table->json('sug');
            $table->json('dev_act');
            $table->json('target_date');
            $table->json('responsible');
            $table->json('support');
            $table->json('status');
            
            $table->string('compfunction0');
            $table->Text('compfunctiondesc0');
            $table->string('compfunction1');
            $table->Text('compfunctiondesc1');
            $table->string('diffunction0');
            $table->Text('diffunctiondesc0');
            $table->string('diffunction1');
            $table->Text('diffunctiondesc1');
            $table->Text('career');
            $table->boolean('submitted')->default(0);
            $table->string('submit_status')->default('Pending');
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
        Schema::dropIfExists('idps');
    }
};
