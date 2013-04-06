<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommentableIdToCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('petersuhm_commentable_comments', function(Blueprint $table)
		{
			$table->integer('commentable_id')->unsigned();
			$table->string('commentable_type');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('petersuhm_commentable_comments', function($table)
		{
			//
		});
	}

}