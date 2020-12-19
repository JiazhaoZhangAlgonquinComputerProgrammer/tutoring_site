<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tutor_id')->references('id')->on('tutors')->onDelete('cascade');
            $table->foreignId('tutee_id')->references('id')->on('tutees')->onDelete('cascade');
            $table->foreignId('course_id')->references('id')->on('tutoringcourses')->onDelete('cascade');
            $table->foreignId('timeslot_id')->references('id')->on('timeslots')->onDelete('cascade');
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
        Schema::dropIfExists('appointments');
    }
}
