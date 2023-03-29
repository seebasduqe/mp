<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonsAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons_address', function (Blueprint $table)
        {
            $table->id('person_address_id');
            $table->string('address')->nullable();
            $table->string('town')->nullable();
            $table->string('postal_code', 5)->nullable();
            $table->integer('province_id')->nullable();
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
        Schema::dropIfExists('persons_address');
    }
}
