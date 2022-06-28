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
            $table->id();
            $table->string('title')->nullable();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('password');
            $table->string('account_id')->unique();
            $table->string('company')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('state')->nullable();
            $table->string('zipcode')->nullable();
            $table->foreignId('country_id')->nullable()->constrained();
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('active')->default(\App\Enums\UserStatus::ACTIVE());
            $table->boolean('verified')->default(false);
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
