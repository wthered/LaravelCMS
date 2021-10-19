<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
    	if( !Schema::hasTable('users')) {
		    Schema::create('users', function (Blueprint $table) {
			    $table->id();
			    $table->string('first_name');
			    $table->string('last_name');
			    $table->string('name')->unique();
			    $table->string('email')->unique();
			    $table->enum('role', ['writer', 'admin'])->default('writer');
			    $table->string('about')->nullable();
			    $table->string('password');
			    $table->rememberToken();
			    $table->ipAddress('registered_from');
			    $table->dateTime('registered_at');
			    $table->timestamp('verified_at')->nullable();
			    $table->timestamps();
		    });
	    }
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
}
