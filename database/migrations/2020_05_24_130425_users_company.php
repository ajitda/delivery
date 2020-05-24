<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersCompany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_companies', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->string('user_type');

            $table->primary(['user_id', 'company_id', 'user_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_companies');
    }
}
