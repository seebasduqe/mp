<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table)
        {
            $table->id('person_id');
            $table->integer('person_address_id');
            $table->integer('category_id');
            $table->string('name')->nullable();
            $table->string('surnames')->nullable();
            $table->string('nif')->nullable();
            $table->string('telephone_1', 20)->nullable();
            $table->string('telephone_2', 20)->nullable();
            $table->string('email')->nullable();
            $table->tinyInteger('leave')->nullable();
            $table->string('nss', 60)->nullable();
            $table->date('start_date')->nullable();
            $table->string('kpqlo')->nullable();
            $table->string('hash')->nullable();
            $table->string('initial', 2)->nullable();
            $table->integer('sub_company_id')->nullable();
            $table->string('observations')->nullable();
            $table->integer('registration_number')->nullable();
            $table->date('birth_date')->nullable();
            $table->integer('liquid_payroll')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            $table->index(['person_address_id', 'category_id', 'sub_company_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persons');
    }
}
