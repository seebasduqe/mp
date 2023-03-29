<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table)
        {
            $table->id('company_id');
            $table->string('name')->nullable();
            $table->string('cif')->nullable();
            $table->string('address')->nullable();
            $table->string('postal_code', 11)->nullable();
            $table->string('population')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('active')->default(1);
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
        Schema::dropIfExists('companies');
    }
}
