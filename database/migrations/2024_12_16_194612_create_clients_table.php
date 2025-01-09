<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('phone')->unique();
			$table->string('email');
			$table->string('password');
			$table->date('d_o_b');
			$table->integer('blood_type_id')->unsigned();
			$table->date('last_donation_date');
			$table->integer('city_id');
			$table->integer('pin_code')->nullable();
            $table->boolean('is_active')->default(1);
            $table->rememberToken();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
