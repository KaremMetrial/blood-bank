<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('notification_setting_text')->nullable();
			$table->text('about_app')->nullable();
			$table->string('phone')->nullable();
			$table->string('email')->nullable();
			$table->string('f_link')->nullable();
			$table->string('ins_link')->nullable();
			$table->string('y_link')->nullable();
			$table->string('t_link')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}
