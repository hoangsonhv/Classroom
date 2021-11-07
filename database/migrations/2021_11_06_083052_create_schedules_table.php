<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string("rank");
            $table->unsignedBigInteger("id_shift")->unsigned()->nullable();
            $table->unsignedBigInteger("id_subject")->unsigned()->nullable();
            $table->string("id_student");
            $table->foreign("id_shift")->references("id")->on("shifts")->cascadeOnDelete();
            $table->foreign("id_subject")->references("id")->on("subjects")->cascadeOnDelete();
//            $table->foreign("id_student")->references("id")->on("students")->cascadeOnDelete();
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
        Schema::dropIfExists('schedules');
    }
}
