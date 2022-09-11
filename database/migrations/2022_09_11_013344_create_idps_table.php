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
            $table->string('competency');
            $table->string('sug');
            $table->string('dev_act');
            $table->date('target_date');
            $table->string('responsible');
            $table->string('support');
            $table->string('status');
            $table->Text('compfunctiondesc0');
            $table->Text('compfunctiondesc1');
            $table->Text('difffunctiondesc0');
            $table->Text('difffunctiondesc1');
            $table->Text('career');
            $table->string('esign')->default(' ');
            $table->string('edate')->default(' ');
            $table->string('ssign')->default(' ');
            $table->string('sdate')->default(' ');
            $table->string('hsign')->default(' ');
            $table->string('hdate')->default(' ');
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
