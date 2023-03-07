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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->string('name');
            $table->string('nik')->nullable();
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('file')->nullable();
            $table->text('address')->nullable();
            $table->string('business_field')->nullable();
            $table->integer('graduating_class')->nullable();
            $table->integer('graduation_year')->nullable();
            $table->integer('id_major')->nullable();
            $table->string('job')->nullable();
            $table->tinyInteger('corresponding_major')->nullable();
            $table->string('university')->nullable();
            $table->string('study_program')->nullable();
            $table->string('password');
            $table->tinyInteger('status')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
