<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients_address', function (Blueprint $table)
        {
            $table->id('client_address_id');
            $table->integer('province_id');
            $table->integer('country_id');
            $table->string('postal_code', 5)->nullable();
            $table->string('address')->nullable();
            $table->string('town')->nullable();
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
        Schema::dropIfExists('clients_address');
    }
}
