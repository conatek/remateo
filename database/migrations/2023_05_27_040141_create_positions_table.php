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
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id')->unsigned();
            $table->bigInteger('area_id')->unsigned();
            $table->string('name');
            $table->decimal('estimated_salary', 11, 2, true)->nullable();
            $table->mediumText('description')->nullable();

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('area_id')->references('id')->on('areas');

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
        Schema::dropIfExists('positions');
    }
};
