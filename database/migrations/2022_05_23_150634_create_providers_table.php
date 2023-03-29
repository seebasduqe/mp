<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table)
        {
            $table->id('provider_id');
            $table->integer('provider_adderss_id');
            $table->string('cif')->nullable();
            $table->string('name')->nullable();
            $table->string('telephone', 13)->nullable();
            $table->string('email')->nullable();
            $table->string('fax', 13)->nullable();
            $table->date('creation_date');

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
        Schema::dropIfExists('providers');
    }
}
