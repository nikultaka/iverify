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
        Schema::create('applicants', function (Blueprint $table) { 
        
            $table->id();
            
            $table->string('FirstName')->nullable();
            $table->string('SecondName')->nullable();
            $table->string('gender')->nullable();
            $table->string('Surname')->nullable();
            $table->string('IDNumber')->nullable();
            $table->string('title')->nullable();
            $table->string('dob')->nullable();

            $table->string('status')->nullable();
            $table->string('HOH')->nullable();
            $table->string('Standtype')->nullable();
            $table->string('address1')->nullable();
            $table->string('dependants')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('wardnum')->nullable();
            $table->string('town')->nullable();
            $table->string('postalcode')->nullable();
            $table->string('suburbs')->nullable();

            $table->string('income')->nullable();
            $table->string('employername')->nullable();
            $table->string('department')->nullable();
            $table->string('emplcontactn')->nullable();
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
        Schema::dropIfExists('applicants');
    }
};
