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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('college_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->integer('role_as')->default('0');
            $table->string('teacher');
            $table->string('position');
            $table->date('yearinPosition');
            $table->date('yearJoined');
            $table->string('email')->unique();
            $table->string('signature')->nullable();
            $table->integer('user_status')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->default('$2y$10$BLcdzo8WWNfprDSiPBUsbeEJF1Y0SwhCUH8EKyqKdTS.xy9gMsLKu');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
