<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('petersuhm_commentable_comments', function(Blueprint $table)
		{
			$table->increments('id');

			$table->text('body');
			$table->integer('authorable_id')->unsigned();
			$table->string('authorable_type');
			$table->integer('commentable_id')->unsigned();
			$table->string('commentable_type');

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
		Schema::drop('petersuhm_commentable_comments');
	}

}