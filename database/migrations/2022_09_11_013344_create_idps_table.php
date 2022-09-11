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
            
            $table->string('competency1');
            $table->string('sug1');
            $table->string('dev_act1');
            $table->date('target_date1');
            $table->string('responsible1');
            $table->string('support1');
            $table->string('status1');

            $table->string('competency2');
            $table->string('sug2');
            $table->string('dev_act2');
            $table->date('target_date2');
            $table->string('responsible2');
            $table->string('support2');
            $table->string('status2');

            $table->string('competency3');
            $table->string('sug3');
            $table->string('dev_act3');
            $table->date('target_date3');
            $table->string('responsible3');
            $table->string('support3');
            $table->string('status3');
            
            $table->Text('compfunctiondesc0');
            $table->Text('compfunctiondesc1');
            $table->Text('diffunctiondesc0');
            $table->Text('diffunctiondesc1');
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
