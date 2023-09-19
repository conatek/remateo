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
        Schema::create('collaborators', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->unsigned();
            $table->unsignedBigInteger('document_type_id')->nullable();
            $table->string('document_number')->nullable();
            $table->date('expedition_date')->nullable();
            // Pais de expedición
            $table->unsignedBigInteger('document_province_id')->nullable();
            $table->unsignedBigInteger('document_city_id')->nullable();
            $table->string('name')->nullable();
            $table->string('first_surname')->nullable();
            $table->string('second_surname')->nullable();
            $table->unsignedBigInteger('sex_type_id')->nullable();
            $table->unsignedBigInteger('rh_type_id')->nullable();
            $table->unsignedBigInteger('scholarship_id')->nullable();
            // Url foto
            $table->date('birth_date')->nullable();
            // País de nacimiento
            $table->unsignedBigInteger('birth_province_id')->nullable();
            $table->unsignedBigInteger('birth_city_id')->nullable();
            // País de residencia
            $table->unsignedBigInteger('residence_province_id')->nullable();
            $table->unsignedBigInteger('residence_city_id')->nullable();
            $table->string('address')->nullable();
            $table->unsignedBigInteger('social_stratum_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('cellphone')->nullable();
            $table->string('email')->nullable();
            $table->text('observations')->nullable();

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('document_province_id')->references('id')->on('provinces')->onDelete('cascade');
            $table->foreign('document_city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('sex_type_id')->references('id')->on('sex_types')->onDelete('cascade');
            $table->foreign('rh_type_id')->references('id')->on('rh_types')->onDelete('cascade');
            $table->foreign('scholarship_id')->references('id')->on('scholarships')->onDelete('cascade');
            $table->foreign('birth_province_id')->references('id')->on('provinces')->onDelete('cascade');
            $table->foreign('birth_city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('residence_province_id')->references('id')->on('provinces')->onDelete('cascade');
            $table->foreign('residence_city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('social_stratum_id')->references('id')->on('social_strata')->onDelete('cascade');

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
        Schema::dropIfExists('collaborators');
    }
};
