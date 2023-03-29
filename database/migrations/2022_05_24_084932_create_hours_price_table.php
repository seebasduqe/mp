<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoursPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hours_price', function (Blueprint $table)
        {
            $table->id();
            $table->integer('client_id');
            $table->integer('hour_type_id');
            $table->integer('job_id');
            $table->integer('company_id');
            $table->decimal('pvp', 8, 2);
            $table->decimal('cost', 8, 2)->nullable();

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
        Schema::dropIfExists('hours_price');
    }
}
