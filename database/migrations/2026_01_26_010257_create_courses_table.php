<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            // Básico
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('subtitle')->nullable();

            // Descripción
            $table->text('description');
            $table->text('directed_to')->nullable();

            // Comercial
            $table->boolean('is_paid')->default(true);
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->string('currency')->default('PEN');

            // Programación
            $table->date('start_date')->nullable();
            $table->integer('duration_weeks')->nullable();
            $table->integer('hours')->nullable();

            // Modalidad
            $table->string('modality')->nullable(); // Virtual
            $table->boolean('has_certificate')->default(true);
            $table->string('certificate_type')->nullable();
            $table->boolean('has_qr')->default(true);

            // Media
            $table->string('image')->nullable();
            $table->string('banner')->nullable();
            $table->string('promo_video')->nullable();

            // Control
            $table->enum('programa', [
                'curso',
                'diplomado',
                'especializacion'
            ]);

            $table->boolean('status')->default(true);
            $table->foreignId('user_id')->constrained();

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
        Schema::dropIfExists('courses');
    }
}
