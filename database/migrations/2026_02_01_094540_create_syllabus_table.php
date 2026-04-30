<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSyllabusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('syllabus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('duration')->default(0);
            $table->string('type'); // video, zoom, pdf, etc.
            $table->string('video_url')->nullable();
            $table->string('zoom_link')->nullable();
            $table->string('pdf')->nullable();
            $table->boolean('is_preview')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();

            // Relación con cursos
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('syllabus');
    }
}
